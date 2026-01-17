<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bakeu Coffe - Detail Produk</title>
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
        .navbar-spacer { height: 110px; }
        .product-image-main { border-radius: 1rem; object-fit: cover; width: 100%; height: 320px; }
        .badge-kategori {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 4px 10px;
            border-radius: 999px;
        }
        .rating-stars {
            display: inline-flex;
            gap: 4px;
        }
        .rating-star {
            font-size: 1.3rem;
            color: #d0c3b8;
            cursor: pointer;
            transition: color 0.15s ease-in-out, transform 0.1s ease-in-out;
        }
        .rating-star.active {
            color: #f4b000;
            transform: translateY(-1px);
        }
        .testimonial-form-wrapper {
            max-width: 420px;
            margin-left: auto;
        }
        .testimonial-form {
            background: #ffffff;
            border-radius: 18px;
            padding: 18px 20px;
            border: 1px solid rgba(30, 22, 17, 0.06);
            box-shadow: 0 14px 35px rgba(15, 10, 5, 0.14);
        }
        .testimonial-form .form-control {
            border-radius: 999px;
            border-color: rgba(30, 22, 17, 0.12);
            padding-left: 16px;
            padding-right: 16px;
            font-size: 0.9rem;
        }
        .testimonial-form textarea.form-control {
            border-radius: 14px;
            resize: vertical;
            min-height: 70px;
        }
        .testimonial-form .form-control:focus {
            border-color: #b37a4c;
            box-shadow: 0 0 0 0.12rem rgba(179, 122, 76, 0.25);
        }
        .testimonial-form-label {
            font-size: 0.8rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: #8a7a6d;
            margin-bottom: 6px;
        }
        .testimonial-form .btn-submit {
            border-radius: 999px;
            padding: 0.45rem 1.6rem;
            font-weight: 500;
        }
    </style>
</head>

