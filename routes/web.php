<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\RuanganController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
    Route::apiResource('students',           StudentController::class);
    Route::apiResource('kelas',              KelasController::class);
    Route::apiResource('jurusans',           JurusanController::class);
    Route::apiResource('tahun-ajarans',      TahunAjaranController::class);
    Route::apiResource('mata-pelajarans',    MataPelajaranController::class);
    Route::apiResource('ruangans',           RuanganController::class);
    Route::apiResource('gurus',              App\Http\Controllers\GuruController::class);
});

// Data Sekolah (Front-end views)
Route::get('/siswa', fn() => view('siswa.index'))->name('siswa.index');
Route::get('/guru',  fn() => view('guru.index'))->name('guru.index');

// Manajemen Data Master (Baru ditambah)
Route::get('/kelas',              fn() => view('kelas.index'))->name('kelas.index');
Route::get('/jurusan',            fn() => view('jurusan.index'))->name('jurusan.index');
Route::get('/tahun-ajaran',       fn() => view('tahun-ajaran.index'))->name('tahun-ajaran.index');
Route::get('/mata-pelajaran',     fn() => view('mata-pelajaran.index'))->name('mata-pelajaran.index');
Route::get('/ruangan',            fn() => view('ruangan.index'))->name('ruangan.index');

// Akademik
Route::get('/jadwal-pelajaran',   fn() => view('jadwal-pelajaran.index'))->name('jadwal-pelajaran.index');
Route::get('/kalender-akademik',  fn() => view('kalender-akademik.index'))->name('kalender-akademik.index');

// Sistem
Route::get('/users',  fn() => view('users.index'))->name('users.index');
Route::get('/roles',  fn() => view('roles.index'))->name('roles.index');

// Monitoring
Route::get('/api-monitoring',  fn() => view('api-monitoring.index'))->name('api-monitoring.index');
Route::get('/activity-log',    fn() => view('activity-log.index'))->name('activity-log.index');
Route::get('/settings',        fn() => view('settings.index'))->name('settings.index');

