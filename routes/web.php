<?php

use Illuminate\Support\Facades\Route;

// Route untuk menampilkan halaman login
Route::get('/login', function () {
    return view('login');
});

// Route Halaman Daftar (Register) - TAMBAHKAN INI
Route::get('/register', function () {
    return view('register');
});

// Route Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
});

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
