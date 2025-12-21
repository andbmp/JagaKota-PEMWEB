@extends('layouts.app')

@section('title', 'Riwayat Laporan - JagaKota')

@section('content')
<style>
    /* --- Styles (Menggunakan style yang sama dengan Profil) --- */
    body {
        background-color: #FEF9F0;
        min-height: 100vh;
    }

    /* Navbar Custom */
    .navbar-custom {
        background-color: #FEF9F0;
        padding: 15px 0;
        border-bottom: 1px solid #e0d0b0;
    }
    .nav-link { color: #333; font-weight: 600; margin: 0 10px; }
    
    /* Sidebar */
    .sidebar-card {
        background-color: #A9C4A8; 
        border-radius: 12px;
        overflow: hidden;
        padding: 20px;
        color: white;
        height: 100%;
        min-height: 300px;
    }
    
    .sidebar-menu-item {
        display: block;
        padding: 10px 15px;
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 5px;
        font-size: 1.1rem;
        border-radius: 8px;
    }
    .sidebar-menu-item:hover { color: #eee; }

    /* Logic Menu Aktif/Tidak Aktif */
    .sidebar-menu-item.active {
        background-color: #55755E; /* Hijau Gelap untuk menu aktif */
        color: white;
    }
    .sidebar-menu-item.inactive {
        color: #333; /* Teks gelap untuk menu tidak aktif */
    }

    /* --- Content Area (Empty State) --- */
    .empty-state-card {
        background: white;
        border-radius: 12px;
        padding: 60px 20px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .icon-box {
        font-size: 4rem;
        color: #333;
        margin-bottom: 20px;
    }

    .btn-sage {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
    }
    .btn-sage:hover { background-color: #587960; color: white; }

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
    <div class="row" style="min-height: 500px;"> <div class="col-md-3 mb-4">
            <div class="sidebar-card">
                <a href="{{ url('/profile') }}" class="sidebar-menu-item inactive">
                    Profil Diri
                </a>
                
                <a href="#" class="sidebar-menu-item active">
                    Riwayat Laporan
                </a>
                
                <a href="{{ url('/leaderboard') }}" class="sidebar-menu-item inactive">
                    Papan Peringkat
                </a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="empty-state-card">
                <div class="icon-box">
                    <i class="bi bi-x-square"></i>
                </div>
                
                <h4 class="fw-bold mb-3">Tidak ada riwayat laporan</h4>
                
                <p class="text-muted mb-4" style="max-width: 500px;">
                    Mulai buat laporan untuk mengisi riwayat dan kumpulkan poin untuk meningkatkan peringkat
                </p>
                
                <a href="{{ url('/laporan/buat') }}" class="btn btn-sage">
                    Buat Laporan
                </a>
            </div>
        </div>

    </div>
</div>
@endsection