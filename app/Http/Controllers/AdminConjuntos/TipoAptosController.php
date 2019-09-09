<?php

namespace App\Http\Controllers\AdminConjuntos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unidade;
use App\Bloque;
use App\User;
use App\TipoApto;
use DB;

class TipoAptosController extends Controller
{
    public function index()
    {
    	//$unidades = Unidade::all();
    	//$bloques = Bloque::all();
        $unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();
        $tipo_aptos = DB::table('tipo_aptos')
                    ->join('unidades','unidades.id','=','tipo_aptos.id_unidad')
                    ->join('users','users.id','=','unidades.id_admin')
                    ->where('unidades.id_admin','=',auth()->user()->id)
                    ->select('tipo_aptos.id','tipo_aptos.tipo_apto as tipo_apto','tipo_aptos.cobro','tipo_aptos.vigencia','tipo_aptos.metros','unidades.id as id_unidad','unidades.nombre as unidad')
                    ->get();

    	//$usuario_actual = Auth::user();
    	//dd($unidades);
        //dd($tipo_aptos);
    	return view('adminc.tipoaptos.index', compact('tipo_aptos','unidades'));
    }

    public function create()//Esta funcion no se usa porque el create esta en el index y pasa al store
    {
    	$unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();
    	//dd($unidades);
    	return view('adminc.tipoaptos.create', compact('unidades'));
    }

    public function store(Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'tipo_apto' => 'required',
			'cobro' => 'required|numeric',
            'vigencia' => 'required|numeric',
			'metros' => 'required|numeric',
			'id_unidad' => 'required'
		]);

		$tipo_apto = new TipoApto;
		$tipo_apto->tipo_apto = $request->get('tipo_apto');
		$tipo_apto->cobro = $request->get('cobro');
        $tipo_apto->vigencia = $request->get('vigencia');
		$tipo_apto->metros = $request->get('metros');
		$tipo_apto->id_unidad = $request->get('id_unidad');
		//dd($tipo_apto);
		$tipo_apto->save();

		return redirect()->route('adminc.tipoaptos.index')->with('flash','Tipo de apto. creado!');

    }

    public function edit($tipo_apto)// tipo apto es un id no un registro y toca asumirlo como id para buscar y sobrescribir la variable
    {   
    	$tipo_apto = TipoApto::find($tipo_apto);  
    	$unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();	
    	return view('adminc.tipoaptos.edit', compact('unidades','tipo_apto'));
    }

    public function update(TipoApto $tipoApto,  Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'tipo_apto' => 'required',
			'cobro' => 'required|numeric',
            'vigencia' => 'required|numeric',
			'metros' => 'required|numeric',
			'id_unidad' => 'required'
		]);

		
		$tipoApto->tipo_apto = $request->get('tipo_apto');
		$tipoApto->cobro = $request->get('cobro');
        $tipoApto->vigencia = $request->get('vigencia');
		$tipoApto->metros = $request->get('metros');
		$tipoApto->id_unidad = $request->get('id_unidad');
		$tipoApto->save();

		return redirect()->route('adminc.tipoaptos.index')->with('flash','Tipo de apartamento actualizado!');

    }

    public function destroy(TipoApto $tipo_apto)
    {    
    	$tipo_apto->delete(); 
    	return redirect()->route('adminc.tipoaptos.index')->with('flash','Tipo de apto. eliminado!');
    }
}
