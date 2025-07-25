<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carrusel;

class CarruselController extends Controller
{
    // Listado
    public function index() {
        $carrusels = Carrusel::all();
        return view('admin.carrusel.index', compact("carrusels"));
    }

    // Crear
    public function create() {
        return view('admin.carrusel.create');
    }
    public function store(Request $request) {
        $carrusel = new Carrusel($request->all());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/carrusel/'), $nombre);
            $carrusel->image = $nombre;
        }
        $carrusel->save();
        return redirect()->route('carrusel.index');
    }

    // Editar
    public function edit($id) {
        $carrusel = Carrusel::findOrFail($id);
        return view('admin.carrusel.edit', compact('carrusel'));
    }

    public function update(Request $request, $id) {
        $carrusel = Carrusel::findOrFail($id);
        $imageanterior = $carrusel->image;
        $carrusel->fill($request->all());
        if ($request->hasFile('image')) {
            $rutaAnterior = public_path("img/carrusel/" . $imageanterior);
            if (file_exists($rutaAnterior)) {
                unlink(realpath($rutaAnterior));
            }
            $file = $request->file('image');
            $nombre = $file->getClientOriginalName();
            $file->move(public_path('img/carrusel/'), $nombre);
            $carrusel->image = $nombre;
        }
        $carrusel->save();
        return redirect()->route('carrusel.index');
    }

    // Eliminar
    public function destroy($id) {
        $carrusel = Carrusel::findOrFail($id);
        $rutaImg = public_path("img/carrusel/" . $carrusel->image);
        if (file_exists($rutaImg)) {
            unlink(realpath($rutaImg));
        }
        $carrusel->delete();
        return redirect()->route('carrusel.index');
    }
}
