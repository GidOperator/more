<?php

namespace App\Livewire\Location;

use App\Models\Category;
use App\Models\CategoryLocationType;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Dictionary;
use App\Models\CategoryPartner;
use App\Models\LocationPartner;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class LocationCreate extends Component
{
    use WithFileUploads;

    // Поля формы
    public $title;
    public $description = '';
    public $type;
    public $phone;
    public $city_id;
    public $address;
    public $latitude;
    public $longitude;
    public $is_confirmed = false;
    public array $categories = [];
    public $photos = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'type' => 'required',
        'description' => 'required|string|min:10',
        'phone' => 'required|string',
        'city_id' => 'required|exists:cities,id',
        'address' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'categories' => 'required|array|min:1',
        'is_confirmed' => 'accepted',
        'photos.*' => 'image|max:10240', // 10MB max

    ];

    protected $messages = [
        'is_confirmed.accepted' => 'Необходимо подтвердить достоверность данных',
        'categories.required' => 'Выберите хотя бы одну категорию',
        'latitude.required' => 'Выберите адрес из выпадающего списка подсказок',
    ];

    #[On('citySelected')]
    public function updateCity($cityId)
    {
        $this->city_id = $cityId;
    }

    #[On('addressUpdated')]
    public function updateAddress($address, $lat = null, $lng = null)
    {
        // Обработка данных как массива или отдельных аргументов
        if (is_array($address)) {
            $this->address = $address['address'] ?? $this->address;
            $this->latitude = $address['lat'] ?? null;
            $this->longitude = $address['lng'] ?? null;
        } else {
            $this->address = $address;
            $this->latitude = $lat;
            $this->longitude = $lng;
        }

        $this->resetValidation(['address', 'latitude', 'longitude']);
    }


    public function save()
    {
        //dd($this->all());
        $this->validate();

        // 1. Создаем основную запись локации
        // Убираем 'type_id' отсюда, так как типы теперь в сводной таблице (morphToMany)
        $location = LocationPartner::create([
            'name'       => $this->title,
            'slug'        => Str::slug($this->title) . '-' . uniqid(),
            'description' => $this->description,
            'phone'       => $this->phone,
            'address'     => $this->address,
            'city_id'     => $this->city_id,
            'latitude'    => $this->latitude,
            'longitude'   => $this->longitude,
            'partner_id' => auth()->user()->partner->id,
            'category_location_type_id' => $this->type,
        ]);


        if (!empty($this->categories)) {
            $location->suitable_event_types()->sync($this->categories);
        }

        // Сохраняем фотографии (MorphMany)
        if ($this->photos) {
            foreach ($this->photos as $index => $photo) {
                $path = $photo->store('locations', 'public');
                $location->images()->create([
                    'path' => $path,
                    'alt'  => $this->title,
                    'sort' => $index,
                ]);
            }
        }

        session()->flash('success', 'Локация успешно создана!');
        return redirect()->route('cabinet.partner');
    }

    public function render()
    {
        return view('livewire.location.location-create', [
            'allTypes' => CategoryLocationType::all(),
            'allCategories' => SubCategory::orderBy('name', 'asc')->get()
        ])->layout('layouts.app');
    }
}
