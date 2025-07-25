<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use Session;

class ProductoController extends Controller
{
    // Listado
    public function index() {
        $productos = Producto::whereSubcategoria_id(Session::get("subcategoria_id"))->get();
        return view('admin.producto.index', compact('productos'));
    }

    // Crear nuevo producto
    public function create() {
        return view('admin.producto.create');
    }

    public function store(Request $request) {
        $producto = new Producto($request->all());

        if ($request->hasFile('seo_image')) {
            $file = $request->file('seo_image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/producto/'), $nombre);
            $producto->seo_image = $nombre;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/producto/'), $nombre);
            $producto->image = $nombre;
        }

        $producto->publicado = $request->publicado ? 1 : 0;
        $producto->subcategoria_id = Session::get("subcategoria_id");
        $producto->save();

        return redirect()->route('producto.index');
    }

    // Editar producto
    public function edit($id) {
        $producto = Producto::findOrFail($id);
        return view('admin.producto.edit', compact('producto'));
    }

    public function update(Request $request, $id) {
        $producto = Producto::findOrFail($id);
        $seo_image_anterior = $producto->seo_image;
        $image_anterior = $producto->image;

        $producto->fill($request->all());

        if ($request->hasFile('seo_image')) {
            $rutaAnterior = public_path("img/producto/" . $seo_image_anterior);
            if (is_file($rutaAnterior)) {
                unlink($rutaAnterior);
            }
            $file = $request->file('seo_image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/producto/'), $nombre);
            $producto->seo_image = $nombre;
        }

        if ($request->hasFile('image')) {
            $rutaAnterior = public_path("img/producto/" . $image_anterior);
            if (is_file($rutaAnterior)) {
                unlink($rutaAnterior);
            }
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/producto/'), $nombre);
            $producto->image = $nombre;
        }

        $producto->publicado = $request->publicado ? 1 : 0;
        $producto->save();

        return redirect()->route('producto.index');
    }

    // Eliminar producto
    public function destroy($id) {
        $producto = Producto::findOrFail($id);

        // Validar si hay blogs relacionados
        if ($producto->blogs()->exists()) {
            return redirect()->route('producto.index')
                ->with('error', 'No se puede eliminar el producto porque tiene blogs relacionados.');
        }

        // Validar si hay detalles relacionados
        if ($producto->detalles()->exists()) {
            return redirect()->route('producto.index')
                ->with('error', 'No se puede eliminar el producto porque tiene detalles relacionados.');
        }

        // Eliminar imágenes si existen
        $rutaSeoImage = public_path("img/producto/" . $producto->seo_image);
        if (file_exists($rutaSeoImage)) {
            unlink(realpath($rutaSeoImage));
        }

        $rutaImage = public_path("img/producto/" . $producto->image);
        if (file_exists($rutaImage)) {
            unlink(realpath($rutaImage));
        }

        $producto->delete();

        return redirect()->route('producto.index')->with('success', 'Producto eliminado correctamente.');
    }
}
