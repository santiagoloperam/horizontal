@extends('admin.layout')

@section('content')
	<div class="row">
				<form method="POST" action="{{route('adminc.bloques.update',$bloque->id)}}">
					@csrf
					{{ method_field('PUT') }}

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('nombre') ? 'has-error' : '' }}">
										<label for="nombre" >Nombre del Bloque</label>
										<input name="nombre" placeholder="Ingresa el nombre del bloque" type="text" class="form-control" value="{{ old('nombre', $bloque->bloque) }}">
										{!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
									</div>

					              <div class="form-group {{ $errors->has('id_unidad') ? 'has-error' : '' }}">
					              	<label>Unidad</label>
					              	<select name="id_unidad" id="" class="form-control">
					              		<option value="">Selecciona la Unidad</option>
					              		@foreach($unidades as $unidad)
											<option value="{{ $unidad->id }}" {{ old('id_unidad', $bloque->id_unidad) == $unidad->id ? 'selected' : '' }} >
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

			      </div>

		      </form>

		  </div>
				
			
@endsection