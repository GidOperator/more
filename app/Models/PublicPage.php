<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PublicPage extends Model
{
    public function pageable(): MorphTo
    {
        return $this->morphTo();
    }
}
