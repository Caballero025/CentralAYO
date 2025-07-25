@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Gestión de Categorías</h3>
                <a href="{{ route('categoria.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nueva Categoría
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre de la Categoría</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categorias as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('categoria.show', $r->id) }}" class="btn btn-outline-info btn-sm me-1">
                                            <i class="bi bi-layers"></i> Subcategorías
                                        </a>
                                        <a href="{{ route('categoria.edit', $r->id) }}" class="btn btn-outline-warning btn-sm me-1">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                        <form action="{{ route('categoria.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">No hay categorías registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
