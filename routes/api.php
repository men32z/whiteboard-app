<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WhiteboardController;

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


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('whiteboards', WhiteboardController::class);
    Route::post('whiteboards/{whiteboard}/participants', [WhiteboardController::class, 'addParticipant']);
    Route::delete('whiteboards/{whiteboard}/participants', [WhiteboardController::class, 'removeParticipant']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});