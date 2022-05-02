@extends('layouts.app')
@section('title', "Clientes")
@section('subtitle', Auth::User()->name)
@section('email', Auth::User()->email)


@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css"/>
 	
<div class="container">
	<div class="card">
		<div class="card-body">
			<table id="clientes" class="table table-striped" style="width:100%">
				<!--begin::Table head-->
				<thead>
					<!--begin::Table row-->
					<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
						<th>Id</th>
						<th>Empresa</th>
						<th>Empleado</th>
						<th>Paterno</th>
						<th>Materno</th>
						<th>Nombre</th>
						<th>Fecha Nacimiento</th>
						<th>Estauts</th>
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
					<!--end::Table row-->
				</thead>
				<!--end::Table head-->
			</table>
		</div>
	</div>
</div>
		
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/bootstrap.bundle.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>
	<script>
		$(document).ready(function() {
			$('#clientes').DataTable({
				"ajax": "{{ route('datatable.cliente') }}",
            responsive: true,
				"columns": [
					{data: 'id'},
					{data: 'nombre_empresa'},
					{data: 'empleado'},
					{data: 'paterno'},
					{data: 'materno'},
					{data: 'nombre'},
					{data: 'fecha_nacimiento'},
					{data: 'estatus'},
					{data: 'ver'},
					{data: 'status'},
				], 
				"columnDefs": [{
				"targets": 0,
				"visible": false,
				"searchable": false,
				}],
				
				filter: true,
				"searching":true,
				language: {
				"sProcessing": "Procesando...",
				"sLengthMenu": "Mostrar _MENU_ resultados",
				"sZeroRecords": "No se encontraron resultados",
				"sEmptyTable": "Ningun dato disponible en esta tabla",
				"sInfo": "Mostrando resultados _START_-_END_ de  _TOTAL_",
				"sInfoEmpty": "Mostrando resultados del 0 al 0 de un total de 0 registros",
				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
				"sSearch": "Buscar ",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst": "Primero",
					"sLast": "Ultimo",
					"sNext": "Siguiente",
					"sPrevious": "Anterior"
				},
				"iDisplayLength": 50, 
				"processing": true,
				"serverSide": true,
				},
				
        		"scrollX": true
			});
		} );
	</script>
@endsection

