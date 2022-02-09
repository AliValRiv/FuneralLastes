<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'empleado', 'paterno', 'materno', 'nombre', 'genero', 'fecha_nacimiento', 'curp',
        'rfc', 'nss', 'telefono', 'email', 'fecha_inicio', 'fecha_fin', 'empresa_id', 'activo',
    ];

    public function empresa()
    {
        return $this->hasOne(Empresa::class);
    }
}