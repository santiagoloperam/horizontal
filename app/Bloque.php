<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Unidade;

class Bloque extends Model
{
    protected $fillable = [
        'nombre','id_unidad'
    ];

    public function unidad()
    {
       return $this->belongsTo(Unidade::class,'id_unidad');
    }
}
