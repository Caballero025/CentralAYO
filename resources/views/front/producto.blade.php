@extends('layouts.page')

@section('title'){{ $producto->seo_title }}@endsection
@section('description'){{ $producto->seo_description }}@endsection
@section('image'){{ "/img/producto/" . $producto->seo_image }}@endsection
@section('url'){{ "https://alfayomega.com/producto/" . $producto->slug }}@endsection

@section('content')
<div class="container py-5">

    <!-- BUSCADOR Y ENCABEZADO -->
    <div class="row align-items-center bg-white shadow-sm rounded-4 p-4 mb-5">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary">Detalle del Producto</h2>
        </div>
        <div class="col-md-6">
            <input type="search" id="textoabuscar" placeholder="Buscar producto..." class="form-control rounded-pill border-primary">
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

        <!-- CONTENIDO PRINCIPAL -->
        <main class="col-lg-9" id="resultados">

            <!-- PRODUCTO -->
            <div class="row bg-white shadow rounded-4 p-4 mb-5 align-items-start">
                <div class="col-md-6">
                    <img src="/img/producto/{{ $producto->image }}" class="img-fluid rounded shadow-sm" alt="{{ $producto->name }}" title="{{ $producto->name }}">
                </div>
                <div class="col-md-6">
                    <h3 class="fw-bold mb-3">{{ $producto->name }}</h3>
                    <p class="text-muted mb-1">Código: <strong>{{ $producto->codigo }}</strong></p>

                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $producto->id }}">

                        <div class="my-3">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" id="cantidad" name="quantity" class="form-control w-50" value="1" min="1">
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg w-100 mt-2">
                            <i class="bi bi-cart-plus-fill me-2"></i>Agregar al carrito
                        </button>
                    </form>
                </div>

                <div class="col-12 mt-4">
                    <div class="border-top pt-4">
                        {!! $producto->description !!}
                    </div>
                </div>
            </div>

            <!-- PRODUCTOS RELACIONADOS -->
            <section class="mb-5">
                <h4 class="fw-bold text-secondary mb-4">Productos relacionados</h4>
                <div class="row g-4">
                    @forelse ($productos as $p)
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm rounded-4">
                                <img src="/img/producto/{{ $p->image }}" class="card-img-top rounded-top" loading="lazy" alt="{{ $p->name }}">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $p->name }}</h5>
                                    <p class="text-success fw-bold">{{ $p->precio }}
                                        @if($p->precio_anterior)
                                            <span class="text-muted text-decoration-line-through ms-2">{{ $p->precio_anterior }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="card-footer bg-white border-0 d-flex justify-content-between">
                                    <a href="/producto/{{ $p->slug }}" class="btn btn-outline-primary w-50 me-1">Ver más</a>
                                    <form method="POST" action="{{ route('cart.add') }}" class="w-50 ms-1">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $p->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-danger w-100">Agregar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No hay productos relacionados.</p>
                    @endforelse
                </div>
            </section>

            <!-- RECOMENDACIONES -->
            <section class="bg-white shadow rounded-4 p-4">
                <h4 class="fw-bold text-secondary mb-4">Recomendaciones</h4>
                @foreach ($posts as $p)
                    <div class="mb-4">
                        <h5><a href="/blog/{{ $p->slug }}" class="text-decoration-none text-dark">{{ $p->name }}</a></h5>
                        <p class="text-muted">{{ $p->seo_description }}</p>
                    </div>
                @endforeach
            </section>

        </main>
    </div>
</div>

<!-- BUSCADOR SCRIPT -->
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
                    'X-CSRF-Token': csrfToken
                }
            })
            .then(res => res.json())
            .then(data => {
                let html = "<h4 class='mb-3'>Resultados</h4>";
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
