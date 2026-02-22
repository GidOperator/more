<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\ServicePartner;
use Illuminate\Support\Facades\Auth;

class Services extends Component
{

    public function createService()
    {
        return redirect()->route('services.create');
    }

    public function createLocation()
    {
        return redirect()->route('location.create');
    }

    public function deleteService($id)
    {
        $service = ServicePartner::where('partner_id', Auth::user()->partner->id)->findOrFail($id);
        $service->delete();

        session()->flash('message', 'Услуга удалена');
    }

    public function render()
    {
        return view('livewire.dashboard.services', [
            // Получаем только услуги этого партнера
            'services' => ServicePartner::where('partner_id', Auth::user()->partner->id)
                ->latest()
                ->get()
        ]);
    }
}
