<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Cache;

class EventGrid extends Component
{
    public string $view = 'grid';
    public int $amount = 12;
    public ?int $categoryId = null;
    public ?int $subcategoryId = null;
    public ?string $citySlug = null;

    public function mount()
    {
        // Берем slug напрямую из параметров текущего роута
        $this->citySlug = request()->route('city_slug');
    }
    public function render()
    {
        //dd($this->citySlug);

        $cacheKey = "events:grid:"
            . "city:{$this->citySlug}:"
            . "cat:{$this->categoryId}:"
            . "sub:{$this->subcategoryId}:"
            . "amount:{$this->amount}";

        $events = Cache::remember($cacheKey, now()->addMinutes(5), function () {

            $query = Event::with(['images', 'category', 'subCategory', 'organizer', 'city'])
                ->latest();


            // ФИЛЬТРАЦИЯ ПО ГОРОДУ
            if ($this->citySlug) {
                $query->whereHas('city', function ($q) {
                    $q->where('slug', $this->citySlug);
                });
            }

            // ФИЛЬТРАЦИЯ ПО КАТЕГОРИЯМ
            if ($this->subcategoryId) {
                $query->where('sub_category_id', $this->subcategoryId);
            } elseif ($this->categoryId) {
                $query->where('category_id', $this->categoryId);
            }

            return $query
                ->take($this->amount)
                ->get();
        });

        return view('livewire.event.event-grid', [
            'events' => $events
        ]);
    }

    #[On('change-view')]
    public function changeView(string $view)
    {
        $this->view = $view;
    }

    #[On('categorySelected')]
    public function onCategorySelected(int $categoryId)
    {
        $this->categoryId = $categoryId;
        $this->subcategoryId = null;

        $this->resetAmount();
    }

    #[On('subcategorySelected')]
    public function onSubcategorySelected(int $subcategoryId)
    {
        $this->subcategoryId = $subcategoryId;

        $this->resetAmount();
    }

    protected function resetAmount()
    {
        $this->amount = 12;
    }



    public function loadMore()
    {
        //$this->amount += 12;
        //$this->dispatch('loaded');
    }
}
