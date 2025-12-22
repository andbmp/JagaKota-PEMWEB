@extends('layouts.app')

@section('title', 'Daftar Laporan - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Halaman Laporan --- */
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

    /* Tombol-tombol */
    .btn-sage { background-color: #6A8E72; color: white; border: none; padding: 8px 20px; border-radius: 6px; font-weight: 600; }
    .btn-sage:hover { background-color: #587960; color: white; }
    .btn-gray { background-color: #D9D9D9; color: #333; border: none; padding: 8px 20px; border-radius: 6px; font-weight: 600; }
    .btn-gold { background-color: #D6B656; color: white; border: none; width: 100%; padding: 8px; border-radius: 8px; font-weight: 600; text-align: center; text-decoration: none; display: block; }
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
    .report-card:hover { transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .report-img-wrapper { position: relative; height: 180px; background-color: #ddd; }
    .report-img { width: 100%; height: 100%; object-fit: cover; }
    
    .badge-status { position: absolute; top: 10px; right: 10px; padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; color: #333; }
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
        <form action="{{ route('laporan.index') }}" method="GET">
            <div class="row g-3">
                <div class="col-md-6">
                    <select class="form-select form-select-custom" name="provinsi">
                        <option selected disabled>Provinsi</option>
                        <option value="Jawa Barat">Jawa Barat</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <select class="form-select form-select-custom" name="kota">
                        <option selected disabled>Kabupaten/Kota</option>
                        <option value="Bogor">Bogor</option>
                    </select>
                </div>
            </div>
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-sage me-2">Terapkan</button>
                <a href="{{ route('laporan.index') }}" class="btn btn-gray text-decoration-none">Atur Ulang</a>
            </div>
        </form>
    </div>

    <div class="row g-4 mb-5">
        {{-- LOOP DATA DARI DATABASE --}}
        @forelse($reports as $report)
        <div class="col-md-3">
            <div class="report-card">
                <div class="report-img-wrapper">
                    @if($report->image_path)
                        <img src="{{ asset('storage/' . $report->image_path) }}" class="report-img" alt="Foto Laporan">
                    @else
                        <img src="{{ asset('image/jalanrusak.png') }}" class="report-img" alt="Default">
                    @endif

                    {{-- Logika Warna Status --}}
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

                    {{-- LINK DETAIL DENGAN ID DINAMIS --}}
                    <a href="{{ route('laporan.show', $report->id) }}" class="btn btn-gold">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <h5 class="text-muted">Belum ada laporan yang dibuat.</h5>
            <a href="{{ route('laporan.create') }}" class="btn btn-sage mt-2">Buat Laporan Sekarang</a>
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