<<<<<<< HEAD
<?php

namespace Modules\Companies\Console\Commands;

use Illuminate\Console\Command;
use Modules\Companies\Models\Companies;
use Modules\Teams\Models\Team;

class AssignTeamsToCompaniesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teams:assign-companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tildel teams til alle virksomheder, som ikke har et team endnu.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {


        $companiesWithoutTeam = Companies::doesntHave('team')->get();


        if ($companiesWithoutTeam->isEmpty()) {

            $this->info('Alle virksomheder har allerede et team ✅');

            return Command::SUCCESS;

        }


        $this->info('Opretter teams for virksomheder uden team...');

        $bar = $this->output->createProgressBar( $companiesWithoutTeam->count() );

        $bar->start();


        foreach ($companiesWithoutTeam as $company) {


            $company->ensureHasTeam();

            $bar->advance();

        }


        $bar->finish();

        $this->newLine();

        $this->info('✅ Alle manglende teams er nu oprettet.');


        return Command::SUCCESS;


    }


}
=======
<?php

namespace Modules\Companies\Console\Commands;

use Illuminate\Console\Command;
use Modules\Companies\Models\Companies;
use Modules\Teams\Models\Team;

class AssignTeamsToCompaniesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teams:assign-companies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tildel teams til alle virksomheder, som ikke har et team endnu.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {


        $companiesWithoutTeam = Companies::doesntHave('team')->get();


        if ($companiesWithoutTeam->isEmpty()) {

            $this->info('Alle virksomheder har allerede et team ✅');

            return Command::SUCCESS;

        }


        $this->info('Opretter teams for virksomheder uden team...');

        $bar = $this->output->createProgressBar( $companiesWithoutTeam->count() );

        $bar->start();


        foreach ($companiesWithoutTeam as $company) {


            $company->ensureHasTeam();

            $bar->advance();

        }


        $bar->finish();

        $this->newLine();

        $this->info('✅ Alle manglende teams er nu oprettet.');


        return Command::SUCCESS;


    }


}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
