<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $produk->nama_produk }} - Bakeu Coffee</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="{{ asset('frontend/img/favicon.png') }}" rel="icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/css/style.min.css') }}" rel="stylesheet">
    <style>
        .navbar-coffee { background: rgba(33,30,27,0.92); box-shadow: 0 8px 20px rgba(0,0,0,0.25); }
        .product-image { border-radius: 1rem; height: 320px; object-fit: cover; }
        .product-card { border-radius: 1rem; }
        .content-with-navbar { padding-top: 100px; }
        .navbar-spacer { height: 110px; }
    </style>
</head>
<body>
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3 navbar-coffee">
            <a href="/" class="navbar-brand px-lg-4 m-0 d-flex align-items-center">
                <img src="{{ isset($profil) && $profil->path_logo ? asset('storage/'.$profil->path_logo) : asset('frontend/img/logobakeu.jpeg') }}" alt="Logo" class="mr-2" style="height: 50px; border-radius: 15px">
                <h1 class="m-0 display-6 text-uppercase text-white">{{ $profil->nama_usaha ?? 'BAKEU COFFEE' }}</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="/" class="nav-item nav-link">Beranda</a>
                    <a href="{{ route('produk.index') }}" class="nav-item nav-link active">Produk</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="navbar-spacer"></div>

    <div class="container py-5 content-with-navbar">
        <div class="row">
            <div class="col-md-5 mb-4">
                @php
                    $img = !empty($produk->path_gambar) ? asset('storage/'.$produk->path_gambar) : asset('frontend/img/menu-1.jpg');
                    $waNumber = optional($profil ?? null)->no_whatsapp;
                    $waUrl = $waNumber ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waNumber) . '?text=' . urlencode('Halo, saya ingin pesan '.$produk->nama_produk) : '#';
                @endphp
                <img src="{{ $img }}" alt="{{ $produk->nama_produk }}" class="w-100 product-image shadow-sm">
            </div>
            <div class="col-md-7">
                <div class="card product-card border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="mb-2">{{ $produk->nama_produk }}</h2>
                        @if($produk->kategori)
                            <span class="badge badge-dark">{{ $produk->kategori }}</span>
                        @endif
                        <div class="mt-3">
                            <div class="text-muted small">Harga</div>
                            <div class="h4 text-primary mb-3">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                        </div>
                        @if(!empty($produk->deskripsi_lengkap))
                            <div class="mb-3">{!! nl2br(e($produk->deskripsi_lengkap)) !!}</div>
                        @else
                            <div class="mb-3">{{ $produk->deskripsi_singkat }}</div>
                        @endif
                        <div class="d-flex">
                            <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="btn btn-success rounded-pill px-4 mr-2">
                                <i class="fab fa-whatsapp mr-1"></i> Pesan via WhatsApp
                            </a>
                            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Kembali ke Produk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Hubungi Kami</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>{{ $profil->alamat_lengkap ?? '-' }}</p>
                <p><i class="fa fa-phone-alt mr-2"></i>{{ $profil->no_telepon ?? '-' }}</p>
                <p><i class="fa fa-whatsapp mr-2"></i>{{ $profil->no_whatsapp ?? '-' }}</p>
                <p class="m-0"><i class="fa fa-envelope mr-2"></i>{{ $profil->email ?? '-' }}</p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Ikuti Kami</h4>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-outline-light btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Jam Operasional</h4>
                <div>
                    <h6 class="text-white text-uppercase">Senin – Jumat</h6>
                    <p>{{ $profil->jam_buka_hari_kerja ?? '-' }}</p>
                    <h6 class="text-white text-uppercase">Sabtu – Minggu</h6>
                    <p>{{ $profil->jam_buka_akhir_pekan ?? '-' }}</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Berlangganan</h4>
                <p>Dapatkan informasi terbaru dari Bakeu Coffee.</p>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;" placeholder="Email Anda">
                        <div class="input-group-append">
                            <button class="btn btn-primary font-weight-bold px-3">Daftar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center text-white border-top mt-4 py-4 px-sm-3 px-md-5" style="border-color: rgba(256, 256, 256, .1) !important;">
            <p class="mb-2 text-white">Copyright &copy; 2025 <a class="font-weight-bold" href="#"> Viola Restu</a>. All Rights Reserved.</p>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>
</html>
