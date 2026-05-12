<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeninghoursTable extends Migration
{
    public function up()
    {

		if(!Schema::hasTable("openinghours"))
        Schema::create('openinghours', function (Blueprint $table) {

		$table->increments('id');
		$table->foreignId('company_id')->nullable();
		$table->integer('day')->nullable();
		$table->boolean('all_day')->default(0);
		$table->integer('from_hours')->default(0);
		$table->integer('from_minutes')->default(0);
		$table->integer('to_hours')->default(0);
		$table->integer('to_minutes')->default(0);
		$table->boolean('closed')->default(0);
		$table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('openinghours');
    }
}