<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bakeu Coffe - Bahun Artistik Kuliner Ekspansi Usaha</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Favicon -->
    <link href="{{ asset('frontend/img/favicon.png') }}" rel="icon">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/style.min.css') }}" rel="stylesheet">
    <style>
        .navbar-coffee { background: rgba(33,30,27,0.92); box-shadow: 0 8px 20px rgba(0,0,0,0.25); }
        .section-title::before,
        .section-title::after,
        .section-title h4::before,
        .section-title h4::after,
        .section-title h1::before,
        .section-title h1::after { display: none !important; content: none !important; }
        .navbar-spacer { height: 110px; }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3 navbar-coffee">
            <a href="{{ url('/') }}" class="navbar-brand px-lg-4 m-0 d-flex align-items-center">
                <img src="{{ isset($profil) && $profil->path_logo ? asset('storage/'.$profil->path_logo) : asset('frontend/img/logobakeu.jpeg') }}" alt="Logo" class="mr-2" style="height: 50px; border-radius: 15px">
                <h1 class="m-0 display-6 text-uppercase text-white">{{ $profil->nama_usaha ?? 'BAKEU COFFEE' }}</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('produk.index') }}" class="nav-item nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">Produk</a>
                    <a href="{{ route('galeri.index') }}" class="nav-item nav-link {{ request()->routeIs('galeri.index') ? 'active' : '' }}">Galeri</a>
                    <a href="{{ url('/#footer') }}" class="nav-item nav-link">Kontak</a>
                    <a href="{{ url('/#tentang') }}" class="nav-item nav-link">Tentang Kami</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="navbar-spacer"></div>
    <!-- Navbar End -->

    {{-- BIKIN SEMUA PRODUK DISINI --}}
        <!-- Semua Produk Start -->
    <div class="container-fluid py-5" id="produk">
        <div class="container">
            {{-- Judul Halaman --}}
            <div class="section-title text-center mb-5">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Produk & Harga</h4>
                <h1 class="display-4 fw-bold">Semua Produk Bakeu Coffee</h1>
                <p class="text-muted mt-3">
                    Jelajahi seluruh katalog produk Bakeu Coffee – cocok untuk stok harian, oleh-oleh, hingga kebutuhan usaha.
                </p>
            </div>

            {{-- Grid Produk --}}
            <div class="row">
                @forelse($produk as $p)
                    @php
                        $img = !empty($p->path_gambar)
                            ? asset('storage/'.$p->path_gambar)
                            : asset('frontend/img/menu-1.jpg');

                        $waNumber = optional($profil ?? null)->no_whatsapp;
                        $waUrl = $waNumber
                            ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waNumber) . '?text=' . urlencode('Halo, saya ingin pesan '.$p->nama_produk)
                            : '#';
                    @endphp

                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 1rem; overflow: hidden;">
                            <div class="position-relative">
                                <a href="{{ route('produk.show', ['produk' => $p->id, 'slug' => \Illuminate\Support\Str::slug($p->nama_produk)]) }}">
                                    <img src="{{ $img }}"
                                         alt="{{ $p->nama_produk }}"
                                         class="card-img-top"
                                         style="height: 190px; object-fit: cover;">
                                </a>

                                {{-- Ribbon Favorit --}}
                                @if($p->ditandai_favorit)
                                    <div style="
                                        position:absolute;
                                        top:12px;
                                        left:-40px;
                                        background:#ffc107;
                                        color:#000;
                                        padding:4px 40px;
                                        font-size:0.75rem;
                                        font-weight:600;
                                        text-transform:uppercase;
                                        transform:rotate(-45deg);
                                        box-shadow:0 4px 10px rgba(0,0,0,0.15);
                                    ">
                                        Favorit
                                    </div>
                                @endif

                                {{-- Badge Kategori --}}
                                @if($p->kategori)
                                    <span style="
                                        position:absolute;
                                        bottom:12px;
                                        left:12px;
                                        font-size:0.7rem;
                                        text-transform:uppercase;
                                        letter-spacing:0.05em;
                                        padding:4px 8px;
                                        border-radius:999px;
                                        background:rgba(0,0,0,0.7);
                                        color:#fff;
                                    ">
                                        {{ strtoupper($p->kategori) === 'HOT'
                                            ? 'Hot Coffee'
                                            : (strtoupper($p->kategori) === 'COLD'
                                                ? 'Cold Coffee'
                                                : ucfirst($p->kategori)) }}
                                    </span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-1 text-truncate">
                                    <a href="{{ route('produk.show', ['produk' => $p->id, 'slug' => \Illuminate\Support\Str::slug($p->nama_produk)]) }}" class="text-dark">{{ $p->nama_produk }}</a>
                                </h5>
                                <p class="card-text text-muted small mb-3">
                                    {{ \Illuminate\Support\Str::limit($p->deskripsi_singkat, 80) }}
                                </p>

                                <div class="mt-auto">
                                    @php
                                        $jumlahTestimoni = $p->testimoni->count();
                                        $avgRating = $p->testimoni->whereNotNull('rating')->avg('rating');
                                        $roundedRating = $avgRating ? round($avgRating) : 0;
                                        $avgRatingDisplay = $avgRating ? number_format($avgRating, 1, ',', '.') : null;
                                    @endphp
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div>
                                            <div class="text-muted small">Harga</div>
                                            <div class="h5 mb-0 text-primary font-weight-bold">
                                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="small">
                                            @if($roundedRating > 0 && $avgRatingDisplay)
                                                <span class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        {!! $i <= $roundedRating ? '&#9733;' : '&#9734;' !!}
                                                    @endfor
                                                </span>
                                                <span class="text-muted ml-1">
                                                    {{ $avgRatingDisplay }}/5
                                                </span>
                                            @else
                                                <span class="text-muted">Belum ada rating</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="text-muted small mb-2">
                                        @if($jumlahTestimoni > 0)
                                            {{ $jumlahTestimoni }} testimoni
                                        @else
                                            Belum ada testimoni
                                        @endif
                                    </div>

                                    <div class="d-flex flex-column">
                                        <a href="{{ route('produk.show', ['produk' => $p->id, 'slug' => \Illuminate\Support\Str::slug($p->nama_produk)]) }}"
                                           class="btn btn-outline-secondary btn-sm rounded-pill mb-2">
                                            Lihat Detail Produk
                                        </a>
                                        <a href="{{ $waUrl }}"
                                           target="_blank"
                                           rel="noopener"
                                           class="btn btn-secondary btn-sm rounded-pill">
                                            <i class="fab fa-whatsapp mr-1"></i> Pesan via WhatsApp
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Belum ada produk yang aktif untuk ditampilkan.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- CTA kecil di bawah --}}
            <div class="row mt-4">
                <div class="col-md-8 mx-auto text-center">
                    <h5 class="mb-2">Butuh katalog harga lengkap?</h5>
                    <p class="text-muted mb-3">
                        Admin Bakeu Coffee dapat mengirimkan daftar harga terbaru dalam bentuk file melalui WhatsApp.
                    </p>
                    @if(!empty($profil->no_whatsapp))
                        <a href="{{ 'https://wa.me/'.preg_replace('/\D/', '', $profil->no_whatsapp).'?text='.urlencode('Halo, saya ingin minta katalog harga Bakeu Coffee.') }}"
                           target="_blank"
                           rel="noopener"
                           class="btn btn-primary rounded-pill px-4">
                            Chat Admin Bakeu Coffee
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Semua Produk End -->

    <!-- Footer Start -->
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
                    @forelse($mediaSosial as $sosmed)
                        <a class="btn btn-lg btn-outline-light btn-lg-square mr-2" href="{{ $sosmed->url }}" target="_blank" title="{{ $sosmed->nama_platform }}">
                            <i class="{{ $sosmed->ikon_css ?? 'fa fa-globe' }}"></i>
                        </a>
                    @empty
                        <p class="text-white-50">Belum ada media sosial.</p>
                    @endforelse
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
            <p class="mb-2 text-white">Copyright &copy; 2025 <a class="font-weight-bold" href="#"> Viola Restu</a>. All Rights Reserved.</a></p>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Contact Javascript File -->
    <script src="{{ asset('frontend/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('frontend/mail/contact.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
