@extends('layouts.app')

@section('title', 'Admin Laporan - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Admin Page (Reusing & Extending) --- */
    body {
        background-color: #FEF9F0;
        overflow-x: hidden; /* Mencegah scroll horizontal window utama */
    }

    /* Layout Wrapper */
    .admin-wrapper {
        display: flex;
        height: 100vh; /* Full height window */
        overflow: hidden; /* Mencegah scroll di body */
    }

    /* --- Sidebar --- */
    .admin-sidebar {
        width: 250px;
        background-color: white;
        border-right: 1px solid #eee;
        display: flex;
        flex-direction: column;
        padding: 20px;
        flex-shrink: 0; /* Sidebar tidak menyusut */
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
        overflow-y: auto; /* Content area bisa discroll */
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: contain;
    }

    /* --- DETAIL CARD (Tengah) --- */
    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        height: 100%;
    }

    .user-header {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .main-report-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        background-color: #ddd;
    }

    .interaction-stats {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .info-box {
        background-color: #F2E8D5;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }
    .info-label { font-weight: 700; font-size: 0.95rem; margin-bottom: 5px; display: block; }
    .info-text { font-size: 0.9rem; margin-bottom: 0; line-height: 1.4; }

    /* Action Buttons (Terima/Tolak) */
    .action-group {
        display: flex;
        gap: 0; /* Nempel */
        margin-bottom: 15px;
        border-radius: 8px;
        overflow: hidden;
    }
    .btn-action {
        flex: 1;
        padding: 12px;
        border: none;
        font-weight: 700;
        font-size: 1rem;
    }
    .btn-accept {
        background-color: #A3D9A5; /* Hijau muda */
        color: #1a5220;
    }
    .btn-accept:hover { background-color: #8fc791; }
    
    .btn-reject {
        background-color: #FF9F9F; /* Merah muda */
        color: #631818;
    }
    .btn-reject:hover { background-color: #eb8c8c; }

    .btn-submit {
        background-color: #6A8E72; /* Hijau Sage Tua */
        color: white;
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        font-weight: 700;
        border: none;
    }
    .btn-submit:hover { background-color: #587960; }

    /* --- LIST CARD (Kanan) --- */
    .filter-btn {
        background: white;
        border: 1px solid #ddd;
        padding: 8px 15px;
        border-radius: 8px;
        font-weight: 600;
        float: right;
        margin-bottom: 15px;
    }
    
    .queue-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
        padding-right: 5px; /* Space for scrollbar */
    }

    .queue-item {
        background: white;
        border-radius: 12px;
        padding: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        display: flex;
        gap: 12px;
        cursor: pointer;
        transition: transform 0.2s;
        border: 1px solid transparent;
    }
    .queue-item:hover {
        transform: translateX(-3px);
        border-color: #6A8E72;
    }
    
    .queue-img {
        width: 100px;
        height: 70px;
        border-radius: 6px;
        object-fit: cover;
        flex-shrink: 0;
        background-color: #ddd;
    }
    
    .queue-content {
        flex-grow: 1;
        overflow: hidden;
    }
    .queue-desc {
        font-size: 0.85rem;
        font-weight: 500;
        margin-bottom: 5px;
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Batasi 2 baris */
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .queue-loc {
        font-size: 0.75rem;
        font-weight: 700;
        color: #555;
    }

    /* Custom Scrollbar untuk Admin Content */
    .admin-content::-webkit-scrollbar { width: 8px; }
    .admin-content::-webkit-scrollbar-track { background: transparent; }
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
            
            <a href="#" class="menu-link active">Laporan</a>
            
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
        <div class="row h-100">
            
            <div class="col-lg-7 mb-4 mb-lg-0">
                <div class="detail-card">
                    <div class="user-header">
                        <i class="bi bi-person-circle fs-4"></i>
                        <span>NamaPengguna</span>
                    </div>

                    <img src="https://placehold.co/600x400/png?text=Jalan+Berlubang+Besar" class="main-report-img" alt="Detail Laporan">
                    
                    <div class="interaction-stats">
                        <div>
                            <i class="bi bi-heart"></i> 1.2rb &nbsp; 
                            <i class="bi bi-paperclip"></i> 500
                        </div>
                        <div>24/01/2025</div>
                    </div>

                    <div class="info-box">
                        <span class="info-label">Deskripsi Kerusakan:</span>
                        <p class="info-text">
                            Udah 5 bulan dan masih belom ada kabar dari pemerintah, udah jadi sumber macet dan kecelakaan beruntun ini, JagaKota do your magic biar FYP
                        </p>
                    </div>

                    <div class="info-box">
                        <span class="info-label">Lokasi:</span>
                        <p class="info-text">Jl. Cagak, Kabupaten Aceh Barat</p>
                    </div>

                    <div class="action-group">
                        <button class="btn-action btn-accept">Terima</button>
                        <button class="btn-action btn-reject">Tolak</button>
                    </div>
                    
                    <button class="btn-submit">Kirim</button>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="d-flex justify-content-end mb-3">
                    <button class="filter-btn"><i class="bi bi-funnel"></i> Filter</button>
                </div>
                
                <div class="queue-list">
                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Jalan" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-desc">Aduh ini kerusakannya masih terus bikin warga sekitar resah karena...</div>
                            <div class="queue-loc">Jl. Panrango, Kota Bogor</div>
                        </div>
                    </div>

                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Plang" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-desc">Ini plang kasian banget ga ada yg bangunin udah kesiangan dia</div>
                            <div class="queue-loc">Jl. Ciomas, Kota Bogor</div>
                        </div>
                    </div>

                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Kursi" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-desc">Mau duduk tapi ga sengaja bablas maap ya kalo jadi kayak gini aku ga tau</div>
                            <div class="queue-loc">Jl. Malabar III, Kota Bogor</div>
                        </div>
                    </div>

                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Taman" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-desc">Taman buat publik kenapa pada rusak ya, Siapa si yang ngebiarin fasilitas</div>
                            <div class="queue-loc">Jl. Tanah Baru, Kota Bogor</div>
                        </div>
                    </div>

                    <div class="queue-item">
                        <img src="https://placehold.co/100x70/png?text=Halte" class="queue-img">
                        <div class="queue-content">
                            <div class="queue-desc">Ini ada kaca pecah di halte bus ngeri banget kalo ada anak kecil lewat</div>
                            <div class="queue-loc">Jl. Cimahpar, Kota Bogor</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection