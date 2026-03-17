<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motorcycle extends Model
{
    protected $fillable = [
        'placa',
        'nombre_propietario',
        'telefono',
        'correo',
        'marca',
        'color',
        'foto',
    ];

    public function parkings()
    {
        return $this->hasMany(Parking::class);
    }
}
