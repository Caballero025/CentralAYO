@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10 p-5 bg-light">
            <h1 class="fw-bold fs-3 text-primary">EDITAR EMPRESA</h1>
            {!! Form::open(['route' => ['empresa.update', $empresa], 'method' => 'PUT', 'files' => true]) !!}

            <!-- SEO -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white fw-semibold">Datos SEO</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        {!! Form::label('seo_title', 'Título SEO') !!}
                        {!! Form::text('seo_title', $empresa->seo_title, ['class' => 'form-control', 'required', 'maxlength' => '60']) !!}
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('seo_description', 'Descripción SEO') !!}
                        {!! Form::textarea('seo_description', $empresa->seo_description, ['class' => 'form-control', 'maxlength' => '155', 'rows' => '2']) !!}
                    </div>
                </div>
            </div>

            <!-- Descripción -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white fw-semibold">Descripción</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        {!! Form::label('description', 'Descripción') !!}
                        {!! Form::textarea('description', $empresa->description, ['class' => 'form-control']) !!}
                        <script>CKEDITOR.replace("description");</script>
                    </div>
                </div>
            </div>

            <!-- Imágenes -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white fw-semibold">Imágenes</div>
                <div class="card-body">
                    <div class="form-group mb-4">
                        {!! Form::label('seo_image', 'Imagen SEO (600x400px)') !!}<br>
                        <img src="/img/empresa/{{ $empresa->seo_image }}" class="img-fluid mb-2 rounded">
                        {!! Form::file('seo_image', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('image', 'Imagen Principal (900x300px)') !!}<br>
                        <img src="/img/empresa/{{ $empresa->image }}" class="img-fluid mb-2 rounded">
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <!-- Botón -->
            <div class="text-end">
                {{ Form::submit('Guardar cambios', ['class' => 'btn btn-primary px-4']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
