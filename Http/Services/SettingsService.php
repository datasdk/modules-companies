<<<<<<< HEAD
<?php

namespace Modules\Companies\Http\Services;

use Modules\Companies\Models\Companies;

class SettingsService
{
    public function set(Companies $company, $settings = null)
    {

        if($settings){
            
            $company->settings()->set($settings);
        }

    }
}
=======
<?php

namespace Modules\Companies\Http\Services;

use Modules\Companies\Models\Companies;

class SettingsService
{
    public function set(Companies $company, $settings = null)
    {

        if($settings){
            
            $company->settings()->set($settings);
        }

    }
}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
