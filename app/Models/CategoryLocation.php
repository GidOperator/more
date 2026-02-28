<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryLocation extends Model
{
    // У одной категории (например, "Еда") много типов ("Ресторан", "Кафе")
    public function category_location_types(): HasMany
    {
        return $this->hasMany(CategoryLocationType::class);
    }
}
