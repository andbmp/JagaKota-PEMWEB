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

// Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); // Pastikan file dashboard.blade.php ada
})->middleware('auth'); // Tambahkan middleware auth agar aman

// Route untuk halaman Laporan
Route::get('/laporan', function () {
    return view('laporan');
});

// Route Detail Laporan
Route::get('/laporan/detail', function () {
    return view('detail_laporan');
});

// Route Halaman Buat Laporan
Route::get('/laporan/buat', function () {
    return view('buat_laporan');
});

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