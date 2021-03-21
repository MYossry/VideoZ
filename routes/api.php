<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/',[DashboardController::class,'index'])->name('dashboard');
Route::resource('video', VideoController::class)->names([
        'index'=>'home',
        'create'=>'video.create',
        'show'=>'video.show',
        'edit'=>'video.edit',
        'update'=>'video.update',
        'store'=>'video.store',
        'destroy'=>'video.destroy',
]);
Route::prefix('user')->group(function(){
    Route::get('/{user}',[UserController::class,'index'])->name('user');
});
Route::prefix('register')->group(function(){
    Route::get('/',[RegisterController::class,'index'])->name('register.index');
    Route::post('/store',[RegisterController::class,'store'])->name('register.store');
});
Route::prefix('login')->group(function(){
    Route::get('/',[LoginController::class.'index'])->name('login.index');
    Route::post('/store',[LoginController::class.'store'])->name('login.store');
    Route::delete('/destroy',[LoginController::class.'destory'])->name('login.destroy');

});
