@extends('layouts.page')

@section('title') {{ $subcategoria->seo_title }} @endsection
@section('description') {{ $subcategoria->seo_description }} @endsection
@section('image') {{ "/img/subcategoria/" . $subcategoria->seo_image }} @endsection
@section('url') {{ "https://alfayomega.com/" . $subcategoria->categoria->slug . "/" . $subcategoria->slug }} @endsection

@section('content')
<div class="container py-4">
    <!-- Encabezado con título y buscador -->
    <div class="row align-items-center bg-white shadow-sm rounded p-3 mb-4">
        <div class="col-md-6 mb-2 mb-md-0">
            <h2 class="text-dark fw-bold">{{ $subcategoria->name }}</h2>
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

        <!-- Productos de la subcategoría -->
        <div class="col-md-9" id="resultados">
            <h4 class="text-primary border-bottom pb-2 mb-3">Productos</h4>
            <div class="row">
                @forelse ($subcategoria->productos as $p)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow rounded-3">
                            <img src="/img/producto/{{ $p->image }}" 
                                 class="card-img-top rounded-top" 
                                 alt="{{ $p->name }}" 
                                 loading="lazy" 
                                 style="object-fit: cover; max-height: 250px;">
                            
                            <div class="card-body text-center">
                                <h5 class="card-title fs-6">{{ $p->name }}</h5>
                                <p class="text-success fw-bold mb-1">
                                    {{ $p->precio }}
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
                                        <button type="submit" class="btn btn-danger w-100">Agregar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No hay productos disponibles en esta subcategoría.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Script para el buscador -->
<script>
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
            .then(response => response.json())
            .then(data => {
                let html = "<h4>Resultados</h4>";
                data.lista.forEach(p => {
                    html += `<a href="/producto/${p.slug}" class="d-block py-2 border-bottom text-decoration-none">${p.name}</a>`;
                });
                resultados.innerHTML = html;
            })
            .catch(error => console.error(error));
        }
    });
</script>
@endsection
