<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


 //Route::get('/', [PostController::class,'map'])->name('map');
Route::get('/', [PostController::class,'test'])->name('test');
Route::get('/maps/navi', [PostController::class,'navi'])->name('navi');
Route::get('/maps/detail', [PostController::class,'detail'])->name('detail');

Route::get('/posts',[PostController::class,'posts'])->name('posts');
Route::get('/posts/create',[PostController::class,'create'])->name('create')->middleware(['auth']);
Route::get('/posts/{post}', [PostController::class,'show'])->name('show');
Route::post('/posts',[PostController::class,'store'])->name('store');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
