<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController; // Pindahkan semua use ke atas agar rapi
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AUTH SECTION ---

Route::get('/', function () {
    return view('login');
});

// HAPUS: Bagian ini duplikat dengan baris di bawahnya
// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// TAMBAH: Sebaiknya gunakan Controller untuk Register jika ada logikanya nanti
Route::get('/register', function () {
    return view('register');
})->name('register');

// TAMBAH: Rute Logout sangat penting
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- USER SECTION (DILINDUNGI AUTH) ---

Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // PERBAIKI: Rute /laporan harus lewat Controller agar data $reports muncul
    // HAPUS: Route::get('/laporan', function () { return view('laporan'); }); 
    Route::get('/laporan', [ReportController::class, 'index'])->name('laporan.index');

    // PERBAIKI: Rute detail harus menggunakan ID dinamis {id}
    // HAPUS: Route::get('/laporan/detail', function () { return view('detail_laporan'); });
    Route::get('/laporan/{id}', [ReportController::class, 'show'])->name('laporan.show');

    // Rute Buat Laporan
   Route::get('/buat-laporan', [ReportController::class, 'create'])->name('laporan.create');

// Jalur untuk memproses penyimpanan laporan
Route::post('/laporan/store', [ReportController::class, 'store'])->name('laporan.store');

    // Profile & Leaderboard
    Route::get('/profile', function () { return view('profile'); })->name('profile');
    Route::get('/profile/edit', function () { return view('edit_profile'); });
    Route::get('/profile/riwayat', function () { return view('riwayat_laporan'); });
    Route::get('/leaderboard', function () { return view('leaderboard'); });
});


// --- ADMIN SECTION ---
// TAMBAH: Sebaiknya kelompokkan admin agar bisa diberi middleware khusus admin nanti
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () { return view('admin_dashboard'); });
    Route::get('/laporan', function () { return view('admin_laporan'); });
    Route::get('/progress', function () { return view('admin_progress'); });
});