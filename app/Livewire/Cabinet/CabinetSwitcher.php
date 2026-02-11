<?php

namespace App\Livewire\Cabinet;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CabinetSwitcher extends Component
{
    public $activeCabinet;

    public function mount()
    {
        // Берем ID из сессии или первую доступную роль пользователя
        $this->activeCabinet = session('active_cabinet') ?? (Auth::user()->roles->first()?->id);
    }

    #[On('roles-updated')]
    public function refreshRoles()
    {
        // Метод может быть пустым. 
        // Когда событие прилетит, Livewire сам вызовет render() 
        // и перечитает Auth::user()->roles из базы.
    }

    public function switchCabinet($value)
    {
        if ($value === 'go_to_settings') {
            return redirect()->route('dashboard');
        }

        $cabinetId = (int) $value;

        // Проверяем, что роль реально принадлежит юзеру
        if (Auth::user()->roles->contains('id', $cabinetId)) {
            $this->activeCabinet = $cabinetId;
            session(['active_cabinet' => $cabinetId]);

            $route = match ($cabinetId) {
                2 => route('cabinet.organizer'),
                1 => route('cabinet.participant'),
                3 => route('cabinet.partner'),
                default => route('cabinet.participant'),
            };

            return redirect($route);
        }
    }

    public function render()
    {
        return view('livewire.cabinet.cabinet-switcher', [
            // Передаем только подключенные роли из базы
            'userRoles' => Auth::user()->roles
        ]);
    }
}
