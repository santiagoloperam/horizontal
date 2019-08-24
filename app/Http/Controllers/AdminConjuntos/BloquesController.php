<?php

namespace App\Http\Controllers\AdminConjuntos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Unidade;
use App\Bloque;
use App\User;
use DB; 

class BloquesController extends Controller
{
    public function index()
    {
    	//$unidades = Unidade::all();
    	//$bloques = Bloque::all();
        $unidades = Unidade::where('id_admin','=', Auth()->user()->id)->get();
        $bloques = DB::table('bloques')
                    ->join('unidades','unidades.id','=','bloques.id_unidad')
                    ->join('users','users.id','=','unidades.id_admin')
                    ->where('unidades.id_admin','=',auth()->user()->id)
                    ->select('bloques.id','unidades.id as id_unidad','unidades.nombre as unidad','bloques.nombre as bloque')
                    ->get();

    	//$usuario_actual = Auth::user();
    	//dd($usuario_actual);
        //dd($bloques);
    	return view('adminc.bloques.index', compact('bloques','unidades'));
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
