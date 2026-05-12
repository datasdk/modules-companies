<?php

namespace Modules\Companies\Database\factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'uid' => Str::uuid(),
            'image' => $this->faker->imageUrl(),
            'username' => $this->faker->userName,
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->optional()->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Skift dette i produktion
            'type' => 'default',
            'remember_token' => Str::random(10),
            'lastLoggedIn' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function withCompany()
    {
        return $this->afterCreating(function (User $user) {

            $company = \Modules\Companies\Models\Companies::factory()->create();
            
            $company->ensureHasTeam();
            
            $company->team->addUserToTeam($user);
           
        });
    }
}