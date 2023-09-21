<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_type_id',
        'name',
        'birthdate'
    ];

    public function animalType()
    {
        return $this->belongsTo(AnimalType::class);
    }
}
