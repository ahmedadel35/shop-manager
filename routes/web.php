<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/", [HomeController::class, "index"]);
Route::post("/categories", [HomeController::class, "store"]);
// axios not updating with patch request
Route::post("/categories/{category}", [HomeController::class, "update"]);
Route::delete("/categories/{category}", [HomeController::class, "destroy"]);

// product
Route::get('/categories/{category}', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');
