<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Bloque;
use App\Apto;

class Unidade extends Model
{
     protected $fillable = [
        'nombre','direccion','telefono','id_admin','active'
    ];

    public function admin(){
        return $this->belongsTo(User::class,'id_admin');
    }

    public function bloques()
    {
       return $this->hasMany(Bloque::class);
    }

    public function aptos()
    {
       return $this->hasMany(Apto::class,'id_unidad');
    }
}
