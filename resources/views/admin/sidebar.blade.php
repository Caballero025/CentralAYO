<style>
    .sidebar {
        min-height: 100vh;
        background-color: #1a1a1a;
        padding-top: 2rem;
        color: white;
    }

    .sidebar .list-group-item {
        background-color: transparent;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }

    .sidebar .list-group-item:hover {
        background-color: #f8c102; /* Amarillo */
        color: #1a1a1a;
    }

    .sidebar .list-group-item.active {
        background-color: #fd7e14 !important; /* Naranja */
        color: white;
    }

    .sidebar .list-group-item i {
        margin-right: 10px;
    }
</style>

<div class="col-sm-2 sidebar">
    <h5 class="text-center mb-4">Menú Admin</h5>
    <div class="list-group list-group-flush">
        <a href="/admin/user"
   class="list-group-item list-group-item-action {{ request()->is('admin/user') ? 'active' : '' }}">
    <i class="bi bi-person-fill"></i> Usuarios-Pedidos
</a>

<a href="/admin/config"
   class="list-group-item list-group-item-action {{ request()->is('admin/config') ? 'active' : '' }}">
    <i class="bi bi-gear-fill"></i> Configuración
</a>

<a href="/admin/categoria"
   class="list-group-item list-group-item-action {{ request()->is('admin/categoria') ? 'active' : '' }}">
    <i class="bi bi-box-seam"></i> Productos
</a>

<a href="/admin/blog"
   class="list-group-item list-group-item-action {{ request()->is('admin/blog') ? 'active' : '' }}">
    <i class="bi bi-journal-text"></i> Blog
</a>

<a href="/admin/carrusel"
   class="list-group-item list-group-item-action {{ request()->is('admin/carrusel') ? 'active' : '' }}">
    <i class="bi bi-images"></i> Carrusel
</a>

<a href="/admin/empresa"
   class="list-group-item list-group-item-action {{ request()->is('admin/empresa') ? 'active' : '' }}">
    <i class="bi bi-building"></i> Empresa
</a>

    </div>
</div>
