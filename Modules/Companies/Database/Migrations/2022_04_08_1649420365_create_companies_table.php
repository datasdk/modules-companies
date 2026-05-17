<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Kalnoy\Nestedset\NestedSet;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('team_id')->nullable()->index();

                // Grunddata
                $table->string('name', 100)->nullable();
                $table->string('slug')->unique();
                $table->string('vat', 100)->nullable();
                $table->string('logo', 500)->nullable();

                // Virksomhedsstatus
                $table->boolean('protected')->default(false);
                $table->boolean('active')->default(true); // Aktiv / Inaktiv
                $table->date('startdate')->nullable();
                $table->date('enddate')->nullable();
                $table->integer('employees')->nullable()->default(null);

                // Branche / type
                $table->string('industrycode', 20)->nullable();
                $table->string('industrydesc', 255)->nullable();
                $table->string('companytype', 20)->nullable();
                $table->string('companydesc', 255)->nullable();


                // Nested Set for parent/child companies
                NestedSet::columns($table);

                $table->boolean('is_primary')->default(true);
                $table->integer('sorting')->nullable();

                $table->softDeletes();
                $table->timestamps();

                // Hvis du vil have en foreign key relation:
                // $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
