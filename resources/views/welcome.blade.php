@extends('layouts.page')

@section('content')

<!-- CARRUSEL -->
<div id="carouselExampleIndicators" class="carousel slide shadow-lg mb-5 rounded overflow-hidden" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($imgs as $img)
            <button type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide-to="{{ $loop->index }}"
                class="{{ $loop->first ? 'active' : '' }}"
                aria-current="{{ $loop->first ? 'true' : 'false' }}"
                aria-label="Slide {{ $loop->iteration }}">
            </button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($imgs as $img)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="/img/carrusel/{{$img->image}}" class="d-block w-100" style="max-height: 500px; object-fit: cover;" alt="{{$img->name}}" title="{{$img->name}}">
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>
<!-- /CARRUSEL -->

<!-- SLOGAN -->
<div class="container mb-5">
    <div class="row justify-content-center mt-5 mb-4">
        <div class="col-12">
            <h1 class="text-center fw-bold text-primary">{{$config->_slogan}}</h1>
        </div>
    </div>

    <!-- CATEGORÍAS -->
    <div class="row">
        @foreach ($categorias as $c)
            <div class="col-sm-4 mb-4">
                <div class="card h-100 shadow d-flex flex-column justify-content-between">
                    <div class="d-flex justify-content-center align-items-center" style="height: 250px; overflow: hidden;">
                        <img src="/img/categoria/{{$c->image}}" 
                            class="card-img-top img-fluid" 
                            loading="lazy" 
                            title="{{$c->name}}" 
                            alt="{{$c->name}}" 
                            style="max-height: 100%; width: auto;">
                    </div>
                    <div class="card-footer bg-light mt-auto">
                        <a href="/{{$c->slug}}" class="btn btn-warning text-dark fw-bold w-100">{{$c->name}}</a>
                    </div>
                </div>
            </div>
        @endforeach  
    </div>

</div>

<!-- UBICACIÓN Y BLOG -->
<div class="container-fluid my-5"> <!-- Aumenta el margen vertical -->
    <div class="row container mb-4">
        <!-- MAPA -->
        <div class="col-sm-6 p-0 pe-sm-4 mb-4 mb-sm-0"> <!-- Espaciado a la derecha del mapa -->
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3426.4839652956025!2d-99.89943996623636!3d20.522332756929377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d39e00e73d6fe5%3A0xad799f4510206d20!2sMundo%20Creativo%20arte%20y%20manualidades!5e0!3m2!1ses-419!2smx!4v1747289348734!5m2!1ses-419!2smx"
                width="100%"
                height="450"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>        
        </div>

        <!-- PUBLICACIONES -->
        <div class="col-sm-6 bg-primary text-white p-4 ps-sm-4">
            <h3 class="fw-bold mb-4">Últimas publicaciones</h3>
            @foreach ($posts as $p)
                <div class="mb-4 border-bottom pb-2">
                    <h4 class="fs-5">
                        <a href="/blog/{{$p->slug}}" class="text-warning text-decoration-none" title="{{$p->name}}">
                            {{$p->name}}
                        </a>
                    </h4>
                    <p class="text-light small mb-0">{{$p->seo_description}}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>



@endsection
