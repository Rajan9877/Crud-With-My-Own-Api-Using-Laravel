<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\FileController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('fetch', [DataController::class, 'Fetch']);
Route::get('fetchid', [DataController::class, 'FetchThroughId']);
Route::post('search', [DataController::class, 'Search']);
Route::post('create', [DataController::class, 'Create']);
Route::post('updateid', [DataController::class, 'Update']);
Route::post('deleteid', [DataController::class, 'Delete']);
Route::post('fileupload', [FileController::class, 'fileUpload']);