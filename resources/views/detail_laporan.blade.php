@extends('layouts.app')

@section('title', 'Detail Laporan - JagaKota')

@section('content')
<style>
    body { background-color: #FEF9F0; min-height: 100vh; }
    .btn-back { text-decoration: none; color: #333; font-weight: 700; font-size: 1.1rem; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; }
    .btn-back:hover { color: #000; }

    .main-image-card { background: white; border-radius: 12px; overflow: hidden; margin-bottom: 15px; }
    .main-image { width: 100%; height: 450px; object-fit: cover; display: block; }
    
    .interaction-btn { background: white; border: 1px solid #ddd; border-radius: 8px; padding: 10px 20px; font-weight: 700; color: #333; display: flex; align-items: center; gap: 8px; flex: 1; justify-content: center; cursor: pointer; transition: 0.2s; }
    .interaction-btn:hover { background-color: #f8f9fa; }
    
    .comment-section { background: white; border-radius: 12px; padding: 25px; margin-top: 20px; }
    .comment-item { margin-bottom: 20px; }
    .comment-user { font-weight: 700; display: flex; align-items: center; gap: 8px; margin-bottom: 5px; }
    .comment-bubble { background-color: #F2E8D5; padding: 15px; border-radius: 8px; font-size: 0.9rem; color: #444; }

    .info-card, .map-card, .progress-card { background: white; border-radius: 12px; padding: 25px; margin-bottom: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
    
    .status-badge { background-color: #E8D888; color: #555; padding: 5px 15px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }

    .map-placeholder { width: 100%; height: 250px; background-color: #eee; border-radius: 8px; object-fit: cover; }
    .btn-sage { background-color: #6A8E72; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-weight: 600; }
    .btn-route { background-color: #6A8E72; color: white; border: none; padding: 5px 15px; border-radius: 6px; font-size: 0.9rem; }
    .empty-progress { text-align: center; padding: 30px 10px; }
</style>

<div class="container py-4">
    <a href="{{ url('/laporan') }}" class="btn-back">
        <i class="bi bi-x-circle"></i> Kembali
    </a>

    <div class="row">
        <div class="col-lg-7 mb-4">
            <div class="main-image-card shadow-sm">
                {{-- Foto Dinamis dari Database --}}
                @if($report->image_path)
                     <img src="{{ asset('image/jalanrusak.png') }}"  class="main-image" alt="Default"">
                @else
                  <img src="{{ asset('image/jalanrusak.png') }}"  class="main-image" alt="Default"">
                @endif
            </div>

            <div class="d-flex gap-3 mb-4">
                {{-- Tombol Like Statis (Bisa diklik tapi tidak simpan ke DB) --}}
                <div class="interaction-btn shadow-sm" onclick="this.classList.toggle('text-danger')">
                    <i class="bi bi-heart-fill"></i> 2.1rb Suka
                </div>
                <div class="interaction-btn shadow-sm">
                    <i class="bi bi-pencil-square"></i> 540 Komentar
                </div>
            </div>

            {{-- Bagian Komentar (Statis/Dummy sesuai permintaan) --}}
            <div class="comment-section shadow-sm">
                <h5 class="fw-bold mb-4">Komentar</h5>
                <div class="comment-item">
                    <div class="comment-user"><i class="bi bi-person-circle fs-5"></i> AsepSurasep</div>
                    <div class="comment-bubble">Wah gila sih, aku sering lewat sini... Semoga pihak bertanggung jawab udah mulai bergerak.</div>
                </div>
                <div class="comment-item">
                    <div class="comment-user"><i class="bi bi-person-circle fs-5"></i> MahaSigma</div>
                    <div class="comment-bubble">WKWKWKWKWK aku pernah lewat kesini sekali dan malah ada tukang ojek online yang malah jatoh.</div>
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
                    <h5 class="fw-bold mb-0">{{ $report->title }}</h5>
                    <span class="status-badge">
                        <i class="bi bi-clock"></i> {{ ucfirst($report->status) }}
                    </span>
                </div>
                <div class="text-muted small mb-3">
                    <i class="bi bi-calendar"></i> {{ $report->created_at->translatedFormat('l, d F Y H:i') }}
                </div>

                <h6 class="fw-bold">Deskripsi Laporan</h6>
                <p class="small text-muted mb-3">{{ $report->description }}</p>

                <h6 class="fw-bold">Lokasi</h6>
                <div class="small text-muted">
                    Alamat: {{ $report->location }}<br>
                    Pelapor: <strong>@ {{ $report->user->name ?? 'Anonim' }}</strong>
                </div>
            </div>

            <div class="map-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-geo-alt"></i> Lokasi di Peta</h6>
                    <button class="btn-route"><i class="bi bi-cursor-fill"></i> Rute</button>
                </div>
                <img src="{{ asset('image/petaMonas.jpg') }}"  class="map-placeholder" alt="Map">
            </div>

            <div class="progress-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0"><i class="bi bi-clock-history"></i> Progress Laporan</h6>
                    <span class="badge bg-secondary">0 Update</span>
                </div>
                <div class="empty-progress">
                    <div class="mb-2"><i class="bi bi-x-square" style="font-size: 2.5rem; color: #333;"></i></div>
                    <h6 class="fw-bold">Belum ada Progress Baru</h6>
                    <p class="text-muted small">Mohon menunggu dan secara berkala memantau kembali</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="height: 50px;"></div>
@endsection