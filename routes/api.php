<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Login

Route::post('/auth/login',[AuthController::class,'Login']);
Route::post('/auth/register',[AuthController::class,'Register']);

Route::post('/page/create',[UserController::class,'PageCreate'])->middleware('auth:api');
Route::post('/follow/person/{personId}',[UserController::class,'FollowUser'])->middleware('auth:api');

Route::post('/follow/page/{pageId}',[PageController::class,'FollowPage'])->middleware('auth:api');

Route::post('/person/attach-post',[PageController::class,'Post'])->middleware('auth:api');

Route::post('/page/{pageId}/attach-post',[PageController::class,'PagePost'])->middleware('auth:api');

Route::get('/person/feed',[UserController::class,'Feed'])->middleware('auth:api');






