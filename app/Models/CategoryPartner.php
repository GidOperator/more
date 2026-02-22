<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Database\Eloquent\Model;

class CategoryPartner extends Model
{
    public function location_partners(): BelongsToMany
    {
        return $this->belongsToMany(
            LocationPartner::class,
            'category_location_partner',
            'category_partner_id',
            'location_partner_id'
        );
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'category_partner_event', 'category_partner_id', 'event_id');
    }

    public function partners(): BelongsToMany
    {
        // Явно указываем таблицу связи 'category_partner_partner'
        return $this->belongsToMany(
            Partner::class,
            'category_partner_partner',
            'category_partner_id',
            'partner_id'
        );
    }

    public function service_partners()
    {
        return $this->hasMany(ServicePartner::class);
    }
}
