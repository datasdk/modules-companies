<?php

namespace Modules\Companies\Database\Factories\Geocodes;

use Modules\Companies\Models\Geocodes\Geocodes;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeocodesFactory extends Factory
{
    protected $model = Geocodes::class;

    public function definition()
    {
        return [
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
        ];
    }
}
