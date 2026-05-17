<<<<<<< HEAD
<?php

namespace Modules\Companies\Console\Commands;

use Illuminate\Console\Command;
use Modules\Companies\Models\CompanyApplication;
use Carbon\Carbon;

class PurgeOldCompanyApplications extends Command
{

    protected $signature = 'companies:purge-old-applications';
    protected $description = 'Fjerner alle company applications ældre end 60 dage, hvor validated_at er null';


    public function handle()
    {


        $dateThreshold = Carbon::now()->subDays(60);

        $applications = CompanyApplication::whereNull('validated_at')
            ->where('created_at', '<', $dateThreshold)
            ->get();

        $count = $applications->count();


        if ($count === 0) {
            $this->info('Ingen gamle ansøgninger at slette.');
            return 0;
        }


        foreach ($applications as $application) {
            $application->delete();
        }


        $this->info("Slettet $count gamle ansøgninger.");

        return 0;

    }

}
=======
<?php

namespace Modules\Companies\Console\Commands;

use Illuminate\Console\Command;
use Modules\Companies\Models\CompanyApplication;
use Carbon\Carbon;

class PurgeOldCompanyApplications extends Command
{

    protected $signature = 'companies:purge-old-applications';
    protected $description = 'Fjerner alle company applications ældre end 60 dage, hvor validated_at er null';


    public function handle()
    {


        $dateThreshold = Carbon::now()->subDays(60);

        $applications = CompanyApplication::whereNull('validated_at')
            ->where('created_at', '<', $dateThreshold)
            ->get();

        $count = $applications->count();


        if ($count === 0) {
            $this->info('Ingen gamle ansøgninger at slette.');
            return 0;
        }


        foreach ($applications as $application) {
            $application->delete();
        }


        $this->info("Slettet $count gamle ansøgninger.");

        return 0;

    }

}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
