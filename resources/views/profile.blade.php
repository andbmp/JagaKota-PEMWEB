@extends('layouts.app')

@section('title', 'Profil Diri - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Halaman Profil --- */
    body {
        background-color: #FEF9F0;
        min-height: 100vh;
    }

    /* Navbar Custom */
    .navbar-custom {
        background-color: #FEF9F0;
        padding: 15px 0;
        border-bottom: 1px solid #e0d0b0; /* Sedikit border biar rapi */
    }
    .nav-link {
        color: #333;
        font-weight: 600;
        margin: 0 10px;
    }
    
    /* --- Sidebar Menu --- */
    .sidebar-card {
        background-color: #A9C4A8; /* Warna hijau sage muda background sidebar */
        border-radius: 12px;
        overflow: hidden;
        /* Jika ingin persis kotak hijau gelap di gambar: */
        background-color: #6A8E72; 
        padding: 20px;
        color: white;
        height: 100%;
        min-height: 300px;
    }
    
    .sidebar-menu-item {
        display: block;
        padding: 10px 15px;
        color: #333; /* Warna teks menu tidak aktif */
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 5px;
        font-size: 1.1rem;
    }
    .sidebar-menu-item:hover {
        color: #ddd;
    }

    /* Menu Aktif (Profil Diri) - Dibuat kotak gelap */
    .sidebar-menu-item.active {
        background-color: #55755E; /* Hijau lebih gelap */
        color: white;
        border-radius: 8px;
    }
    /* Menu Lainnya (Teks hitam/gelap di desain, tapi karena bg hijau gelap, kita sesuaikan jadi putih/terang agar terbaca) */
    .sidebar-menu-item.inactive {
        color: black; 
    }

    /* --- Profile Main Card --- */
    .profile-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    /* Foto Profil Placeholder */
    .profile-pic-box {
        width: 150px;
        height: 150px;
        background-color: #E8D8B0; /* Warna krem gelap placeholder */
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
        border: 2px solid #333;
    }
    .profile-icon {
        font-size: 5rem;
        color: #333;
    }

    /* Input Fields (Read Only style) */
    .form-control-custom {
        background-color: #F2E8D5;
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        color: #333;
        margin-bottom: 15px;
    }
    
    .desc-box {
        background-color: #F2E8D5;
        border-radius: 8px;
        padding: 15px;
        height: 100%;
        position: relative;
    }
    .edit-icon {
        position: absolute;
        bottom: 15px;
        right: 15px;
        color: #555;
        cursor: pointer;
    }

    /* Tombol Aksi */
    .btn-edit-profile {
        background-color: #D6B656; /* Emas/Krem tua */
        color: #000;
        font-weight: 700;
        border: none;
        width: 100%;
        padding: 8px;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .btn-logout {
        background-color: #FF9F9F; /* Merah muda / Salmon */
        color: #000;
        font-weight: 700;
        border: none;
        width: 100%;
        padding: 8px;
        border-radius: 8px;
    }

    /* --- Stats Cards --- */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #000;
        line-height: 1;
        margin-bottom: 5px;
    }
    .stat-label {
        font-size: 0.9rem;
        color: #333;
        font-weight: 500;
    }

</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
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

<div class="container py-5">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="sidebar-card">
                <a href="#" class="sidebar-menu-item active">
                    Profil Diri
                </a>
                
                <a href="{{ url('/profile/riwayat') }}" class="sidebar-menu-item inactive">
                     Riwayat Laporan
                </a>
                
               <a href="{{ url('/leaderboard') }}" class="sidebar-menu-item inactive">
                     Papan Peringkat
                </a>
            </div>
        </div>

        <div class="col-md-9">
            
            <div class="profile-card">
                <div class="row">
                    <div class="col-md-3 d-flex flex-column align-items-center">
                        <div class="profile-pic-box">
                            <i class="bi bi-person profile-icon"></i>
                        </div>
                       <a href="{{ url('/profile/edit') }}" class="btn btn-edit-profile text-center text-decoration-none">Ubah Profil</a>
                        <button class="btn btn-logout">Keluar Akun</button>
                    </div>

                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-custom" value="Nama Pengguna" readonly>
                        <input type="email" class="form-control form-control-custom" value="Pengguna@gmail.com" readonly>
                        <input type="text" class="form-control form-control-custom" value="Dibuat 12/02/2024" readonly>
                    </div>

                    <div class="col-md-5">
                        <div class="desc-box">
                            <span class="text-muted small">Deskripsi diri</span>
                            <br><br>
                            <i class="bi bi-pencil-fill edit-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">#2</div>
                        <div class="stat-label">Papan Peringkat</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Poin Jaga</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">12</div>
                        <div class="stat-label">Laporan Diunggah</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-number">5</div>
                        <div class="stat-label">Notifikasi Masuk</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div style="height: 100px;"></div>
@endsection