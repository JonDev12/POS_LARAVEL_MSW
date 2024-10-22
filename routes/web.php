<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home\Inicio;
use App\Livewire\Category\CategoryComponent;
use App\Livewire\Product\ProductComponent;
use App\Livewire\Product\ProductShow;
use App\Livewire\Category\CategoryShow;
use App\Livewire\Home\Inicio as HomeInicio;
use App\Livewire\User\UserComponent;
use App\Livewire\User\UserShow;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/inicio', HomeInicio::class)->name('inicio');
Route::get('/categorias', CategoryComponent::class)->name('categories');
Route::get('/categorias/{category}', CategoryShow::class)->name('categories.show');
Route::get('/productos', ProductComponent::class)->name('products');
Route::get('/productos/{product}', ProductShow::class)->name('products.show');
Route::get('/usuarios', UserComponent::class)->name('users');
Route::get('/usuarios/{user}', UserShow::class)->name('users.show');

