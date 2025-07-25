@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4 fw-bold rounded-top-4">
                    Restablecer contraseña
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success text-center" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="text-center mb-4">
                        Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                    </p>

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Correo electrónico -->
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

                        <!-- Botón -->
                        <div class="mb-0 row">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success px-4">
                                    Enviar enlace de recuperación
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-muted text-center small">
                    ¿Recuerdas tu contraseña? <a href="{{ route('login') }}">Inicia sesión aquí</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
