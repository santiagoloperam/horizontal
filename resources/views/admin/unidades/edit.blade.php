@extends('admin.layout')

@section('content')
	<div class="row">
				<form method="POST" action="{{route('admin.unidades.update',$unidad)}}">
					@csrf
					{{ method_field('PUT') }}

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
										<label for="nombre" >Nombre del Conjunto Residencial</label>
										<input name="nombre" placeholder="Ingresa el nombre de la Unidad" type="text" class="form-control" value="{{ old('nombre', $unidad->nombre) }}">
										{!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
									</div>
									
									<div class="form-group {{ $errors->has('direccion') ? 'has-error' : '' }}">
										<label for="direccion" >Dirección</label>
										<input name="direccion" placeholder="Ingresa la dirección de la unidad" type="text" class="form-control" value="{{ old('direccion', $unidad->direccion) }}">
										{!! $errors->first('direccion','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
										<label for="telefono" >Teléfono</label>
										<input name="telefono" placeholder="Ingresa el telefono p/pal de la unidad" type="number" class="form-control" value="{{ old('telefono', $unidad->telefono) }}">
										{!! $errors->first('telefono','<span class="help-block">:message</span>') !!}
									</div>
									

					              <div class="form-group {{ $errors->has('id_admin') ? 'has-error' : '' }}">
					              	<label>Tipo de usuario</label>
					              	<select name="id_admin" id="" class="form-control">
					              		<option value="">Selecciona un Rol</option>
					              		@foreach($users as $user)
											<option value="{{ $user->id }}" {{ old('id_admin', $unidad->id_admin) == $user->id ? 'selected' : '' }} >
												{{ $user->name }} {{ $user->last_name }}
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('id_admin','<span class="help-block">:message</span>') !!}
					              </div>

					              
								
								<div class="form-group">
									<label for="active" >Usuario Activo?</label>
									<select name="active" id="" class="form-control">
					              		<option value=1 {{ old(1, $unidad->active) == 1 ? 'selected' : '' }}>Activo</option>
					              		<option value=0 {{ old(0, $unidad->active) == 0 ? 'selected' : '' }}>Inactivo</option>
					              	</select>
								</div>

										

							</div>

						</div>
					</div>
			<div class="modal-footer">
	       		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        		<button type="submit" class="btn btn-primary">Guardar</button>
	      	</div>

	      </form>
				
			
			@endsection