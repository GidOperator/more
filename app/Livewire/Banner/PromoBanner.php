<?php

namespace App\Livewire\Banner;

use Livewire\Component;

class PromoBanner extends Component
{
    public $title;
    public $image;
    public $link;
    public $viewType; // 'button' или 'link'

    public function mount($title, $image, $link, $viewType = 'button')
    {
        $this->title = $title;
        $this->image = $image;
        $this->link = $link;
        $this->viewType = $viewType;
    }

    public function render()
    {
        return view('livewire.banner.promo-banner');
    }
}
