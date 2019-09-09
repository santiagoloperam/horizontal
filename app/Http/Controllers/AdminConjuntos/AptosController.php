<?php

namespace App\Http\Controllers\AdminConjuntos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unidade;
use App\Bloque;
use App\User;
use App\TipoApto;
use App\Apto;
use DB;

class AptosController extends Controller
{
    public function index()
    {
    	$unidades = Unidade::where('id_admin','=', auth()->user()->id)->get();
    	$aptos = Apto::where('id_admin','=', auth()->user()->id)->get();
    	
    	//dd($aptos);
    	$propietarios = User::where('id_admin','=', auth()->user()->id)->where('tipo_usuario', '=', 3)->where('active', '=', 1)->get();
    	$arrendatarios = User::where('id_admin','=', auth()->user()->id)->where('tipo_usuario', '=', 4)->where('active', '=', 1)->get();
    	//dd($arrendatarios);
        
       $bloques = DB::table('bloques')
                    ->join('unidades','unidades.id','=','bloques.id_unidad')
                    ->join('users','users.id','=','unidades.id_admin')
                    ->where('unidades.id_admin','=',auth()->user()->id)
                    ->select('bloques.id','unidades.id as id_unidad','unidades.nombre as unidad','bloques.nombre as bloque')
                    ->get();
        $tipoaptos = DB::table('tipo_aptos')
                    ->join('unidades','unidades.id','=','tipo_aptos.id_unidad')
                    ->join('users','users.id','=','unidades.id_admin')
                    ->where('unidades.id_admin','=',auth()->user()->id)
                    ->select('tipo_aptos.id','unidades.id as id_unidad','unidades.nombre as unidad','tipo_aptos.tipo_apto')
                    ->get();
    	//$usuario_actual = Auth::user();
    	//dd($usuario_actual);
        //dd($bloques);
    	return view('adminc.aptos.index', compact('aptos','bloques','tipoaptos','unidades','propietarios','arrendatarios'));
    }

    public function create()//Esta funcion no se usa porque el create esta en el index y pasa al store
    {
    	$unidades = Unidade::where('id_admin','=', auth()->user()->id)->get();
    	//dd($unidades);
    	return view('adminc.bloques.create', compact('unidades'));
    }

    public function store(Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'nomenclatura' => 'required|min:1|max:20',
			'id_unidad' => 'required',
			'id_bloque' => 'required',
			'id_tipo_apto' => 'required',
			'id_propietario' => 'required'
		]);

		$apto = new Apto;
		$apto->nomenclatura = $request->get('nomenclatura');
		$apto->id_unidad = $request->get('id_unidad');
		$apto->id_bloque = $request->get('id_bloque');
		$apto->id_tipo_apto = $request->get('id_tipo_apto');
		$apto->id_propietario = $request->get('id_propietario');
		$apto->id_arrendatario = $request->get('id_arrendatario');
		$apto->id_admin = auth()->user()->id;
		//dd($apto);
		$apto->save();

		return back()->with('flash','Apto creado!');

    }

    public function edit(Apto $apto)
    {     
    	$unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();	
    	$propietarios = User::where('id_admin','=', auth()->user()->id)->where('tipo_usuario', '=', 3)->where('active', '=', 1)->get();
    	$arrendatarios = User::where('id_admin','=', auth()->user()->id)->where('tipo_usuario', '=', 4)->where('active', '=', 1)->get();
    	//dd($arrendatarios);
        
       $bloques = DB::table('bloques')
                    ->join('unidades','unidades.id','=','bloques.id_unidad')
                    ->join('users','users.id','=','unidades.id_admin')
                    ->where('unidades.id_admin','=',auth()->user()->id)
                    ->select('bloques.id','unidades.id as id_unidad','unidades.nombre as unidad','bloques.nombre as bloque')
                    ->get();
        $tipoaptos = DB::table('tipo_aptos')
                    ->join('unidades','unidades.id','=','tipo_aptos.id_unidad')
                    ->join('users','users.id','=','unidades.id_admin')
                    ->where('unidades.id_admin','=',auth()->user()->id)
                    ->select('tipo_aptos.id','unidades.id as id_unidad','unidades.nombre as unidad','tipo_aptos.tipo_apto')
                    ->get();
    	return view('adminc.aptos.edit', compact('unidades','apto','bloques','tipoaptos','propietarios','arrendatarios'));
    }

    public function update(Apto $apto,  Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'nomenclatura' => 'required|min:1|max:20',
			'id_unidad' => 'required',
			'id_bloque' => 'required',
			'id_tipo_apto' => 'required',
			'id_propietario' => 'required'
		]);

		$apto->nomenclatura = $request->get('nomenclatura');
		$apto->id_unidad = $request->get('id_unidad');
		$apto->id_bloque = $request->get('id_bloque');
		$apto->id_tipo_apto = $request->get('id_tipo_apto');
		$apto->id_propietario = $request->get('id_propietario');
		$apto->id_arrendatario = $request->get('id_arrendatario');
		$apto->id_admin = auth()->user()->id;
		$apto->save();

		return redirect()->route('adminc.aptos.index')->with('flash','Apartamento/casa editado!');

    }

    public function destroy(Apto $apto)
    {    
    	$apto->delete(); 
    	return redirect()->route('adminc.aptos.index')->with('flash','Apartamento/casa eliminado!');
    }
}
