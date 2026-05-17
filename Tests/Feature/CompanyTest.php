<<<<<<< HEAD
<?php

namespace Modules\Companies\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Companies\Models\Companies;
use Modules\Companies\Models\User;


class CompanyTest extends TestCase
{

    use RefreshDatabase;


    public function test_can_create_company()
    {

        $user = User::factory()->create();


        $response = $this->actingAs($user)->postJson(route('api.companies.companies.store'), [
            'name' => 'Test Company',
            'vat' => '12345678'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('companies', ['name' => 'Test Company']);

    }


    public function test_can_store_user_with_company()
    {

        $response = $this->postJson(route('api.companies.companies.store'), [
            'user' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
            ],
            'name' => 'New Company',
            'vat' => '98765432'
        ]);


        $response->assertStatus(201);

        $this->assertDatabaseHas('companies', ['name' => 'New Company']);

    }


    public function test_can_update_company()
    {

        $user = User::factory()->create();

        $company = Companies::factory()->create();

        $response = $this->actingAs($user)->putJson(route('api.companies.companies.update', $company->id), [
            'name' => 'Updated Company'
        ]);


        $response->assertStatus(200);

        $this->assertDatabaseHas('companies', ['name' => 'Updated Company']);

    }

    public function test_can_view_company()
    {
        
        $company = Companies::factory()->create();


        $response = $this->getJson(route('api.companies.companies.show', $company->id));

        $response->assertStatus(200);

    }


    public function test_can_delete_company()
    {


        $user = User::factory()->create();

        $company = Companies::factory()->create();


        $response = $this->actingAs($user)->deleteJson(route('api.companies.companies.destroy', $company->id));

        $response->assertNoContent();

    }


   
=======
<?php

namespace Modules\Companies\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Modules\Companies\Models\Companies;
use Modules\Companies\Models\User;


class CompanyTest extends TestCase
{

    use RefreshDatabase;


    public function test_can_create_company()
    {

        $user = User::factory()->create();


        $response = $this->actingAs($user)->postJson(route('api.companies.companies.store'), [
            'name' => 'Test Company',
            'vat' => '12345678'
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('companies', ['name' => 'Test Company']);

    }


    public function test_can_store_user_with_company()
    {

        $response = $this->postJson(route('api.companies.companies.store'), [
            'user' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
            ],
            'name' => 'New Company',
            'vat' => '98765432'
        ]);


        $response->assertStatus(201);

        $this->assertDatabaseHas('companies', ['name' => 'New Company']);

    }


    public function test_can_update_company()
    {

        $user = User::factory()->create();

        $company = Companies::factory()->create();

        $response = $this->actingAs($user)->putJson(route('api.companies.companies.update', $company->id), [
            'name' => 'Updated Company'
        ]);


        $response->assertStatus(200);

        $this->assertDatabaseHas('companies', ['name' => 'Updated Company']);

    }

    public function test_can_view_company()
    {
        
        $company = Companies::factory()->create();


        $response = $this->getJson(route('api.companies.companies.show', $company->id));

        $response->assertStatus(200);

    }


    public function test_can_delete_company()
    {


        $user = User::factory()->create();

        $company = Companies::factory()->create();


        $response = $this->actingAs($user)->deleteJson(route('api.companies.companies.destroy', $company->id));

        $response->assertNoContent();

    }


   
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
}