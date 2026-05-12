<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeninghoursExceptionsTable extends Migration
{
    public function up()
    {

        if(!Schema::hasTable("openinghours_exceptions"))
        Schema::create('openinghours_exceptions', function (Blueprint $table) {

		$table->increments('id');
		$table->foreignId('company_id');
		$table->timestamp('date')->useCurrent();
		$table->boolean('all_day');
		$table->integer('from_hours');
		$table->integer('from_minutes');
		$table->integer('to_hours');
		$table->integer('to_minutes');
		$table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('openinghours_exceptions');
    }
}