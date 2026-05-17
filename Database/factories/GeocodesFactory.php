<<<<<<< HEAD
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
=======
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
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
