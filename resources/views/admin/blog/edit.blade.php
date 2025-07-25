@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10 p-5 bg-light">
            <h1 class="fw-bold fs-3 text-warning">EDITAR BLOG</h1>
            {!! Form::open(['route' => ['blog.update', $blog], 'method' => 'PUT', 'files' => true]) !!}

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Datos SEO</div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <div class="col-sm-4">
                            {!! Form::label('slug', 'Slug') !!}
                            {!! Form::text('slug', $blog->slug, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-8">
                            {!! Form::label('seo_title', 'Title') !!}
                            {!! Form::text('seo_title', $blog->seo_title, ['class' => 'form-control', 'required', 'maxlength' => '60']) !!}
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        {!! Form::label('seo_description', 'Description') !!}
                        {!! Form::textarea('seo_description', $blog->seo_description, ['class' => 'form-control', 'maxlength' => '155', 'rows' => '2']) !!}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Información general</div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <div class="col-sm-6">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', $blog->name, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-sm-3">
                            {!! Form::label('producto_id', 'Producto') !!}
                            {!! Form::select('producto_id', $productos, $blog->producto_id, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-sm-3">
                            {!! Form::label('orden', 'Orden') !!}
                            {!! Form::number('orden', $blog->orden, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('description', 'Descripción') !!}
                        {!! Form::textarea('description', $blog->description, ['class' => 'form-control']) !!}
                        <script>CKEDITOR.replace("description");</script>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Imágenes</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        {!! Form::label('seo_image', 'SEO Image (600x400px)') !!}<br>
                        <img src="/img/blog/{{ $blog->seo_image }}" class="img-fluid mb-2 rounded">
                        {!! Form::file('seo_image', ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group mb-3">
                        {!! Form::label('image', 'Imagen principal (900x300px)') !!}<br>
                        <img src="/img/blog/{{ $blog->image }}" class="img-fluid mb-2 rounded">
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Opciones</div>
                <div class="card-body">
                    <div class="form-check form-switch mb-3">
                        {!! Form::checkbox('publicado', 1, $blog->publicado, ['class' => 'form-check-input', 'id' => 'publicado']) !!}
                        {!! Form::label('publicado', 'Publicado', ['class' => 'form-check-label']) !!}
                    </div>
                </div>
            </div>

            <div class="text-end">
                {{ Form::submit('Actualizar blog', ['class' => 'btn btn-warning px-4 text-white']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
