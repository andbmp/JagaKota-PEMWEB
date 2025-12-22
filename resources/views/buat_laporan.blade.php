@extends('layouts.app')

@section('title', 'Buat Laporan - JagaKota')

@section('content')
<style>
    /* --- Styles Khusus Halaman Buat Laporan --- */
    body {
        background-color: #FEF9F0;
        min-height: 100vh;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        margin-top: 20px;
        margin-bottom: 50px;
    }

    .form-label {
        font-weight: 700;
        margin-bottom: 8px;
        font-size: 1rem;
    }

    .form-control-custom {
        background-color: #F2E8D5;
        border: none;
        border-radius: 8px;
        padding: 12px 15px;
        color: #333;
    }

    .form-control-custom:focus {
        background-color: #F2E8D5;
        box-shadow: 0 0 0 2px rgba(106, 142, 114, 0.5);
        outline: none;
    }

    /* Input File Custom */
    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input-btn {
        background-color: #F2E8D5;
        color: #555;
        display: flex;
        align-items: center;
        border-radius: 8px;
        overflow: hidden;
        position: relative;
        z-index: 1; /* Di bawah tombol silang */
    }

    .file-btn-label {
        background-color: #F2E8D5;
        padding: 12px 20px;
        font-weight: 600;
        border-right: 1px solid #ddd;
    }

    .file-btn-text {
        padding: 12px 20px;
        color: #888;
        font-style: italic;
    }

    /* Input file asli dibuat transparan tapi di bawah tombol silang */
    #file-input-actual {
        font-size: 100px;
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 2; 
    }

    .remove-file {
        display: none;
        cursor: pointer;
        padding: 12px 15px;
        color: #ff4d4d;
        font-weight: bold;
        font-size: 1.2rem;
        transition: 0.3s;
        position: relative;
        z-index: 3; /* PALING ATAS agar bisa diklik */
    }

    .remove-file:hover {
        color: #cc0000;
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
        background-color: #B0B0B0;
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

    .map-container {
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #D6B656;
        height: 300px;
        background-color: #eee;
        position: relative;
    }
    .map-img { width: 100%; height: 100%; object-fit: cover; }
</style>

<div class="container">
    <h2 class="fw-bold mt-4 mb-2">Tulis, Unggah, Perubahan.</h2>
    
    <div class="form-card">
        <form action="{{ url('/laporan/buat') }}" method="POST" enctype="multipart/form-data" id="reportForm">
            @csrf
            <div class="row">
                <div class="col-lg-7 pe-lg-5">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" name="title" class="form-control form-control-custom" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi Kerusakan</label>
                        <textarea name="description" class="form-control form-control-custom" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="location" class="form-control form-control-custom" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <label class="form-label">Provinsi</label>
                            <input type="text" name="province" class="form-control form-control-custom">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kabupaten/Kota</label>
                            <input type="text" name="city" class="form-control form-control-custom">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Foto</label>
                        <div class="file-input-wrapper">
                            <div class="file-input-btn d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="file-btn-label">pilih file</span>
                                    <span id="file-btn-text" class="file-btn-text">Tidak ada file dipilih</span>
                                </div>
                                <span id="remove-file-btn" class="remove-file">&times;</span>
                            </div>
                            <input type="file" name="image" id="file-input-actual" accept="image/*">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <button type="submit" class="btn btn-sage">Laporkan</button>
                        </div>
                        <div class="col-md-6">
                            <button type="reset" id="resetBtn" class="btn btn-gray-reset">Reset</button>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mt-4 mt-lg-0">
                    <h5 class="fw-bold mb-2">Pilih lokasi di Peta</h5>
                    <div class="map-container mb-3">
                        <img src="https://placehold.co/600x400/e0e0e0/888?text=Peta+Lokasi" class="map-img">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const fileInput = document.getElementById('file-input-actual');
    const fileText = document.getElementById('file-btn-text');
    const removeBtn = document.getElementById('remove-file-btn');
    const resetBtn = document.getElementById('resetBtn');

    // Update tampilan saat file dipilih
    fileInput.addEventListener('change', function() {
        if (this.files && this.files.length > 0) {
            fileText.innerText = this.files[0].name;
            fileText.style.color = "#333";
            fileText.style.fontStyle = "normal";
            removeBtn.style.display = "block";
            // Matikan pointer-events pada input agar tidak menutupi tombol X setelah file dipilih
            fileInput.style.width = "80%"; 
        }
    });

    // Fungsi menghapus file via tombol silang
    removeBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation(); // Penting: agar klik tidak tembus ke input file di bawahnya
        
        clearFile();
    });

    // Reset visual saat tombol reset form diklik
    resetBtn.addEventListener('click', function() {
        setTimeout(clearFile, 10);
    });

    function clearFile() {
        fileInput.value = ""; 
        fileInput.style.width = "100%"; // Kembalikan lebar input
        fileText.innerText = "Tidak ada file dipilih";
        fileText.style.color = "#888";
        fileText.style.fontStyle = "italic";
        removeBtn.style.display = "none";
    }
</script>
@endsection