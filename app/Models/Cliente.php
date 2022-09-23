<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'empleado', 'paterno', 'materno', 'nombre', 'genero', 'fecha_nacimiento', 'curp',
        'rfc', 'nss', 'telefono', 'email', 'fecha_inicio', 'fecha_fin', 'empresa_id', 'activo','opc1',
        'opc2',
        'opc3',
        'opc4',
        'opc5',
        'opc6',
        'estatus',
        'otorgado',
    ];

    public function empresa()
    {
        return $this->hasOne(Empresa::class,'id','empresa_id');
    }
}