@extends('layouts.app')
@section('title', "Dashboard")
@section('subtitle', Auth::User()->name)
@section('email', Auth::User()->email)
@section('user_id', Auth::User()->id)
@section('usercompany_id', Auth::User()->company_id)

@section('content')
<!--begin::Card-->
<div class="card">
	<!--begin::Card header-->
	<div class="card-header border-0 pt-6">
		<!--begin::Card title-->
		<div class="card-title">
			<!--begin::Search-->

			<div class="d-flex align-items-center position-relative my-1">
				<span class="svg-icon svg-icon-1 position-absolute ms-6">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
						<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
					</svg>
				</span>
				<input type="text" id="txtBusqueda" onkeyup="Buscar();" class="form-control form-control-solid w-250px ps-15" placeholder="Búsqueda" />
			</div>

			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		<div class="card-toolbar">
			<!--begin::Toolbar-->
			<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
				<!--begin::Import-->
				@if(Auth::User()->priv === 'cl')
				<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_import_modal">
				<!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil022.svg-->
				<span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path opacity="0.3" d="M5 16C3.3 16 2 14.7 2 13C2 11.3 3.3 10 5 10H5.1C5 9.7 5 9.3 5 9C5 6.2 7.2 4 10 4C11.9 4 13.5 5 14.3 6.5C14.8 6.2 15.4 6 16 6C17.7 6 19 7.3 19 9C19 9.4 18.9 9.7 18.8 10C18.9 10 18.9 10 19 10C20.7 10 22 11.3 22 13C22 14.7 20.7 16 19 16H5ZM8 13.6H16L12.7 10.3C12.3 9.89999 11.7 9.89999 11.3 10.3L8 13.6Z" fill="black"/>
				<path d="M11 13.6V19C11 19.6 11.4 20 12 20C12.6 20 13 19.6 13 19V13.6H11Z" fill="black"/>
				</svg></span>
				<!--end::Svg Icon-->
				Cargar Archivo Altas</button>
				<!--end::Import-->
				@endif
			</div>
			<!--end::Toolbar-->
			<!--begin::Toolbar-->
			<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
				<!--begin::Import-->
				@if(Auth::User()->priv === 'cl')
				<button type="button" class="btn btn-light-warning me-3" data-bs-toggle="modal" data-bs-target="#kt_delete_customers_modal">
				<!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil021.svg-->
				<span class="svg-icon svg-icon-muted svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="black"/>
				<path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="black"/>
				<path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="black"/>
				</svg></span>
				<!--end::Svg Icon-->
				Cargar Archivo Bajas</button>
				<!--end::Import-->
				@endif	
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Card toolbar-->
	</div>
	<!--end::Card header-->
	<!--begin::Card body-->
	<div class="card-body pt-0">
		<!--begin::Table-->
		<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
		<!-- <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table"> -->
			<!--begin::Table head-->
			<thead>
				<!--begin::Table row-->
				<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
					<!--begin::Checkbox ES NECESARIO PARA QUE FUNCIONE LA BUSQUEDA, ORDENAMIENTO Y LISTADO-->
					<th class="w-10px pe-2">
					</th>
					<!--end::Checkbox-->
                    @if(Auth::User()->priv != 'cl')
					<th class="min-w-100px">Empresa</th>
					@endif
					<th class="min-w-125px">Fecha Carga</th>
					<th class="min-w-125px">Archivo</th>
					<th class="min-w-50px">Tipo</th>
					<th class="min-w-125px">Comentarios</th>
					<th class="min-w-125px">Observaciones</th>
                    @if(Auth::User()->priv != 'cl')
					<th class="min-w-70px">Acciónes</th>
                    @endif
				</tr>
				<!--end::Table row-->
			</thead>
			<!--end::Table head-->
			<!--begin::Table body-->
			<tbody class="fw-bold text-gray-600">
				@foreach($cargas as $carga)
				<tr class="text-{{ $carga->status ? 'grey-800 ext-hover-primary mb-1' : (($carga->tipo == 'a') ? 'success' : 'warning') }}">
					<!--begin::Checkbox ES NECESARIO PARA QUE FUNCIONE LA BUSQUEDA, ORDENAMIENTO Y LISTADO-->
					<td>
					</td>
					<!--end::Checkbox-->
                    @if(Auth::User()->priv != "cl")
                    <td>{{$carga->empresa->nombre}}</td>
					@endif
					<td>{{ $carga->fecha_carga }}</td>
					<td>{{ $carga->archivo }}</td>
					@if ($carga->tipo === 'a')
						<td>Alta</td>
					@else
						<td>Baja</td>
					@endif	
					<td>{{ $carga->comentarios }}</td>
					<td>{{ $carga->observaciones }}</td>
                    @if(Auth::User()->priv != "cl")
					<!--begin::Action=-->
					<td class="text-end">
						<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Acciónes
						<!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
						<!--end::Svg Icon--></a>
						<!--begin::Menu-->
						<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="{{ route('cargas.show', $carga->id) }}" class="menu-link px-3">Ver</a>
							</div>
							<!--end::Menu item-->
							@if(Auth::User()->admin)
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								@if(!$carga->status)
									<a href="{{ route('cargas.status', ['id' => $carga->id, 'status'=> true])}}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Pendiente</a>
								@else
									<a href="{{ route('cargas.status', ['id' => $carga->id, 'status'=> false])}}" class="menu-link px-3 text-success" data-kt-customer-table-filter="delete_row">Finalizar</a>
								@endif
								</div>
							<!--end::Menu item-->
                            <!--begin::Menu item-->
							<div class="menu-item px-3">
								<a href="{{'cargas/'.$carga->archivo}}"  class="menu-link px-3">Descargar</a>
							</div>
							<!--end::Menu item-->
							@endif
						</div>
						<!--end::Menu-->
					</td>
                    @endif
					<!--end::Action=-->
				</tr>
				@endforeach
			</tbody>
			<!--end::Table body-->
		</table>
		<!--end::Table-->
	</div>
	<!--end::Card body-->
