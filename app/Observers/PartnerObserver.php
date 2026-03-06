<?php


namespace App\Observers;

use App\Models\Partner;
use App\Models\PublicPage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PartnerObserver
{
    public function created(Partner $partner): void
    {
        Log::info('PartnerObserver triggered for Partner ID: ' . $partner->id);

        // Используем имя компании или fallback
        $name = $partner->company_name ?? ('Partner ' . $partner->id);

        // Генерируем слаг на основе имени компании
        $slug = Str::slug($name);

        // Если слаг занят, добавляем ID для уникальности
        if (PublicPage::where('slug', $slug)->exists()) {
            $slug .= '-' . $partner->id;
        }

        // Создаем публичную страницу полиморфно
        $partner->publicPage()->create([
            'slug' => $slug,
            'title' => $name,
            'is_published' => true,
        ]);

        Log::info('PublicPage created for Partner ID: ' . $partner->id);
    }
}
