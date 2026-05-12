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
