<?php

namespace Modules\Companies\Database\factories;

use Modules\Companies\Models\Addresses;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressesFactory extends Factory
{
    protected $model = Addresses::class;

    public function definition()
    {
        return [
            'street' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'post_code' => $this->faker->postcode,
            'country_id' => 1, // Hvis du har en Country-model, kan du bruge Country::factory()
            'addressable_type' => 'App\Models\User',
            'addressable_id' => 1, // Du kan ændre dette til User::factory() hvis nødvendigt
            'is_public' => $this->faker->boolean,
        ];
    }
}
