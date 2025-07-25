<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pedido {{ $pedido->user->name }}</title>
    <style>
        .text-center { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 8px; border: 1px solid #ccc; }
        h1, h2, h3 { margin-bottom: 5px; }
        tfoot td { font-weight: bold; }
        .logo-container { text-align: center; margin: 10px 0; }
    </style>
</head>
<body>

    <h2 class="text-center"><strong>ALFA Y OMEGA DISTRIBUCIONES</strong></h2>

    <div class="logo-container">
        <img src="{{ public_path('img/config/' . $config->_logo) }}" alt="Logo {{ $config->_razonsocial }}" height="80" />
    </div>

    <h1 class="text-center">Pedido de {{ $pedido->user->name }}</h1>
    <p class="text-center">Fecha del pedido: {{ $pedido->created_at->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->name ?? 'Producto eliminado' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->preciototal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td><strong>Total</strong></td>
                <td>{{ $pedido->detalles->sum('cantidad') }}</td>
                <td><strong>${{ number_format($pedido->detalles->sum('preciototal'), 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

</body>
</html>
