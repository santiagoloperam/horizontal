@extends('adminc.layout')

@section('content')
	<h1>TIPO DE APARTAMENTOS/CASAS</h1>

	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Nuevo Tipo de Apto/Casa</button>

	 <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de tipos de aptos/casas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

				
              <table id="tipo_aptos-table" class="table table-bordered table-striped">

				
                <thead> 
                	<th></th>
                	<th></th>
                	<th>
                		<div class="col-lg-4">
                			<select name="unidades-select" class="form-control input-sm">
	                  		@foreach($unidades as $unidad)
			              		<option>Filtre por Unidad</option>
			              		<option value="{{ $unidad->id_unidad }}">{{ $unidad->nombre }}</option>
		              		@endforeach
		              	</select>
                		</div>
                	</th>               	
	                <tr>
	                  <th>ID</th>
	                  <th>NOMBRE TIPO APTO</th>
	                  <th>COBRO</th>
	                  <th>VIGENCIA</th>
	                  <th>METROS</th>
	                  <th>UNIDAD</th> 
	                  <th>ACCIONES</th> 
	                </tr>
                </thead>
                
                <tbody>
                	@foreach($tipo_aptos as $tipo_apto)
						<tr>
							<td>{{ $tipo_apto->id }}</td>
							<td>{{ $tipo_apto->tipo_apto }}</td>
							<td>{{ $tipo_apto->cobro }}</td>
							<td>{{ $tipo_apto->vigencia }}</td> 						
							<td>{{ $tipo_apto->metros }}</td> 						
							<td>{{ $tipo_apto->unidad }}</td> 						
							
							<td>
								&nbsp;&nbsp;&nbsp;
								<a href="{{ route('adminc.tipoaptos.edit',$tipo_apto->id) }}"  class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a>

								{{--  <a href="{{ route('admin.unidads.delete',$unidad) }}" class="btn btn-xs btn-danger" onclick="return confirm('Está seguro de eliminar el registro?')"><i class="fa fa-times"></i></a> --}}
								<form method="post" action="{{ route('adminc.tipoaptos.delete',$tipo_apto->id) }}" class="pull-left">
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
	    $('#tipo_aptos-table').DataTable()({
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
				<form method="POST" action="{{route('adminc.tipoaptos.store')}}">
					@csrf

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('tipo_apto') ? 'has-error' : '' }}">
										<label for="tipo_apto" >Tipo de Apartamento</label>
										<input name="tipo_apto" placeholder="Ingresa el tipo de apto./casa" type="text" class="form-control" value="{{ old('tipo_apto') }}">
										{!! $errors->first('tipo_apto','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('cobro') ? 'has-error' : '' }}">
										<label for="cobro" >Cobro</label>
										<input name="cobro" placeholder="Ingresa el cobro administrativo por periodo" type="text" class="form-control" value="{{ old('cobro') }}">
										{!! $errors->first('cobro','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('vigencia') ? 'has-error' : '' }}">
										<label for="vigencia" >Vigencia de cobro en dias</label>
										<input name="vigencia" placeholder="Ingresa la vigencia en dias del cobro de admon." type="text" class="form-control" value="{{ old('vigencia') }}">
										{!! $errors->first('vigencia','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('metros') ? 'has-error' : '' }}">
										<label for="metros" >Metros cuadrados del apto. o casa </label>
										<input name="metros" placeholder="Ingresa la m2 del apto. o casa" type="text" class="form-control" value="{{ old('metros') }}">
										{!! $errors->first('metros','<span class="help-block">:message</span>') !!}
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