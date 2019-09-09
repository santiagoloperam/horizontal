@extends('admin.layout')

@section('content')
	<div class="row">
				<form method="POST" action="{{route('adminc.users.update',$user)}}">
					@csrf
					{{ method_field('PUT') }}

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
										<label for="name" >Nombre</label>
										<input name="name" placeholder="Ingresa el nombre del usuario" type="text" class="form-control" value="{{ old('name', $user->name) }}">
										{!! $errors->first('name','<span class="help-block">:message</span>') !!}
									</div>
									
									<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
										<label for="last_name" >Apellidos</label>
										<input name="last_name" placeholder="Ingresa los apellidos del usuario" type="text" class="form-control" value="{{ old('last_name', $user->last_name) }}">
										{!! $errors->first('last_name','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label for="email" >Email</label>
										<input name="email" placeholder="Ingresa el email del usuario" type="email" class="form-control" value="{{ old('email', $user->email) }}">
										{!! $errors->first('email','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
										<label for="dni" >Número de documento</label>
										<input name="dni" placeholder="Ingresa el número de documento del usuario" type="text" class="form-control" value="{{ old('dni', $user->dni) }}">
										{!! $errors->first('dni','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
										<label for="telefono" >Teléfono</label>
										<input name="telefono" placeholder="Ingresa numero de teléfono o celular del usuario" type="number" class="form-control" value="{{ old('telefono', $user->telefono) }}">
										{!! $errors->first('telefono','<span class="help-block">:message</span>') !!}
									</div>

								</div>
							
						</div>
					</div>

					<div class="col-md-4">
						<div class="box box-primary">
							
							<div class="box-body">

								  <!-- Date -->
					              <!-- <div class="form-group">
					                <label>Fecha de publicación:</label>

					                <div class="input-group date">
					                  <div class="input-group-addon">
					                    <i class="fa fa-calendar"></i>
					                  </div>
					                  <input name="published_at" type="text" class="form-control pull-right" id="datepicker">
					                </div> -->

					                <!-- /.input group -->
					              </div>

					              <div class="form-group {{ $errors->has('tipo_usuario') ? 'has-error' : '' }}">
					              	<label>Tipo de usuario</label>
					              	<select name="tipo_usuario" id="" class="form-control">
					              		<option value="">Selecciona un Rol</option>
					              		<option value=3 {{ old('tipo_usuario', $user->tipo_usuario) == 3 ? 'selected' : '' }}>Propietario</option>
					              		<option value=4 {{ old('tipo_usuario', $user->tipo_usuario) == 4 ? 'selected' : '' }}>Arrendatario</option>			              		
					              	</select>
					              	{!! $errors->first('tipo_usuario','<span class="help-block">:message</span>') !!}
					              </div>

					              
								<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }} {{ $errors->has('confirm') ? 'has-error' : '' }}">
									<label for="password" >Password</label>
									<input name="password" placeholder="Ingresa un password para el usuario" type="password" class="form-control"><br>
									{!! $errors->first('password','<span class="help-block">:message</span>') !!}
									<input name="confirm" placeholder="confirma el password para el usuario" type="password" class="form-control">
									{!! $errors->first('confirm','<span class="help-block">:message</span>') !!}
								</div>

								<div class="form-group">
									<label for="active" >Usuario Activo?</label>
									<select name="active" id="" class="form-control">
					              		<option value=1 {{ old(1, $user->active) == 1 ? 'selected' : '' }}>Activo</option>
					              		<option value=0 {{ old(0, $user->active) == 0 ? 'selected' : '' }}>Inactivo</option>
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