<?php

use App\Http\Controllers\Api\AccessTokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\institutionController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::guard('sanctum')->user();
});

// Route::prefix('auth')->group(function(){

//     Route::post('login',[ApiAuthController::class, 'login']);
// });

// Route::prefix('auth')->middleware('auth:api')->group(function(){
//     Route::get('logout',[ApiAuthController::class ,'logout' ]);
// });


Route::post('login', [AccessTokensController::class, 'login']);
Route::post('register', [AccessTokensController::class, 'register']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('profile', [AccessTokensController::class, 'profile']);
    Route::post('logout', [AccessTokensController::class, 'logout']);
});
Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/posts', PostController::class);
Route::get('institutions', [institutionController::class, 'index']);

