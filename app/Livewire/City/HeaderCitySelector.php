<?php

namespace App\Livewire\City;

use Livewire\Component;
use App\Models\City;
use Illuminate\Support\Facades\Session;

class HeaderCitySelector extends Component
{
    public $search = '';
    public $currentCityName;
    public $showConfirm = false;
    public $detectedCity = null;

    public function mount()
    {
        $this->currentCityName = session('selected_city_name', 'Выберите город');

        $detectedCityName = session('detected_city_name');
        $detectedCitySlug = session('detected_city_slug');
        $cityConfirmed    = session('city_confirmed', false);

        // Проверяем наше Flash-сообщение
        $forceConfirm = session()->has('force_confirm');

        //dd($detectedCityName, $detectedCitySlug, $cityConfirmed, $forceConfirm);
        // Логика показа
        if ($detectedCityName && (!$cityConfirmed || $forceConfirm)) {
            $this->showConfirm = true;
            $this->detectedCity = [
                'name' => $detectedCityName,
                'slug' => $detectedCitySlug,
            ];
        }
    }

    /**
     * Подтверждение города
     */
    public function confirmCity()
    {
        if (!$this->detectedCity || empty($this->detectedCity['name'])) {
            return;
        }

        $this->selectCity($this->detectedCity['name']);
    }

    /**
     * Отклонение предложения — показываем модалку
     */
    public function declineCity()
    {
        // Отмечаем, что город подтвержден (чтобы плашка больше не показывалась)
        Session::put('city_confirmed', true);
        $this->showConfirm = false;
        $this->detectedCity = null;

        // Триггер фронтенду для открытия модалки выбора города
        $this->dispatch('open-city-modal');
    }

    /**
     * Результаты поиска городов
     */
    public function getResultsProperty()
    {
        $searchTerm = trim($this->search);
        if (mb_strlen($searchTerm) < 2) {
            return [];
        }

        return City::where('name', 'ILIKE', $searchTerm . '%')
            ->orderBy('population', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Выбор города и запись в сессию
     */
    public function selectCity($cityName)
    {
        $city = City::where('name', 'ILIKE', trim($cityName))->first();

        if (!$city) {
            $city = City::where('slug', 'moskva')->first() ?? City::first();
        }

        Session::put('selected_city_id', $city->id);
        Session::put('selected_city_name', $city->name);
        Session::put('selected_city_slug', $city->slug);
        Session::put('city_confirmed', true);
        Session::save();

        // Обновляем текущий заголовок города
        $this->currentCityName = $city->name;

        // Перенаправление на роут города
        return redirect()->route('events.index', ['city_slug' => $city->slug]);
    }

    public function render()
    {
        return view('livewire.city.header-city-selector');
    }
}
