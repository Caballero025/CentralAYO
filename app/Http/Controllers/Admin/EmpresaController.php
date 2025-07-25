<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empresa;
use App\Models\Producto;

class EmpresaController extends Controller
{
    // Listado
    public function index() {
        $empresas = Empresa::all();
        return view('admin.empresa.index', compact('empresas'));
    }

    // Insertar
    public function create() {
        return view('admin.empresa.create');
    }

    public function store(Request $request) {
        $empresa = new Empresa($request->all());

        if ($request->hasFile('seo_image')) {
            $file = $request->file('seo_image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/empresa/'), $nombre);
            $empresa->seo_image = $nombre;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/empresa/'), $nombre);
            $empresa->image = $nombre;
        }
        $empresa->save();
        return redirect()->route('empresa.index');
    }

    // Actualizar
    public function edit($id) {
        $empresa = Empresa::findOrFail($id);
        return view('admin.empresa.edit', compact('empresa'));
    }

    public function update(Request $request, $id) {
        $empresa = Empresa::findOrFail($id);
        $seo_image_anterior = $empresa->seo_image;
        $image_anterior = $empresa->image;

        $empresa->fill($request->all());

        if ($request->hasFile('seo_image')) {
            $rutaAnterior = public_path("img/empresa/" . $seo_image_anterior);
            if ((file_exists($rutaAnterior)) && ($seo_image_anterior!=null)){unlink(realpath($rutaAnterior));}
            $file = $request->file('seo_image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/empresa/'), $nombre);
            $empresa->seo_image = $nombre;
        }

        if ($request->hasFile('image')) {
            $rutaAnterior = public_path("img/empresa/" . $image_anterior);
            if ((file_exists($rutaAnterior))  && ($image_anterior!=null)){unlink(realpath($rutaAnterior));
            }
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/empresa/'), $nombre);
            $empresa->image = $nombre;
        }
        $empresa->save();
        return redirect()->route('empresa.index');
    }

    // Eliminar
    public function destroy($id) {
        $empresa = Empresa::findOrFail($id);

        $rutaAnterior = public_path("img/empresa/" . $empresa->seo_image);
        if (file_exists($rutaAnterior)) {
            unlink(realpath($rutaAnterior));
        }

        $rutaAnterior = public_path("img/empresa/" . $empresa->image);
        if (file_exists($rutaAnterior)) {
            unlink(realpath($rutaAnterior));
        }

        $empresa->delete();
        return redirect()->route('empresa.index');
    }
}
