<?php

<<<<<<< HEAD
namespace Modules\Companies\Providers;
=======
namespace Modules\Posts\Providers;
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Modules\Posts\Models\Posts;
use Modules\Posts\Policies\Policy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Posts::class => Policy::class,
    ];
   
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(){
        

        $this->registerPolicies();


    }

}
