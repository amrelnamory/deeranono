<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\Fakecar($this->faker));

        return [
            'name' => $this->faker->vehicleBrand,
            'model' => $this->faker->vehicleModel,
            'plate_no' => $this->faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'),
            'serial_number' => $this->faker->vin,
            'chassis_no' => $this->faker->randomNumber,
            'color' => $this->faker->colorName,
            'license_expiry_date' => $this->faker->date,
            'insurance_company' => $this->faker->company,
            'insurance_expiry_date' => $this->faker->date,
            'full_insurance' => 1,
            'third_party_insurance' => 0,
            'buy_price' => $this->faker->numberBetween(100000, 900000),
            'images' => 'not-found.jpg',
            'user_id' => 1,
        ];
    }
}
