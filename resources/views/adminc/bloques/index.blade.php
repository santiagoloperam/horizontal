@extends('admin.layout')

@section('content')
	<h1>BLOQUES</h1>

	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Nuevo Bloque/Interior</button>

	 <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Bloques</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

				
              <table id="bloques-table" class="table table-bordered table-striped">


                <thead>                	
	                <tr>
	                  <th>ID</th>
	                  <th>NOMBRE BLOQUE</th>
	                  <th>
	                  	UNIDAD
	                  	<select name="unidades-select" class="form-control input-sm">
	                  		@foreach($bloques as $bloque)
			              		<option>Filtre por Unidad</option>
			              		<option value="{{ $bloque->id_unidad }}">{{ $bloque->unidad }}</option>
		              		@endforeach
		              	</select>
	                  </th> 
	                  <th>ACCIONES</th> 
	                </tr>
                </thead>
                
                <tbody>
                	@foreach($bloques as $bloque)
						<tr>
							<td>{{ $bloque->id }}</td>
							<td>{{ $bloque->bloque }}</td>
							<td>{{ $bloque->unidad }}</td> 						
							
							<td>
								&nbsp;&nbsp;&nbsp;
								<a href="{{ route('adminc.bloques.edit',$bloque->id) }}"  class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a>

								{{--  <a href="{{ route('admin.unidads.delete',$unidad) }}" class="btn btn-xs btn-danger" onclick="return confirm('Está seguro de eliminar el registro?')"><i class="fa fa-times"></i></a> --}}
								<form method="post" action="{{ route('adminc.bloques.delete',$bloque->id) }}" class="pull-left">
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
	    $('#bloques-table').DataTable()({
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
	        <h4 class="modal-title" id="myModalLabel">Crear Bloque</h4>
	      </div>

	      
	      <div class="modal-body">
	        <div class="row">
				<form method="POST" action="{{route('adminc.bloques.store')}}">
					@csrf

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
										<label for="nombre" >Nombre del Bloque/Interior/Manzana</label>
										<input name="nombre" placeholder="Ingresa el nombre del bloque/interior" type="text" class="form-control" value="{{ old('nombre') }}">
										{!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
									</div>

					              <div class="form-group {{ $errors->has('id_unidad') ? 'has-error' : '' }}">
					              	<label>Unidad</label>
					              	<select name="id_unidad" id="" class="form-control">
					              		<option value="">Seleccione la Unidad</option>
					              		@foreach($unidades as $unidad)
											<option value="{{ $unidad->id }}" {{ old('id_unidad') == $unidad->id ? 'selected' : '' }}>
												{{ $unidad->nombre }} 
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('id_unidad','<span class="help-block">:message</span>') !!}
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