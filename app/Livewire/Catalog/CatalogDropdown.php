<?php

namespace App\Livewire\Catalog;

use Livewire\Component;
use App\Models\Category;

class CatalogDropdown extends Component
{
    public $categories;
    public $selectedCategory = null;
    public $selectedSubcategory = null;
    public $expandedCategories = [];
    public $showMenu = false; // Меню закрыто по умолчанию

    public function mount()
    {
        $this->categories = Category::with('subcategories')->get();
    }

    public function toggleCategory($categoryId)
    {
        if (in_array($categoryId, $this->expandedCategories)) {
            $this->expandedCategories = array_diff($this->expandedCategories, [$categoryId]);
        } else {
            $this->expandedCategories[] = $categoryId;
        }

        $this->selectedCategory = $categoryId;
        $this->selectedSubcategory = null;
    }

    public function selectSubcategory($subcategoryId)
    {
        $this->selectedSubcategory = $subcategoryId;
    }

    public function render()
    {
        return view('livewire.catalog.catalog-dropdown');
    }
}
