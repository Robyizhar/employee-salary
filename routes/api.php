<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HRD\MKaryawanController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/karyawan', [MKaryawanController::class, 'index']);

});
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/karyawan', [MKaryawanController::class, 'index']);
    // Route::get('/profile', function(Request $request) {
    //     return auth()->user();
    // });

    // // API route for logout user
    // Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
