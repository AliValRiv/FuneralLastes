@extends('layouts.auth')

@section('content')
<!--begin::Authentication - Two-stes -->
<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url(assets/media/illustrations/sketchy-1/14.png">
    <!--begin::Content-->
    <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">
        <!--begin::Logo-->
        <a href="{{ route('login') }}" class="mb-12">
            <img alt="Logo" src="{{ asset('assets/media/logos/logo.png') }}" class="h-40px" />
        </a>
        <!--end::Logo-->
        <!--begin::Wrapper-->
        <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
            <!--begin::Form-->
            <form class="form w-100 mb-10" method="POST"  action="{{ route('login.verification') }}" novalidate="novalidate" id="kt_sing_in_two_steps_form">
                @csrf
                <!--begin::Icon-->
                <div class="text-center mb-10">
                    <img alt="Logo" class="mh-125px" src="{{ asset ('assets/media/svg/misc//smartphone.svg') }}" />
                </div>
                <!--end::Icon-->
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-dark mb-3">Verificación de dos factores</h1>
                    <!--end::Title-->
                    <!--begin::Sub-title-->
                    <div class="text-muted fw-bold fs-5 mb-5">Introduce el codigo de verificación que te enviamos a tu número celular</div>
                    <!--end::Sub-title-->
                    <!--begin::Mobile no-->
                    <!--<div class="fw-bolder text-dark fs-3">******7859</div> -->
                    <!--end::Mobile no--> 
                </div>
                <!--end::Heading-->
                <!--begin::Section-->
                <div class="mb-10 px-md-10">
                    <!--begin::Label-->
                    <div class="fw-bolder text-start text-dark fs-6 mb-1 ms-1">Introduce los 4 números del código de seguridad</div>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-wrap flex-stack">
                        <input type="text" name="digit_1" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />
                        <input type="text" name="digit_2" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />
                        <input type="text" name="digit_3" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />
                        <input type="text" name="digit_4" data-inputmask="'mask': '9', 'placeholder': ''" maxlength="1" class="form-control form-control-solid h-60px w-60px fs-2qx text-center border-primary border-hover mx-1 my-2" value="" />
                    </div>
                    <!--begin::Input group-->
                </div>
                <!--end::Section-->
                <!--begin::Submit-->
                <div class="d-flex flex-center">
                    <button type="submit" class="btn btn-lg btn-primary fw-bolder">
                        <span class="indicator-label">Aceptar</span>
                        <span class="indicator-progress">Por favor, espera...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Submit-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Content-->
    <!--begin::Footer-->
    <div class="d-flex flex-center flex-column-auto p-10">
        <!--begin::Links-->
        <div class="d-flex align-items-center fw-bold fs-6">
            <a href="https://jgarcialopez.com.mx/" class="text-muted text-hover-primary px-2">J. García López</a>
        </div>
        <!--end::Links-->
    </div>
    <!--end::Footer-->
</div>
<!--end::Authentication - Two-stes-->
@endsection