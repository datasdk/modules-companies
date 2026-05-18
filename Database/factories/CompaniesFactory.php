<?php

namespace Modules\Companies\Database\factories;

use Modules\Companies\Models\Companies;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompaniesFactory extends Factory
{
    protected $model = Companies::class;


    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'slug' => uniqid(), // den burde selv indsætte slug?? :(((
            'vat' => $this->faker->unique()->numerify('########'), // 8-cifret VAT-nummer
            'logo' => $this->faker->imageUrl(200, 200, 'business', true, 'company-logo'),
            'is_primary' => $this->faker->boolean(10), // 10% chance for at være primær
        ];
    }

  
}
