@extends('layouts.app')

@section('title', 'Daftar Laporan - JagaKota')

@section('content')
<style>
    body {
        background-color: #FEF9F0;
        background-image: url('{{ asset('image/reportcarrousel-background.svg') }}');
        background-position: bottom;
        background-repeat: repeat-x;
        background-size: contain; 
        min-height: 100vh;
    }

    .filter-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.03);
    }

    .form-select-custom {
        background-color: #F2E8D5;
        border: none;
        padding: 12px;
        border-radius: 8px;
        color: #555;
    }

    .btn-sage { background-color: #6A8E72; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-weight: 600; }
    .btn-sage:hover { background-color: #587960; color: white; }

    .btn-gray { background-color: #D9D9D9; color: #333; border: none; padding: 8px 20px; border-radius: 6px; font-weight: 600; }
    
    .btn-gold { background-color: #D6B656; color: white; border: none; width: 100%; padding: 8px; border-radius: 8px; font-weight: 600; }
    .btn-gold:hover { background-color: #c4a548; color: white; }

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

    .status-diterima { background-color: #A3D9A5; } 
    .status-diproses { background-color: #FCEEB5; } 
    .status-ditolak { background-color: #FFB3B3; }

    .report-body { padding: 15px; }
    .report-title { font-weight: 700; font-size: 1rem; margin-bottom: 5px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .report-meta { font-size: 0.85rem; color: #666; margin-bottom: 15px; }

    .pagination-bar { background: white; border-radius: 12px; padding: 15px 25px; border: 1px solid #eee; }
</style>

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
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select form-select-custom">
                        <option selected>Kabupaten/Kota</option>
                        <option value="1">Bogor</option>
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
                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                <input type="text" class="form-control border-start-0 ps-0" placeholder="Cari judul, deskripsi, atau lokasi">
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        @forelse($reports as $report)
        <div class="col-md-3">
            <div class="report-card">
                <div class="report-img-wrapper">
                    @if($report->image_path)
                        <img src="{{ asset('storage/' . $report->image_path) }}" class="report-img" alt="Foto Laporan">
                    @else
                        <img src="https://placehold.co/300x200/png?text=Tidak+Ada+Foto" class="report-img" alt="Default">
                    @endif

                    @php
                        $statusClass = 'status-diproses';
                        if($report->status == 'diterima' || $report->status == 'selesai') $statusClass = 'status-diterima';
                        if($report->status == 'ditolak') $statusClass = 'status-ditolak';
                    @endphp
                    <span class="badge-status {{ $statusClass }}">
                        {{ ucfirst($report->status) }}
                    </span>     
                </div>

                <div class="report-body">
                    <h6 class="report-title">{{ $report->title }}</h6>
                    <div class="text-muted small mb-2">
                        <i class="bi bi-geo-alt-fill"></i> {{ $report->location }}
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center report-meta">
                        <span>@ {{ $report->user->name ?? 'Anonim' }}</span>
                        <span>{{ $report->created_at->format('d/m/Y') }}</span>
                    </div>

                    <a href="{{ url('/laporan/'.$report->id) }}" class="btn btn-gold">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-muted">Belum ada laporan yang tersedia.</p>
        </div>
        @endforelse
    </div>

    <div class="pagination-bar d-flex justify-content-between align-items-center shadow-sm">
        <div class="fw-bold small">
            Total {{ $reports->total() }} Laporan
        </div>
        <div>
            {{ $reports->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>

<div style="height: 100px;"></div>
@endsection