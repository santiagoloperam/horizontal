<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Unidade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UnidadesController extends Controller
{
    public function index()
    {
    	$unidades = Unidade::all();
    	$users = User::where('tipo_usuario','=', 1)->get();
    	//$usuario_actual = Auth::user();
    	//dd($usuario_actual);
    	return view('admin.unidades.index', compact('unidades','users'));
    }

    public function create()
    {
    	$users = User::where('tipo_usuario','=', 1)->where('active','=', 1)->get();
    	//dd($users);
    	return view('admin.unidades.create', compact('users'));
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
    	return view('admin.unidades.edit', compact('users','unidad'));
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
    	return redirect()->route('admin.unidades.index');
    }
}
