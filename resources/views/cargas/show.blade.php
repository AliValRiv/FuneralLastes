@extends('layouts.app')

@section('title')
Carga
@endsection

@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Carga</h3>
                <div class="card-toolbar">
                    
                </div>
            </div>
            <form class="form" action="{{ route('cargas.update', $carga->id) }}" method="POST" id="kt_modal_add_customer_form" data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                @csrf
                {{ method_field('PATCH') }}
                    <div class="card-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Fecha de Carga</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid"  maxlength="100" name="fecha_carga" value='{{ $carga->fecha_carga }}' disabled/>
                            <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Archivo</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid"  maxlength="255" name="archivo" value='{{ $carga->archivo }}' disabled/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Usuario</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" maxlength="255" name="usuario" value='{{ $carga->user->email }}' disabled/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Empresa</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" maxlength="255" name="empresa" value='{{ $carga->empresa->nombre }}' disabled/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold mb-2">Comentarios(s)</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" maxlength="255" placeholder="Comentarios" name="comentarios" value='{{ $carga->comentarios }}' disabled/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Observaciones(s)</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" maxlength="255" placeholder="Observaciones" name="observaciones" value='{{ $carga->observaciones }}'/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                    </div>
                <div class="card-footer">
                    <!--begin::Button-->
                    @if(Auth::User()->admin)
                    <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                        <span class="indicator-label">Guardar</span>
                        <span class="indicator-progress">Por favor espere...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    @endif
                    <button type="button" class="btn btn-primary" onclick="location.href='/dashboard'">
                        <span class="indicator-label">Regresar</span>
                    </button>
                    <!--end::Button-->
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
@endsection