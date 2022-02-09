@extends('dashboard')

@section('title')
Importar por Excel
@endsection

@section('content')
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Importar archivo de Excel
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Importar información</button>
            </form>
        </div>
    </div>
</div>
@endsection