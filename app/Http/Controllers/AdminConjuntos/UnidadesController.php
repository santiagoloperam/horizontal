<?php

namespace App\Http\Controllers\AdminConjuntos;

use App\User;
use App\Unidade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

class UnidadesController extends Controller
{
    public function index()
    {
    	//$usuario_actual = Auth()->user();
    	//$usuario_actual_id = Auth()->user()->id;
    	$unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();    	
    	
    	//dd($unidades);
    	//$unidades = Unidade::all();
    	$users = User::where('tipo_usuario','=', 1)->get();
    	return view('adminc.unidades.index', compact('unidades','users'));
    }
   

    
}
