@extends('layouts.app')

@section('title', 'Beranda - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Dashboard --- */
    body {
        background-color: #FEF9F0; /* Warna dasar krem */
    }
    

    
    /* Hero Section */
    .hero-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .hero-img-container {
        height: 100%;
        min-height: 300px;
        background-color: #ddd; /* Placeholder warna */
        border-radius: 12px;
        overflow: hidden;
        position: relative;
    }
    .hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Activity Cards */
    .activity-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        color: white;
    }
    .activity-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
    .activity-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
        padding: 10px;
        font-size: 0.8rem;
    }

    /* Accordion (FAQ) */
    .accordion-button:not(.collapsed) {
        background-color: #F2ECD9;
        color: #333;
    }
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,0.1);
    }
    .accordion-item {
        border: none;
        margin-bottom: 10px;
        border-radius: 8px !important;
        overflow: hidden;
    }

    /* Stats Section */
    .stats-box {
        background-color: #FDF6E3; /* Sedikit lebih gelap dari bg utama */
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border-left: 2px solid #D2C4A8;
    }

    /* Search/Footer Section */
    .search-section {
        position: relative;
        padding-top: 50px;
        padding-bottom: 100px;
        /* Background garis kota di bawah */
        background-image: url('public/image/reportcarrousel-background.svg');
        background-position: bottom;
        background-repeat: repeat-x;
        background-size: contain;
    }
    .search-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }

    /* Tombol Hijau */
    .btn-sage {
        background-color: #6A8E72;
        color: white;
        border: none;
        padding: 8px 25px;
        border-radius: 6px;
    }
    .btn-sage:hover {
        background-color: #587960;
        color: white;
    }

    /* Footer Gelap */
    .footer-dark {
        background-color: #333;
        color: #ccc;
        padding: 40px 0;
        font-size: 0.9rem;
    }
    .footer-dark h5 {
        color: white;
        margin-bottom: 20px;
    }
    .footer-dark ul {
        list-style: none;
        padding: 0;
    }
    .footer-dark ul li {
        margin-bottom: 10px;
    }
    .footer-dark a {
        color: #ccc;
        text-decoration: none;
    }
</style>

<div class="container py-4">
    
    <div class="row align-items-stretch mb-5">
        <div class="col-md-5 mb-4 mb-md-0">
            <div class="hero-card h-100 d-flex flex-column justify-content-center">
                <h2 class="fw-bold mb-3">Satu laporan untuk menjaga fasilitas kota</h2>
<div class="mb-4">
    <a href="{{ url('/laporan') }}">
        <button class="btn btn-sage">Mulai</button>
    </a>
</div>
                <p class="text-muted small">Fasilitas rusak bikin ribet? JagaKota menjadi solusi cepat.</p>
            </div>
        </div>
        <div class="col-md-7">
            <div class="hero-img-container">
                <img src="https://placehold.co/800x400/png?text=Gambar+Kota" alt="City View" class="hero-img">
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h4 class="fw-bold mb-4">Aktivitas Komunitas JagaKota</h4>
        <div class="row g-3">
            @for ($i = 0; $i < 4; $i++)
            <div class="col-6 col-md-3">
                <div class="activity-card shadow-sm">
                    <img src="https://placehold.co/300x400/png?text=Foto+Laporan" alt="Activity">
                    <div class="activity-overlay d-flex justify-content-between">
                        <span><i class="bi bi-heart"></i> 1.2rb</span>
                        <span><i class="bi bi-chat"></i> 500</span>
                        <span><i class="bi bi-geo-alt"></i> Bogor</span>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>

    <div class="mb-5 text-center">
        <h5 class="fw-bold mb-3">Pertanyaan yg sering diajukan</h5>
        <p class="text-muted small mb-4">Berikut beberapa pertanyaan yang sering ditanyakan oleh pengguna baru.</p>
        
        <div class="accordion accordion-flush mx-auto" id="accordionFAQ" style="max-width: 800px;">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        Apa itu JagaKota?
                    </button>
                </h2>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body text-start">JagaKota adalah platform pelaporan fasilitas publik yang bisa diakses masyarakat, user dapat dengan cepat dan mudah melaporkan kerusakan atau mengajukan perbaikan untuk fasilitas yang sudah tidak layak pakai</div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Bagaimana cara membuat laporan?
                    </button>
                </h2>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                    <div class="accordion-body text-start">Klik tombol 'Buat Laporan' di navbar...</div>
                </div>
            </div>
            </div>
    </div>

    <div class="mb-5 text-center">
        <h5 class="fw-bold mb-3">Transparan, cepat, dan berdampak nyata</h5>
        <p class="text-muted small mb-4">JagaKota menghubungkan laporan warga dengan instansi terkait.</p>
        
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="stats-box">
                    <h2 class="fw-bold">230</h2>
                    <small class="text-muted">Laporan Harian Masuk</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-box">
                    <h2 class="fw-bold">89%</h2>
                    <small class="text-muted">Kesuksesan Laporan</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-box">
                    <h2 class="fw-bold">150</h2>
                    <small class="text-muted">Bantuan Organisasi</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stats-box">
                    <h2 class="fw-bold">14</h2>
                    <small class="text-muted">Penghargaan Pengabdian</small>
                </div>
            </div>
        </div>
    </div>

</div> <div class="search-section">
    <div class="container">
        <h4 class="fw-bold mb-4">Ulasan Laporan</h4>
        
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="search-card d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div style="flex: 1;">
                        <h5 class="fw-bold mb-0">Mari kita cari laporan <br>di sekitar wilayah yang kau tuju</h5>
                    </div>
                    
                    <div style="flex: 1; min-width: 200px;">
                        <select class="form-select mb-2 bg-light border-0">
                            <option selected>Provinsi</option>
                            <option value="1">Jawa Barat</option>
                            <option value="2">DKI Jakarta</option>
                        </select>
                        <select class="form-select mb-3 bg-light border-0">
                            <option selected>Kabupaten/Kota</option>
                            <option value="1">Bogor</option>
                            <option value="2">Jakarta Selatan</option>
                        </select>
                        <div class="text-end">
                            <button class="btn btn-sage w-50">Cari</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold text-warning">Beranda</h5>
                <ul>
                    <li><a href="#">Hasil yang diberikan</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Ulasan Laporan</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Artikel</h5>
                <ul>
                    <li><a href="#">Laman Awal</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Laporan</h5>
                <ul>
                    <li><a href="#">Laman Awal</a></li>
                    <li><a href="#">Bikin Laporan</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                <h5>Hubungi Kami</h5>
                <p>+62 812 3456 7890<br>Gedung Merdeka, Jakarta Utara</p>
                <div class="mt-3">
                    <img src="https://placehold.co/100x30/333/ccc?text=Logo+JagaKota" alt="Logo Footer">
                </div>
            </div>
        </div>
        <div class="text-center mt-4 border-top border-secondary pt-3">
            <small>Satu laporan untuk menjaga fasilitas kota</small>
        </div>
    </div>
</footer>

@endsection