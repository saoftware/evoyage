<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BilletsController;
use App\Http\Controllers\Api\CarsController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ConvoisController;
use App\Http\Controllers\Api\HorairesController;
use App\Http\Controllers\Api\PaysController;
use App\Http\Controllers\Api\VillesController;
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
// Route d'authentification
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);


// Route des catégories de cars
Route::get('/categories', [CategoriesController::class, 'index']);
Route::post('/categories/create', [CategoriesController::class, 'store']);
Route::get('/categories/detail/{id}', [CategoriesController::class, 'show']);
Route::put('/categories/update/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/delete/{id}', [CategoriesController::class, 'destroy']);
Route::get('/categories/search', [CategoriesController::class, 'search']);

// Route des villes
Route::get('/villes', [VillesController::class, 'index']);
Route::post('/villes/create', [VillesController::class, 'store']);
Route::get('/villes/detail/{id}', [VillesController::class, 'show']);
Route::put('/villes/update/{id}', [VillesController::class, 'update']);
Route::delete('/villes/delete/{id}', [VillesController::class, 'destroy']);
Route::get('/villes/search', [VillesController::class, 'search']);

// Route des pays
Route::get('/pays', [PaysController::class, 'index']);
Route::post('/pays/create', [PaysController::class, 'store']);
Route::get('/pays/detail/{id}', [PaysController::class, 'show']);
Route::put('/pays/update/{id}', [PaysController::class, 'update']);
Route::delete('/pays/delete/{id}', [PaysController::class, 'destroy']);
Route::get('/pays/search', [PaysController::class, 'search']);

// Route des horaires
Route::get('/horaires', [HorairesController::class, 'index']);
Route::post('/horaires/create', [HorairesController::class, 'store']);
Route::get('/horaires/detail/{id}', [HorairesController::class, 'show']);
Route::put('/horaires/update/{id}', [HorairesController::class, 'update']);
Route::delete('/horaires/delete/{id}', [HorairesController::class, 'destroy']);
Route::get('/horaires/search', [HorairesController::class, 'search']);

// Route des cars
Route::get('/cars', [CarsController::class, 'index']);
Route::post('/cars/create', [CarsController::class, 'store']);
Route::get('/cars/detail/{id}', [CarsController::class, 'show']);
Route::put('/cars/update/{id}', [CarsController::class, 'update']);
Route::delete('/cars/delete/{id}', [CarsController::class, 'destroy']);
Route::get('/cars/search', [CarsController::class, 'search']);

// Route des convois
Route::get('/convois', [ConvoisController::class, 'index']);
Route::post('/convois/create', [ConvoisController::class, 'store']);
Route::get('/convois/detail/{id}', [ConvoisController::class, 'show']);
Route::put('/convois/update/{id}', [ConvoisController::class, 'update']);
Route::delete('/convois/delete/{id}', [ConvoisController::class, 'destroy']);
Route::get('/convois/search', [ConvoisController::class, 'search']);

// Route des billets
Route::get('/billets', [BilletsController::class, 'index']);
Route::post('/billets/create', [BilletsController::class, 'store']);
Route::get('/billets/detail/{id}', [BilletsController::class, 'show']);
Route::put('/billets/update/{id}', [BilletsController::class, 'update']);
Route::delete('/billets/delete/{id}', [BilletsController::class, 'destroy']);
Route::get('/billets/search', [BilletsController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});