</div>
<!--end::Card-->
<!--begin::Modal - ALTA DE REGISTROS - Adjust Balance-->
<div class="modal fade" id="kt_customers_import_modal" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bolder">Cargar archivo para altas de regristros</h2>
				<!--end::Modal title-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
				<!--begin::Form-->
				<form class="form" action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
				@csrf	
                <input type="hidden" name="email" value="{{ Auth::User()->email }}">
                <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                <input type="hidden" name="empresa_id" value="{{ Auth::User()->company_id }}">
				<div class="text-center">
					<a href="{{ asset('assets/Plantilla_FuneralNet.xls') }}"  target="_blank" class="menu-link px-3">Descargar Plantilla</a>
				</div>
				<div class="text-center mt-10">
					<a href="{{ asset('assets/Ejemplo.xls') }}"  target="_blank" class="menu-link px-3">Descargar Ejemplo</a>
				</div>
				<!--begin::Input group-->
					<div class="fv-row mb-10 mt-10">
						<input type="file" name="file" class="form-control">
					</div>
					<!--end::Row-->
					<!--begin::Actions-->
					<div class="text-center">
                    <!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 fw-bold mb-2">Comentarios</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" class="form-control form-control-solid"  maxlength="255" placeholder="Comentarios" name="comentarios"/>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Limpiar</button>
						<button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
							<span class="indicator-label">Importar Altas</span>
							<span class="indicator-progress">Por favor espere...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - ALTA DE REGISTROS - New Card-->
<!--begin::Modal - BAJA DE REGISTROS - Adjust Balance-->
<div class="modal fade" id="kt_delete_customers_modal" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Modal header-->
			<div class="modal-header">
				<!--begin::Modal title-->
				<h2 class="fw-bolder">Cargar archivo para bajas de regristros</h2>
				<!--end::Modal title-->
			</div>
			<!--end::Modal header-->
			<!--begin::Modal body-->
			<div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
				<!--begin::Form-->
				<form class="form" action="{{ route('cargas.guardarbajas') }}" method="POST" enctype="multipart/form-data">
				@csrf	
                <input type="hidden" name="email" value="{{ Auth::User()->email }}">
                <input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
                <input type="hidden" name="empresa_id" value="{{ Auth::User()->company_id }}">
				<div class="fv-row mb-7">
					<!--begin::Label-->
					<label class="text-warning fs-6 fw-bold mb-2">Nota:</label>
					<!--end::Label-->
					<!--begin::Label-->
					<label class="text-warning fs-6 fw-bold mb-2">El archivo debe contener al menos un identificador personal que fuera agregado en el archivo de alta para poder ubicarlo y darlo de baja.</label>
					<!--end::Label-->
				</div>
				<!--begin::Input group-->
					<div class="fv-row mb-10 mt-10">
						<input type="file" name="file" class="form-control">
					</div>
					<!--end::Row-->
					<!--begin::Actions-->
					<div class="text-center">
                    <!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="fs-6 fw-bold mb-2">Comentarios</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" class="form-control form-control-solid"  maxlength="255" placeholder="Comentarios" name="comentarios"/>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">Limpiar</button>
						<button type="submit" id="kt_delete_customers" class="btn btn-primary">
							<span class="indicator-label">Importar Bajas</span>
							<span class="indicator-progress">Por favor espere...
							<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
						</button>
					</div>
					<!--end::Actions-->
				</form>
				<!--end::Form-->
			</div>
			<!--end::Modal body-->
		</div>
		<!--end::Modal content-->
	</div>
	<!--end::Modal dialog-->
</div>
<!--end::Modal - BAJA DE REGISTROS - New Card-->
<!--end::Modals-->
<script type="text/javascript">// < ![CDATA[
	function Buscar() {
		var tabla = document.getElementById('kt_customers_table');
		var busqueda = document.getElementById('txtBusqueda').value.toLowerCase();
		var cellsOfRow="";
		var found=false;
		var compareWith="";
		for (var i = 1; i < tabla.rows.length; i++) {
			cellsOfRow = tabla.rows[i].getElementsByTagName('td');
			found = false;
			for (var j = 0; j < cellsOfRow.length && !found; j++) { compareWith = cellsOfRow[j].innerHTML.toLowerCase(); if (busqueda.length == 0 || (compareWith.indexOf(busqueda) > -1))
				{
					found = true;
				}
			}
			if(found)
			{
				tabla.rows[i].style.display = '';
			} else {
				tabla.rows[i].style.display = 'none';
			}
		}
	}
// ]]></script>
@endsection

