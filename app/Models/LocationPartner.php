<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LocationPartner extends Model
{


    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function images()
    {
        // Указываем связь «один ко многим» полиморфно
        return $this->morphMany(Image::class, 'imageable')->orderBy('sort');
    }

    // Полезный помощник для получения главного фото
    public function mainImage()
    {
        return $this->morphOne(Image::class, 'imageable')->orderBy('sort')->limit(1);
    }

    public function service_partners()
    {
        return $this->hasMany(ServicePartner::class);
    }

    public function location_type(): BelongsTo
    {
        return $this->belongsTo(CategoryLocationType::class, 'category_location_type_id');
    }

    public function suitable_event_types(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'location_subcategory_event', 'location_partner_id', 'sub_category_id')
            ->withTimestamps();
    }
}
