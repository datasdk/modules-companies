<?php

namespace Modules\Companies\Database\Factories\Contact;

use Modules\Companies\Models\Contact\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'attachment' => $this->faker->optional()->url,
            'address' => $this->faker->email,
            'sent' => $this->faker->boolean,
            'error' => $this->faker->optional()->sentence,
            'to' => $this->faker->email,
            'from_email' => $this->faker->email,
            'reply_to' => $this->faker->optional()->email,
        ];
    }
}
