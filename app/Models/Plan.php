<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'nombre',
        'duracion',
        'precio',
        'descripcion',
    ];

    public function parkings()
    {
        return $this->hasMany(Parking::class);
    }
}
