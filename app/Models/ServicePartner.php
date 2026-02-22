<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePartner extends Model
{

    public function partner()
    {
        return $this->belongsTo(Partner::class);
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

    public function category_partner()
    {
        return $this->belongsTo(CategoryPartner::class);
    }

    public function location_partner()
    {
        return $this->belongsTo(LocationPartner::class);
    }
}
