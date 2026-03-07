<?php

namespace App\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class EventCard extends Component
{
    public Event $event;
    public string $view; // Тип вида: 'grid' или 'list'
    public bool $isFavorite = false;

    public function mount(Event $event, string $view)
    {
        $this->event = $event;
        $this->view = $view;

        // Проверяем, есть ли событие в избранном у пользователя
        $this->isFavorite = auth()->check() &&
            auth()->user()->favorites()
            ->where('favoritable_id', $this->event->id)
            ->where('favoritable_type', Event::class)
            ->exists();
    }

    public function toggleFavorite()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($this->isFavorite) {
            $user->favorites()
                ->where('favoritable_id', $this->event->id)
                ->where('favoritable_type', Event::class)
                ->delete();
        } else {
            $user->favorites()->create([
                'favoritable_id' => $this->event->id,
                'favoritable_type' => Event::class,
            ]);
        }

        $this->isFavorite = !$this->isFavorite;
    }

    public function render()
    {
        return view('livewire.event.event-card');
    }
}
