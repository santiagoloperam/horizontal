<?php

namespace App\Http\Controllers\AdminConjuntos;

use App\User;
use App\TipoUsuario;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
    	$users = User::where('id_admin','=', auth()->user()->id)->get();
    	//$users = User::all();
    	$tipo_usuarios = TipoUsuario::all();
    	//$usuario_actual = Auth::user();
    	//dd($users);
    	return view('adminc.users.index', compact('users','tipo_usuarios'));
    }

    public function create()
    {
    	$tipo_usuarios = TipoUsuario::all();
    	//dd($tipo_usuarios);
    	return view('adminc.users.create', compact('tipo_usuarios'));
    }

    public function store(Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
			'dni' => 'required',
			'telefono' => 'required',
			'password' => 'min:6',
    		'confirm' => 'required_with:password|same:password|min:6',
			'tipo_usuario' => 'required',
			'active' => 'required'
		]);

		$user = new User;
		$user->name = $request->get('name');
		$user->last_name = $request->get('last_name');
		$user->email = $request->get('email');
		$user->dni = $request->get('dni');
		$user->telefono = $request->get('telefono');
		$user->password = bcrypt($request->get('password'));
		$user->tipo_usuario = $request->get('tipo_usuario');
		$user->active = $request->get('active');
		$user->id_admin = auth()->user()->id;
		//dd($user);
		$user->save();

		return back()->with('flash','tu usuario ha sido creado!');

    }

    public function edit(User $user)
    {    
    	$tipo_usuarios = TipoUsuario::all();		
    	return view('adminc.users.edit', compact('tipo_usuarios','user'));
    }

    public function update(User $user,  Request $request)
    {
		//VALIDACIÓN
		$this->validate($request,[
			'name' => 'required',
			'last_name' => 'required',
			'email' => 'required',
			'dni' => 'required',
			'telefono' => 'required',
			'password' => 'min:6',
    		'confirm' => 'required_with:password|same:password|min:6',
			'tipo_usuario' => 'required',
			'active' => 'required'
		]);

		$user->name = $request->get('name');
		$user->last_name = $request->get('last_name');
		$user->email = $request->get('email');
		$user->dni = $request->get('dni');
		$user->telefono = $request->get('telefono');
		$user->password = bcrypt($request->get('password'));
		$user->tipo_usuario = $request->get('tipo_usuario');
		$user->active = $request->get('active');
		$user->save();

		return redirect()->route('adminc.users.index')->with('flash','tu usuario ha sido actualizado!');

    }

    public function destroy(User $user)
    {    
    	$user->delete(); 
    	return redirect()->route('adminc.users.index');
    }
}
