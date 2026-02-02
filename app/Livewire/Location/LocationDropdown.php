<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\CategoryLocation;

class LocationDropdown extends Component
{
    public function render()
    {
        return view('livewire.location.location-dropdown', [
            'categories' => CategoryLocation::orderBy('name', 'asc')->get()
        ]);
    }
}
