@extends('admin.layout')

@section('content')
	<div class="row">
				<form method="POST" action="{{route('adminc.tipoaptos.update',$tipo_apto->id)}}">
					@csrf
					{{ method_field('PUT') }}

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('tipo_apto') ? 'has-error' : '' }}">
										<label for="tipo_apto" >Tipo de Apartamento</label>
										<input name="tipo_apto" placeholder="Ingresa el tipo de apto./casa" type="text" class="form-control" value="{{ old('tipo_apto', $tipo_apto->tipo_apto) }}">
										{!! $errors->first('tipo_apto','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('cobro') ? 'has-error' : '' }}">
										<label for="cobro" >Cobro</label>
										<input name="cobro" placeholder="Ingresa el cobro del bloque" type="text" class="form-control" value="{{ old('cobro', $tipo_apto->cobro) }}">
										{!! $errors->first('cobro','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('vigencia') ? 'has-error' : '' }}">
										<label for="vigencia" >Vigencia de cobro en dias</label>
										<input name="vigencia" placeholder="Ingresa la vigencia en dias del cobro de admon." type="text" class="form-control" value="{{ old('vigencia', $tipo_apto->vigencia) }}">
										{!! $errors->first('vigencia','<span class="help-block">:message</span>') !!}
									</div>

									<div class="form-group {{ $errors->has('metros') ? 'has-error' : '' }}">
										<label for="metros" >Metros cuadrados del apto. o casa</label>
										<input name="metros" placeholder="Ingresa la m2 del apto. o casa" type="text" class="form-control" value="{{ old('metros', $tipo_apto->metros) }}">
										{!! $errors->first('metros','<span class="help-block">:message</span>') !!}
									</div>

					              <div class="form-group {{ $errors->has('id_unidad') ? 'has-error' : '' }}">
					              	<label>Unidad</label>
					              	<select name="id_unidad" id="" class="form-control">
					              		<option value="">Selecciona la Unidad</option>
					              		@foreach($unidades as $unidad)
											<option value="{{ $unidad->id }}" {{ old('id_unidad',$tipo_apto->id_unidad) == $unidad->id ? 'selected' : '' }} >
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