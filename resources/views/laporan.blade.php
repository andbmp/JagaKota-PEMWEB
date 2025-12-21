@extends('layouts.app')

@section('title', 'Daftar Laporan - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Halaman Laporan --- */
    body {
        background-color: #FEF9F0;
        /* Gambar garis kota di bagian bawah halaman */
        background-image: url('public/image/reportcarrousel-background.svg');
        background-position: bottom;
        background-repeat: repeat-x;
        background-size: contain; 
        min-height: 100vh;
    }

    /* Navbar Custom (Sama dengan Dashboard) */
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
        background-color: #757575; /* Abu-abu gelap sesuai desain untuk menu aktif */
        color: white !important;
        border-radius: 20px;
        padding: 5px 25px;
    }

    /* Filter Section (Card Atas) */
    .filter-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }
    .form-select-custom {
        background-color: #F2E8D5; /* Warna krem input */
        border: none;
        padding: 12px;
        border-radius: 8px;
        color: #555;
    }

    /* Tombol-tombol */
    .btn-sage {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
    }
    .btn-sage:hover { background-color: #587960; color: white; }

    .btn-gray {
        background-color: #D9D9D9;
        color: #333;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
    }
    .btn-gray:hover { background-color: #c0c0c0; }

    .btn-gold {
        background-color: #D6B656; /* Warna emas/kuning tombol detail */
        color: white;
        border: none;
        width: 100%;
        padding: 8px;
        border-radius: 8px;
        font-weight: 600;
    }
    .btn-gold:hover { background-color: #c4a548; color: white; }

    /* Card Laporan */
    .report-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #eee;
        transition: transform 0.2s;
        height: 100%;
    }
    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .report-img-wrapper {
        position: relative;
        height: 180px;
        background-color: #ddd;
    }
    .report-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    /* Badge Status */
    .badge-status {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        color: #333;
    }
    .status-diterima { background-color: #A3D9A5; } /* Hijau Muda */
    .status-diproses { background-color: #FCEEB5; } /* Kuning Muda */
    .status-ditolak { background-color: #FFB3B3; }  /* Merah Muda */

    .report-body {
        padding: 15px;
    }
    .report-title {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .report-meta {
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 15px;
    }

    /* Pagination Bar Bawah */
    .pagination-bar {
        background: white;
        border-radius: 12px;
        padding: 15px 25px;
        border: 1px solid #eee;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
        <img src="https://placehold.co/40" alt="Logo" width="40" height="40" class="me-2">
        <span class="fw-bold" style="color: #B88A4D;">JagaKota</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLaporan">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navLaporan">
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

    <div class="filter-card mb-4">
        <h5 class="fw-bold">Cari laporan</h5>
        <p class="text-muted small mb-3">Cari laporan berdasarkan provinsi dan kabupaten/kota</p>
        
        <form action="">
            <div class="row g-3">
                <div class="col-md-6">
                    <select class="form-select form-select-custom">
                        <option selected>Provinsi</option>
                        <option value="1">Jawa Barat</option>
                        <option value="2">DKI Jakarta</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select form-select-custom">
                        <option selected>Kabupaten/Kota</option>
                        <option value="1">Bogor</option>
                        <option value="2">Bandung</option>
                    </select>
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="button" class="btn btn-sage me-2">Terapkan</button>
                <button type="button" class="btn btn-gray">Atur Ulang</button>
            </div>
        </form>
    </div>

    <div class="row mb-4 align-items-center">
        <div class="col-md-2 mb-2 mb-md-0">
            <select class="form-select bg-white border">
                <option selected>Status</option>
                <option value="diterima">Diterima</option>
                <option value="diproses">Diproses</option>
                <option value="ditolak">Ditolak</option>
            </select>
        </div>
        <div class="col-md-10">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari judul, deskripsi, atau lokasi">
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        
        <div class="col-md-3">
            <div class="report-card">
                <div class="report-img-wrapper">
                    <img src="https://placehold.co/300x200/png?text=Jalan+Rusak" class="report-img" alt="Laporan">
                    <span class="badge-status status-diterima">Diterima</span>
                </div>
                <div class="report-body">
                    <h6 class="report-title">Jalan rusak di Jalan Ciganitri</h6>
                    <div class="text-muted small mb-2">
                        <i class="bi bi-geo-alt-fill"></i> Kota Bogor
                    </div>
                    <div class="d-flex justify-content-between align-items-center report-meta">
                        <span>@BudiSiregar</span>
                        <span>24/01/2025</span>
                    </div>
                    <a href="{{ url('/laporan/detail') }}" class="btn btn-gold">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="report-card">
                <div class="report-img-wrapper">
                    <img src="https://placehold.co/300x200/png?text=Plang+Jatoh" class="report-img" alt="Laporan">
                    <span class="badge-status status-diproses">Diproses</span>
                </div>
                <div class="report-body">
                    <h6 class="report-title">Plang Jatoh</h6>
                    <div class="text-muted small mb-2">
                        <i class="bi bi-geo-alt-fill"></i> Kota Bogor
                    </div>
                    <div class="d-flex justify-content-between align-items-center report-meta">
                        <span>@BudiSiregar</span>
                        <span>20/01/2025</span>
                    </div>
                    <a href="#" class="btn btn-gold">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="report-card">
                <div class="report-img-wrapper">
                    <img src="https://placehold.co/300x200/png?text=Kursi+Roboh" class="report-img" alt="Laporan">
                    <span class="badge-status status-diterima">Diterima</span>
                </div>
                <div class="report-body">
                    <h6 class="report-title">Kursi publik roboh sebelah</h6>
                    <div class="text-muted small mb-2">
                        <i class="bi bi-geo-alt-fill"></i> Kota Bogor
                    </div>
                    <div class="d-flex justify-content-between align-items-center report-meta">
                        <span>@BudiSiregar</span>
                        <span>29/12/2024</span>
                    </div>
                    <a href="#" class="btn btn-gold">Lihat Detail</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="report-card">
                <div class="report-img-wrapper">
                    <img src="https://placehold.co/300x200/png?text=Papan+Taman" class="report-img" alt="Laporan">
                    <span class="badge-status status-ditolak">Ditolak</span>
                </div>
                <div class="report-body">
                    <h6 class="report-title">Papan taman dirusak</h6>
                    <div class="text-muted small mb-2">
                        <i class="bi bi-geo-alt-fill"></i> Kota Bogor
                    </div>
                    <div class="d-flex justify-content-between align-items-center report-meta">
                        <span>@BudiSiregar</span>
                        <span>19/11/2024</span>
                    </div>
                    <a href="#" class="btn btn-gold">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>

    <div class="pagination-bar d-flex justify-content-between align-items-center shadow-sm">
        <div class="fw-bold small">
            Halaman 1 dari 1 &bull; Total 4 Laporan
        </div>
        <div>
            <button class="btn btn-light border me-1" disabled>Prev</button>
            <button class="btn btn-dark">Next</button>
        </div>
    </div>
    
</div>
<div style="height: 100px;"></div>
@endsection