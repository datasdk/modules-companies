<?php

namespace Modules\Companies\Database\Seeders;

use Modules\Companies\Database\Seeders\RolesSeeder;
use Illuminate\Database\Seeder;
use Model;

class CompaniesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call([
            CompaniesRolesSeeder::class
        ]);
    }
}
