<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LocationPartner;

class Partner extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locations()
    {
        return $this->belongsToMany(LocationPartner::class);
    }

    public function categories()
    {
        return $this->belongsToMany(CategoryPartner::class, 'category_partner_partner');
    }

    public function services()
    {
        return $this->hasMany(ServicePartner::class);
    }

    public function languages()
    {
        return $this->morphToMany(Language::class, 'languageable');
    }

    public function selectedCategories()
    {
        // Указываем таблицу связи вторым аргументом, так как имя нестандартное
        return $this->belongsToMany(
            \App\Models\CategoryPartner::class,
            'category_partner_partner',
            'partner_id',
            'category_partner_id'
        );
    }
}
