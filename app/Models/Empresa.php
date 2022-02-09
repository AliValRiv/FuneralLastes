<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $fillable = [
        'nombre', 'activo',
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class);
    }
    public function carga()
    {
        return $this->hasOne(Carga::class);
    }
}
