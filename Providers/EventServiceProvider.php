<?php

namespace Modules\Companies\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Companies\Events\UserEvent;

// Importer nødvendige klasser
use App\Models\User;
use Modules\Companies\Models\Companies;
use Modules\Companies\Observers\UserCompanyObserver;
use Modules\Companies\Observers\CompaniesObserver;


class EventServiceProvider extends ServiceProvider
{
 

    protected $listen = [
        // ... din eksisterende $listen array ...
        "store.users" => [
         //   \Modules\Companies\Listeners\UserListener::class
        ],
    ];

    /**
     * Register any events for your module.
     *
     * @return void
     */
    public function boot(): void
    {
        // Du behøver IKKE længere at kalde $model->observe() her, 
        // da det håndteres automatisk af Laravel via $observers array'et.
        parent::boot(); 
    }
}