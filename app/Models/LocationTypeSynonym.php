<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationTypeSynonym extends Model
{
    // Модель LocationTypeSynonym
    public function categoryLocationType()
    {
        return $this->belongsTo(CategoryLocationType::class);
    }
}
