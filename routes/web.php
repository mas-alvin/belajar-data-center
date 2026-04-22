<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



// Data Sekolah (Front-end views)
Route::get('/siswa', fn() => view('siswa.index'))->name('siswa.index');
Route::get('/guru',  fn() => view('guru.index'))->name('guru.index');

// Manajemen Data Master (Baru ditambah)
Route::resource('kelas', \App\Http\Controllers\KelasController::class);
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

