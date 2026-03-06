<?php

namespace App\Livewire\Partner;

use Livewire\Component;
use App\Models\Partner;
use App\Models\City;

class PartnerGrid extends Component
{
    public $city_slug;
    public $selectedCategoryId = null;
    protected $listeners = ['category-partner-selected' => 'filterByCategory'];


    public function mount($city_slug)
    {
        $this->city_slug = $city_slug;
        $this->selectedCategoryId = request()->query('category');
    }

    public function filterByCategory($categoryId)
    {
        $this->selectedCategoryId = $categoryId;
    }

    public function render()
    {
        // 1. Начинаем с Query Builder, а не с get()
        $partnersQuery = Partner::query();

        // 2. Если категория выбрана, фильтруем
        if ($this->selectedCategoryId) {
            $partnersQuery->whereHas('categories', function ($query) {
                // Здесь мы указываем ID категории из таблицы category_partners
                $query->where('category_partners.id', $this->selectedCategoryId);
            });
        }

        // 3. Добавляем сортировку по имени и выполняем запрос
        $partners = $partnersQuery->orderBy('company_name', 'asc')->get();

        return view('livewire.partner.partner-grid', [
            'partners' => $partners
        ]);
    }
}
