<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryLocationType extends Model
{

    public function category_location(): BelongsTo
    {
        return $this->belongsTo(CategoryLocation::class);
    }

    public function synonyms()
    {
        return $this->hasMany(LocationTypeSynonym::class);
    }
}
