@extends('adminc.layout')

@section('content')
	<h1>FACTURAS</h1>

	<button class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Crear Nuevo Factura</button>

	 <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Listado de Facturas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

				
              <table id="bloques-table" class="table table-bordered table-striped">


                <thead> 
                	<!--<tr>
                		<th></th>
                		<th></th>
                		<th>
                			<select name="unidades-select" class="form-control input-sm">
		                  		@foreach($unidades as $unidad)
				              		<option>Filtre por Unidad</option>
				              		<option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
			              		@endforeach
		              		</select>
                		</th> -->
                	</tr>               	
	                <tr>
	                  <th>ID</th>
	                  <th>APTO/CASA</th>
	                  <th>CONSECUTIVO</th> 
	                  <th>VALOR FACTURA</th> 
	                  <th>MES/AÑO</th> 
	                  <th>ESTADO DE PAGO</th> 
	                  <th>ACCIONES</th> 
	                </tr>
                </thead>
                
                <tbody>
                	@foreach($facturas as $factura)
						<tr>
							<td>{{ $factura->id }}</td>
							<td>{{ $factura->apto }}</td>
							<td>{{ $factura->consecutivo }}</td>
							<td>{{ $factura->monto_total_fact }}</td>
							<td>{{ $factura->mes_ano }}</td>
							<td>
								@if($factura->estado == 1)
									<i class="fa fa-check iconos">										
								@else
									<i class="fa fa-times iconos">
								@endif
							</td>
																				
							
							<td>
								&nbsp;&nbsp;&nbsp;
								<a href="{{ route('adminc.facturas.edit',$factura->id) }}"  class="btn btn-xs btn-info" ><i class="fa fa-pencil"></i></a>

								{{--  <a href="{{ route('admin.unidads.delete',$unidad) }}" class="btn btn-xs btn-danger" onclick="return confirm('Está seguro de eliminar el registro?')"><i class="fa fa-times"></i></a> --}}
								<form method="post" action="{{ route('adminc.facturas.delete',$factura->id) }}" class="pull-left">
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
	        <h4 class="modal-title" id="myModalLabel">Crear Factura</h4>
	      </div>

	      
	      <div class="modal-body">
	        <div class="row">
				<form method="POST" action="{{route('adminc.aptos.store')}}">
					@csrf

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									
					              <div class="form-group {{ $errors->has('apto_id') ? 'has-error' : '' }}">
					              	<label>Apto/Casa</label>
					              	<select name="apto_id" id="unidad" class="form-control">
					              		<option value="">Seleccione el Apto/Casa a facturar</option>
					              		@foreach($aptos as $apto)
											<option value="{{ $apto->id }}" {{ old('apto_id') == $apto->id ? 'selected' : '' }}>
												{{ $apto->nomenclatura }} 
											</option>
					              		@endforeach
					              	</select>
					              	{!! $errors->first('apto_id','<span class="help-block">:message</span>') !!}
					              </div>	
								
									<div class="form-group {{ $errors->has('tipo_apto') ? 'has-error' : '' }}">
										<label for="monto_total_fact" >Valor a Facturar</label>
										<input name="monto_total_fact" placeholder="Ingresa el valor total a facturar" type="number" class="form-control" value="{{ old('monto_total_fact') }}">
										{!! $errors->first('monto_total_fact','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('tipo_apto') ? 'has-error' : '' }}">
										<label for="monto_total_fact" >Fecha a Facturar</label>
										<input name="monto_total_fact" placeholder="Ingresa la fecha a facturar" type="date" class="form-control" value="{{ old('monto_total_fact') }}">
										{!! $errors->first('monto_total_fact','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group">
									<label for="estado" >Estado de Pago</label>
									<select name="estado" id="" class="form-control">
					              		<option value=1 ">Cancelado</option>
					              		<option value=0>Sin Cancelar</option>
					              	</select>
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
	<script>
		$('#unidad').on('change',function(e){
			console.log(e);

			var uni_id = e.target.value;

			//AJAX
			$.get('adminc/ajax-selectblo?uni_id = ' + uni_id, function(data){
				//SUCCESS DATA
				$('#bloque').empty();
				$.each(data,function(index,selectObj){
					$('#bloque').append('<option value="'+selectObj.id+'">'+selectObj.nombre+'</option>')
				});
			});
		});

		
		
	</script>
	
@endpush