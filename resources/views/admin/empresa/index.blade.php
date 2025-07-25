@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('admin.sidebar')

        <div class="col-sm-10">
            <div class="card shadow-sm rounded-3">
                <div class="card-header bg-primary text-white fw-semibold">
                    Lista de Empresas Registradas
                </div>
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Descripción SEO</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($empresas as $r)
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->seo_title }}</td>
                                    <td>{{ $r->seo_description }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('empresa.edit', $r->id) }}" class="btn btn-sm btn-outline-primary">
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    @if($empresas->isEmpty())
                        <div class="alert alert-info text-center mt-4">
                            No se encontraron empresas registradas.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
