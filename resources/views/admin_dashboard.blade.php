@extends('layouts.app')

@section('title', 'Admin Dashboard - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Admin Page --- */
    body {
        background-color: #FEF9F0;
        overflow-x: hidden;
    }

    /* Layout Wrapper */
    .admin-wrapper {
        display: flex;
        min-height: 100vh;
    }

    /* --- Sidebar --- */
    .admin-sidebar {
        width: 250px;
        background-color: white;
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
        padding: 20px;
        position: fixed; /* Sidebar tetap */
        height: 100vh;
        z-index: 100;
    }

    .sidebar-logo {
        margin-bottom: 40px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        font-size: 1.2rem;
        color: #B88A4D;
    }

    .sidebar-menu {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .menu-link {
        text-decoration: none;
        color: #333;
        font-weight: 700;
        padding: 10px 15px;
        border-radius: 20px; /* Bentuk pill/kapsul */
        transition: all 0.2s;
        font-size: 0.95rem;
    }
    .menu-link:hover {
        background-color: #f0f0f0;
    }
    
    /* Menu Aktif (Warna Abu Gelap) */
    .menu-link.active {
        background-color: #757575; 
        color: white;
    }

    .sidebar-footer {
        margin-top: auto;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }
    .user-profile-link {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #333;
        font-weight: 700;
    }

    /* --- Content Area --- */
    .admin-content {
        margin-left: 250px; /* Memberi ruang untuk sidebar */
        flex-grow: 1;
        padding: 30px;
        /* Background Kota */
        /* background-image: url('/images/background-city.png'); */
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: contain;
    }

    /* Cards */
    .stat-card-small {
        background: white;
        border-radius: 12px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        height: 100%;
    }
    .stat-card-small h2 { font-weight: 800; font-size: 2.5rem; margin-bottom: 0; }
    .stat-card-small span { font-weight: 700; font-size: 0.9rem; color: #333; }

    .graph-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-top: 25px;
        min-height: 250px;
    }

    .bottom-stat-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-top: 25px;
        display: flex;
        justify-content: space-around;
        align-items: center;
        text-align: center;
    }
    .bottom-stat-item h3 { font-weight: 800; font-size: 2rem; margin-bottom: 0; }
    .bottom-stat-item small { font-weight: 600; color: #555; }

    /* Form Elements */
    .form-select-custom {
        background-color: #F2E8D5;
        border: none;
        margin-bottom: 15px;
        padding: 10px;
        border-radius: 8px;
    }
    .btn-sage {
        background-color: #6A8E72;
        color: white;
        font-weight: 600;
        border: none;
        padding: 8px 30px;
        border-radius: 6px;
    }
    .btn-sage:hover { background-color: #587960; color: white; }

    /* Preview List (Kanan) */
    .preview-card {
        background: white;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        margin-bottom: 15px;
        display: flex;
        gap: 10px;
        align-items: center;
    }
    .preview-img {
        width: 80px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
        background-color: #ddd;
    }
    .preview-info { font-size: 0.8rem; }
    
    .scrollable-list {
        /* Opsional: jika ingin list bisa di-scroll terpisah */
        /* max-height: 600px; overflow-y: auto; */
    }

</style>

<div class="admin-wrapper">
    
    <div class="admin-sidebar">
        <div class="sidebar-logo">
           <img src="{{ asset('image/JagaKotaa.png') }}" alt="Logo">
            JagaKota
        </div>

        <nav class="sidebar-menu">
            <a href="#" class="menu-link active">Beranda</a>
            <a href="{{ url('/admin/laporan') }}" class="menu-link">Laporan</a>
            <a href="{{ url('/admin/progress') }}" class="menu-link">Progress</a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ url('/profile') }}" class="user-profile-link">
                <i class="bi bi-person-circle fs-4"></i>
                Pengguna
            </a>
        </div>
    </div>

    <div class="admin-content">
        <div class="row">
            
            <div class="col-lg-8">
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="stat-card-small">
                            <span>Laporan Hari ini</span>
                            <h2>102</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card-small">
                            <span>Total antrian</span>
                            <h2>59</h2>
                        </div>
                    </div>
                </div>

                <div class="graph-card">
                    <h5 class="fw-bold mb-4">Grafik Daerah</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <select class="form-select form-select-custom">
                                <option>Provinsi</option>
                            </select>
                            <select class="form-select form-select-custom">
                                <option>Kabupaten/Kota</option>
                            </select>
                            <div class="text-center mt-3">
                                <button class="btn btn-sage">Cari</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bottom-stat-card">
                    <div class="w-100 text-center position-relative">
                        <h6 class="fw-bold mb-3 position-absolute start-0 top-0">Statistik laporan</h6>
                        <div class="row mt-5">
                            <div class="col-4 bottom-stat-item">
                                <h3>1,2rb</h3>
                                <small>Diterima</small>
                            </div>
                            <div class="col-4 bottom-stat-item">
                                <h3>150</h3>
                                <small>Diproses</small>
                            </div>
                            <div class="col-4 bottom-stat-item">
                                <h3>121</h3>
                                <small>Selesai</small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                <h5 class="fw-bold mb-3 mt-3 mt-lg-0">Pratinjau</h5>
                
                <div class="scrollable-list">
                    <div class="preview-card">
                        <img src="{{ asset('image/jalanrusak.png') }}" class="preview-img">
                        <div class="preview-info">
                            <div class="fw-bold"><i class="bi bi-heart"></i> 1,2rb &nbsp; <i class="bi bi-paperclip"></i> 50</div>
                            <div class="text-muted mt-1">Kota Bogor.</div>
                        </div>
                    </div>
                    <div class="preview-card">
                         <img src="{{ asset('image/trotoarRusak.jpg') }}" class="preview-img">
                        <div class="preview-info">
                            <div class="fw-bold"><i class="bi bi-heart"></i> 204 &nbsp; <i class="bi bi-paperclip"></i> 5</div>
                            <div class="text-muted mt-1">Kota Bogor.</div>
                        </div>
                    </div>
                    <div class="preview-card">
                       <img src="{{ asset('image/plangRusak.jpg') }}" class="preview-img">
                        <div class="preview-info">
                            <div class="fw-bold"><i class="bi bi-heart"></i> 5,1rb &nbsp; <i class="bi bi-paperclip"></i> 34</div>
                            <div class="text-muted mt-1">Kota Probolinggo.</div>
                        </div>
                    </div>
                    <div class="preview-card">
                        <img src="{{ asset('image/tamanrusak.jpg') }}" class="preview-img">
                        <div class="preview-info">
                            <div class="fw-bold"><i class="bi bi-heart"></i> 830 &nbsp; <i class="bi bi-paperclip"></i> 21</div>
                            <div class="text-muted mt-1">Kota Bandung.</div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-end">
                    <button class="btn btn-sage w-100">Selengkapnya</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection