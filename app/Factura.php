<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unidade;
use App\TipoApto;
use App\Apto;
use App\User;
use App\Bloque;

class Factura extends Model
{
     protected $fillable = [
        'apto_id','consecutivo','monto_total_fact','mes_ano','estado'
    ];

    public function apto()
    {
       return $this->belongsTo(Apto::class,'apto_id');
    }
    
}
