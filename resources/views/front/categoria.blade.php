@extends('layouts.page')

@section('title') {{ $categoria->seo_title }} @endsection
@section('description') {{ $categoria->seo_description }} @endsection
@section('image') {{ "/img/categoria/" . $categoria->seo_image }} @endsection
@section('url') {{ "https://alfayomega.com/" . $categoria->slug }} @endsection

@section('content')

<!-- ALERTAS DE SESIÓN -->
@if(session('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

@if(session('error_message'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
@endif

<div class="container py-4">
    <!-- Nombre de Categoría y Buscador -->
    <div class="row align-items-center bg-white shadow-sm rounded p-3 mb-4">
        <div class="col-md-6 mb-2 mb-md-0">
            <h2 class="text-dark fw-bold">{{ $categoria->name }}</h2>
        </div>
        <div class="col-md-6">
            <input type="search" id="textoabuscar" placeholder="Buscar producto..." class="form-control border-primary rounded-pill">
        </div>
    </div>

    <div class="row">
         <!-- BARRA LATERAL -->
        <aside class="col-lg-3 mb-4">
            <div class="accordion shadow-sm" id="categoriasAccordion">
                @foreach ($categorias as $c)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-{{ $c->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $c->id }}">
                            {{ $c->name }}
                        </button>
                    </h2>
                    <div id="collapse-{{ $c->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body p-2">
                            @foreach ($c->subcategorias as $sub)
                                <a href="/{{ $c->slug }}/{{ $sub->slug }}" class="d-block py-1 ps-3 text-decoration-none text-dark">{{ $sub->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </aside>

        <!-- Resultados / Productos -->
        <div class="col-md-9" id="resultados">
            @foreach ($categoria->subcategorias as $subcategoria)
                <div class="mb-4">
                    <h4 class="text-primary border-bottom pb-2 mb-3">{{ $subcategoria->name }}</h4>
                    <div class="row">
                        @forelse ($subcategoria->productos as $p)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow position-relative">
                                    <img src="/img/producto/{{ $p->image }}" 
                                         class="card-img-top rounded-top" 
                                         alt="{{ $p->name }}" loading="lazy" style="object-fit: cover; height: 250px;">
                                    <!-- Etiqueta "Nuevo" -->
                                    @if(\Carbon\Carbon::parse($p->created_at)->diffInDays(now()) < 15)
                                        <span class="badge bg-success position-absolute top-0 start-0 m-2">Nuevo</span>
                                    @endif

                                    <div class="card-body text-center">
                                        <h5 class="card-title fs-6">{{ $p->name }}</h5>
                                        <p class="text-success fw-bold">{{ $p->precio }}
                                            @if ($p->precio_anterior)
                                                <small class="text-muted text-decoration-line-through ms-2">{{ $p->precio_anterior }}</small>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <div class="d-flex justify-content-between">
                                            <a href="/producto/{{ $p->slug }}" class="btn btn-outline-primary w-50 me-1">Ver más</a>
                                            <form method="POST" action="{{ route('cart.add') }}" class="w-50 ms-1">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $p->id }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-danger w-100">Agregar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- fin card -->
                            </div>
                        @empty
                            <p class="text-muted">No hay productos disponibles en esta subcategoría.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Script Buscador -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const textoabuscar = document.getElementById("textoabuscar");
    const resultados = document.getElementById("resultados");

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    textoabuscar.addEventListener("keyup", e => {
        const texto = e.target.value;

        if (texto.length > 3) {
            fetch("/buscador", {
                method: "POST",
                body: JSON.stringify({ texto }),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            })
            .then(res => res.json())
            .then(data => {
                let html = "<h2>Resultados</h2>";
                data.lista.forEach(p => {
                    html += `<a href="/producto/${p.slug}" class="d-block py-2 border-bottom text-decoration-none">${p.name}</a>`;
                });
                resultados.innerHTML = html;
            })
            .catch(error => console.error("Error al buscar productos:", error));
        }
    });
});
</script>

@endsection
