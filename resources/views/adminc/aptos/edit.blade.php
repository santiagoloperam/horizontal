@extends('admin.layout')

@section('content')
	<div class="row">
				<form method="POST" action="{{route('adminc.aptos.update',$apto->id)}}">
					@csrf
					{{ method_field('PUT') }}

					<div class="col-md-8">
						<div class="box box-primary">
							
								<div class="box-body">

									<div class="form-group {{ $errors->has('nomenclatura') ? 'has-error' : '' }}">
										<label for="nomenclatura" >Nomenclatura del apto./Casa</label>
										<input name="nomenclatura" placeholder="Ingresa el nomenclatura del apto./casa" type="text" class="form-control" value="{{ old('nomenclatura', $apto->nomenclatura) }}">
										{!! $errors->first('nomenclatura','<span class="help-block">:message</span>') !!}
									</div>

					              <div class="form-group {{ $errors->has('id_admin') ? 'has-error' : '' }}">
					              	<label>Unidad</label>
					              	<select name="id_unidad" id="" class="form-control">
					              		<option value="">Selecciona la Unidad a la que pertenece</option>
					              		@foreach($unidades as $unidad)
											<option value="{{ $unidad->id }}" {{ old('id_unidad', $apto->id_unidad) == $unidad->id ? 'selected' : '' }} >
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
											<option value="{{ $bloque->id }}" {{ old('id_bloque', $apto->id_bloque) == $bloque->id ? 'selected' : '' }}>
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
											<option value="{{ $tipoapto->id }}" {{ old('id_tipo_apto', $apto->id_tipo_apto) == $tipoapto->id ? 'selected' : '' }}>
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
											<option value="{{ $propietario->id }}" {{ old('id_propietario', $apto->id_propietario) == $propietario->id ? 'selected' : '' }}>
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
												<option value="{{ $arrendatario->id }}" {{ old('id_arrendatario', $apto->id_arrendatario) == $arrendatario->id ? 'selected' : '' }}>
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

			      </div>

		      </form>

		  </div>
				
			
@endsection