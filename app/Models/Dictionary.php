<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Dictionary extends Model
{
    public function locations(): MorphToMany
    {
        // Первый аргумент — класс модели, с которой связываемся
        // Второй аргумент — имя, которое мы использовали в morphs('dictionable') в миграции
        return $this->morphedByMany(LocationPartner::class, 'dictionable');
    }
}
