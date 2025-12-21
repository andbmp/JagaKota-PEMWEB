@extends('layouts.app')

@section('title', 'Buat Laporan - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Halaman Buat Laporan --- */
    body {
        background-color: #FEF9F0;
        min-height: 100vh;
    }

    /* Navbar Custom */
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
        background-color: #757575; /* Abu-abu gelap (Tombol Aktif) */
        color: white !important;
        border-radius: 20px;
        padding: 5px 25px;
    }

    /* Container Card Putih Utama */
    .form-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-top: 20px;
        margin-bottom: 50px;
    }

    /* Custom Input Style (Warna Krem) */
    .form-label {
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 1rem;
    }
    .form-control-custom {
        background-color: #F2E8D5; /* Warna krem input */
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        color: #333;
    }
    .form-control-custom:focus {
        background-color: #F2E8D5;
        box-shadow: 0 0 0 2px rgba(106, 142, 114, 0.5); /* Shadow hijau saat aktif */
        outline: none;
    }

    /* Input File Custom */
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }
    .file-input-wrapper input[type=file] {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
    }
    .file-input-btn {
        background-color: #F2E8D5;
        color: #555;
        display: flex;
        align-items: center;
        border-radius: 8px;
        overflow: hidden;
    }
    .file-btn-label {
        background-color: #F2E8D5; /* Warna agak gelap dikit buat tombol pilih */
        padding: 12px 20px;
        font-weight: 600;
        border-right: 1px solid #ddd;
    }
    .file-btn-text {
        padding: 12px 20px;
        color: #888;
        font-style: italic;
    }

    /* Tombol */
    .btn-sage {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 12px 0;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
    }
    .btn-sage:hover { background-color: #587960; color: white; }

    .btn-gray-reset {
        background-color: #B0B0B0; /* Abu-abu tombol reset */
        color: white;
        border: none;
        padding: 12px 0;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
    }
    .btn-gray-reset:hover { background-color: #999; color: white; }

    .btn-gold-location {
        background-color: #D6B656;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
    }
    .btn-gold-location:hover { background-color: #c4a548; color: white; }

    /* Map Section */
    .map-container {
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #D6B656; /* Border emas tipis sesuai gambar */
        height: 300px;
        background-color: #eee;
        position: relative;
    }
    .map-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

</style>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/dashboard') }}">
        <img src="https://placehold.co/40" alt="Logo" width="40" height="40" class="me-2">
        <span class="fw-bold" style="color: #B88A4D;">JagaKota</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navBuat">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navBuat">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/dashboard') }}">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/laporan') }}">Laporan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active-pill" href="{{ url('/laporan/buat') }}">Buat Laporan</a>
        </li>
      </ul>
    </div>
    <div class="d-flex align-items-center">
        <a href="#" class="text-dark">
             <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </svg>
        </a>
    </div>
  </div>
</nav>

<div class="container">
    <h2 class="fw-bold mt-4 mb-2">Tulis, Unggah, Perubahan.</h2>
    
    <div class="form-card">
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-lg-7 pe-lg-5">
                    
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control form-control-custom" placeholder="">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Kerusakan</label>
                        <textarea class="form-control form-control-custom" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control form-control-custom" placeholder="">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <label class="form-label">Provinsi</label>
                            <input type="text" class="form-control form-control-custom">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kabupaten/Kota</label>
                            <input type="text" class="form-control form-control-custom">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <label class="form-label">longitude</label>
                            <input type="text" class="form-control form-control-custom">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">latitude</label>
                            <input type="text" class="form-control form-control-custom">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Foto</label>
                        <div class="file-input-wrapper">
                            <div class="file-input-btn">
                                <span class="file-btn-label">pilih file</span>
                                <span class="file-btn-text">Tidak ada file dipilih</span>
                            </div>
                            <input type="file" name="foto_laporan">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <button type="submit" class="btn btn-sage">Laporkan</button>
                        </div>
                        <div class="col-md-6">
                            <button type="reset" class="btn btn-gray-reset">Reset</button>
                        </div>
                    </div>

                </div>

                <div class="col-lg-5 mt-4 mt-lg-0">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold mb-0">Pilih lokasi di Peta</h5>
                        <button type="button" class="btn btn-gold-location">Lokasi saya</button>
                    </div>

                    <div class="map-container mb-3">
                        <img src="https://placehold.co/600x400/e0e0e0/888?text=Peta+Jakarta+Monas" class="map-img" alt="Map Selection">
                    </div>

                    <div class="input-group">
                        <input type="text" class="form-control form-control-custom" placeholder="Cari Lokasi">
                        <button class="btn btn-outline-secondary bg-white border-start-0 border-top-0 border-bottom-0" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection