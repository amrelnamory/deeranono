<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

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
            'birthdate' => $this->faker->date,
            'license_no' => $this->faker->randomNumber,
            'license_expiry_date' => $this->faker->date,
            'image' => 'avatar.png',
            'license_image' => 'not-found.jpg',
            'user_id' => 1,
        ];
    }
}
