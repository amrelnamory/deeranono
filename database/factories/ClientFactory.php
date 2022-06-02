<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->e164PhoneNumber,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'nat_id' => $this->faker->randomNumber,
            'license_no' => $this->faker->randomNumber,
            'nat_id_image' => 'not-found.jpg',
            'license_image' => 'not-found.jpg',
            'user_id' => 1,
        ];
    }
}
