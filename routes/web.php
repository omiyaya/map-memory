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
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MapDetailController;

Route::get('/', function () {
    return redirect('login');
});
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::prefix('/map')->group(function () {
    Route::get('/map', [MapController::class, 'index']);
    Route::get('/map_detail/{mapId}/regist', [MapDetailController::class, 'regist']);
    Route::post('/map_detail/{mapId}/regist', [MapDetailController::class, 'regist']);
    Route::get('/map_detail/{mapId}', [MapDetailController::class, 'index']);
});

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('/welcome', function () {
    return view('welcome');
});

