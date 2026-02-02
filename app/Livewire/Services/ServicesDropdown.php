<?php

namespace App\Livewire\Services;

use App\Models\CategoryPartner;
use Livewire\Component;

class ServicesDropdown extends Component
{
    public function render()
    {
        return view('livewire.services.services-dropdown', [
            'categories' => CategoryPartner::whereNull('parent_id')->get()
        ]);
    }
}
