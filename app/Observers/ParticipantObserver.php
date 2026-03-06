<?php

namespace App\Observers;

use App\Models\Participant;
use App\Models\PublicPage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ParticipantObserver
{
    public function created(Participant $participant): void
    {
        // Пишем в storage/logs/laravel.log
        Log::info('Observer triggered for Participant ID: ' . $participant->id);

        $participant->load('user');

        $name = ($participant->user->name ?? 'participant') . ' ' . ($participant->user->surname ?? '');
        $slug = Str::slug($name);

        // Уникальность слаг-строки
        if (PublicPage::where('slug', $slug)->exists()) {
            $slug .= '-' . $participant->id;
        }

        // Создаем страницу
        $participant->publicPage()->create([
            'slug' => $slug,
            'title' => trim($name),
            'is_published' => true,
        ]);
    }
}
