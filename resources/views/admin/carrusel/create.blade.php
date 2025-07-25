@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-sm-10 p-4 bg-white shadow rounded-3">
            <h1 class="fw-bold fs-3 mb-4 text-primary">Crear Carrusel</h1>

            {!! Form::open(['route' => 'carrusel.store', 'method' => 'POST', 'files' => true]) !!}

            {{-- Información general --}}
            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-semibold">Información general</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('link', 'Link') !!}
                            {!! Form::url('link', null, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-md-3">
                            {!! Form::label('order', 'Orden') !!}
                            {!! Form::number('order', null, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Imagen --}}
            <div class="card mb-4">
                <div class="card-header bg-info text-white fw-semibold">Imagen</div>
                <div class="card-body">
                    <div class="mb-3">
                        {!! Form::label('image', 'Imagen (1400x450px)') !!}<br>
                        <img src="/img/carrusel/image.jpg" class="img-fluid mb-2 rounded">
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            {{-- Botón --}}
            <div class="text-end">
                {!! Form::submit('Agregar Imagen ', ['class' => 'btn btn-primary px-4']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
