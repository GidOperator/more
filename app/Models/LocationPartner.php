<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class LocationPartner extends Model
{


    public function parther()
    {
        return $this->belongsTo(Partner::class);
    }

    public function category_partners()
    {
        return $this->belongsToMany(
            CategoryPartner::class,
            'category_location_partner', // Имя твоей новой сводной таблицы
            'location_partner_id',       // Ключ этой модели в сводной таблице
            'category_partner_id'        // Ключ категорий в сводной таблице
        );
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

    public function locationTypes(): MorphToMany
    {
        // 'dictionable' — это название из миграции ($table->morphs('dictionable'))
        return $this->morphToMany(Dictionary::class, 'dictionable');
    }
}
