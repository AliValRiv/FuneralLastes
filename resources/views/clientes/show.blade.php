@extends('layouts.app')

@section('title')
Contacto
@endsection

@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Contacto</h3>
                <div class="card-toolbar">
                    
                </div>
            </div>
            <form class="form" action="{{ route('clientes.update', $cliente->id) }}" method="POST" id="kt_modal_add_customer_form" data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                @csrf
                {{ method_field('PATCH') }}
                <input type="hidden" name="empresa_id" value="{{ Auth::User()->company_id }}">
                    <div class="card-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">No. Empelado</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid"  maxlength="100" placeholder="No. Empleado" name="empleado" value='{{ $cliente->empleado }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Apellido Paterno</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid"  maxlength="255" placeholder="Apellido Paterno" name="paterno" value='{{ $cliente->paterno }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Apellido Materno</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" maxlength="255" placeholder="Apellido Materno" name="materno" value='{{ $cliente->materno }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Nombre(s)</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" maxlength="255" placeholder="Nombre(s)" name="nombre" value='{{ $cliente->nombre }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Genero</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select" aria-label="Genero" name="genero"'>
								<option value="">Seleccionar Genero</option>
								<option value="M" {{$cliente->genero == 'M' ? 'selected':''}}>MASCULINO</option>
                                <option value="F" {{$cliente->genero == 'F' ? 'selected':''}}>FEMENINO</option>
                                
							</select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Fecha de Nacimiento</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="date" class="form-control form-control-solid" placeholder="dd/MM/yyyy" name="fecha_nacimiento" value='{{ $cliente->fecha_nacimiento }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                            <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Fecha de Inicio de Vigencia</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="date" class="form-control form-control-solid" placeholder="dd/MM/yyyy" name="fecha_inicio" value='{{ $cliente->fecha_inicio }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                            <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">Fecha de Fin de Vigencia</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="date" class="form-control form-control-solid" placeholder="dd/MM/yyyy" name="fecha_fin" value='{{ $cliente->fecha_fin }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">CURP</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" maxlength="18" placeholder="CURP" name="curp"  value='{{ $cliente->curp }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">RFC</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" maxlength="13" placeholder="RFC" name="rfc"  value='{{ $cliente->rfc }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">NSS</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" maxlength="15" placeholder="NSS" name="nss"  value='{{ $cliente->nss }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Teléfono</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" maxlength="10" placeholder="5512345678" name="telefono"  value='{{ $cliente->telefono }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-15">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">Email</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="email" class="form-control form-control-solid" maxlength="100" placeholder="correo@mail.com" name="email"  value='{{ $cliente->email }}'/>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        </div>
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