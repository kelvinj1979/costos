<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IngredientesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RecetasController;
use App\Http\Controllers\CostosController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\MaterialesController;
use App\Http\Controllers\MdobraController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnidadMedidaController;
use App\Http\Controllers\ConversionUnidadController;

// Cambia esta línea:
// Route::view('/', 'pages.dashboard')->name('dashboard');

// Por esta:
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


// Usuarios
Route::view('/usuarios', 'pages.usuarios')->name('usuarios');

// Dashboard
// Esta ruta se puede usar para mostrar un dashboard o panel de control
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


// Rutas resource para CRUD, incluyendo PUT/PATCH/DELETE
Route::resources([
    'ingredientes' => IngredientesController::class,
    'productos' => ProductosController::class,
    'recetas' => RecetasController::class,    
    'gastos' => GastosController::class,
    'materiales' => MaterialesController::class,
    'mdobra' => MdobraController::class,
    'usuarios' => UsuarioController::class,
    'crear_recetas' => RecetasController::class,
    'unidad_medida' => UnidadMedidaController::class,
    'conversion_unidad' => ConversionUnidadController::class,
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('usuarios/{usuario}/json', [UsuarioController::class, 'showJson']);
