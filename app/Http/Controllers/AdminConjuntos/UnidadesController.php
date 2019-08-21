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
    	//$unidades = DB::select('SELECT nombre,direccion,telefono,name
                // from unidades 
                // on id_admin='+$usuario_actual_id);    	
    	
    	//dd($usuario_actual);
    	$unidades = Unidade::all();
    	$users = User::where('tipo_usuario','=', 1)->get();
    	return view('adminc.unidades.index', compact('unidades','users'));
    }

    public function create()
    {
    	$users = User::where('tipo_usuario','=', 1)->where('active','=', 1)->get();
    	//dd($users);
    	return view('adminc.unidades.create', compact('users'));
    }

    public function store(Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'nombre' => 'required',
			'direccion' => 'required',
			'telefono' => 'required',
			'id_admin' => 'required',
			'active' => 'required'
		]);

		$unidad = new Unidade;
		$unidad->nombre = $request->get('nombre');
		$unidad->direccion = $request->get('direccion');
		$unidad->telefono = $request->get('telefono');
		$unidad->id_admin = $request->get('id_admin');
		$unidad->active = $request->get('active');
		//dd($unidad);
		$unidad->save();

		return back()->with('flash','tu Unidad ha sido creada!');

    }

    public function edit(Unidade $unidad)
    {    
    	$users = User::where('tipo_usuario','=', 1)->get();	//AGREGARLE EL WHERE TIPO SEA ADMIN 1	
    	return view('adminc.unidades.edit', compact('users','unidad'));
    }

    public function update(Unidade $unidad,  Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'nombre' => 'required',
			'direccion' => 'required',
			'telefono' => 'required',
			'id_admin' => 'required',
			'active' => 'required'
		]);

		$unidad->nombre = $request->get('nombre');
		$unidad->direccion = $request->get('direccion');
		$unidad->telefono = $request->get('telefono');
		$unidad->id_admin = $request->get('id_admin');
		$unidad->active = $request->get('active');
		$unidad->save();

		return back()->with('flash','La Unidad ha sido actualizada!');

    }

    public function destroy(Unidade $unidad)
    {    
    	$unidad->delete(); 
    	return redirect()->route('adminc.unidades.index');
    }
}
