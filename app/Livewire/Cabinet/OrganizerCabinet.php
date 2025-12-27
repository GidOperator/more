<?php

namespace App\Livewire\Cabinet;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class OrganizerCabinet extends Component
{
    public $organizer;

    // public function mount()
    //{
    // Берём текущего пользователя
    //     $user = Auth::user();

    // Проверяем есть ли профиль организатора
    //$this->organizer = $user->organizer;

    //    abort_unless($this->organizer, 403); // если нет профиля, доступ запрещён
    //}
    public function render()
    {
        return view('livewire.cabinet.organizer-cabinet')->layout('layouts.app');
    }
}
