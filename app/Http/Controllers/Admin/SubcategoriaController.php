<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Categoria;
use Session;

class SubcategoriaController extends Controller
{
    // Listado
    public function index() {
        $subcategorias = Subcategoria::where('categoria_id', Session::get("categoria_id"))->get();
        return view('admin.subcategoria.index', compact('subcategorias'));
    }

    // Insertar
    public function create() {
        return view('admin.subcategoria.create');
    }

    public function store(Request $request) {
        $subcategoria = new Subcategoria($request->all());

        if ($request->hasFile('seo_image')) {
            $file = $request->file('seo_image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/subcategoria/'), $nombre);
            $subcategoria->seo_image = $nombre;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/subcategoria/'), $nombre);
            $subcategoria->image = $nombre;
        }

        $subcategoria->portada = $request->portada ? 1 : 0;
        $subcategoria->publicado = $request->publicado ? 1 : 0;
        $subcategoria->categoria_id = Session::get("categoria_id");
        $subcategoria->save();
        return redirect()->route('subcategoria.index');
    }

    // Editar
    public function edit($id) {
        $subcategoria = Subcategoria::findOrFail($id);
        return view('admin.subcategoria.edit', compact('subcategoria'));
    }

    public function update(Request $request, $id) {
        $subcategoria = Subcategoria::findOrFail($id);
        $seo_image_anterior = $subcategoria->seo_image;
        $image_anterior = $subcategoria->image;

        $subcategoria->fill($request->all());

        if ($request->hasFile('seo_image')) {
            $rutaAnterior = public_path("img/subcategoria/" . $seo_image_anterior);
            if (is_file($rutaAnterior)) {
                unlink($rutaAnterior);
            }
            $file = $request->file('seo_image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/subcategoria/'), $nombre);
            $subcategoria->seo_image = $nombre;
        }

        if ($request->hasFile('image')) {
            $rutaAnterior = public_path("img/subcategoria/" . $image_anterior);
            if (is_file($rutaAnterior)) {
                unlink($rutaAnterior);
            }
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/subcategoria/'), $nombre);
            $subcategoria->image = $nombre;
        }
        $subcategoria->portada = $request->portada ? 1 : 0;
        $subcategoria->publicado = $request->publicado ? 1 : 0;
        $subcategoria->save();
        return redirect()->route('subcategoria.index');
    }

    // Eliminar
    public function destroy($id) {
        $subcategoria = Subcategoria::findOrFail($id);
        $rutaAnterior = public_path("img/subcategoria/".$subcategoria->seo_image);
        if (file_exists($rutaAnterior))  { unlink(realpath($rutaAnterior));}
        $rutaAnterior = public_path("img/subcategoria/" . $subcategoria->image);
        if (file_exists($rutaAnterior)) { unlink(realpath($rutaAnterior));}
        $subcategoria->delete();
        return redirect()->route('subcategoria.index');
    }

     public function show($id){
        Session::put("subcategoria_id",$id);
        return redirect('admin/producto');
    }
}
 