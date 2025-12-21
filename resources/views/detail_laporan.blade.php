@extends('layouts.app')

@section('title', 'Detail Laporan - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Detail Laporan --- */
    body {
        background-color: #FEF9F0;
        min-height: 100vh;
    }

    /* Navbar Custom (Konsisten) */
    .navbar-custom {
        background-color: #FEF9F0;
        padding: 15px 0;
    }
    .nav-link {
        color: #333;
        font-weight: 600;
        margin: 0 10px;
    }
    .nav-link.active-pill {
        background-color: #757575;
        color: white !important;
        border-radius: 20px;
        padding: 5px 25px;
    }

    /* Tombol Kembali */
    .btn-back {
        text-decoration: none;
        color: #333;
        font-weight: 700;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }
    .btn-back:hover { color: #000; }

    /* Layout Kiri (Gambar & Komentar) */
    .main-image-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 15px;
    }
    .main-image {
        width: 100%;
        height: auto;
        display: block;
    }
    
    .interaction-btn {
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 700;
        color: #333;
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 1;
        justify-content: center;
    }
    
    .comment-section {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-top: 20px;
    }
    .comment-item {
        margin-bottom: 20px;
    }
    .comment-user {
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 5px;
    }
    .comment-bubble {
        background-color: #F2E8D5; /* Warna krem komentar */
        padding: 15px;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #444;
    }

    /* Layout Kanan (Info, Peta, Progress) */
    .info-card, .map-card, .progress-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }
    
    .status-badge {
        background-color: #E8D888; /* Warna emas muda status */
        color: #555;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .map-placeholder {
        width: 100%;
        height: 250px;
        background-color: #eee;
        border-radius: 8px;
        object-fit: cover;
    }

    /* Tombol Sage Green */
    .btn-sage {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
    }
    .btn-sage:hover { background-color: #587960; color: white; }

    .btn-route {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 5px 15px;
        border-radius: 6px;
        font-size: 0.9rem;
    }

    /* Progress Empty State */
    .empty-progress {
        text-align: center;
        padding: 30px 10px;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
        <img src="https://placehold.co/40" alt="Logo" width="40" height="40" class="me-2">
        <span class="fw-bold" style="color: #B88A4D;">JagaKota</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navDetail">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navDetail">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/dashboard') }}">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active-pill" href="{{ url('/laporan') }}">Laporan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/laporan/buat') }}">Buat Laporan</a>
        </li>
      </ul>
    </div>
    <div class="d-flex align-items-center">
        <<a href="{{ url('/profile') }}" class="text-dark">>
             <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
        </a>
    </div>
  </div>
</nav>

<div class="container py-4">
    <a href="{{ url('/laporan') }}" class="btn-back">
        <i class="bi bi-x-circle"></i> Kembali
    </a>

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="main-image-card shadow-sm">
                <img src="https://placehold.co/800x500/png?text=Foto+Jalan+Rusak" class="main-image" alt="Bukti Laporan">
            </div>

            <div class="d-flex gap-3 mb-4">
                <div class="interaction-btn shadow-sm">
                    <i class="bi bi-heart"></i> 2.1rb Suka
                </div>
                <div class="interaction-btn shadow-sm">
                    <i class="bi bi-pencil"></i> 540 Komentar
                </div>
            </div>

            <div class="comment-section shadow-sm">
                <h5 class="fw-bold mb-4">Komentar</h5>
                
                <div class="comment-item">
                    <div class="comment-user">
                        <i class="bi bi-person-circle fs-5"></i> AsepSurasep
                    </div>
                    <div class="comment-bubble">
                        Wah gila sih, aku sering lewat sini dan kebetulan juga keluarga aku ikut nyeblos juga disini, emang rawan lah ya mau gimana lagi. Semoga pihak bertanggung jawab udah mulai bergerak.
                    </div>
                </div>

                <div class="comment-item">
                    <div class="comment-user">
                        <i class="bi bi-person-circle fs-5"></i> MahaSigma
                    </div>
                    <div class="comment-bubble">
                        WKWKWKWKWK aku pernah lewat kesini sekali dan malah ada tukang ojek online yang malah jatoh, akhirnya semua yg lewat pada bantuin untungnya.
                    </div>
                </div>

                <div class="comment-item">
                    <div class="comment-user">
                        <i class="bi bi-person-circle fs-5"></i> AkuEmot
                    </div>
                    <div class="comment-bubble">
                        wadidaw banget si kalo lewat sini, harus siapin nekat dan tekad yg kuat. Lengah dikit nanti kesenggol batu der dor.
                    </div>
                </div>
                
                <hr>

                <div class="d-flex flex-column gap-2">
                    <label class="fw-bold small">Tulis Pendapatmu</label>
                    <div class="d-flex gap-2">
                         <input type="text" class="form-control" placeholder="Tulis komentar disini..." style="background-color: #F9F9F9;">
                         <button class="btn btn-sage text-nowrap">Tulis Komentar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            
            <div class="info-card">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="fw-bold mb-0">Jalan Rusak Depan Rumah</h5>
                    <span class="status-badge">
                        <i class="bi bi-clock"></i> Menunggu Verifikasi
                    </span>
                </div>
                <div class="text-muted small mb-3">
                    <i class="bi bi-calendar"></i> Jumat, 19 September 2025 pukul 17:36
                </div>

                <h6 class="fw-bold">Deskripsi Laporan</h6>
                <p class="small text-muted mb-3">
                    Jalan rusak karena hal yang tidak terduga disebabkan oleh makanan yang terhubung di dalam fatamorgana
                </p>

                <h6 class="fw-bold">Lokasi</h6>
                <div class="small text-muted">
                    Alamat: jalan kemana aja<br>
                    Provinsi: Jawa Barat &nbsp; | &nbsp; Kota/Kabupaten: Kabupaten Bandung
                </div>
            </div>

            <div class="map-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-geo-alt"></i> Lokasi di Peta</h6>
                    <button class="btn-route"><i class="bi bi-cursor-fill"></i> Rute</button>
                </div>
                <img src="https://placehold.co/400x300/e0e0e0/888?text=Peta+Lokasi" class="map-placeholder" alt="Map">
            </div>

            <div class="progress-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-clock-history"></i> Progress Laporan</h6>
                    <span class="badge bg-secondary">0 Update</span>
                </div>
                
                <div class="empty-progress">
                    <div class="mb-2">
                        <i class="bi bi-x-square" style="font-size: 2.5rem; color: #333;"></i>
                    </div>
                    <h6 class="fw-bold">Belum ada Progress Baru</h6>
                    <p class="text-muted small">Mohon menunggu dan secara berkala memantau kembali</p>
                </div>
            </div>

        </div>
    </div>
</div>
<div style="height: 50px;"></div>
@endsection