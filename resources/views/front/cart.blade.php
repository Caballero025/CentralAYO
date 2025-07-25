@extends('layouts.page')

@section('content')
<div class="container py-5">

    <h1 class="text-center mb-4 text-primary fw-bold">Carrito de Compra</h1>

    {{-- Mostrar mensajes de éxito o error --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if (count(Cart::getContent()))
        <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Producto</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Importe</th>
                        <th>Acciones</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach(Cart::getContent() as $p)
                        <tr class="text-center">
                            <td>
                                <img src="/img/producto/{{ $p->attributes->image }}" alt="{{ $p->name }}" width="100" class="rounded">
                            </td>
                            <td class="text-start">{{ $p->name }}</td>
                            <td>{{ $p->quantity }}</td>
                            <td>${{ number_format($p->price, 2) }}</td>
                            <td>${{ number_format($p->price * $p->quantity, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.removeitem') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $p->id }}">
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este producto del carrito?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="table-light text-end">
                    <tr>
                        <td colspan="5" class="fw-bold">Subtotal</td>
                        <td class="fw-bold">${{ number_format(Cart::getSubTotal(), 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="fw-bold">Impuesto (16%)</td>
                        <td class="fw-bold">${{ number_format(Cart::getSubTotal() * 0.16, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="fw-bold text-success fs-5">Total</td>
                        <td class="fw-bold text-success fs-5">${{ number_format(Cart::getSubTotal() * 1.16, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-center mt-5">
            @if(Auth::user())
                <form action="{{ route('cart.procesar') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-success btn-lg px-5">
        <i class="bi bi-check-circle-fill me-2"></i>Procesar Pedido
    </button>
</form>

            @else
                <div class="alert alert-warning mt-4" role="alert">
                    Para procesar el pedido debe iniciar sesión con su cuenta.
                </div>
                <a href="/login" class="btn btn-danger btn-lg px-5">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                </a>
            @endif
        </div>
    @else
        <div class="alert alert-info text-center">
            El carrito está vacío. <a href="/" class="btn btn-link">Ver productos</a>
        </div>
    @endif

</div>
@endsection
