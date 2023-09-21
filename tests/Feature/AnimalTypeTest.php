<?php

namespace Tests\Feature;

use App\Models\Animal;
use App\Models\AnimalType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class AnimalTypeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test_create_animals_before_2020
     *
     * @return void
     */
    public function test_create_animals_before_2020()
    {
        // Crear un tipo de animal
        $animalType = AnimalType::create(['name' => 'mamifero']);

        // Crear un animal con fecha menor a 2020
        for ($i = 0; $i < 3; $i++) {
            Animal::create([
                'animal_type_id' => $animalType->id,
                'name' => 'Felix',
                'birthdate' => Carbon::parse('2019-09-09')
            ]);
        }

        $response = $this->get('/api/animal_types');

        $response->assertExactJson([
            'quantityAnimalTypes' => []
        ]);
    }

    /**
     * test_create_animals_after_2020
     *
     * @return void
     */
    public function test_create_animals_after_2020()
    {
        // Crear un tipo de animal
        $animalType = AnimalType::create(['name' => 'mamifero']);

        // Crear un animal con fecha mayor a 2020
        for ($i = 0; $i < 3; $i++) {
            Animal::create([
                'animal_type_id' => $animalType->id,
                'name' => 'Felix',
                'birthdate' => Carbon::now()->format('Y-m-d')
            ]);
        }

        $response = $this->get('/api/animal_types');

        $response->assertExactJson([
            'quantityAnimalTypes' => [
                'mamifero' => 3
            ]
        ]);
    }
}
