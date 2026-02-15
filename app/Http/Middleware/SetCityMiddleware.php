<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\City;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class SetCityMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Извлекаем слаг из URL
        $urlSlug = $request->route('city_slug');

        if ($urlSlug) {
            $city = City::where('slug', $urlSlug)->first();

            if ($city) {
                // Если в сессии город другой или его нет — обновляем сессию
                // ВАЖНО: confirmed всегда false здесь, чтобы плашка могла появиться
                if (session('selected_city_slug') !== $city->slug) {
                    $this->updateSessionCity($city, false);
                }

                URL::defaults(['city_slug' => $city->slug]);
                return $next($request);
            }
        }

        // 2. Если в URL слага нет, пробуем взять из сессии выбранный ранее
        $selectedSlug = session('selected_city_slug');
        if ($selectedSlug) {
            URL::defaults(['city_slug' => $selectedSlug]);
        }

        // 3. Если город вообще не определен (даже по IP) — идем в DaData
        if (!session()->has('selected_city_id') && !session()->has('detected_city_id')) {
            $this->detectCityByIp($request);
        }

        // 4. Установка URL по умолчанию из определенных данных, если выбранных нет
        if (!session()->has('selected_city_slug') && session()->has('detected_city_slug')) {
            URL::defaults(['city_slug' => session('detected_city_slug')]);
        }

        return $next($request);
    }

    /**
     * Определение города через API DaData
     */
    private function detectCityByIp(Request $request)
    {
        $ip = $request->ip();

        // Заглушка для локальной разработки
        if (in_array($ip, ['127.0.0.1', '::1', '172.19.0.1', '127.19.0.1'])) {
            $ip = '5.165.212.230'; // Томск
        }

        try {
            $token = config('services.dadata.token');
            if (!$token) return;

            $response = Http::withHeaders(['Authorization' => 'Token ' . $token])
                ->timeout(3)
                ->get("https://suggestions.dadata.ru/suggestions/api/4_1/rs/iplocate/address?ip=" . $ip);

            if ($response->successful()) {
                $location = $response->json()['location'] ?? null;
                $cityName = $location['data']['city'] ?? null;

                if ($cityName) {
                    $city = City::where('name', 'ILIKE', $cityName)->first();
                    if ($city) {
                        session([
                            'detected_city_id'   => $city->id,
                            'detected_city_name' => $city->name,
                            'detected_city_slug' => $city->slug,
                        ]);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('City detect error: ' . $e->getMessage());
        }
    }

    /**
     * Запись города в сессию (выбранного пользователем или из URL)
     */
    private function updateSessionCity($city, $confirmed = false)
    {
        session([
            'selected_city_id'   => $city->id,
            'selected_city_name' => $city->name,
            'selected_city_slug' => (string) $city->slug, // Явно приводим к строке
        ]);

        if ($confirmed) {
            session(['city_confirmed' => true]);
        }

        session()->save();
    }
}
