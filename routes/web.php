<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DetalleController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\SubcategoriaController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\CarruselController;
use App\Http\Controllers\Admin\EmpresaController;

Auth::routes();

// Grupo de rutas para usuarios con rol ADMIN
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::resource('user', UserController::class);
    Route::resource('detalle', DetalleController::class);
    Route::resource('categoria', CategoriaController::class);
    Route::resource('subcategoria', SubcategoriaController::class);
    Route::resource('producto', ProductoController::class);
    Route::resource('blog', BlogController::class);
    Route::resource('config', ConfigController::class);
    Route::resource('carrusel', CarruselController::class);
    Route::resource('empresa', EmpresaController::class);

    // Ruta para generar PDF por pedido individual
    Route::get('pedido/pdf/{id}', [UserController::class, 'generarpdf'])->name('pedido.generarpdf');
});

// Rutas para el carrito de compras
Route::post('/store/cart-add', [CartController::class, 'add'])->name('cart.add');
Route::get('/store/cart-checkout', [CartController::class, 'cart'])->name('cart.checkout');
Route::post('/store/cart-clear', [CartController::class, 'clear'])->name('cart.clear');
Route::post('/store/cart-removeitem', [CartController::class, 'removeitem'])->name('cart.removeitem');
Route::post('/store/procesar', [CartController::class, 'proceso'])->name('cart.procesar');

// Grupo de rutas para usuarios con rol CLIENTE
Route::group(['prefix' => 'cliente', 'middleware' => ['auth', 'role:cliente']], function () {
    // Aquí puedes agregar rutas específicas del cliente
});

// Rutas públicas del sitio
Route::get('/', [FrontController::class, 'index']);
Route::get('/generarpdf/{id}', [UserController::class, 'generarpdf'])->name('generarpdf'); // PDF general por usuario (opcional)
Route::post('/buscador', [FrontController::class, 'buscador']);
Route::get('/blog', [FrontController::class, 'blog']);
Route::get('/blog/{blog:slug}', [FrontController::class, 'post']);
Route::view('/contacto', 'front.contacto');
Route::get('/empresa', [FrontController::class, 'empresa']);
Route::get('/producto/{producto:slug}', [FrontController::class, 'producto']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/{categoria:slug}/{subcategoria:slug}', [FrontController::class, 'subcategoria']);
Route::get('/{categoria:slug}', [FrontController::class, 'categoria']);
