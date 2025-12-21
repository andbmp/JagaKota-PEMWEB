<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JagaKota')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #FEF9F0; font-family: 'Segoe UI', sans-serif; }
        
        .navbar-custom { 
            background-color: #FEF9F0; 
            padding: 20px 0; 
            border-bottom: 1px solid #eee; 
        }

        /* Ukuran Logo diperbesar 3x lipat (40px * 3 = 120px) */
        .navbar-brand img {
            width: 120px; 
            height: auto;
        }

        /* Memaksa menu tetap menyamping dan tidak hilang */
        .navbar-nav-custom {
            display: flex !important;
            flex-direction: row !important;
            list-style: none;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        .nav-link { 
            color: #333 !important; 
            font-weight: 600; 
            margin: 0 15px;
            white-space: nowrap; /* Agar teks tidak turun ke bawah */
        }

        .nav-link.active-pill { 
            background-color: #8D8D8D; 
            color: white !important; 
            border-radius: 25px; 
            padding: 8px 25px !important; 
        }

        .profile-icon {
            font-size: 2.2rem;
            color: #333;
            margin-left: 20px;
        }

        /* Responsif untuk layar HP agar tetap rapi */
        @media (max-width: 576px) {
            .nav-link {
                margin: 0 5px;
                font-size: 0.85rem;
            }
            .navbar-brand img {
                width: 80px; /* Sedikit dikecilkan di HP agar muat */
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-custom">
        <div class="container d-flex justify-content-between align-items-center">
            
            <a class="navbar-brand" href="{{ url('/dashboard') }}">
                <img src="{{ asset('image/JagaKotaa.svg') }}" alt="Logo JagaKota">
            </a>

            <ul class="navbar-nav-custom">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active-pill' : '' }}" href="{{ url('/dashboard') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('laporan') ? 'active-pill' : '' }}" href="{{ url('/laporan') }}">Laporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('laporan/buat') ? 'active-pill' : '' }}" href="{{ url('/laporan/buat') }}">Buat Laporan</a>
                </li>
            </ul>

            <div class="d-flex align-items-center">
                <a href="{{ url('/profile') }}">
                    <i class="bi bi-person-circle profile-icon"></i>
                </a>
            </div>

        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>