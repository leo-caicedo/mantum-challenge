<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'animal_type_id' => function () {
                return \App\Models\AnimalType::query()
                    ->inRandomOrder()
                    ->first()->id;
            },
            'name' => $this->faker->name(),
            'birthdate' => $this->faker->dateTimeBetween('2019-00-00', '2023-00-00')
        ];
    }
}
