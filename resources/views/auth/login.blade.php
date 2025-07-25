@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4 fw-bold rounded-top-4">
                    Iniciar sesión
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email -->
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                                    name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <!-- Enlace a registro -->
                        <div class="mb-3 row">
                            <div class="col-md-6 offset-md-4">
                                <p class="mb-0">¿Primera vez aquí?
                                    <a href="{{ route('register') }}">Regístrate</a>
                                </p>
                            </div>
                        </div>

                        <!-- Botón -->
                        <div class="mb-0 row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success px-4">
                                    Iniciar sesión
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center text-muted small">
                    © {{ date('Y') }} Distribuidor Alfa y Omega
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
