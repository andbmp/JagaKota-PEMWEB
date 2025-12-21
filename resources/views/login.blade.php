@extends('layouts.app')

@section('title', 'Masuk - Aplikasi')

@section('content')
{{-- Custom CSS khusus untuk halaman Login ini --}}
<style>
    /* Mengatur background halaman utama */
    body {
        background-color: #FEF9F0; /* Warna krem background */
        /* Jika Anda punya gambar kota background, uncomment baris bawah ini: */
        background-image: url('public/image/reportcarrousel-background.svg');
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: contain;
        min-height: 100vh;
    }

    /* Style untuk Card Login */
    .login-card {
        background-white;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 40px;
        max-width: 450px;
        width: 100%;
    }

    /* Garis pemisah di bawah judul */
    .divider {
        height: 2px;
        background-color: #F0E6D2;
        margin: 20px 0;
        width: 100%;
    }

    /* Custom Input Field (Warna krem gelap) */
    .form-control-custom {
        background-color: #F2ECD9; /* Warna input field */
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        color: #555;
    }
    
    .form-control-custom:focus {
        background-color: #F2ECD9;
        box-shadow: 0 0 0 2px rgba(106, 142, 114, 0.5);
    }

    .form-label {
        font-weight: 600;
        color: #000;
    }

    /* Tombol Masuk (Hijau) */
    .btn-sage {
        background-color: #6A8E72; /* Warna hijau sage */
        color: white;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px;
    }
    .btn-sage:hover {
        background-color: #597a60;
        color: white;
    }

    /* Tombol Daftar Baru (Outline) */
    .btn-outline-sage {
        background-color: transparent;
        border: 2px solid #6A8E72;
        color: #000;
        border-radius: 8px;
        font-weight: 600;
        padding: 10px;
    }
    .btn-outline-sage:hover {
        background-color: #6A8E72;
        color: white;
    }

    .admin-link {
        font-size: 0.8rem;
        color: #000;
        text-decoration: none;
        font-weight: 600;
    }
</style>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    
    <div class="card login-card bg-white">
        <h2 class="fw-bold mb-1">Masuk</h2>
        <p class="text-muted mb-0">Selamat datang kembali!</p>
        
        <div class="divider"></div>

        {{-- Ganti action agar mengarah ke pintu yang benar: /api/login --}}
<form action="{{ url('/api/login') }}" method="POST">
    @csrf 
    
    <div class="mb-3">
        <label for="email" class="form-label">Pos-el</label>
        {{-- WAJIB: Tambahkan atribut name="email" agar data terbaca oleh Laravel --}}
        <input type="email" name="email" class="form-control form-control-custom" id="email" placeholder="Pengguna@gmail.com" required>
    </div>

    <div class="mb-4">
        <label for="password" class="form-label">Kata Sandi</label>
        {{-- WAJIB: Tambahkan atribut name="password" --}}
        <input type="password" name="password" class="form-control form-control-custom" id="password" placeholder="KataSandi" required>
    </div>

    <div class="d-grid gap-2 mb-3">
        <button type="submit" class="btn btn-sage">Masuk</button>
    </div>

    <div class="d-grid gap-2">
         <a href="{{ url('/register') }}" class="btn btn-outline-sage">Daftar Baru</a>
    </div>
</form>
    </div>
    
    <div style="height: 50px;"></div>
</div>
@endsection