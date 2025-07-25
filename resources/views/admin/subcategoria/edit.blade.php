@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10 p-5 bg-light">
            <h1 class="fw-bold fs-3 text-warning">EDITAR SUBCATEGORÍA</h1>
            {!! Form::open(['route' => ['subcategoria.update', $subcategoria], 'method' => 'PUT', 'files' => true]) !!}

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Datos SEO</div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <div class="col-sm-4">
                            {!! Form::label('slug', 'Slug') !!}
                            {!! Form::text('slug', $subcategoria->slug, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-8">
                            {!! Form::label('seo_title', 'Title') !!}
                            {!! Form::text('seo_title', $subcategoria->seo_title, ['class' => 'form-control', 'required', 'maxlength' => '60']) !!}
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('seo_description', 'Description') !!}
                        {!! Form::textarea('seo_description', $subcategoria->seo_description, ['class' => 'form-control', 'maxlength' => '155', 'rows' => '2']) !!}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Información general</div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <div class="col-sm-9">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', $subcategoria->name, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::label('orden', 'Orden') !!}
                            {!! Form::number('orden', $subcategoria->orden, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('description', 'Descripción') !!}
                        {!! Form::textarea('description', $subcategoria->description, ['class' => 'form-control']) !!}
                        <script>CKEDITOR.replace("description");</script>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Imágenes</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        {!! Form::label('seo_image', 'Imagen SEO (600x400px)') !!}<br>
                        <img src="/img/subcategoria/{{ $subcategoria->seo_image }}" class="img-fluid mb-2 rounded">
                        {!! Form::file('seo_image', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('image', 'Imagen principal (900x300px)') !!}<br>
                        <img src="/img/subcategoria/{{ $subcategoria->image }}" class="img-fluid mb-2 rounded">
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Opciones</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        {!! Form::checkbox('portada', 1, $subcategoria->portada, ['class' => 'form-check-input', 'id' => 'portada']) !!}
                        {!! Form::label('portada', 'Mostrar en portada', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form-check form-switch">
                        {!! Form::checkbox('publicado', 1, $subcategoria->publicado, ['class' => 'form-check-input', 'id' => 'publicado']) !!}
                        {!! Form::label('publicado', 'Publicado', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
            </div>

            <div class="text-end">
                {{ Form::submit('Actualizar subcategoría', ['class' => 'btn btn-warning px-4 text-white']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
