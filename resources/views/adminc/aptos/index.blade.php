@extends('adminc.layout')

@section('content')
	<h1>APARTAMENTOS/CASAS</h1>

	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Nuevo Apto./Casa</button>

	 <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Bloques</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

				
              <table id="bloques-table" class="table table-bordered table-striped">


                <thead> 
                	<tr>
                		<th></th>
                		<th></th>
                		<th>
                			<select name="unidades-select" class="form-control input-sm">
		                  		@foreach($bloques as $bloque)
				              		<option>Filtre por Unidad</option>
				              		<option value="{{ $bloque->id_unidad }}">{{ $bloque->unidad }}</option>
			              		@endforeach
		              		</select>
                		</th>
                	</tr>               	
	                <tr>
	                  <th>ID</th>
	                  <th>NOMENCLATURA</th>
	                  <th>UNIDAD</th> 
	                  <th>BLOQUE</th> 
	                  <th>TIPO APTO/CASA</th> 
	                  <th>PROPIETARIO</th> 
	                  <th>ARRENDATARIO</th> 
	                  <th>ACCIONES</th> 
	                </tr>
                </thead>
                
                <tbody>
                	@foreach($aptos as $apto)
						<tr>
							<td>{{ $apto->id }}</td>
							<td>{{ $apto->nomenclatura }}</td>
							<td>{{ $apto->unidad->nombre }}</td>
							<td>{{ $apto->bloque->nombre }}</td>
							<td>{{ $apto->tipoapto->tipo_apto }}</td>
							<td>{{ $apto->propietario->name }} {{ $apto->propietario->last_name }}</td>
							<td>{{ $apto->arrendatario ? $apto->arrendatario->name  : '' }} {{ $apto->arrendatario ? $apto->arrendatario->last_name  : '' }}</td>
													
							
							<td>
								&nbsp;&nbsp;&nbsp;
								<a href="{{ route('adminc.aptos.edit',$apto->id) }}"  class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a>

								{{--  <a href="{{ route('admin.unidads.delete',$unidad) }}" class="btn btn-xs btn-danger" onclick="return confirm('Está seguro de eliminar el registro?')"><i class="fa fa-times"></i></a> --}}
								<form method="post" action="{{ route('adminc.aptos.delete',$apto->id) }}" class="pull-left">
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
	        <h4 class="modal-title" id="myModalLabel">Crear Apto/Casa</h4>
	      </div>

	      
	      <div class="modal-body">
	        <div class="row">
				<form method="POST" action="{{route('adminc.aptos.store')}}">
					@csrf

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('nomenclatura') ? 'has-error' : '' }}">
										<label for="nomenclatura" >Nomenclatura del Apto/Casa</label>
										<input name="nomenclatura" placeholder="Ingresa la nomenclatura del apto/casa" type="text" class="form-control" value="{{ old('nomenclatura') }}">
										{!! $errors->first('nomenclatura','<span class="help-block">:message</span>') !!}
									</div>

					              <div class="form-group {{ $errors->has('id_unidad') ? 'has-error' : '' }}">
					              	<label>Unidad</label>
					              	<select name="id_unidad" id="" class="form-control">
					              		<option value="">Seleccione la Unidad a la que pertenece</option>
					              		@foreach($unidades as $unidad)
											<option value="{{ $unidad->id }}" {{ old('id_unidad') == $unidad->id ? 'selected' : '' }}>
												{{ $unidad->nombre }} 
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('id_unidad','<span class="help-block">:message</span>') !!}
					              </div>	
								
								<div class="form-group {{ $errors->has('id_bloque') ? 'has-error' : '' }}">
					              	<label>Bloque</label>
					              	<select name="id_bloque" id="" class="form-control">
					              		<option value="">Seleccione el bloque al que pertenece</option>
					              		@foreach($bloques as $bloque)
											<option value="{{ $bloque->id }}" {{ old('id_bloque') == $bloque->id ? 'selected' : '' }}>
												{{ $bloque->bloque }} 
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('id_bloque','<span class="help-block">:message</span>') !!}
					              </div>

					              <div class="form-group {{ $errors->has('id_tipo_apto') ? 'has-error' : '' }}">
					              	<label>Tipo de Apto/Casa</label>
					              	<select name="id_tipo_apto" id="" class="form-control">
					              		<option value="">Seleccione el tipo de apto./casa</option>
					              		@foreach($tipoaptos as $tipoapto)
											<option value="{{ $tipoapto->id }}" {{ old('id_tipo_apto') == $tipoapto->id ? 'selected' : '' }}>
												{{ $tipoapto->tipo_apto }} 
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('id_tipo_apto','<span class="help-block">:message</span>') !!}
					              </div>

					              <div class="form-group {{ $errors->has('id_propietario') ? 'has-error' : '' }}">
					              	<label>Propietario</label>
					              	<select name="id_propietario" id="" class="form-control">
					              		<option value="">Seleccione el propietario del apto./casa</option>
					              		@foreach($propietarios as $propietario)
											<option value="{{ $propietario->id }}" {{ old('id_propietario') == $propietario->id ? 'selected' : '' }}>
												{{ $propietario->name }} {{ $propietario->last_name }}
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('id_propietario','<span class="help-block">:message</span>') !!}
					              </div>

					              <div class="form-group {{ $errors->has('id_arrendatario') ? 'has-error' : '' }}">
					              	<label>Arrendatario</label>
					              	<select name="id_arrendatario" id="" class="form-control">
					              		<option value="">Seleccione el Arrendatario (opcional)</option>
					              		@if($arrendatarios->first())
						              		@foreach($arrendatarios as $arrendatario)
												<option value="{{ $arrendatario->id }}" {{ old('id_arrendatario') == $arrendatario->id ? 'selected' : '' }}>
													{{ $arrendatario->name }} {{ $arrendatario->last_name }}
												</option>
						              		@endforeach
					              		@endif
					              	</select>
					              	{!! $errors->first('id_arrendatario','<span class="help-block">:message</span>') !!}
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