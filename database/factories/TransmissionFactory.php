<?php

namespace Database\Factories;

use App\Models\Transmission;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transmission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'satellite_name' => $this->faker->sentence(5),
            'distance' => rand(1, 500),
            'message' => ['este' , 'es', 'un', 'mensaje']
        ];
    }
}
