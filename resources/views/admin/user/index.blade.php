@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">Gestión de Usuarios y Pedidos</h3>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Pedidos</th>
                                <th scope="col" class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->name }}</td>
                                    <td>
                                        <ul class="mb-0 ps-3">
                                            @forelse($r->pedidos->sortByDesc("created_at") as $item)
                                                <li class="mb-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a href="{{ route('user.show', $item->id) }}">
                                                            {{ $item->created_at->format('d/m/Y H:i') }}
                                                        </a>
                                                        <a href="{{ route('pedido.generarpdf', $item->id) }}"
                                                           class="btn btn-sm btn-outline-danger ms-2"
                                                           target="_blank"
                                                           title="Generar PDF de este pedido">
                                                            <i class="bi bi-file-earmark-pdf"></i> PDF
                                                        </a>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="text-muted">Sin pedidos</li>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('user.edit', $r->id) }}" class="btn btn-outline-warning btn-sm me-1">
                                            <i class="bi bi-pencil-square"></i> Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
