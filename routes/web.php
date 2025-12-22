<?php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
// Route untuk menampilkan halaman login
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
// Route Halaman Daftar (Register) - TAMBAHKAN INI
Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard', function () {
    return view('dashboard'); // Pastikan file dashboard.blade.php ada
})->middleware('auth');

// Route untuk halaman Laporan
Route::get('/laporan', function () {
    return view('laporan');
});

// Route Detail Laporan
Route::get('/laporan/detail', function () {
    return view('detail_laporan');
});

use App\Http\Controllers\ReportController;

// Rute untuk menampilkan halaman form (ini yang sudah ada)
Route::get('/laporan/buat', [ReportController::class, 'create'])->name('laporan.create');

// Rute untuk PROSES simpan data (TAMBAHKAN INI)
Route::post('/laporan/buat', [ReportController::class, 'store'])->name('laporan.store');
// Route Halaman Profil
Route::get('/profile', function () {
    return view('profile');
});

// Route Halaman Edit Profil
Route::get('/profile/edit', function () {
    return view('edit_profile');
});

// Route Halaman Riwayat Laporan
Route::get('/profile/riwayat', function () {
    return view('riwayat_laporan');
});

// Route Papan Peringkat
Route::get('/leaderboard', function () {
    return view('leaderboard');
});

// Route Admin Dashboard
Route::get('/admin/dashboard', function () {
    return view('admin_dashboard');
});

// Route Admin Laporan
Route::get('/admin/laporan', function () {
    return view('admin_laporan');
});

// Route Admin Progress
Route::get('/admin/progress', function () {
    return view('admin_progress');
});