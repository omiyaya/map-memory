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

use App\Http\Controllers\MapDetailController;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::get('/commentRegist/', [MapDetailController::class, 'commentRegist']);
Route::post('/commentRegist/', [MapDetailController::class, 'commentRegist']);
Route::get('/getMapPhoto/{areaId}/', [MapDetailController::class, 'getMapPhoto']);
Route::post('/getMapPhoto/{areaId}/', [MapDetailController::class, 'getMapPhoto']);