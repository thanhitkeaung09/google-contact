<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::post('/register',[\App\Http\Controllers\ApiAuthController::class,'register'])->name('api.register');
Route::post('/login',[\App\Http\Controllers\ApiAuthController::class,'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function(){
    Route::delete('/forceDelete/{contactapi}',[\App\Http\Controllers\ContactApiController::class,'forceDelete']);
    Route::get('/trash',[\App\Http\Controllers\ContactApiController::class,'trash']);
    Route::post('/restore/{contactapi}',[\App\Http\Controllers\ContactApiController::class,'restore']);
    Route::delete('/multipleDelete',[\App\Http\Controllers\ContactApiController::class,'multipleDelete']);
    Route::get('users/export/',[\App\Http\Controllers\ContactApiController::class,'export']);
    Route::post('/copy/{id}',[\App\Http\Controllers\ContactApiController::class,'copy']);
    Route::post('/multipleCopy',[\App\Http\Controllers\ContactApiController::class,'multipleCopy']);


    Route::apiResource('/contactapi',\App\Http\Controllers\ContactApiController::class);
    Route::post('/logout',[\App\Http\Controllers\ApiAuthController::class,'logout'])->name('api.logout');
    Route::post('logoutAll',[\App\Http\Controllers\ApiAuthController::class,'logoutAll'])->name('api.logoutAll');
});
