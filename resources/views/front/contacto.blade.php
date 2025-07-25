@extends('layouts.page')

@section('title', 'Contacto con Distribuidora Alfa y Omega')
@section('description', 'Ubícanos en Lázaro Cárdenas 29-B, Centro, 76750 Tequisquiapan, Qro.')
@section('image', 'img/contacto.jpg')
@section('url', 'https://alfayomega.com/contacto')

@section('content')
<div class="container py-5">
    <!-- Encabezado -->
    <div class="bg-primary text-white rounded-4 p-4 mb-5 shadow">
        <h1 class="display-5 fw-bold mb-2">Contáctanos</h1>
        <p class="lead">Estamos aquí para ayudarte. Encuentra nuestros datos y ubicación.</p>
    </div>

    <div class="row g-5">
        <!-- Información de contacto -->
        <div class="col-lg-7">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body p-5">
                    <h3 class="text-primary mb-4">Información de Contacto</h3>
                    <ul class="list-unstyled fs-5">
                        <li class="mb-3">
                            <i class="bi bi-building text-primary fs-4 me-3"></i>
                            <strong>Razón Social:</strong> {{ $config->_razonsocial }}
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-envelope text-primary fs-4 me-3"></i>
                            <strong>Email:</strong> 
                            <a href="mailto:{{ $config->_email }}" class="text-decoration-none">{{ $config->_email }}</a>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-telephone text-primary fs-4 me-3"></i>
                            <strong>Teléfono:</strong> 
                            <a href="tel:{{ $config->_celular }}" class="text-decoration-none">{{ $config->_celular }}</a>
                        </li>
                        <li class="mb-3">
                            <i class="bi bi-geo-alt text-primary fs-4 me-3"></i>
                            <strong>Dirección:</strong> {{ $config->_direccion }}
                        </li>
                    </ul>

                    @if(!empty($config->link_facebook) || !empty($config->link_instagram))
                        <h5 class="mt-5 mb-3 text-primary">Síguenos en Redes Sociales</h5>
                        <div class="d-flex gap-4 fs-3">
                            @if (!empty($config->link_facebook))
                                <a href="{{ $config->link_facebook }}" target="_blank" class="text-primary" aria-label="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            @endif
                            @if (!empty($config->link_instagram))
                                <a href="{{ $config->link_instagram }}" target="_blank" class="text-danger" aria-label="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Google Maps -->
            <div class="mt-5 rounded-4 overflow-hidden shadow" style="height: 400px;">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3426.4839652956025!2d-99.89943996623636!3d20.522332756929377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d39e00e73d6fe5%3A0xad799f4510206d20!2sMundo%20Creativo%20arte%20y%20manualidades!5e0!3m2!1ses-419!2smx!4v1747289348734!5m2!1ses-419!2smx"
                    width="100%" height="100%" frameborder="0"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection
