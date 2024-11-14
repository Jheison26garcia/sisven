<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Ruta para el dashboard (accesible por admin y cliente)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Perfil del usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas para productos (solo accesible para admin y vendedor)
    Route::resource('products', ProductController::class)->middleware('role:admin,vendedor');
    
    // Rutas para categorías (solo accesible para admin)
    Route::resource('categories', CategoryController::class)->middleware('role:admin');
    
    // Rutas para clientes (accesible por admin, cliente y vendedor)
    Route::resource('customers', CustomerController::class)->middleware('role:admin,cliente,vendedor');
    
    // Rutas para facturas (solo accesible para admin)
    Route::resource('invoices', InvoiceController::class)->middleware('role:admin');
});

// Cargar las rutas de autenticación
require __DIR__.'/auth.php';


