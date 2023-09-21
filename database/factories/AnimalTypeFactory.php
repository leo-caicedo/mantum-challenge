<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalTypeFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [
            'mamifero',
            'ave',
            'pez',
            'reptil',
            'insecto'
        ];

        return [
            'name' => $this->faker
                ->unique()
                ->randomElement($types)
        ];
    }
}
