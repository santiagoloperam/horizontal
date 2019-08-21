@extends('admin.layout')

@section('content')
	<h1>UNIDADES</h1>

	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Nueva Unidad</button>

	 <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Unidades</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="unidades-table" class="table table-bordered table-striped">
                <thead>
	                <tr>
	                  <th>ID</th>
	                  <th>UNIDAD</th>
	                  <th>DIRECCION</th>                
	                  <th>TELÉFONO</th>                
	                  <th>ADMINISTRADOR</th>                
	                  <th>ACTIVO</th>  
	                  <th>ACCIONES</th> 
	                </tr>
                </thead>
                
                <tbody>
                	@foreach($unidades as $unidad)
						<tr>
							<td>{{ $unidad->id }}</td>
							<td>{{ $unidad->nombre }}</td>
							<td>{{ $unidad->direccion }}</td>
							<td>{{ $unidad->telefono }}</td>
							<td>{{ $unidad->admin->name }} {{ $unidad->admin->last_name }}</td> 						
							<td>
								@if($unidad->active == 1)
									<i class="fa fa-check iconos">										
								@else
									<i class="fa fa-times iconos">
								@endif
							</td>
							<td>
								&nbsp;&nbsp;&nbsp;
								<a href="{{ route('admin.unidades.edit',$unidad) }}"  class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a>

								{{--  <a href="{{ route('admin.unidads.delete',$unidad) }}" class="btn btn-xs btn-danger" onclick="return confirm('Está seguro de eliminar el registro?')"><i class="fa fa-times"></i></a> --}}
								<form method="post" action="{{ route('admin.unidades.delete',$unidad) }}" class="pull-left">
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
	  	//if($('#unidades-table').DataTable() != undefined){
		    $('#unidades-table').DataTable()({
		      'paging'      : true,
		      'lengthChange': false,
		      'searching'   : false,
		      'ordering'    : true,
		      'info'        : true,
		      'autoWidth'   : false
		    })
		//}
	  })
	</script>

	<!-- Modal CREAR-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Crear Unidad</h4>
	      </div>

	      
	      <div class="modal-body">
	        <div class="row">
				<form method="POST" action="{{route('admin.unidades.store')}}">
					@csrf

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
										<label for="nombre" >Nombre del Conjunto</label>
										<input name="nombre" placeholder="Ingresa el nombre de la unidad" type="text" class="form-control" value="{{ old('nombre') }}">
										{!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
									</div>
									
									<div class="form-group {{ $errors->has('direccion') ? 'has-error' : '' }}">
										<label for="direccion" >Dirección</label>
										<input name="direccion" placeholder="Ingresa la dirección de la unidad" type="text" class="form-control" value="{{ old('direccion') }}">
										{!! $errors->first('direccion','<span class="help-block">:message</span>') !!}
									</div>
									

									<div class="form-group {{ $errors->has('telefono') ? 'has-error' : '' }}">
										<label for="telefono" >Teléfono</label>
										<input name="telefono" placeholder="Ingresa numero de teléfono p/pal de la unidad" type="number" class="form-control" value="{{ old('telefono') }}">
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

					              <div class="form-group {{ $errors->has('id_admin') ? 'has-error' : '' }}">
					              	<label>Administrador</label>
					              	<select name="id_admin" id="" class="form-control">
					              		<option value="">Seleccione el Administrador</option>
					              		@foreach($users as $user)
											<option value="{{ $user->id }}" {{ old('id_admin') == $user->id ? 'selected' : '' }}>
												{{ $user->name }} {{ $user->last_name }}
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('id_admin','<span class="help-block">:message</span>') !!}
					              </div>					              
								

								<div class="form-group">
									<label for="active" >Unidad Activo?</label>
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
	
	{{-- FIN MODAL ACTUALIZAR--}}
@endpush