<?php

namespace App\Http\Controllers\AdminConjuntos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unidade;
use App\Bloque;
use App\User;
use App\Apto;
use App\Factura;
use DB; 

class FacturasController extends Controller
{
     public function index()
    {
    	//$unidades = Unidade::all();
    	//$bloques = Bloque::all();
        $unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();
        $aptos = Apto::where('id_admin','=', Auth()->user()->id)->get();
        $facturas = Factura::all(); //FILTRAR

    	//$usuario_actual = Auth::user();
    	//dd($usuario_actual);
        //dd($bloques);
    	return view('adminc.facturas.index', compact('facturas','aptos','unidades'));
    }

    public function create()//Esta funcion no se usa porque el create esta en el index y pasa al store
    {
    	$unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();
    	//dd($unidades);
    	return view('adminc.bloques.create', compact('unidades'));
    }

    public function store(Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'nombre' => 'required',
			'id_unidad' => 'required'
		]);

		$bloque = new Bloque;
		$bloque->nombre = $request->get('nombre');
		$bloque->id_unidad = $request->get('id_unidad');
		//dd($bloque);
		$bloque->save();

		return back()->with('flash','Bloque creado!');

    }

    public function edit(Bloque $bloque)
    {     
    	$unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();	
    	return view('adminc.bloques.edit', compact('unidades','bloque'));
    }

    public function update(Bloque $bloque,  Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'nombre' => 'required',
			'id_unidad' => 'required'
		]);

		$bloque->nombre = $request->get('nombre');
		$bloque->id_unidad = $request->get('id_unidad');
		$bloque->save();

		return back()->with('flash','Bloque actualizado!');

    }

    public function destroy(Bloque $bloque)
    {    
    	$bloque->delete(); 
    	return redirect()->route('adminc.bloques.index');
    }
}
