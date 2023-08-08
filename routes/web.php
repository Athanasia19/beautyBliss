<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
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

Auth::routes();

Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');

Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/create', [App\Http\Controllers\CategoryController::class,'create'])->name('categories.create');
Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::get('/category/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
Route::delete('/category/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
Route::put('/category/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');

Route::resource('brand', brandController::class)->middleware('role:Admin');
Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
Route::get('/brand/create', [BrandController::class, 'create'])->name('brand.create');
Route::post('/brand', [BrandController::class, 'store'])->name('brand.store');
Route::get('/brand/{id}', [BrandController::class, 'show'])->name('brand.show');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
Route::put('/brand/{id}', [BrandController::class, 'update'])->name('brand.update');
Route::delete('/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
Route::put('/brand/restore/{id}', [BrandController::class, 'restore'])->name('brand.restore');

Route::prefix('user')->group(function () {
    Route::get('/signup', [UserController::class, 'getSignup']);
    Route::post('/signup', [UserController::class, 'signUp'])->name('user.signup');
    Route::view('/signin', 'user.signin');
    Route::post('/signin', [LoginController::class, 'signIn'])->name('user.signin');
    Route::get('/logout',[LoginController::class,'logOut'])->name('user.logout')->middleware('auth');
   
});
