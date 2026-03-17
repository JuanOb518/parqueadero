<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $fillable = [
        'motorcycle_id',
        'plan_id',
        'hora_entrada',
        'hora_salida',
        'total_costo',
        'pago',
    ];

    protected $casts = [
        'hora_entrada' => 'datetime',
        'hora_salida' => 'datetime',
        'total_costo' => 'decimal:2',
    ];

    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
