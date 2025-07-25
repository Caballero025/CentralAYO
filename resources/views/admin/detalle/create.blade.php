@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')
        <div class="col-sm-10 p-5 bg-light">
            <h1 class="fw-bold fs-3">CREAR CARRUSEL</h1>
            {!! Form::open(['route' => 'carrusel.store', 'method' => 'POST', 'files' => true]) !!}
            
                <div class="form-group row mt-5">
                    <div class="col-sm-6">
                        {!! Form::label('name', 'NOMBRE') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="col-sm-3">
                        {!! Form::label('link', 'LINK') !!}
                        {!! Form::url('link', null, ['class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="col-sm-3">
                        {!! Form::label('order', 'ORDEN') !!}
                        {!! Form::number('order', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="form-group mt-5">
                    {!! Form::label('image', 'IMAGE (1400X450PX)', ['class' => 'control-label']) !!}<br>
                    <img src="/img/carrusel/image.jpg" class="img-fluid mb-2">
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group mt-5">
                    {!! Form::submit('CREAR', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
