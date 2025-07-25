<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pedido;
use Session;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index() {
        $users = User::with('pedidos')->get();  // eager loading pedidos
        return view('admin.user.index', compact('users'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->estado = $request->estado ? 1 : 0;
        $user->save();
        return redirect()->route('user.index');
    }

    public function show($id) {
        Session::put("pedido_id", $id);
        return redirect('admin/detalle');
    }

    public function generarpdf($id) {
    $pedido = Pedido::with('user', 'detalles.producto')->findOrFail($id);

    $fecha = $pedido->created_at->format('Ymd-His');
    $username = preg_replace('/\s+/', '_', strtolower($pedido->user->name)); // limpia el nombre
    $nombreArchivo = "Pedido-{$username}-{$fecha}.pdf";

    $pdf = PDF::loadView("admin.user.pdf", compact("pedido"));
    return $pdf->download($nombreArchivo);
}

}
