<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    protected $fillable = [
        'fecha_carga', 'archivo', 'usuario','comentarios','observaciones', 'status', 'company_id',
    ];

    public function empresa()
    {
        return $this->hasOne(Empresa::class,'id','company_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','usuario');
    }
}
