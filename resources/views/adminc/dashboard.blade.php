@extends('admin.layout')


@section('header')

	<h1>
		INTERFACES

		<small>PROBANDO</small>
	</h1>

	

@stop 



@section('content')

<h1>DASHBOARD</h1>

<p> Usuario autenticado: {{ auth()->user()->name }} </p>


@stop