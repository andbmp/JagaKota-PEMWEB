@extends('layouts.app')

@section('title', 'Admin Progress - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Admin Page (Konsisten) --- */
    body {
        background-color: #FEF9F0;
        overflow-x: hidden;
    }

    .admin-wrapper {
        display: flex;
        height: 100vh;
        overflow: hidden;
    }

    /* --- Sidebar --- */
    .admin-sidebar {
        width: 250px;
        background-color: white;
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
        padding: 20px;
        flex-shrink: 0;
        z-index: 10;
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
        border-radius: 20px;
        transition: all 0.2s;
        font-size: 0.95rem;
    }
    .menu-link:hover { background-color: #f0f0f0; }
    
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
        flex-grow: 1;
        padding: 30px;
        overflow-y: auto;
    }

    /* --- DETAIL PROGRESS CARD (Tengah) --- */
    .progress-detail-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        height: 100%;
        overflow-y: auto;
    }

    .report-header-row {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }
    .report-main-img {
        width: 55%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px;
        background-color: #ddd;
    }
    .report-info-col {
        flex: 1;
    }
    .info-label { font-weight: 700; font-size: 0.9rem; margin-bottom: 5px; }
    .user-info { display: flex; align-items: center; gap: 8px; font-weight: 600; margin-bottom: 10px; }
    .stats-row { display: flex; gap: 15px; margin-bottom: 15px; color: #555; font-size: 0.9rem; font-weight: 600; }
    
    .location-box {
        background-color: #F2E8D5;
        padding: 10px;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-bottom: 10px;
    }

    /* Form Elements */
    .form-label-custom { font-weight: 700; font-size: 0.95rem; margin-bottom: 8px; display: block; }
    
    .textarea-custom {
        background-color: #F2E8D5;
        border: none;
        border-radius: 8px;
        width: 100%;
        padding: 15px;
        min-height: 150px;
        resize: none;
        margin-bottom: 20px;
    }
    .textarea-custom:focus { outline: 2px solid #6A8E72; }

    .file-input-custom {
        background-color: #F2E8D5;
        padding: 10px;
        border-radius: 8px;
        width: 100%;
        margin-bottom: 25px;
    }

    .footer-action {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }
    .btn-finish {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 10px 30px;
        border-radius: 8px;
        font-weight: 700;
    }
    .btn-finish:hover { background-color: #587960; }

    /* --- RIGHT LIST (Dengan Indikator Warna) --- */
    .queue-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding-right: 5px;
    }

    .queue-item {
        background: white;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        display: flex;
        gap: 10px;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    /* Indikator Warna di Kanan */
    .status-indicator {
        position: absolute;
        right: 0;
        top: 0;
        bottom: 0;
        width: 15px;
    }
    .status-green { background-color: #A3D9A5; } /* Hijau Muda */
    .status-yellow { background-color: #FFF59D; } /* Kuning Muda */

    .queue-img {
        width: 80px;
        height: 60px;
        border-radius: 6px;
        object-fit: cover;
        background-color: #ddd;
    }
    .queue-content {
        flex-grow: 1;
        padding-right: 20px; /* Space agar tidak ketutup indikator */
    }
    .queue-stats { font-weight: 700; font-size: 0.85rem; margin-bottom: 2px; }
    .queue-loc { font-size: 0.8rem; color: #555; }

    /* Custom Scrollbar */
    .admin-content::-webkit-scrollbar { width: 8px; }
    .admin-content::-webkit-scrollbar-thumb { background-color: #ccc; border-radius: 4px; }
</style>

<div class="admin-wrapper">
    
    <div class="admin-sidebar">
        <div class="sidebar-logo">
            <img src="https://placehold.co/30" alt="Logo">
            JagaKota
        </div>

        <nav class="sidebar-menu">
            <a href="{{ url('/admin/dashboard') }}" class="menu-link">Beranda</a>
            <a href="{{ url('/admin/laporan') }}" class="menu-link">Laporan</a>
            <a href="#" class="menu-link active">Progress</a>
        </nav>

        <div class="sidebar-footer">
            <a href="{{ url('/profile') }}" class="user-profile-link">
                <i class="bi bi-person-circle fs-4"></i>
                Pengguna
            </a>
        </div>
    </div>

    <div class="admin-content">
        <div class="row h-100">
            
            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="progress-detail-card">
                    
                    <div class="report-header-row">
                        <img src="https://placehold.co/600x400/png?text=Jalan+Berlubang" class="report-main-img">
                        
                        <div class="report-info-col">
                            <h6 class="fw-bold mb-3">Deskripsi Laporan:</h6>
                            
                            <div class="user-info">
                                <i class="bi bi-person-circle"></i> NamaPengguna
                            </div>
                            
                            <div class="stats-row">
                                <span><i class="bi bi-heart"></i> 1.2rb</span>
                                <span><i class="bi bi-paperclip"></i> 500</span>
                            </div>

                            <div class="mb-2 fw-bold small">Lokasi:</div>
                            <div class="location-box">
                                Jl. Cagak, Kabupaten Aceh Barat
                            </div>
                            
                            <div class="text-end fw-bold small text-muted mt-2">
                                24/01/2025
                            </div>
                        </div>
                    </div>

                    <label class="form-label-custom">Catatan Progress :</label>
                    <textarea class="textarea-custom" placeholder="Tulis catatan pengerjaan disini..."></textarea>

                    <label class="form-label-custom">Upload gambar:</label>
                    <input type="file" class="form-control file-input-custom">

                    <div class="footer-action">
                        <span class="small fw-bold text-muted">modifikasi terakhir: 27/04/2025</span>
                        <button class="btn btn-finish">Selesaikan</button>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="queue-list">
                    
                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Jalan" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-stats"><i class="bi bi-heart"></i> 1,2rb &nbsp; <i class="bi bi-paperclip"></i> 50</div>
                            <div class="queue-loc">Kota Bogor.</div>
                        </div>
                        <div class="status-indicator status-green"></div>
                    </div>

                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Plang" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-stats"><i class="bi bi-heart"></i> 204 &nbsp; <i class="bi bi-paperclip"></i> 5</div>
                            <div class="queue-loc">Kota Bogor.</div>
                        </div>
                        <div class="status-indicator status-yellow"></div>
                    </div>

                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Kursi" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-stats"><i class="bi bi-heart"></i> 5,1rb &nbsp; <i class="bi bi-paperclip"></i> 34</div>
                            <div class="queue-loc">Kota Bogor.</div>
                        </div>
                        <div class="status-indicator status-green"></div>
                    </div>

                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Taman" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-stats"><i class="bi bi-heart"></i> 830 &nbsp; <i class="bi bi-paperclip"></i> 21</div>
                            <div class="queue-loc">Kota Bogor.</div>
                        </div>
                        <div class="status-indicator status-green"></div>
                    </div>
                    
                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Trotoar" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-stats"><i class="bi bi-heart"></i> 3,4rb &nbsp; <i class="bi bi-paperclip"></i> 41</div>
                            <div class="queue-loc">Kota Bogor.</div>
                        </div>
                        <div class="status-indicator status-yellow"></div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection