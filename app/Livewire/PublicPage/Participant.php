<?php

namespace App\Livewire\PublicPage;

use Livewire\Component;

class Participant extends Component
{
    public Participant $participant;

    public function mount(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function render()
    {
        return view('livewire.public-page.participant');
    }
}
