<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Favorites extends Component
{
    public function render()
    {
        $favorites = Auth::user()->favorites()
            ->with('favoritable')
            ->latest()
            ->paginate(12);

        return view('livewire.dashboard.favorites', [
            'favorites' => $favorites
        ])->layout('layouts.app');
    }
}
