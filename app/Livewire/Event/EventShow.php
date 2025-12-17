<?php

namespace App\Livewire\Event;

use Livewire\Component;
use App\Models\Event;

class EventShow extends Component
{

    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.event.event-show')->layout('layouts.app');
    }
}
