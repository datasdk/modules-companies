<?php

use Modules\Companies\Http\Controllers\CompaniesController;


Route::group([
    "middleware" => ["web","auth","role:admin|editor|analyzer|guest"]
], function () {


    Route::resource('companies',CompaniesController::class);

});


