<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\HomePageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;

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

Route::get('/homepage', [HomePageController::class, 'index']);
Route::get('/categories-with-subcategories', [CategoryApiController::class, 'index']);
Route::get('/category/{id}/subcategories', [CategoryApiController::class, 'subcategories']);
Route::get('/categories/{slug}/posts', [CategoryController::class, 'posts']);
Route::get('/post-detail/{slug}', [PostController::class, 'show']);
Route::get('/posts-list', [PostController::class, 'index']);