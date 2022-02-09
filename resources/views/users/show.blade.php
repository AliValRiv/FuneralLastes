@extends('layouts.app')

@section('title')
Usuario
@endsection

@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Usuario</h3>
                <div class="card-toolbar">
                    
                </div>
            </div>
            <form class="form" action="{{ route('users.update', $user->id) }}" method="POST" id="kt_modal_add_customer_form" data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                @csrf
                {{ method_field('PATCH') }}
                <div class="card-body">
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Nombre</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="Nombre" name="name" value='{{ $user->name }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="email" class="form-control form-control-solid" maxlength="100" placeholder="nombre@email.com" name="email" value='{{ $user->email }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Telefono</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" maxlength="10" placeholder="5512345678" name="mobile" value='{{ $user->mobile }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Empresa</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select" aria-label="Empresa" name="company_id"'>
								<option>Seleccionar Empresa</option>
								@foreach($empresas as $empresa)
								<option value="{{ $empresa->id}}" {{$empresa->id == $user->company_id ? 'selected':''}}>{{$empresa->nombre}}</option>
								@endforeach
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
                            <input type="password" class="form-control form-control-solid" maxlength="20" placeholder="Contraseña" name="password" value='{{ $user->password }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                </div>
                <div class="card-footer">
                <!--begin::Button-->
                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                        <span class="indicator-label">Guardar</span>
                        <span class="indicator-progress">Por favor espere...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </form>
        </div>
    </div>
</div>
@endsection