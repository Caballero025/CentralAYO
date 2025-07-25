@extends('layouts.page')

@section('content')
<div class="container py-5">
    <!-- Encabezado -->
    <div class="row align-items-center bg-white shadow-sm rounded-4 p-4 mb-5">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-0">Blog</h2>
        </div>
        <div class="col-md-6">
            <input type="search" id="textoabuscar" placeholder="Buscar en el blog..." class="form-control rounded-pill border-primary">
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="row">
        <!-- Blog -->
        <div class="col-lg-9" id="resultados">
            @foreach ($blogs as $b)
                <div class="card mb-4 shadow-sm border-0 rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5">
                            <a href="/blog/{{ $b->slug }}">
                                <img src="/img/blog/{{ $b->image }}" alt="{{ $b->name }}" class="img-fluid h-100 w-100 object-fit-cover">
                            </a>
                        </div>
                        <div class="col-md-7 p-4">
                            <h5 class="card-title mb-3">
                                <a href="/blog/{{ $b->slug }}" class="text-decoration-none text-dark fw-bold">{{ $b->name }}</a>
                            </h5>
                            <p class="card-text text-muted">{{ $b->seo_description }}</p>
                        </div>
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
