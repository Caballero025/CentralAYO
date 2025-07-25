@extends('layouts.page')

@section('content')
<div class="container py-5">
    <!-- Encabezado -->
    <div class="bg-light p-4 rounded shadow-sm mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="mb-0 text-primary">Nuestra Empresa</h3>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="row justify-content-center">
        <div class="col-lg-9 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="text-center pt-4">
                    <img src="/img/config/_logo.png"
                         alt="{{ $config->_razonsocial }}"
                         style="max-width: 150px; height: auto;"
                         class="img-fluid rounded">
                </div>
                <div class="card-body bg-white">
                    <div class="text-dark fs-5">
                        {!! $empresa->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
