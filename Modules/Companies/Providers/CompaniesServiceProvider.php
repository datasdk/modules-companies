<?php

namespace Modules\Companies\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;



use Lecturize\Addresses\Models\Address;
use Module;
use Modules\Companies\Observers\UserAddressObserver;

use App\Models\User;
use Modules\Companies\Models\Companies;

use Modules\Companies\Observers\UserCompanyObserver;

use Modules\Companies\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\Event;
use Modules\Companies\Providers\EventServiceProvider;

use Modules\Companies\Http\Controllers\Api\CompaniesController;
use Illuminate\Support\Facades\Config;
use Modules\Companies\Console\Commands\PurgeOldCompanyApplications;

use Modules\Companies\Observers\CompaniesObserver;
use Widget;


class CompaniesServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Companies';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'companies';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {

        User::observe(UserCompanyObserver::class);
        
        Companies::observe(CompaniesObserver::class);

     

        $this->registerTranslations();

        $this->registerConfig();

        $this->registerViews();
 
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));


        $this->commands([
            \Modules\Companies\Console\Commands\PurgeOldCompanyApplications::class,
            \Modules\Companies\Console\Commands\AssignTeamsToCompaniesCommand::class
        ]);

     
    }



    public function register()
    {

       
        $this->app->register(RouteServiceProvider::class);
        
        $this->app->register(EventServiceProvider::class);
        
        $this->app->register(RelationServiceProvider::class);

 
        Widget::group('dashboard')->position(3)->addWidget(\Modules\Companies\Widgets\DashboardCompanies::class);

    }


    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );


    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
