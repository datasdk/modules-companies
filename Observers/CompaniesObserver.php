<?php

namespace Modules\Companies\Observers;

use Modules\Companies\Models\Companies;
use Modules\Teams\Models\Team;
use Spatie\Permission\Models\Role;

class CompaniesObserver
{


    public function retrieved(Companies $company)
    {
     
        $this->ensureCompanyHasTeam($company);

    }


    /**
     * Handle the Companies "created" event.
     */
    public function created(Companies $company): void
    {

        $this->ensureCompanyHasTeam($company);

    }

    /**
     * Handle the Companies "updated" event.
     */
    public function saved(Companies $company): void
    {

        $this->ensureCompanyHasTeam($company);

    }

    /**
     * Handle the Companies "deleted" event.
     */
    public function deleted(Companies $company): void
    {

        if ($company->team()->exists()) {

            $company->team()->delete();

        }

    }

    /**
     * 🔒 Sikrer, at virksomheden har et tilknyttet team.
     * Hvis der er members med 'owner'-rolle, sættes den første som team owner.
     */
    private function ensureCompanyHasTeam(Companies $company): void
    {

        if(empty($company->vat)){

            return;
        }


        $company->ensureHasTeam();

        

    }

}
