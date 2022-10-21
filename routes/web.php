<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('contact.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('/contact',\App\Http\Controllers\ContactController::class);
Route::resource('/photo',\App\Http\Controllers\PhotoController::class);

Route::post('/multipleDelete',[\App\Http\Controllers\ContactController::class,'multipleDeltete'])->name('contact.multipleDelete');
Route::get('/trashBin',[\App\Http\Controllers\ContactController::class,'trashBin'])->name('contact.trash');
Route::delete("/forceDelete/{id}",[\App\Http\Controllers\ContactController::class,'forceDelete'])->name('contact.forceDelete');
Route::post("/restore/{id}",[\App\Http\Controllers\ContactController::class,'restore'])->name('contact.restore');
//Route::post('/selectAll',[\App\Http\Controllers\ContactController::class,'selectAll'])->name("contact.selectAll");

Route::get('users/export/', [\App\Http\Controllers\ContactController::class, 'export'])->name('contact.export');
require __DIR__.'/auth.php';
