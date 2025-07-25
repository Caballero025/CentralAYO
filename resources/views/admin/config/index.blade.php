@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10 p-5 bg-light">
            <h1 class="fw-bold fs-3 text-primary">EDITAR CONFIGURACIÓN</h1>
            {!! Form::open(['route' => ['config.update', $config], 'method' => 'PUT', 'files' => true]) !!}

            {{-- SEO --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white fw-semibold">Datos SEO</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        {!! Form::label('seo_title', 'Título SEO') !!}
                        {!! Form::text('seo_title', $config->seo_title, ['class' => 'form-control', 'required', 'maxlength' => '60']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('seo_description', 'Descripción SEO') !!}
                        {!! Form::textarea('seo_description', $config->seo_description, ['class' => 'form-control', 'maxlength' => '155', 'rows' => 2]) !!}
                    </div>
                </div>
            </div>

            {{-- Información General --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white fw-semibold">Información General</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            {!! Form::label('_slogan', 'Slogan') !!}
                            {!! Form::text('_slogan', $config->_slogan, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('_razonsocial', 'Razón Social') !!}
                            {!! Form::text('_razonsocial', $config->_razonsocial, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            {!! Form::label('_email', 'Correo Electrónico') !!}
                            {!! Form::text('_email', $config->_email, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="col-sm-6">
                            {!! Form::label('_direccion', 'Dirección') !!}
                            {!! Form::text('_direccion', $config->_direccion, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('_celular', 'Celular') !!}
                        {!! Form::tel('_celular', $config->_celular, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>
            </div>

            {{-- Imágenes --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white fw-semibold">Imágenes</div>
                <div class="card-body">
                    <div class="mb-3">
                        {!! Form::label('seo_image', 'SEO Image (600x400px)') !!}
                        <br>
                        <img src="/img/config/{{ $config->seo_image }}" class="img-fluid rounded mb-2">
                        {!! Form::file('seo_image', ['class' => 'form-control']) !!}
                    </div>
                    <div class="mb-3">
                        {!! Form::label('_logo', 'Logo (200x200px)') !!}
                        <br>
                        <img src="/img/config/{{ $config->_logo }}" class="img-fluid rounded mb-2">
                        {!! Form::file('_logo', ['class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::label('_favicon', 'Favicon (16x16px)') !!}
                        <br>
                        <img src="/img/config/{{ $config->_favicon }}" class="img-fluid rounded mb-2">
                        {!! Form::file('_favicon', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            {{-- Redes Sociales --}}
           <div class="card mb-4">
    <div class="card-header bg-primary text-white fw-semibold">Redes Sociales</div>
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-6">
                {!! Form::label('link_facebook', 'Facebook') !!}
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-facebook-f text-primary"></i></span>
                    {!! Form::text('link_facebook', $config->link_facebook, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-sm-6">
                {!! Form::label('link_whatsapp', 'WhatsApp') !!}
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-whatsapp text-success"></i></span>
                    {!! Form::text('link_whatsapp', $config->link_whatsapp, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                {!! Form::label('link_tiktok', 'TikTok') !!}
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-tiktok text-dark"></i></span>
                    {!! Form::text('link_tiktok', $config->link_tiktok, ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-sm-6">
                {!! Form::label('link_instagram', 'Instagram') !!}
                <div class="input-group">
                    <span class="input-group-text"><i class="fab fa-instagram text-danger"></i></span>
                    {!! Form::text('link_instagram', $config->link_instagram, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>
    </div>
</div>


            {{-- Botón --}}
            <div class="text-end">
                {{ Form::submit('Guardar Cambios', ['class' => 'btn btn-primary px-4']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
