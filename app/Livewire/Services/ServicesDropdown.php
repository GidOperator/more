<?php

namespace App\Livewire\Services;

use App\Models\CategoryPartner;
use Livewire\Component;

class ServicesDropdown extends Component
{
    public string $selectedName = 'Все услуги';

    public function selectCategory($id)
    {
        $referer = request()->header('referer');

        if ($referer && str_contains($referer, '/services')) {
            $this->dispatch('serviceCategorySelected', categoryId: $id)->to(ServicesGrid::class);
        } else {
            $city = request()->route('city_slug') ?? 'tomsk';
            return redirect()->to("/{$city}/services?category={$id}");
        }
    }

    public function render()
    {
        return view('livewire.services.services-dropdown', [
            'categories' => CategoryPartner::whereNull('parent_id')
                ->orderBy('name', 'asc')
                ->get()
        ]);
    }
}
