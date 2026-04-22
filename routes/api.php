<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\StudentController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\GuruController;

Route::apiResource('students',           StudentController::class);
Route::apiResource('students',           StudentController::class);
Route::apiResource('jurusans',           JurusanController::class);
Route::apiResource('tahun-ajarans',      TahunAjaranController::class);
Route::apiResource('mata-pelajarans',    MataPelajaranController::class);
Route::apiResource('ruangans',           RuanganController::class);
Route::apiResource('gurus',              GuruController::class);
