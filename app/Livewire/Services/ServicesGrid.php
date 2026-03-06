<?php

namespace App\Livewire\Services;

use App\Models\ServicePartner;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Cache;

class ServicesGrid extends Component
{
    public string $view = 'grid';
    public int $amount = 12;
    public ?int $categoryId = null;
    public ?int $subcategoryId = null;

    public function render()
    {
        $cacheKey = "services:grid:"
            . "cat:" . ($this->categoryId ?? 'all') . ":"
            . "sub:" . ($this->subcategoryId ?? 'all') . ":"
            . "amount:{$this->amount}:"
            . "view:{$this->view}";

        $services = Cache::remember($cacheKey, now()->addMinutes(10), function () {
            $query = ServicePartner::with(['category_partner', 'partner.user'])
                ->latest();

            if ($this->subcategoryId) {
                $query->where('sub_category_id', $this->subcategoryId);
            } elseif ($this->categoryId) {
                $query->where('category_partner_id', $this->categoryId);
            }

            return $query
                ->take($this->amount)
                ->get();
        });

        return view('livewire.services.services-grid', [
            'services' => $services
        ]);
    }

    /**
     * Изменение вида отображения (плитка/список)
     */
    #[On('change-services-view')]
    public function changeView(string $view)
    {
        $this->view = $view;
    }

    /**
     * Срабатывает при выборе категории
     */
    #[On('serviceCategorySelected')]
    public function onCategorySelected(int $categoryId)
    {
        $this->categoryId = $categoryId;
        $this->subcategoryId = null;
        $this->resetAmount();
    }

    /**
     * Срабатывает при выборе подкатегории
     */
    #[On('serviceSubcategorySelected')]
    public function onSubcategorySelected(int $subcategoryId)
    {
        $this->subcategoryId = $subcategoryId;
        $this->resetAmount();
    }

    /**
     * Сброс количества выводимых элементов
     */
    protected function resetAmount()
    {
        $this->amount = 12;
    }

    /**
     * Пагинация "Загрузить еще"
     */
    public function loadMore()
    {
        $this->amount += 12;
    }
}
