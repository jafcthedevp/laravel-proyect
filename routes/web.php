<?php

use App\Http\Controllers\PetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
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
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/veterinaria-registro', function () {
        return Inertia::render('Vetregister');
    })->name('veterinaria.register');

    Route::get('/veterinaria', function () {
            return view('veterinaria.index');
        })->name('veterinaria.index');

    Route::get('/veterinaria/login', function () {
            return view('veterinaria.login');
        })->name('veterinaria.login');

    Route::get('/veterinaria/register', function () {
            return view('veterinaria.register');
        })->name('veterinaria.register');

    Route::post('/register', [App\Http\Controllers\RegisterController::class, 'register'])->name('register');
        
    Route::get('/about', fn () => Inertia::render('About'))->name('about');
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* Mascotas */
    Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
    Route::post('/pets/create', [PetController::class, 'create'])->name('pets.create');
    Route::post('/pets/store', [PetController::class, 'store'])->name('pets.store');
    Route::get('/pets/edit/{id}', [PetController::class, 'edit'])->name('pets.edit');

});

require __DIR__.'/auth.php';


Route::get('/admin', 'AdminController@index')->middleware(['auth', 'admin'])->name('admin.dashboard');

Route::get('/shop', 'ShopController@index')->middleware(['auth', 'shop'])->name('shop.dashboard');

Route::get('/user', 'UserController@index')->middleware(['auth', 'user'])->name('user.dashboard');

Route::get('/vetregister', 'VetRegisterController@index')->middleware(['auth', 'vetregister'])->name('vetregister.dashboard');

