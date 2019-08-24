<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\TipoUsuario;
use App\Unidade;
use App\Bloque;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','last_name', 'email','dni','telefono', 'password','active','tipo_usuario'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tipo(){
        return $this->belongsTo(TipoUsuario::class,'tipo_usuario');
    }

    public function unidad(){
        return $this->belongsTo(Unidad::class);
    }

    public function bloques()
    {
        return $this->hasManyThrough('Bloque', 'Unidade', 'id_admin', 'id_unidad');
    }
}
