@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Gestión de Carruseles</h3>
                <a href="{{ route('carrusel.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Agregar Imagen
                </a>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($carrusels as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('carrusel.edit', $r->id) }}" class="btn btn-outline-warning btn-sm me-1">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                        <form action="{{ route('carrusel.destroy', $r->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este carrusel?')">
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
                                    <td colspan="3" class="text-center py-4">No hay carruseles registrados.</td>
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
