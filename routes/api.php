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
Route::get('products', [\App\Http\Controllers\Api\HomeController::class, 'products']);
Route::get('categories', [\App\Http\Controllers\Api\HomeController::class, 'categories']);
Route::get('brands', [\App\Http\Controllers\Api\HomeController::class, 'brands']);
Route::get('view-product/{id}', [\App\Http\Controllers\Api\HomeController::class, 'viewProduct']);
Route::get('view-brand-products/{brandID}', [\App\Http\Controllers\Api\HomeController::class, 'viewBrandProducts']);
Route::get('view-category-products/{categoryID}', [\App\Http\Controllers\Api\HomeController::class, 'viewCategoryProducts']);
Route::post('register', [\App\Http\Controllers\Api\HomeController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\HomeController::class, 'login']);
Route::group(['middleware' => 'auth:api'], function () {

    Route::post('user', [\App\Http\Controllers\Api\UserController::class, 'user']);
    Route::post('logout', [\App\Http\Controllers\Api\UserController::class, 'logout']);
});
