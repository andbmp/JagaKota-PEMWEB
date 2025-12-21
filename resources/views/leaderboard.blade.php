@extends('layouts.app')

@section('title', 'Papan Peringkat - JagaKota')

@section('content')
<style>
    /* --- Global Styles --- */
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

    /* Sidebar (Sama dengan Profile & Riwayat) */
    .sidebar-card {
        background-color: #A9C4A8; 
        border-radius: 12px;
        overflow: hidden;
        padding: 20px;
        color: white;
        height: 100%; /* Agar full height mengikuti konten kanan */
        min-height: 500px;
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

    .sidebar-menu-item.active {
        background-color: #55755E; /* Hijau Gelap */
        color: white;
    }
    .sidebar-menu-item.inactive {
        color: #333; 
    }

    /* --- Leaderboard List Styling --- */
    .leaderboard-container {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .rank-item {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        border-radius: 8px; /* Border radius kecil untuk item list */
        background: white; /* Default background */
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .rank-item:hover {
        transform: scale(1.01);
    }

    /* Warna Background Khusus Top 3 (Krem Emas Muda) */
    .rank-top-3 {
        background-color: #E6D5AC; 
    }

    /* Warna Background Khusus User Login (Emas Gelap/Coklat Muda) */
    .rank-current-user {
        background-color: #D6B656 !important; 
        color: white; /* Teks jadi putih agar kontras */
        transform: scale(1.02); /* Sedikit lebih besar */
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        border: 2px solid #b89c45;
        z-index: 2;
    }

    /* Elemen dalam Item */
    .rank-number {
        font-weight: 800;
        font-size: 1.2rem;
        width: 40px;
    }
    .rank-avatar {
        font-size: 2rem;
        margin-right: 15px;
        display: flex;
        align-items: center;
    }
    .rank-name {
        font-weight: 700;
        flex-grow: 1; /* Mengisi ruang kosong */
        font-size: 1.1rem;
    }
    .rank-points {
        background-color: #C4A661; /* Warna badge poin default */
        color: white;
        padding: 5px 15px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.9rem;
    }
    
    /* Ubah warna badge poin jika background item gelap */
    .rank-current-user .rank-points {
        background-color: rgba(255,255,255,0.3); /* Transparan putih */
        color: white;
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
                <a href="{{ url('/profile') }}" class="sidebar-menu-item inactive">
                    Profil Diri
                </a>
                <a href="{{ url('/profile/riwayat') }}" class="sidebar-menu-item inactive">
                    Riwayat Laporan
                </a>
                <a href="{{ url('/leaderboard') }}" class="sidebar-menu-item active">
                    Papan Peringkat
                </a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="leaderboard-container">
                
                {{-- Simulasi Data User dalam Array PHP (Nanti diganti data Database) --}}
                @php
                    $users = [
                        ['name' => 'NasiUdukLover', 'points' => 132],
                        ['name' => 'KopiSenjaID', 'points' => 98],
                        ['name' => 'JalanJalanSantuy', 'points' => 85],
                        ['name' => 'SateMadura99', 'points' => 65],
                        ['name' => 'WartegWarrior', 'points' => 55],
                        ['name' => 'CemilanRakyat_', 'points' => 54], // Ceritanya ini User Login
                        ['name' => 'AngkringanMalam', 'points' => 47],
                        ['name' => 'BatikHunter_', 'points' => 45],
                        ['name' => 'GorenganKriuk', 'points' => 39],
                        ['name' => 'SiPalingNusantara', 'points' => 33],
                    ];
                @endphp

                @foreach($users as $index => $user)
                    @php
                        $rank = $index + 1;
                        $isTop3 = $rank <= 3;
                        $isCurrentUser = $rank == 6; // Anggap user login ada di peringkat 6
                        
                        // Menentukan class CSS berdasarkan kondisi
                        $rowClass = 'rank-item';
                        if ($isCurrentUser) {
                            $rowClass .= ' rank-current-user';
                        } elseif ($isTop3) {
                            $rowClass .= ' rank-top-3';
                        }
                    @endphp

                    <div class="{{ $rowClass }}">
                        <div class="rank-number">#{{ $rank }}</div>
                        
                        <div class="rank-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        
                        <div class="rank-name">
                            {{ $user['name'] }}
                        </div>
                        
                        <div class="rank-points">
                            {{ $user['points'] }} Poin
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
<div style="height: 100px;"></div>
@endsection