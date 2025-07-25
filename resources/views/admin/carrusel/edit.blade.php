@extends('layouts.app')

@section('content')
<div class='container'>
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10 p-5 bg-white shadow rounded-3">
            <h1 class="fw-bold fs-3 text-warning">Editar Carrusel</h1>
            {!! Form::open(['route' => ['carrusel.update', $carrusel], 'method' => 'PUT', 'files' => true]) !!}

            {{-- Información general --}}
            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Información general</div>
                <div class="card-body">
                    <div class="form-group row mb-3">
                        <div class="col-sm-6">
                            {!! Form::label('name', 'Nombre') !!}
                            {!! Form::text('name', $carrusel->name, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-sm-3">
                            {!! Form::label('link', 'Link') !!}
                            {!! Form::url('link', $carrusel->link, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="col-sm-3">
                            {!! Form::label('order', 'Orden') !!}
                            {!! Form::number('order', $carrusel->order, ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Imagen --}}
            <div class="card mb-4">
                <div class="card-header bg-warning text-white fw-semibold">Imagen</div>
                <div class="card-body">
                    <div class="form-group mb-3">
                        {!! Form::label('image', 'Imagen (1400x450px)') !!}<br>
                        <img src="/img/carrusel/{{ $carrusel->image }}" class="img-fluid mb-2 rounded">
                        {!! Form::file('image', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>

            {{-- Botón --}}
            <div class="text-end">
                {{ Form::submit('Guardar cambios', ['class' => 'btn btn-warning px-4 text-white']) }}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
