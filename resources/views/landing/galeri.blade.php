<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Galeri - Bakeu Coffee</title>
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
        .gallery-card {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .gallery-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.18);
        }
        .gallery-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
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
                    <a href="{{ url('/#tentang') }}" class="nav-item nav-link">Tentang Kami</a>
                    <a href="{{ route('produk.index') }}" class="nav-item nav-link {{ request()->routeIs('produk.*') ? 'active' : '' }}">Produk</a>
                    <a href="{{ route('galeri.index') }}" class="nav-item nav-link {{ request()->routeIs('galeri.index') ? 'active' : '' }}">Galeri</a>
                    <a href="{{ url('/#footer') }}" class="nav-item nav-link">Kontak</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="navbar-spacer"></div>

    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Galeri</h4>
                <h1 class="display-4 fw-bold">Album Foto & Video Bakeu Coffee</h1>
                <p class="text-muted mt-3">
                    Pilih album untuk melihat kumpulan foto atau video di dalamnya.
                </p>
            </div>

            <div class="row">
                @forelse($albums as $album)
                    <div class="col-md-4 mb-4">
                        <button type="button"
                                class="btn p-0 w-100 text-left border-0 bg-transparent"
                                data-toggle="modal"
                                data-target="#albumModal{{ $album->id }}"
                                data-bs-toggle="modal"
                                data-bs-target="#albumModal{{ $album->id }}">
                            <div class="gallery-card">
                                <img src="{{ $album->cover_path ? asset('storage/'.$album->cover_path) : asset('frontend/img/menu-1.jpg') }}" alt="{{ $album->judul }}" class="gallery-image">
                                <div class="p-3 bg-white">
                                    <h5 class="mb-1 text-truncate">{{ $album->judul }}</h5>
                                    <div class="small text-muted">
                                        {{ $album->deskripsi }}
                                    </div>
                                    <div class="small text-primary mt-1">
                                        {{ $album->items->count() }} konten
                                    </div>
                                </div>
                            </div>
                        </button>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Belum ada album galeri yang ditambahkan.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @foreach($albums as $album)
        <div class="modal fade" id="albumModal{{ $album->id }}" tabindex="-1" role="dialog" aria-labelledby="albumModalLabel{{ $album->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="albumModalLabel{{ $album->id }}">{{ $album->judul }}</h5>
                        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted">{{ $album->deskripsi }}</p>
                        <div class="row">
                            @foreach($album->items as $item)
                                <div class="col-md-6 mb-3">
                                    @if($item->tipe === 'image' && $item->path_file)
                                        <img src="{{ asset('storage/'.$item->path_file) }}" alt="{{ $item->judul ?? $album->judul }}" class="img-fluid rounded mb-2">
                                    @else
                                        @if($item->url_video)
                                            <div class="embed-responsive embed-responsive-16by9 mb-2">
                                                <iframe class="embed-responsive-item" src="{{ $item->url_video }}" allowfullscreen></iframe>
                                            </div>
                                        @endif
                                    @endif
                                    @if(!empty($item->judul))
                                        <div class="small text-muted">{{ $item->judul }}</div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="container-fluid footer text-white mt-5 pt-5 px-0 position-relative overlay-top" id="footer">
        <div class="row mx-0 pt-5 px-sm-3 px-lg-5 mt-4">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-white text-uppercase mb-4" style="letter-spacing: 3px;">Hubungi Kami</h4>
                <p><i class="fa fa-map-marker-alt mr-2"></i>{{ $profil->alamat_lengkap ?? '-' }}</p>
                <p><i class="fa fa-phone-alt mr-2"></i>{{ $profil->no_telepon ?? '-' }}</p>
                <p><i class="fa fa-envelope mr-2"></i>{{ $profil->email ?? '-' }}</p>
            </div>
        </div>
        <div class="text-center py-3" style="background: rgba(0,0,0,0.7);">
            <small>&copy; {{ date('Y') }} {{ $profil->nama_usaha ?? 'Bakeu Coffee' }}. All Rights Reserved.</small>
        </div>
    </div>

    {{-- JavaScript Libraries (mengikuti landing.index) --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    {{-- Contact & template JS (opsional, sama seperti landing utama) --}}
    <script src="{{ asset('frontend/mail/jqBootstrapValidation.min.js') }}"></script>
    <script src="{{ asset('frontend/mail/contact.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>
</html>
