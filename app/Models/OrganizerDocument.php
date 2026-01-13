<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizerDocument extends Model
{
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
