<?php


namespace App\Livewire\Services;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ServicePartner;
use Illuminate\Support\Facades\Auth;

class ServiceCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $category_id;
    public $location_type = 'fixed';

    public $address_id;
    public $description;
    public $min_people = 1;
    public $max_people = 1;
    public $price;
    public $is_price_from = false;
    public $photos = [];

    protected $rules = [
        'title' => 'required|min:3',
        'category_id' => 'required',
        'description' => 'required',
        'min_people' => 'required|numeric|min:1',
        'max_people' => 'required|numeric|min:1|gte:min_people',
        'price' => 'required|numeric',
        'is_price_from' => 'required|boolean',
        'photos.*' => 'image|max:2048', // Валидация каждого фото
    ];

    public function save()
    {
        $this->validate();

        $slug = \Illuminate\Support\Str::slug($this->title);
        // Логика сохранения (пример)
        $service = ServicePartner::create([
            'partner_id' => Auth::user()->partner->id,
            'name' => $this->title,
            'slug' => $slug,
            'category_partner_id' => $this->category_id,
            'description' => $this->description,
            'min_people' => $this->min_people,
            'max_people' => $this->max_people,
            'price' => $this->price,
            'is_price_from' => $this->is_price_from,
            'location_partners_id' => $this->address_id,
        ]);

        // Сохранение фото (если есть связь в БД)
        // foreach($this->photos as $photo) { ... }

        return redirect()->route('cabinet.partner')->with('success', 'Услуга создана!');
    }

    public function render()
    {
        $user = Auth::user();
        $partner = $user->partner;

        return view('livewire.services.service-create', [
            // Загружаем только те категории, которые привязаны к партнеру
            'categories' => $partner
                ? $partner->selectedCategories
                : collect([]),

            'myAddresses' => $partner
                ? $partner->addresses
                : []
        ])->layout('layouts.app');
    }
}
