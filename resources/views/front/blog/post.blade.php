@extends('layouts.page')

@section('content')
<div class="container py-5">
    <!-- Encabezado con búsqueda -->
    <div class="row align-items-center bg-white shadow-sm rounded-4 p-4 mb-5">
        <div class="col-md-6">
            <h2 class="fw-bold text-primary mb-0">Blog</h2>
        </div>
        <div class="col-md-6">
            <input type="search" id="textoabuscar" placeholder="Buscar producto..." class="form-control rounded-pill border-primary shadow-sm">
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="row">
        <div class="col-lg-9" id="resultados">
            <div class="bg-white p-4 rounded-4 shadow-sm">
                <h1 class="text-center text-dark fw-bold mb-4">{{ $blog->name }}</h1>
                <img src="/img/blog/{{ $blog->image }}" alt="{{ $blog->name }}" title="{{ $blog->name }}"
                    class="img-fluid rounded-4 shadow-sm mb-4">

                <div class="text-secondary fs-6 mb-4">
                    {!! $blog->description !!}
                </div>

                <hr>

                <div class="text-muted small mt-3">
                    <i class="bi bi-calendar3 me-1"></i> Publicado {{ $blog->created_at->diffForHumans() }} |
                    <i class="bi bi-eye ms-2 me-1"></i> Visitas: {{ $blog->visitas }}
                </div>
            </div>
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
