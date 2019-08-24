@extends('admin.layout')

@section('content')
	<h1>UNIDADES</h1>


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

	
@endpush