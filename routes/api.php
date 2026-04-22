<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\CategoryApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/news', [NewsApiController::class, 'index']);
Route::get('/news/search', [NewsApiController::class, 'search']);
Route::get('/notifications', [NewsApiController::class, 'notifications']);
Route::get('/categories', [CategoryApiController::class, 'index']);

Route::post('/save-token', function (Request $request) {
    DB::table('device_tokens')->updateOrInsert(
        ['token' => $request->token],
        ['updated_at' => now()]
    );

    return response()->json(['success' => true]);
});