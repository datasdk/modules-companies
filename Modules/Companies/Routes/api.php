<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;


Route::group([
    'as' => 'api.companies.',
    'prefix' => 'companies',

], function ($router) {



        Route::middleware(['auth.both:api'])->group(function () {

            Orion::resource('companies', 'Api\CompaniesController');

            Orion::resource('users', 'Api\UserCompanyController');

            Route::match(['get', 'post'], 'exists/{vat}', 'Api\CompaniesController@exists');

            
        });



        Route::middleware(['auth.both:api'])->group(function () {

            Orion::hasManyResource('users','companies', 'Api\UserCompanyController');
            
            Orion::hasManyResource('companies', 'addresses', 'Api\CompanyAddressController');

            Orion::hasManyResource('companies', 'contacts', 'Api\CompanyAddressController');
 
            Route::post('{vat}/application', 'Api\CompanyApplicationController@newUser');    

        });


        
        Route::middleware(['auth:api'])->group(function () {
 
            Route::post('{vat}/application/{user_id}', 'Api\CompanyApplicationController@existingUser');    
            
            Route::post('{vat}/invitation', 'Api\CompanyInvitationController@newUser');

            Route::post('{vat}/invitation/{user_id}', 'Api\CompanyInvitationController@existingUser');

        });



});
  