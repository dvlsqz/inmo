@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Centros <a href="centro_educativo/create"><button class="btn btn-success">Nuevo</button></h3></a>
		@include('centro_educativo.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Logo</th>
					<th>Nombre</th>
					<th>Direccion</th>
					<th>Ciudad</th>
					<th>Telefonos</th>
					<th>Opciones</th>
				</thead>

				@foreach($centros as $cen)
					<tr>
						<td><td><img src="{{asset('imagenes/logos/'.$cen->logo)}}" all="{{$cen->logo}}" height="100px" width="100px"></td></td>
						<td>{{$cen->nombre}}</td>
						<td>{{$cen->direccion}}</td>
						<td>{{$cen->ciudad}}</td>
						<td>{{$cen->telefono1.' '.$cen->telefono2}}</td>
						<td>
							<a href="{{URL::action('CentroController@edit', $cen->id)}}">
								<button class="btn btn-info fa fa-edit"></button>
							</a>

							<a href="{{URL::action('CentroController@show',$cen->id)}}">
								<button class="btn btn-primary fa fa-eye"></button>
							</a>

							<a href="" data-target="#modal-delete-{{$cen->id}}" data-toggle="modal">
								<button class="btn btn-danger fa  fa-trash-o"></button>
							</a>
						</td>
					</tr>
					@include('centro_educativo.modal')
				@endforeach
			</table>
		</div>
		{{$centros->render()}}
	</div>
</div>
@endsection
