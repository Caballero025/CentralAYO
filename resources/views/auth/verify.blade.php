@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center fs-4 fw-bold rounded-top-4">
                    Verifica tu correo electrónico
                </div>

                <div class="card-body">

                    @if (session('resent'))
                        <div class="alert alert-success text-center" role="alert">
                            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                        </div>
                    @endif

                    <p class="mb-3 text-center">
                        Antes de continuar, revisa tu bandeja de entrada y confirma tu correo electrónico.
                    </p>
                    <p class="text-center">
                        Si no recibiste el correo,
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">
                                haz clic aquí para solicitar otro
                            </button>.
                        </form>
                    </p>

                </div>

                <div class="card-footer text-muted text-center small">
                    © {{ date('Y') }} Distribuidor Alfa y Omega
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
