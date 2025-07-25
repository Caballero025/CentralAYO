@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4 fw-bold rounded-top-4">
                    Crear una cuenta
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Correo electrónico -->
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmar contraseña</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                    class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="mb-0 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success px-4">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center text-muted small">
                    ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión aquí</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
