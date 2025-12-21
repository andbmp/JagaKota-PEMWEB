@extends('layouts.app')

@section('title', 'Ubah Profil - JagaKota')

@section('content')
<style>
    body {
        background-color: #FEF9F0;
        min-height: 100vh;
    }

    /* Navbar Custom (Tetap ditampilkan agar konsisten) */
    .navbar-custom {
        background-color: #FEF9F0;
        padding: 15px 0;
    }
    .nav-link { color: #333; font-weight: 600; margin: 0 10px; }

    /* Card Container */
    .edit-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        max-width: 500px; /* Lebar dibatasi agar rapi di tengah */
        width: 100%;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin: 0 auto; /* Tengah secara horizontal */
    }

    /* Header */
    .page-title { font-weight: 800; font-size: 1.5rem; margin-bottom: 0; }
    .page-subtitle { color: #888; font-size: 0.9rem; margin-bottom: 20px; }
    .divider { height: 2px; background-color: #F0E6D2; margin-bottom: 20px; width: 100%; }

    /* Upload Foto Section */
    .profile-upload-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px;
    }
    .upload-icon-box {
        width: 80px;
        height: 80px;
        border: 2px solid #D6B656; /* Warna emas outline */
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #D6B656;
        font-size: 2rem;
        margin-bottom: 10px;
        background-color: white;
    }
    .btn-upload-gold {
        background-color: #D6B656;
        color: white;
        border: none;
        padding: 5px 20px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .btn-upload-gold:hover { background-color: #c4a548; }

    /* Form Fields */
    .form-label { font-weight: 700; margin-bottom: 5px; color: #000; }
    .form-control-custom {
        background-color: #F2E8D5;
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        color: #555;
    }
    .form-control-custom:focus {
        background-color: #F2E8D5;
        box-shadow: 0 0 0 2px rgba(106, 142, 114, 0.5);
        outline: none;
    }

    /* Action Buttons */
    .btn-sage {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 700;
        width: 100%;
        margin-bottom: 10px;
    }
    .btn-sage:hover { background-color: #587960; color: white; }

    .btn-outline-dark-custom {
        background-color: white;
        border: 2px solid #6A8E72; /* Border hijau sage */
        color: #000;
        padding: 10px;
        border-radius: 8px;
        font-weight: 700;
        width: 100%;
        display: block;
        text-align: center;
        text-decoration: none;
    }
    .btn-outline-dark-custom:hover {
        background-color: #f8fcf9;
        color: #000;
    }

</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
        <img src="https://placehold.co/40" alt="Logo" width="40" height="40" class="me-2">
        <span class="fw-bold" style="color: #B88A4D;">JagaKota</span>
    </a>
    <div class="collapse navbar-collapse justify-content-center">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ url('/dashboard') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/laporan') }}">Laporan</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/laporan/buat') }}">Buat Laporan</a></li>
      </ul>
    </div>
    <div class="d-flex align-items-center">
        <a href="{{ url('/profile') }}" class="text-dark">
             <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
        </a>
    </div>
  </div>
</nav>

<div class="container pb-5">
    <div class="edit-card">
        <h2 class="page-title">Ubah Profil</h2>
        <p class="page-subtitle">Perbaharui informasi profilmu</p>
        
        <div class="divider"></div>

        <form action="{{ url('/profile') }}" method="GET"> 
            {{-- Action mengarah ke profile (GET) hanya untuk simulasi tombol "Simpan" agar kembali ke profil --}}
            
            <div class="mb-4">
                <label class="form-label">Ganti Profil</label>
                <div class="profile-upload-area">
                    <div class="upload-icon-box">
                        <i class="bi bi-image"></i>
                        <span style="position: absolute; font-size: 1rem; margin-left: 20px; margin-top: -20px;">+</span>
                    </div>
                    <button type="button" class="btn btn-upload-gold">Unggah</button>
                    <input type="file" style="display: none;"> 
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control form-control-custom" placeholder="Nama Baru">
            </div>

            <div class="mb-3">
                <label class="form-label">Pos-el</label>
                <input type="email" class="form-control form-control-custom" placeholder="Namabaru@gmail.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Kata Sandi</label>
                <input type="password" class="form-control form-control-custom" placeholder="SandiBaru">
            </div>

            <div class="mb-5">
                <label class="form-label">Deskripsi Diri</label>
                <input type="text" class="form-control form-control-custom" placeholder="Deskripsi Baru">
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-sage">Simpan Data Baru</button>
                <a href="{{ url('/profile') }}" class="btn btn-outline-dark-custom">Batalkan Perubahan</a>
            </div>
        </form>
    </div>
</div>
@endsection