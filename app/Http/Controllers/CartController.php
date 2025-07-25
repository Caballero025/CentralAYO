<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Detalle;

use Cart;
use Auth;
use PDF;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Agregar producto al carrito
    public function add(Request $request){
        $producto = Producto::find($request->id);

        // Validar que haya ingresado una cantidad válida
        $cantidad = intval($request->quantity);
        if ($cantidad < 1) {
            return redirect()->back()->with("error_message", "La cantidad debe ser mayor o igual a 1.");
        }

        Cart::add(array(
            "id" => $producto->id,
            "name" => $producto->name,
            "price" => $producto->precio,
            "quantity" => $cantidad,
            "attributes" => array(
                "image" => $producto->image,
                "slug" => $producto->slug
            )
        ));

        return redirect()->back()->with("success_message", "Producto $producto->name agregado ($cantidad unidades).");
    }

    // Mostrar Carrito
    public function cart(){
        return view('front.cart');
    }

    // Remover un producto del carrito
    public function removeitem(Request $request){
        Cart::remove([
            'id'=>$request->id,
        ]);
        return back()->with('success',"Producto eliminado con éxito de su carrito.");
    }

    // Limpiar el carrito
    public function clear(){
        Cart::clear();
        return back()->with('success','Carrito de compra vacío!');
    }

    // Procesar pedido: crear pedido, generar PDF y enviar por WhatsApp
    public function proceso(){
        if (Cart::getContent()->count() > 0) {
            // Crear pedido
            $pedido = new Pedido();
            $pedido->subTotal = Cart::getSubTotal();
            $pedido->impuesto = Cart::getSubTotal() * 0.16;
            $pedido->total = Cart::getSubTotal() * 1.16;
            $pedido->entregado = 1;
            $pedido->user_id = Auth::user()->id;
            $pedido->save();

            // Crear detalles del pedido
            foreach (Cart::getContent() as $c) {
                $detalle = new Detalle();
                $detalle->cantidad = $c->quantity;
                $detalle->precioTotal = $c->price * $c->quantity;
                $detalle->pedido_id = $pedido->id;
                $detalle->producto_id = $c->id;
                $detalle->save();
            }

            // Cargar relaciones para el PDF
            $pedido = Pedido::with('user', 'detalles.producto')->find($pedido->id);

            // Simulación de config (logo y razón social)
            $config = (object)[
                '_logo' => 'logo.png', // Debe estar en public/img/config/logo.png
                '_razonsocial' => 'ALFA Y OMEGA DISTRIBUCIONES'
            ];

            // Generar el PDF usando la vista existente
            $pdf = PDF::loadView('admin.user.pdf', compact('pedido', 'config'));

            // Guardar PDF en storage
            $nombreArchivo = 'pedido_' . $pedido->id . '_' . Str::random(6) . '.pdf';
            $rutaPDF = "public/pedidos/{$nombreArchivo}";
            Storage::put($rutaPDF, $pdf->output());

            // Vaciar el carrito
            Cart::clear();

            // Obtener URL pública del PDF
            $urlPDF = asset("storage/pedidos/{$nombreArchivo}");

            // Enviar mensaje con enlace al PDF por WhatsApp
            $mensaje = "Nuevo pedido generado:\nPor favor revisa el resumen aquí:\n{$urlPDF}";
            $whatsappURL = "https://api.whatsapp.com/send?phone=521.$_celular&text=" . urlencode($mensaje);

            return redirect($whatsappURL);
        } else {
            return redirect()->back()->with("error", "El carrito está vacío.");
        }
    }
}
