<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Master\MDepartemenController;
use App\Http\Controllers\Master\MPenempatanController;
use App\Http\Controllers\Master\MBagianController;
use App\Http\Controllers\Master\MJabatanController;
use App\Http\Controllers\Master\MKaryawanController;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('/departemen')->group(function () {
        Route::get('/', [MDepartemenController::class, 'index']);
        Route::post('/store', [MDepartemenController::class, 'store']);
        Route::get('/{id}', [MDepartemenController::class, 'show']);
        Route::put('/{id}/update', [MDepartemenController::class, 'update']);
        Route::delete('/{id}/destroy', [MDepartemenController::class, 'destroy']);
    });

    Route::prefix('/penempatan')->group(function () {
        Route::get('/', [MPenempatanController::class, 'index']);
        Route::post('/store', [MPenempatanController::class, 'store']);
        Route::get('/{id}', [MPenempatanController::class, 'show']);
        Route::put('/{id}/update', [MPenempatanController::class, 'update']);
        Route::delete('/{id}/destroy', [MPenempatanController::class, 'destroy']);
    });

    Route::prefix('/bagian')->group(function () {
        Route::get('/', [MBagianController::class, 'index']);
        Route::post('/store', [MBagianController::class, 'store']);
        Route::get('/{id}', [MBagianController::class, 'show']);
        Route::put('/{id}/update', [MBagianController::class, 'update']);
        Route::delete('/{id}/destroy', [MBagianController::class, 'destroy']);
    });

    Route::prefix('/jabatan')->group(function () {
        Route::get('/', [MJabatanController::class, 'index']);
        Route::post('/store', [MJabatanController::class, 'store']);
        Route::get('/{id}', [MJabatanController::class, 'show']);
        Route::put('/{id}/update', [MJabatanController::class, 'update']);
        Route::delete('/{id}/destroy', [MJabatanController::class, 'destroy']);
    });

    Route::prefix('/karyawan')->group(function () {
        Route::get('/', [MKaryawanController::class, 'index']);
        Route::post('/store', [MKaryawanController::class, 'store']);
        Route::get('/{id}', [MKaryawanController::class, 'show']);
        Route::put('/{id}/update', [MKaryawanController::class, 'update']);
        Route::delete('/{id}/destroy', [MKaryawanController::class, 'destroy']);
    });

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