<body>
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

    <div class="container-fluid py-4 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk }}</li>
                </ol>
            </nav>
            <h1 class="h2 mb-0">{{ $produk->nama_produk }}</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-md-5 mb-4 mb-md-0">
                @php
                    $img = !empty($produk->path_gambar)
                        ? asset('storage/'.$produk->path_gambar)
                        : asset('frontend/img/menu-1.jpg');
                @endphp
                <img src="{{ $img }}" alt="{{ $produk->nama_produk }}" class="product-image-main shadow-sm">
            </div>
            <div class="col-md-7">
                <div class="mb-3">
                    @if($produk->kategori)
                        <span class="badge badge-kategori bg-dark text-white">
                            {{ strtoupper($produk->kategori) === 'HOT'
                                ? 'Hot Coffee'
                                : (strtoupper($produk->kategori) === 'COLD'
                                    ? 'Cold Coffee'
                                    : ucfirst($produk->kategori)) }}
                        </span>
                    @endif
                    @if($produk->ditandai_favorit)
                        <span class="badge bg-warning text-dark ml-2">Favorit</span>
                    @endif
                </div>

                <h2 class="h3 text-primary mb-3">
                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                </h2>

                @if($produk->deskripsi_singkat)
                    <p class="lead">{{ $produk->deskripsi_singkat }}</p>
                @endif

                @if($produk->deskripsi_lengkap)
                    <p>{{ $produk->deskripsi_lengkap }}</p>
                @endif

                @php
                    $waNumber = optional($profil ?? null)->no_whatsapp;
                    $waUrl = $waNumber
                        ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waNumber) . '?text=' . urlencode('Halo, saya tertarik dengan '.$produk->nama_produk)
                        : '#';
                @endphp

                <div class="mt-4 d-flex flex-wrap align-items-center">
                    <a href="{{ $waUrl }}"
                       target="_blank"
                       rel="noopener"
                       class="btn btn-primary mr-3 mb-2">
                        <i class="fab fa-whatsapp mr-1"></i> Pesan via WhatsApp
                    </a>
                    <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary mb-2">
                        Kembali ke Daftar Produk
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5 bg-white">
        <div class="container">
            <div class="section-title d-flex justify-content-between align-items-end">
                <div>
                    <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimoni</h4>
                    <h1 class="display-5">Testimoni untuk Produk Ini</h1>
                </div>
                @php
                    $jumlahTestimoni = ($testimoni ?? collect())->count();
                @endphp
                <div class="text-right flex-grow-1 ml-4">
                    <div class="small text-muted mb-2">
                        @if($jumlahTestimoni > 0)
                            {{ $jumlahTestimoni }} testimoni telah ditulis
                        @else
                            Belum ada testimoni. Jadilah yang pertama.
                        @endif
                    </div>
                    <div class="testimonial-form-wrapper">
                        <form action="{{ route('produk.testimoni.store', $produk) }}" method="POST" class="testimonial-form">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                            <div class="form-group mb-2">
                                <div class="testimonial-form-label">Nama</div>
                                <input type="text" name="nama_klien" class="form-control form-control-sm" placeholder="Nama lengkap Anda" required>
                            </div>
                            <div class="form-group mb-2">
                                <div class="testimonial-form-label">Profesi</div>
                                <input type="text" name="profesi" class="form-control form-control-sm" placeholder="Profesi atau aktivitas sehari-hari" >
                            </div>
                            <div class="form-group mb-2">
                                <div class="testimonial-form-label">Rating</div>
                                <div class="d-flex align-items-center">
                                    <div class="rating-stars" data-input-id="rating-input">
                                        @for($i = 1; $i <= 5; $i++)
                                            <span class="rating-star" data-value="{{ $i }}">&#9733;</span>
                                        @endfor
                                    </div>
                                </div>
                                <input type="hidden" name="rating" id="rating-input" required>
                            </div>
                            <div class="form-group mb-2">
                                <div class="testimonial-form-label">Testimoni</div>
                                <textarea name="pesan_testimoni" class="form-control form-control-sm" rows="3" placeholder="Ceritakan pengalaman Anda dengan produk ini" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary btn-sm btn-submit">
                                    Kirim testimoni
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(($testimoni ?? collect())->count())
                <div class="owl-carousel testimonial-carousel">
                    @foreach($testimoni as $t)
                        @php
                            $foto = !empty($t->path_foto)
                                ? asset('storage/'.$t->path_foto)
                                : asset('frontend/img/testimonial-1.jpg');
                            $rating = (int)($t->rating ?? 5);
                        @endphp
                        <div class="testimonial-item">
                            <div class="d-flex align-items-center mb-3">
                                <img class="img-fluid rounded" src="{{ $foto }}" alt="{{ $t->nama_klien }}" style="width:56px;height:56px;object-fit:cover;">
                                <div class="ml-3 text-left">
                                    <h4 class="mb-1">{{ $t->nama_klien }}</h4>
                                    <i class="text-muted">{{ $t->profesi ?: 'Pelanggan' }}</i>
                                    <div class="text-warning small mt-1">
                                        @for($i=1;$i<=5;$i++)
                                            {!! $i <= $rating ? '&#9733;' : '&#9734;' !!}
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            @if(!empty($t->pesan_testimoni))
                                <p class="m-0">{{ $t->pesan_testimoni }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted mb-0">
                    Belum ada testimoni khusus untuk produk ini.
                </p>
            @endif
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
            <p class="mb-2 text-white">Copyright &copy; 2025 <a class="font-weight-bold" href="#"> Viola Restu</a>. All Rights Reserved.</a></p>
        </div>
    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var container = document.querySelector('.rating-stars');
            if (!container) return;
            var stars = container.querySelectorAll('.rating-star');
            var inputId = container.getAttribute('data-input-id');
            var input = document.getElementById(inputId);
            if (!input) return;
            function setRating(value) {
                input.value = value;
                stars.forEach(function (star) {
                    var starValue = parseInt(star.getAttribute('data-value'), 10);
                    if (starValue <= value) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                });
            }
            stars.forEach(function (star) {
                star.addEventListener('click', function () {
                    var value = parseInt(this.getAttribute('data-value'), 10);
                    if (!isNaN(value)) {
                        setRating(value);
                    }
                });
            });
        });
    </script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('frontend/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('frontend/mail/contact.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>
