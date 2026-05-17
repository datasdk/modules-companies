<<<<<<< HEAD
<?php

use Modules\Companies\Http\Controllers\CompaniesController;


Route::group([
    "middleware" => ["web","auth","role:admin|editor|analyzer|guest"]
], function () {


    Route::resource('companies',CompaniesController::class);

});


=======
<?php

use Modules\Companies\Http\Controllers\CompaniesController;


Route::group([
    "middleware" => ["web","auth","role:admin|editor|analyzer|guest"]
], function () {


    Route::resource('companies',CompaniesController::class);

});


>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
