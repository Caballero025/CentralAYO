@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-sm-10 p-4 bg-white shadow rounded-3">
            <h1 class="fw-bold fs-3 mb-4 text-primary">Crear nuevo producto</h1>

            {!! Form::open(['route' => 'producto.store', 'method' => 'POST', 'files' => true]) !!}
            
            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-semibold">Datos SEO</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            {!! Form::label('slug', 'Slug') !!}
                            {!! Form::text('slug', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-8">
                            {!! Form::label('seo_title', 'Título SEO') !!}
                            {!! Form::text('seo_title', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        {!! Form::label('seo_description', 'Descripción SEO') !!}
                        {!! Form::textarea('seo_description', null, ['class' => 'form-control', 'required', 'maxlength' => 500, 'rows' => 3]) !!}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-semibold">Información general</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-9">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-3">
                            {!! Form::label('orden', 'Orden') !!}
                            {!! Form::number('orden', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            {!! Form::label('stock', 'Stock') !!}
                            {!! Form::number('stock', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('precio_anterior', 'Precio anterior') !!}
                            {!! Form::text('precio_anterior', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-4">
                            {!! Form::label('precio', 'Precio') !!}
                            {!! Form::text('precio', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        {!! Form::label('description', 'Descripción') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                        <script>CKEDITOR.replace("description");</script>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-semibold">Imágenes</div>
                <div class="card-body">
                    <div class="mb-3">
                        {!! Form::label('seo_image', 'Imagen SEO (900x300px)') !!}<br>
                        <img src="/img/producto/seo_image.jpg" class="img-fluid mb-2 rounded">
                        {!! Form::file('seo_image', ['class' => 'form-control']) !!}
                    </div>

                    <div class="mb-3">
                        {!! Form::label('image', 'Imagen principal (900x300px)') !!}<br>
                        <img src="/img/producto/image.jpg" class="img-fluid mb-2 rounded">
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-semibold">Opciones</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        {!! Form::checkbox('portada', 1, false, ['class' => 'form-check-input', 'id' => 'portada']) !!}
                        {!! Form::label('portada', 'Mostrar en portada', ['class' => 'form-check-label']) !!}
                    </div>

                    <div class="form-check form-switch">
                        {!! Form::checkbox('publicado', 1, false, ['class' => 'form-check-input', 'id' => 'publicado']) !!}
                        {!! Form::label('publicado', 'Publicado', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
            </div>

            <div class="text-end">
                {!! Form::submit('Crear producto', ['class' => 'btn btn-primary px-4']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
