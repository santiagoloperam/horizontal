<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unidade;
use App\Bloque;

class BloquesController extends Controller
{
    public function index()
    {
    	$unidades = Unidade::all();
    	$bloques = Bloque::all();
    	//$usuario_actual = Auth::user();
    	//dd($usuario_actual);
    	return view('admin.bloques.index', compact('bloques','unidades'));
    }

    public function create()
    {
    	$unidades = User::all();
    	//dd($unidades);
    	return view('admin.bloques.create', compact('unidades'));
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
    	$unidades = Unidade::all();	//En tipo Admin conjunto ponerle where::admin_id==auth()->user()->id	
    	return view('admin.bloques.edit', compact('unidades','bloque'));
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
    	return redirect()->route('admin.bloques.index');
    }
}
