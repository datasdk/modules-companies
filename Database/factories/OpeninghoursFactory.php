<<<<<<< HEAD
<?php

namespace Modules\Companies\Database\factories;

use Modules\Companies\Models\Openinghours;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpeninghoursFactory extends Factory
{
    protected $model = Openinghours::class;

    public function definition()
    {
        return [
            'company_id' => \Modules\Companies\Models\Companies::factory(),
            'day' => $this->faker->randomElement(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']),
            'all_day' => $this->faker->boolean,
            'from_hours' => $this->faker->numberBetween(0, 23),
            'from_minutes' => $this->faker->numberBetween(0, 59),
            'to_hours' => $this->faker->numberBetween(0, 23),
            'to_minutes' => $this->faker->numberBetween(0, 59),
            'closed' => $this->faker->boolean,
        ];
    }
}
=======
<?php

namespace Modules\Companies\Database\factories;

use Modules\Companies\Models\Openinghours;
use Illuminate\Database\Eloquent\Factories\Factory;

class OpeninghoursFactory extends Factory
{
    protected $model = Openinghours::class;

    public function definition()
    {
        return [
            'company_id' => \Modules\Companies\Models\Companies::factory(),
            'day' => $this->faker->randomElement(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']),
            'all_day' => $this->faker->boolean,
            'from_hours' => $this->faker->numberBetween(0, 23),
            'from_minutes' => $this->faker->numberBetween(0, 59),
            'to_hours' => $this->faker->numberBetween(0, 23),
            'to_minutes' => $this->faker->numberBetween(0, 59),
            'closed' => $this->faker->boolean,
        ];
    }
}
>>>>>>> 9b9d6c660d69d33530610f05faa5e8f6ffa2a95d
