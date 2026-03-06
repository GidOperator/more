<?php

namespace App\Livewire\PublicPage;

use App\Models\PublicPage;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class ShowPage extends Component
{
    public $slug;
    public $city_slug;

    public function mount($slug)
    {
        dd($slug);
        $this->slug = $slug;
        $this->city_slug = Route::current()->parameter('city_slug');
    }

    public function render()
    {
        $page = PublicPage::where('slug', $this->slug)
            ->where('is_published', true)
            ->firstOrFail();

        $model = $page->pageable;

        $type = strtolower(class_basename($page->pageable_type));

        return view('livewire.public-page.show-page', [
            'page' => $page,
            'model' => $model,
            'type' => $type
        ])->layout('layouts.app');
    }
}
