<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unidade;
use App\TipoApto;
use App\User;
use App\Bloque;

class Apto extends Model
{
    protected $fillable = [
        'nomenclatura','id_unidad','id_bloque','id_tipo_apto','id_propietario','id_arrendatario','id_admin'
    ];

    public function unidad()
    {
       return $this->belongsTo(Unidade::class,'id_unidad');
    }
    public function tipoapto()
    {
       return $this->belongsTo(TipoApto::class,'id_tipo_apto');
    }

    public function bloque()
    {
       return $this->belongsTo(Bloque::class,'id_bloque');
    }

    public function propietario()
    {
       return $this->belongsTo(User::class,'id_propietario');
    }

    public function arrendatario()
    {
       return $this->belongsTo(User::class,'id_arrendatario');
    }
    
}
