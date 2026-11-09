
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\PinjamanController;

// ==============================
// DASHBOARD
// ==============================
Route::get('/', function () {
    return view('dashboard');
});

// ==============================
// DATA ANGGOTA
// ==============================

Route::get('/anggota', [AnggotaController::class, 'index']);
Route::get('/anggota/tambah', [AnggotaController::class, 'create']);
Route::post('/anggota', [AnggotaController::class, 'store']);
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit']);
Route::put('/anggota/{id}', [AnggotaController::class, 'update']);
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy']);


// ==============================
// DATA SIMPANAN
// ==============================
Route::get('/simpanan', [SimpananController::class, 'index']);
Route::get('/simpanan/tambah', [SimpananController::class, 'create']);
Route::post('/simpanan', [SimpananController::class, 'store']);

// ==============================
// DATA PINJAMAN
// ==============================
Route::get('/pinjaman', [PinjamanController::class, 'index']);
Route::get('/pinjaman/tambah', [PinjamanController::class, 'create']);
Route::post('/pinjaman', [PinjamanController::class, 'store']);

// ==============================
// DATA ANGSURAN
// ==============================
Route::get('/angsuran', function () {
    return 'Halaman Data Angsuran Koperasi';
});
