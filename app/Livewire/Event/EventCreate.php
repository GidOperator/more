<?php

namespace App\Livewire\Event;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Event;
use App\Models\Video;
use App\Models\CategoryPartner;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class EventCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $description = '';
    public $start_at;
    public $end_at;
    public $price;
    public $price_from = false;
    public $has_discount = false;
    public $discount_type = 'percent';
    public $discount_value;

    public array $categories = [];
    public $subcategory_id;
    public $showCategories = false; // Связано с Alpine через entangle
    public $openCategoryId = null;  // Связано с Alpine через entangle

    public $city_id;
    public $address;
    public $max_participants = 0;
    public array $partner_categories = [];
    public Collection $partnerCategories;

    public $media = [];
    public array $videos = [];

    protected $rules = [
        'title' => 'required|string|max:255',
        'start_at' => 'required',
        'end_at' => 'required|after_or_equal:start_at',
        'description' => 'required|string',
        'subcategory_id' => 'required|exists:sub_categories,id',
        'city_id' => 'required|exists:cities,id',
        'address' => 'required|string',
        'price' => 'required|numeric|min:0',
        'media.*' => 'nullable|image|max:10240',
    ];

    public function mount()
    {
        $organizer = auth()->user()->organizer;
        $mySubCategoryIds = $organizer->subCategories()->pluck('sub_categories.id')->toArray();

        // Загружаем дерево только с подкатегориями организатора
        $this->categories = Category::with(['subcategories' => function ($q) use ($mySubCategoryIds) {
            $q->whereIn('id', $mySubCategoryIds);
        }])
            ->whereHas('subcategories', function ($q) use ($mySubCategoryIds) {
                $q->whereIn('id', $mySubCategoryIds);
            })
            ->get()
            ->toArray();

        // Авто-раскрытие, если категория всего одна
        if (count($this->categories) === 1) {
            $this->showCategories = true;
            $this->openCategoryId = $this->categories[0]['id'];
            if (count($this->categories[0]['subcategories']) === 1) {
                $this->subcategory_id = $this->categories[0]['subcategories'][0]['id'];
            }
        }

        $this->partnerCategories = CategoryPartner::all();
    }

    #[On('citySelected')]
    public function updateCity($cityId)
    {
        $this->city_id = $cityId;
    }

    #[On('addressUpdated')]
    public function updateAddress($address)
    {
        $this->address = $address;
    }

    public function save()
    {
        $this->validate();

        $sub = SubCategory::findOrFail($this->subcategory_id);

        $event = Event::create([
            'name'             => $this->title,
            'description'      => $this->description,
            'slug'             => Str::slug($this->title) . '-' . uniqid(),
            'address'          => $this->address,
            'city_id'          => $this->city_id,
            'date_start'       => date('Y-m-d', strtotime($this->start_at)),
            'date_end'         => date('Y-m-d', strtotime($this->end_at)),
            'time_start'       => date('H:i', strtotime($this->start_at)),
            'time_end'         => date('H:i', strtotime($this->end_at)),
            'price'            => $this->price,
            'price_from'       => $this->price_from,
            'has_discount'     => $this->has_discount,
            'discount_type'    => $this->discount_type,
            'discount_value'   => $this->discount_value,
            'max_participants' => $this->max_participants,
            'category_id'      => $sub->category_id,
            'sub_category_id'  => $this->subcategory_id,
            'organizer_id'     => auth()->user()->organizer->id,
        ]);

        if ($this->media) {
            foreach ($this->media as $file) {
                $event->images()->create([
                    'path' => $file->store('events', 'public'),
                    'alt' => $this->title,
                    'title' => $this->title,
                ]);
            }
        }

        foreach ($this->videos as $url) {
            if ($url) Video::create(['event_id' => $event->id, 'url' => $url]);
        }

        if (!empty($this->partner_categories)) {
            $event->partnerCategories()->sync($this->partner_categories);
        }

        session()->flash('success', 'Событие создано!');
        return redirect()->route('cabinet.organizer');
    }

    public function render()
    {
        return view('livewire.event.event-create')->layout('layouts.app');
    }
}
