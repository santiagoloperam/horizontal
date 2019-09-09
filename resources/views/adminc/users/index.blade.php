@extends('adminc.layout')

@section('content')
	<h1>USUARIOS</h1>

	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Nuevo Usuario</button>

	 <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Usuarios</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="users-table" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th>ID</th>
	                  <th>NOMBRE</th>
	                  <th>APELLIDO</th>
	                  <th>EMAIL</th>                
	                  {{-- <th>PASSWORD</th> --}}               
	                  <th>CÉDULA</th>                
	                  <th>TELÉFONO</th>                
	                  <th>TIPO DE USUARIO</th>                
	                  <th>ACTIVO</th>  
	                  <th>ACCIONES</th> 
	                </tr>
                </thead>
                
                <tbody>
                	@foreach($users as $user)
						<tr>
							<td>{{ $user->id }}</td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->last_name }}</td>
							<td>{{ $user->email }}</td>
							{{-- <td>{{ $user->password }}</td>  --}}
							<td>{{ $user->dni }}</td>
							<td>{{ $user->telefono }}</td>
							{{-- <td>{{ $user->tipo_usuario }}</td> --}}
							<td>{{ $user->tipo->tipo_usuarios }}</td> 
							<td>
								@if($user->active == 1)
									<i class="fa fa-check iconos">										
								@else
									<i class="fa fa-times iconos">
								@endif
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;
								<a href="{{ route('adminc.users.edit',$user) }}"  class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a> 

								{{--  <a href="{{ route('admin.users.delete',$user) }}" class="btn btn-xs btn-danger" onclick="return confirm('Está seguro de eliminar el registro?')"><i class="fa fa-times"></i></a> --}}
								<form method="post" action="{{ route('adminc.users.delete',$user) }}" class="pull-left">
								    {!! csrf_field() !!} {{ method_field('DELETE') }}
								    <div>
								        <button type="submit" class="btn btn-warning btn btn-xs btn-info" onclick="return confirm('Está seguro de eliminar el registro?')"><i class="fa fa-times"></i></button>
								    </div>                
								</form>								
							</td>
						</tr>
                	@endforeach                	
                </tbody>


              </table>
            </div>
            <!-- /.box-body -->
          </div>

@stop

@push('styles')
	<!-- DataTables -->
  <link rel="stylesheet" href="/adminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- MIS ESTILOS -->
  <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

@endpush
 
@push('scripts')
		<!-- DataTables -->
	<script src="/adminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="/adminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script>
	  $(function () {
	    $('#users-table').DataTable()({
	      'paging'      : true,
	      'lengthChange': false,
	      'searching'   : false,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    })
	  })
	</script>

	<!-- Modal CREAR-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Crear Usuario</h4>
	      </div>

	      
	      <div class="modal-body">
	        <div class="row">
				<form method="POST" action="{{route('adminc.users.store')}}">
					@csrf

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
										<label for="name" >Nombre</label>
										<input name="name" placeholder="Ingresa el nombre del usuario" type="text" class="form-control" value="{{ old('name') }}">
										{!! $errors->first('name','<span class="help-block">:message</span>') !!}
									</div>
									
									<div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
										<label for="last_name" >Apellidos</label>
										<input name="last_name" placeholder="Ingresa los apellidos del usuario" type="text" class="form-control" value="{{ old('last_name') }}">
										{!! $errors->first('last_name','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
										<label for="email" >Email</label>
										<input name="email" placeholder="Ingresa el email del usuario" type="email" class="form-control" value="{{ old('email') }}">
										{!! $errors->first('email','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('dni') ? 'has-error' : '' }}">
										<label for="dni" >Número de documento</label>
										<input name="dni" placeholder="Ingresa el número de documento del usuario" type="text" class="form-control" value="{{ old('dni') }}">
										{!! $errors->first('dni','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
										<label for="telefono" >Teléfono</label>
										<input name="telefono" placeholder="Ingresa numero de teléfono o celular del usuario" type="number" class="form-control" value="{{ old('telefono') }}">
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
					              		<option value=3>Propietario</option>
					              		<option value=4>Arrendatario</option>				              		
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
					              		<option value=1>Activo</option>
					              		<option value=0>Inactivo</option>
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
				
			</div>
	      </div>
	      
	    </div>
	  </div>
	</div>
	{{-- FIN MODAL CREAR --}}

	<!-- MODAL ACTUALIZAR -->
	<div class="modal fade" id="myModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Crear Usuario</h4>
	      </div>

	      
	      <div class="modal-body">
	        <div class="row">
				<form method="POST" action="{{route('admin.users.update',$user)}}">
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
					              		@foreach($tipo_usuarios
					              		 as $tipo)
											<option value="{{ $tipo->id }}" {{ old('tipo_usuario', $user->tipo_usuario) == $tipo->id ? 'selected' : '' }} >
												{{ $tipo->tipo_usuarios }}
											</option>
					              		@endforeach
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
					              		<option value=1 ">Activo</option>
					              		<option value=0>Inactivo</option>
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
				
			</div>
	      </div>
	      
	    </div>
	  </div>
	</div>
	{{-- FIN MODAL ACTUALIZAR--}}
@endpush