@extends('layouts.app')

@section('title')
Empresa
@endsection

@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title">Empresa</h3>
                <div class="card-toolbar">
                    
                </div>
            </div>
            <form class="form" action="{{ route('empresas.update', $empresa->id) }}" method="POST" id="kt_modal_add_customer_form" data-kt-redirect="../../demo6/dist/apps/customers/list.html">
                @csrf
                {{ method_field('PATCH') }}
                <input type="hidden" name="empresa_id" value="{{ Auth::User()->company_id }}">
                    <div class="card-body">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-6 fw-bold mb-2">Empresa</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" placeholder="Nombre" name="nombre" value='{{ $empresa->nombre }}'/>
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