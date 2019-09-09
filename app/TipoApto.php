<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Unidade;


class TipoApto extends Model
{
    protected $fillable = [
        'tipo_apto','cobro','vigencia','id_unidad'
    ];

    public function unidad()
    {
       return $this->belongTo(Unidade::class);
    }
}
