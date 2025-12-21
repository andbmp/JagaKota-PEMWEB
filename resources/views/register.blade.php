@extends('layouts.app')

@section('title', 'Daftar Baru - Aplikasi')

@section('content')
<style>
    /* Menggunakan style yang sama agar konsisten */
    body {
        background-color: #FEF9F0;
        background-image: url('public/image/reportcarrousel-background.svg');
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: contain;
        /* Gunakan min-height agar bisa discroll jika form panjang */
        min-height: 100vh; 
    }

    .register-card {
        background: white;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        padding: 40px;
        max-width: 500px; /* Sedikit lebih lebar dari login */
        width: 100%;
        margin-bottom: 50px;
    }

    .form-control-custom {
        background-color: #F2ECD9;
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        color: #555;
    }
    
    .form-control-custom:focus {
        background-color: #F2ECD9;
        box-shadow: 0 0 0 2px rgba(106, 142, 114, 0.5);
        outline: none;
    }

    .form-label {
        font-weight: 700; /* Lebih tebal sesuai gambar */
        color: #000;
        margin-bottom: 8px;
    }

    .btn-sage {
        background-color: #6A8E72;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        padding: 12px;
        border: none;
    }
    .btn-sage:hover {
        background-color: #597a60;
        color: white;
    }

    .btn-outline-sage {
        background-color: transparent;
        border: 2px solid #6A8E72; /* Border hijau tebal */
        color: #000;
        border-radius: 8px;
        font-weight: 700;
        padding: 10px;
        text-decoration: none;
        display: block;
        text-align: center;
    }
    .btn-outline-sage:hover {
        background-color: #f8fcf9;
        color: #000;
    }
</style>

<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    
    <div class="card register-card">
        <h2 class="fw-bold mb-4">Daftar Baru</h2>
        
        <form action="{{ url('/login') }}" method="GET"> 
            {{-- Catatan: Action di atas sementara mengarah ke login (GET) untuk simulasi tombol "Daftarkan". 
                 Nanti diganti ke route POST khusus register jika backend sudah siap. --}}
            @csrf

            <div class="mb-3">
                <label class="form-label">Pos-el</label>
                <input type="email" class="form-control form-control-custom" placeholder="Pengguna@gmail.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Kata Sandi</label>
                <input type="password" class="form-control form-control-custom" placeholder="KataSandi">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control form-control-custom" placeholder="Nama Pengguna">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                {{-- Tipe date agar muncul kalender --}}
                <input type="date" class="form-control form-control-custom" placeholder="dd/mm/yyyy">
            </div>

            <div class="mb-3">
                <label class="form-label">Kota/Kabupaten</label>
                <input type="text" class="form-control form-control-custom" placeholder="Kota Bogor">
            </div>

            <div class="mb-5">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control form-control-custom" placeholder="Jalan Pengguna nomor 1">
            </div>

            <div class="d-grid gap-2 mb-3">
                {{-- Menggunakan button type submit --}}
                <button type="submit" class="btn btn-sage">Daftarkan</button>
            </div>

            <div class="d-grid gap-2">
                <a href="{{ url('/login') }}" class="btn btn-outline-sage">Halaman Masuk</a>
            </div>

        </form>
    </div>
</div>
@endsection