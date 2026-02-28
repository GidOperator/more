<?php

namespace App\Livewire\Location;

use Livewire\Component;
use App\Models\CategoryLocation;

class LocationDropdown extends Component
{
    public function selectCategory($id)
    {
        // Получаем реальный URL страницы из браузера через заголовок Referer
        $referer = request()->header('referer');

        // Проверяем, есть ли слово "locations" в этом адресе
        if ($referer && str_contains($referer, '/locations')) {

            $this->dispatch('category-location-selected', categoryId: $id)->to(LocationGrid::class);
        } else {

            // Мы на другой странице (например, события) — делаем редирект
            $city = request()->route('city_slug') ?? 'tomsk';
            return redirect()->to("/{$city}/locations?category={$id}");
        }
    }


    public function render()
    {
        return view('livewire.location.location-dropdown', [
            'categories' => CategoryLocation::orderBy('name', 'asc')->get()
        ]);
    }
}
