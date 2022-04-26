<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;

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

Route::middleware('auth:api')->group(function () {
   Route::get('user', [AuthController::class, 'user']);
   Route::post('logout', [AuthController::class,'logout']);
   Route::resource('products', ProductController::class);
});
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);

//ruta al controlador de la Api de Productes
Route::resource('products', 'Api\ProductController');
Route::resource('company', 'Api\CompanyController');
Route::resource('category', 'Api\CategoryController');
