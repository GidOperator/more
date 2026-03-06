<?php

namespace App\Observers;

use App\Models\Organizer;
use App\Models\PublicPage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class OrganizerObserver
{
    public function created(Organizer $organizer): void
    {
        Log::info('OrganizerObserver triggered for Organizer ID: ' . $organizer->id);

        // Используем имя организации или fallback
        $name = $organizer->name ?? ('Organizer ' . $organizer->id);

        // Генерируем уникальный слаг
        $slug = Str::slug($name);

        // Если слаг занят, добавляем ID
        if (PublicPage::where('slug', $slug)->exists()) {
            $slug .= '-' . $organizer->id;
        }

        // Создаем публичную страницу полиморфно
        $organizer->publicPage()->create([
            'slug' => $slug,
            'title' => $name,
            'is_published' => true,
        ]);

        Log::info('PublicPage created for Organizer ID: ' . $organizer->id);
    }
}
