@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4 fw-bold rounded-top-4">
                    Confirmar contraseña
                </div>

                <div class="card-body">

                    <p class="text-center mb-4">
                        Por favor, confirma tu contraseña antes de continuar.
                    </p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Campo contraseña -->
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

                        <!-- Botones -->
                        <div class="mb-0 row">
                            <div class="col-md-8 offset-md-4 d-flex flex-wrap gap-2">
                                <button type="submit" class="btn btn-success">
                                    Confirmar contraseña
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center text-muted small">
                    Seguridad primero – confirma tu identidad
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
