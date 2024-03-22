<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public function vaccineAndMedicine()
    {
        return $this->hasMany(VaccineAndMedicinePet::class, 'pet_id', 'id');
    }
    public function training()
    {
        return $this->hasMany(TrainingPet::class, 'pet_id', 'id');
    }
    public function supplement()
    {
        return $this->hasMany(SupplementPet::class, 'pet_id', 'id');
    }
}
