<?php

namespace App\Http\Controllers;

//use App\Http\Requests\StoreAnimalTypeRequest;
//use App\Http\Requests\UpdateAnimalTypeRequest;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

//use App\Models\AnimalType;

class AnimalTypeController extends Controller
{
    /**
     * Show the quantity of animals of the animal type.
     *
     * @return \Illuminate\Http\Response
     */
    public function getQuantityAnimalByType(Request $request)
    {
        // Filtro de fecha nacimiento dinamico
        $date = $request->query('date') ?
            $request->query('date') :  '2020-12-31';

        // Filtro de longer than dinamico
        $lt = $request->query('lt') ?
            $request->query('lt') :  2;

        // Challenge Mantum
        $quantityAnimalTypes = Animal::with('animalType')
            ->where('birthdate', '>', Carbon::parse($date))
            ->get()
            ->groupBy('animalType.name')
            ->filter(function ($groupAnimal) use ($lt) {
                return count($groupAnimal) > $lt;
            })
            ->map(function ($groupAnimal) {
                return count($groupAnimal);
            });

        return response()->json(compact('quantityAnimalTypes'));
    }
}
