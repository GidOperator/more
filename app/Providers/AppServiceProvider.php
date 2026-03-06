<?php

namespace App\Providers;

use App\Models\Organizer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Models\Participant;
use App\Models\Partner;
use App\Observers\ParticipantObserver;
use App\Observers\OrganizerObserver;
use App\Observers\PartnerObserver;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Participant::observe(ParticipantObserver::class);
        Organizer::observe(OrganizerObserver::class);
        Partner::observe(PartnerObserver::class);
    }
}
