@extends('layouts.app')
@section('title', "Usuarios")
@section('subtitle', Auth::User()->name)
@section('email', Auth::User()->email)


@section('content')
<!--begin::Card-->
<div class="card">
	<!--begin::Card header-->
	<div class="card-header border-0 pt-6">
		<!--begin::Card title-->
		<div class="card-title">
			<!--begin::Search-->
			<div class="d-flex align-items-center position-relative my-1">
				<!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
				<span class="svg-icon svg-icon-1 position-absolute ms-6">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
						<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
					</svg>
				</span>
				<!--end::Svg Icon-->
				<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Búsqueda" />
			</div>
			<!--end::Search-->
		</div>
		<!--begin::Card title-->
		<!--begin::Card toolbar-->
		<div class="card-toolbar">
			<!--begin::Toolbar-->
			<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
				<!--begin::Add customer-->
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">Agregar</button>
				<!--end::Add customer-->
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
			<!--begin::Table head-->
			<thead>
				<!--begin::Table row-->
					<tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
					<th class="w-10px pe-2">
					</th>	
					<th class="min-w-125px">Nombre</th>
					<th class="min-w-125px">Email</th>
					<th class="min-w-125px">Teléfono</th>
					<th class="min-w-125px">Empresa</th>
					<th class="min-w-125px">Administrador</th>
					<th class="text-end min-w-70px">Acciónes</th>
				</tr>
				<!--end::Table row-->
			</thead>
			<!--end::Table head-->
			<!--begin::Table body-->
			<tbody class="fw-bold">
				@foreach($users as $user)
				<tr class="text-{{ $user->activo ? 'grey-800' : 'danger' }}">
					<td>
					</td>
					<td>
						{{ $user->name }}
					</td>
					<td>
						{{ $user->email }}
					</td>
                    <td>
						{{ $user->mobile }}
					</td>
                    <td>
						{{ $user->empresa->nombre }}
					</td>
                    <td>
						@if(!$user->admin)
							NO
						@else
							SI
						@endif
					</td>
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
								<a href="{{ route('users.show', $user->id) }}" class="menu-link px-3">Ver</a>
							</div>
							<!--end::Menu item-->
                            <!--begin::Menu item-->
							<div class="menu-item px-3">
								@if(!$user->admin)
									<a href="{{ route('users.permisos', ['id' => $user->id, 'admin'=> true])}}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">ADMIN</a>
								@else
									<a href="{{ route('users.permisos', ['id' => $user->id, 'admin'=> false])}}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">NO ADMIN</a>
								@endif
								</div>
							<!--end::Menu item-->
							<!--begin::Menu item-->
							<div class="menu-item px-3">
								@if(!$user->activo)
									<a href="{{ route('users.status', ['id' => $user->id, 'status'=> true])}}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Activar</a>
								@else
									<a href="{{ route('users.status', ['id' => $user->id, 'status'=> false])}}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Inactivar</a>
								@endif
								</div>
							<!--end::Menu item-->
						</div>
						<!--end::Menu-->
					</td>
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
<!--begin::Modals-->
<!--begin::Modal - Customers - Add-->
<div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Form-->
			<form class="form" action="{{ route('users.store') }}" method="POST">
				@csrf
				<!--begin::Modal header-->
				<div class="modal-header" id="kt_modal_add_customer_header">
					<!--begin::Modal title-->
					<h2 class="fw-bolder">Agregar Usuario</h2>
					<!--end::Modal title-->
				</div>
				<!--end::Modal header-->
				<!--begin::Modal body-->
				<div class="modal-body py-10 px-lg-17">
					<!--begin::Scroll-->
					<div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 fw-bold mb-2">Nombre</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" class="form-control form-control-solid"  maxlength="255" placeholder="Nombre" name="name"/>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 fw-bold mb-2">Email</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" class="form-control form-control-solid" maxlength="100" placeholder="nombre@email.com" name="email"/>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 fw-bold mb-2">Teléfono</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="text" class="form-control form-control-solid" maxlength="10" placeholder="Teléfono" name="mobile"/>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 fw-bold mb-2">Empresa</label>
							<!--end::Label-->
							<select class="form-select" aria-label="Empresa" name="company_id">
								<option>Seleccionar Empresa</option>
								@foreach($empresas as $empresa)
								<option value="{{ $empresa->id}}">{{$empresa->nombre}}</option>
								@endforeach
							</select>
						</div>
						<!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Privilegios</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select" aria-label="Privilegios" name="priv">
								<option>Seleccionar Privilegios</option>
								<option value="cl">Cliente</option>
								<option value="cc">CallCenter</option>
								<option value="ad">Administrador</option>
							</select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
						<!--begin::Input group-->
						<div class="fv-row mb-7">
							<!--begin::Label-->
							<label class="required fs-6 fw-bold mb-2">Contraseña</label>
							<!--end::Label-->
							<!--begin::Input-->
							<input type="password" class="form-control form-control-solid" placeholder="Contraseña" name="password"/>
							<!--end::Input-->
						</div>
						<!--end::Input group-->
					</div>
					<!--end::Scroll-->
				</div>
				<!--end::Modal body-->
				<!--begin::Modal footer-->
				<div class="modal-footer flex-center">
					<!--begin::Button-->
					<button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">Limpiar</button>
					<!--end::Button-->
					<!--begin::Button-->
					<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
						<span class="indicator-label">Agregar</span>
						<span class="indicator-progress">Por favor espere...
						<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
					</button>
					<!--end::Button-->
				</div>
				<!--end::Modal footer-->
			</form>
			<!--end::Form-->
		</div>
	</div>
</div>
<!--end::Modals-->
@endsection