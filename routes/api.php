<?php

use App\Http\Controllers\Api\Authentication\AuthController;
use App\Http\Controllers\Api\Media\MoviesController;
use App\Http\Controllers\Api\Media\SeriesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*
 * movie routes
 */
Route::prefix('/movies')->group(function () {
    Route::get('/', [MoviesController::class, 'index']);
    Route::get('/top-rated', [MoviesController::class, 'topRated']);
    Route::get('/{id}/detail', [MoviesController::class, 'detail']);
    Route::get('/{id}/videos', [MoviesController::class, 'videos']);
    Route::get('/search', [MoviesController::class, 'search']);
});

/*
 * Authentication routes
 */
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::prefix('/tv')->group(function () {
    Route::get('/', [SeriesController::class, 'index']);
    Route::get('/top-rated', [SeriesController::class, 'topRated']);
    Route::get('/{id}/detail', [SeriesController::class, 'detail']);
    Route::get('/{id}/videos', [SeriesController::class, 'videos']);
    Route::get('/search', [SeriesController::class, 'search']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
