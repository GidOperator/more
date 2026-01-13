<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function organizers()
    {
        return $this->morphedByMany(Organizer::class, 'languageable');
    }
    public function partners()
    {
        return $this->morphedByMany(Partner::class, 'languageable');
    }
    public function participants()
    {
        return $this->morphedByMany(Participant::class, 'languageable');
    }
}
