<?php

namespace App\Livewire\Location;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\LocationPartner;

class LocationGrid extends Component
{

    public ?int $categoryId = null;

    // Срабатывает при инициализации
    public function mount()
    {
        $this->categoryId = request()->query('categoryId');
    }

    // Слушаем событие выбора категории из dropdown
    #[On('category-location-selected')]
    public function updateCategory($categoryId)
    {
        $this->categoryId = $categoryId;

        // Вручную перенаправляем на тот же URL с новым параметром
        return $this->redirect(route('locations.index', [
            'city_slug' => request()->route('city_slug'),
            'category' => $categoryId
        ]), navigate: true);
    }

    public function render()
    {
        // Фильтруем локации
        $locations = LocationPartner::query()
            ->with(['images', 'location_type'])
            ->when($this->categoryId, function ($query) {
                // Фильтруем по ID основной категории (CategoryLocation)
                $query->whereHas('location_type', function ($q) {
                    $q->where('category_location_id', $this->categoryId);
                });
            })
            ->get();

        return view('livewire.location.location-grid', [
            'locations' => $locations
        ]);
    }
}
