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
        .product-card {
            border-radius: 1rem;
            transition: all 0.2s ease-in-out;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.10);
        }

        .product-image {
            height: 190px;
            object-fit: cover;
            transition: transform 0.3s ease;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .product-ribbon {
            position: absolute;
            top: 12px;
            left: -40px;
            background: #ffc107;
            color: #000;
            padding: 4px 40px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            transform: rotate(-45deg);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .product-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 4px 8px;
            border-radius: 999px;
            opacity: 0.95;
        }

        /* Highlight cards inside dark overlay section */
        .highlight-card {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 1rem;
            transition: all 0.25s ease;
            backdrop-filter: blur(3px);
        }
        .highlight-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }
        .highlight-icon {
            width: 42px;
            height: 42px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
        }
        .highlight-badge {
            background: rgba(0,0,0,0.35);
            border: 1px solid rgba(255,255,255,0.2);
        }
    </style>
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="/" class="navbar-brand px-lg-4 m-0 d-flex align-items-center">
                <img src="{{ isset($profil) && $profil->path_logo ? asset('storage/'.$profil->path_logo) : asset('frontend/img/logobakeu.jpeg') }}" alt="Logo" class="mr-2" style="height: 50px; border-radius: 15px">
                <h1 class="m-0 display-6 text-uppercase text-white">{{ $profil->nama_usaha ?? 'BAKEU COFFEE' }}</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="index.html" class="nav-item nav-link active">Beranda</a>
                    <a href="about.html" class="nav-item nav-link">Tentang Kami</a>
                    <a href="menu.html" class="nav-item nav-link">Produk</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu text-capitalize">
                            <a href="reservation.html" class="dropdown-item">Reservation</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        </div>
                    </div> --}}
                    <a href="contact.html" class="nav-item nav-link">Kontak</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('frontend/img/carousel-1.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">{{ $profil->slogan ?? 'Authentic Local Coffee from Sungai Penuh & Kerinci' }}</h2>
                        <h1 class="display-4 text-white m-0">{{ $profil->nama_usaha ?? 'BAKEU COFFEE' }}</h1>
                        <h2 class="text-white m-0">{{ $profil->subjudul_hero ?? 'Freshly Roasted · Premium Beans · Crafted with Passion' }}</h2>
                        <div class="mt-4 d-flex">
                            <a href="{{ $profil->tautan_tombol_lihat_produk ?? 'menu.html' }}" class="btn btn-primary btn-lg px-4">{{ $profil->teks_tombol_lihat_produk ?? 'Lihat Produk' }}</a>
                            <a href="{{ isset($profil->no_whatsapp) ? 'https://wa.me/'.preg_replace('/\D/', '', $profil->no_whatsapp) : 'https://wa.me/6281234567890' }}" target="_blank" rel="noopener" class="btn btn-outline-light btn-lg px-4 ml-3">{{ $profil->teks_tombol_whatsapp ?? 'Pesan via WhatsApp' }}</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('frontend/img/carousel-2.jpg') }}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class="text-primary font-weight-medium m-0">{{ $profil->slogan ?? 'Authentic Local Coffee from Sungai Penuh & Kerinci' }}</h2>
                        <h1 class="display-3 text-white m-0">{{ $profil->nama_usaha ?? 'BAKEU COFFEE' }}</h1>
                        <h2 class="text-white m-0">{{ $profil->subjudul_hero ?? 'Freshly Roasted · Premium Beans · Crafted with Passion' }}</h2>
                        <div class="mt-4 d-flex">
                            <a href="{{ $profil->tautan_tombol_lihat_produk ?? 'menu.html' }}" class="btn btn-primary btn-lg px-4">{{ $profil->teks_tombol_lihat_produk ?? 'Lihat Produk' }}</a>
                            <a href="{{ isset($profil->no_whatsapp) ? 'https://wa.me/'.preg_replace('/\D/', '', $profil->no_whatsapp) : 'https://wa.me/6281234567890' }}" target="_blank" rel="noopener" class="btn btn-outline-light btn-lg px-4 ml-3">{{ $profil->teks_tombol_whatsapp ?? 'Pesan via WhatsApp' }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang Kami</h4>
            </div>
            <div class="row">
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Sejarah</h1>
                    <h5 class="mb-3">{{ $profil->nama_usaha ?? 'Bakeu Coffee' }}</h5>
                    <p>{{ $profil->sejarah ?? 'Bakeu Coffee adalah UKM lokal yang berdiri sejak 2018 di Kota Sungai Penuh, Kerinci. Kami memproduksi berbagai varian kopi lokal berkualitas, diolah secara higienis, dan dipasarkan melalui media digital dan event pameran daerah hingga tingkat provinsi.' }}</p>
                </div>
                <div class="col-lg-4 py-5 py-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('frontend/img/about.png') }}" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-4 py-0 py-lg-5">
                    <h1 class="mb-3">Visi & Misi</h1>
                    <p>{{ $profil->visi ?? 'Menyediakan kopi lokal berkualitas tinggi dari daerah Kerinci, memperluas jangkauan pasar secara digital, serta berkontribusi pada perekonomian lokal melalui inovasi produk dan pemberdayaan masyarakat sekitar.' }}</p>
                    @php
                        $misiList = isset($profil) && $profil->misi ? preg_split('/\r?\n/', $profil->misi) : [];
                    @endphp
                    @if(!empty($misiList))
                        @foreach($misiList as $m)
                            @if(trim($m) !== '')
                                <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>{{ $m }}</h5>
                            @endif
                        @endforeach
                    @else
                        <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Menjadi UKM kopi unggulan dari Sungai Penuh & Kerinci.</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Memperkenalkan kopi lokal ke pasar nasional.</h5>
                        <h5 class="mb-3"><i class="fa fa-check text-primary mr-3"></i>Menghadirkan produk berkualitas untuk semua kalangan.</h5>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <section id="highlight" class="py-5">
      <div class="offer container-fluid my-5 py-5 text-center position-relative overlay-top overlay-bottom">
        <div class="container text-center text-white">
          <div class="p-5">
            <h2 class="mb-3 text-white">Highlight Bakeu Coffee</h2>
            <p class="mb-5 text-white">Mengenal lebih dekat produk, aktivitas, dan prestasi UMKM Bakeu Coffee.</p>

            @if(isset($highlights) && $highlights->count())
              <div class="row">
                @foreach($highlights as $h)
                  <div class="col-12 col-md-6 col-lg-4 mb-4">
                    <div class="card highlight-card h-100 border-0">
                      <div class="card-body text-start text-white">
                        <div class="d-flex align-items-center mb-2">
                          <span class="highlight-icon me-2">
                            <i class="{{ $h->ikon_css ?? 'fa fa-star' }} text-{{ $h->warna_tema ?? 'primary' }}" style="font-size:1.1rem;"></i>
                          </span>
                          <h5 class="mb-0 text-white">{{ $h->judul }}</h5>
                        </div>
                        @if($h->deskripsi)
                          <p class="mb-0">{{ $h->deskripsi }}</p>
                        @endif
                        @if(!empty($h->kategori))
                          <span class="badge highlight-badge text-white mt-3">{{ ucfirst($h->kategori) }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @else
              <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                  <div class="card highlight-card h-100 border-0">
                    <div class="card-body text-start text-white">
                      <div class="d-flex align-items-center mb-2">
                        <span class="highlight-icon me-2"><i class="fa fa-coffee text-warning" style="font-size:1.1rem;"></i></span>
                        <h5 class="mb-0 text-white">Produk Unggulan</h5>
                      </div>
                      <ul class="list-unstyled mt-3 mb-0">
                        <li><strong>Kopi Arabika Kerinci</strong><br> Kopi pilihan dari dataran tinggi Kerinci dengan aroma khas.</li>
                        <li class="mt-3"><strong>Kopi Susu Kekinian</strong><br> Racikan kopi susu dalam kemasan praktis siap minum.</li>
                        <li class="mt-3"><strong>Snack Pendamping Kopi</strong><br> Aneka kue kering rumahan sebagai teman ngopi.</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                  <div class="card highlight-card h-100 border-0">
                    <div class="card-body text-start text-white">
                      <div class="d-flex align-items-center mb-2">
                        <span class="highlight-icon me-2"><i class="fa fa-users text-info" style="font-size:1.1rem;"></i></span>
                        <h5 class="mb-0 text-white">Aktivitas UMKM</h5>
                      </div>
                      <ul class="list-unstyled mt-3 mb-0">
                        <li><strong>Pameran & Bazar</strong><br> Aktif ikut pameran UMKM tingkat kota, kabupaten, dan provinsi.</li>
                        <li class="mt-3"><strong>Pelatihan Usaha</strong><br> Mengikuti pelatihan pengolahan kopi & pemasaran digital.</li>
                        <li class="mt-3"><strong>Kolaborasi Lokal</strong><br> Bekerja sama dengan petani kopi & komunitas sekitar.</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 mb-4">
                  <div class="card highlight-card h-100 border-0">
                    <div class="card-body text-start text-white">
                      <div class="d-flex align-items-center mb-2">
                        <span class="highlight-icon me-2"><i class="fa fa-trophy text-primary" style="font-size:1.1rem;"></i></span>
                        <h5 class="mb-0 text-white">Prestasi</h5>
                      </div>
                      <ul class="list-unstyled mt-3 mb-0">
                        <li><strong>Legalitas Usaha</strong><br> Memiliki NIB, izin PIRT, dan sertifikasi pendukung lainnya.</li>
                        <li class="mt-3"><strong>Penghargaan</strong><br> Pernah mengikuti dan meraih prestasi di ajang UMKM.</li>
                        <li class="mt-3"><strong>Kepercayaan Pelanggan</strong><br> Menjadi pilihan konsumen di Sungai Penuh dan sekitarnya.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
        </div>
      </div>
    </section>


    <!-- Produk Start -->
    <div class="container-fluid pt-5" id="produk">
        <div class="container">
            <div class="section-title text-center mb-5">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Produk & Harga</h4>
                <h1 class="display-4 fw-bold">Harga Kompetitif</h1>
                <p class="text-muted mt-3">
                    Nikmati racikan kopi lokal terbaik dari Bakeu Coffee dengan harga yang tetap ramah di kantong.
                </p>
            </div>

            <div class="row g-4">
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
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ $img }}"
                                    alt="{{ $p->nama_produk }}"
                                    class="card-img-top product-image">

                                {{-- Ribbon Favorit --}}
                                @if($p->ditandai_favorit)
                                    <div class="product-ribbon">
                                        Favorit
                                    </div>
                                @endif

                                {{-- Badge Kategori --}}
                                @if($p->kategori)
                                    <span class="badge bg-dark text-white product-badge">
                                        {{ strtoupper($p->kategori) === 'HOT' ? 'Hot Coffee' : (strtoupper($p->kategori) === 'COLD' ? 'Cold Coffee' : ucfirst($p->kategori)) }}
                                    </span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-1 text-truncate">{{ $p->nama_produk }}</h5>
                                <p class="card-text text-muted small mb-3">
                                    {{ \Illuminate\Support\Str::limit($p->deskripsi_singkat, 80) }}
                                </p>

                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <div class="text-muted small">Harga</div>
                                            <div class="h5 mb-0 text-primary fw-bold">
                                                Rp {{ number_format($p->harga, 0, ',', '.') }}
                                            </div>
                                        </div>
                                        {{-- Rating dummy (kalau mau gaya e-commerce) --}}
                                        <div class="text-warning small">
                                            ★★★★☆
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <div class="d-flex justify-content-center w-100">
                                            <a href="{{ route('produk.show', ['produk' => $p->id, 'slug' => \Illuminate\Support\Str::slug($p->nama_produk)]) }}" class="btn btn-secondary rounded-pill px-4">Lihat Produk</a>
                                        </div>
                                        {{-- Tombol lihat detail kalau nanti mau pakai halaman produk --}}
                                        {{-- <a href="{{ route('produk.detail', $p->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="fa fa-eye"></i>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    @php
                        $placeholderProduk = [
                            [
                                'nama_produk' => 'Kopi Arabika Kerinci',
                                'harga' => 25000,
                                'kategori' => 'HOT',
                                'deskripsi_singkat' => 'Kopi pilihan dari dataran tinggi Kerinci dengan aroma khas.',
                                'img' => asset('frontend/img/menu-1.jpg'),
                            ],
                            [
                                'nama_produk' => 'Kopi Susu Kekinian',
                                'harga' => 22000,
                                'kategori' => 'COLD',
                                'deskripsi_singkat' => 'Racikan kopi susu dalam kemasan praktis siap minum.',
                                'img' => asset('frontend/img/menu-2.jpg'),
                            ],
                            [
                                'nama_produk' => 'Espresso Single Shot',
                                'harga' => 18000,
                                'kategori' => 'HOT',
                                'deskripsi_singkat' => 'Espresso pekat untuk energi instan.',
                                'img' => asset('frontend/img/menu-3.jpg'),
                            ],
                            [
                                'nama_produk' => 'Americano Dingin',
                                'harga' => 20000,
                                'kategori' => 'COLD',
                                'deskripsi_singkat' => 'Americano segar dengan es batu.',
                                'img' => asset('frontend/img/menu-4.jpg'),
                            ],
                            [
                                'nama_produk' => 'Latte Art',
                                'harga' => 28000,
                                'kategori' => 'HOT',
                                'deskripsi_singkat' => 'Latte creamy dengan seni latte art.',
                                'img' => asset('frontend/img/menu-5.jpg'),
                            ],
                            [
                                'nama_produk' => 'Snack Pendamping Kopi',
                                'harga' => 15000,
                                'kategori' => 'Snack',
                                'deskripsi_singkat' => 'Aneka kue kering rumahan sebagai teman ngopi.',
                                'img' => asset('frontend/img/menu-6.jpg'),
                            ],
                        ];
                    @endphp
                    @foreach($placeholderProduk as $item)
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ $item['img'] }}"
                                        alt="{{ $item['nama_produk'] }}"
                                        class="card-img-top product-image">

                                    @if(!empty($item['kategori']))
                                        <span class="badge bg-dark text-white product-badge">
                                            {{ strtoupper($item['kategori']) === 'HOT' ? 'Hot Coffee' : (strtoupper($item['kategori']) === 'COLD' ? 'Cold Coffee' : ucfirst($item['kategori'])) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1 text-truncate">{{ $item['nama_produk'] }}</h5>
                                    <p class="card-text text-muted small mb-3">
                                        {{ \Illuminate\Support\Str::limit($item['deskripsi_singkat'], 80) }}
                                    </p>

                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <div class="text-muted small">Harga</div>
                                                <div class="h5 mb-0 text-primary fw-bold">
                                                    Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="text-warning small">★★★★☆</div>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <div class="d-flex justify-content-center w-100">
                                                <a href="{{ route('produk.index') }}" class="btn btn-secondary rounded-pill px-4">Lihat Produk</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
                @php
                    $missing = isset($produk) ? max(0, 8 - $produk->count()) : 8;
                @endphp
                @if($missing > 0)
                    @php
                        $placeholderProduk = [
                            [
                                'nama_produk' => 'Kopi Arabika Kerinci',
                                'harga' => 25000,
                                'kategori' => 'HOT',
                                'deskripsi_singkat' => 'Kopi pilihan dari dataran tinggi Kerinci dengan aroma khas.',
                                'img' => asset('frontend/img/menu-1.jpg'),
                            ],
                            [
                                'nama_produk' => 'Kopi Susu Kekinian',
                                'harga' => 22000,
                                'kategori' => 'COLD',
                                'deskripsi_singkat' => 'Racikan kopi susu dalam kemasan praktis siap minum.',
                                'img' => asset('frontend/img/menu-2.jpg'),
                            ],
                            [
                                'nama_produk' => 'Espresso Single Shot',
                                'harga' => 18000,
                                'kategori' => 'HOT',
                                'deskripsi_singkat' => 'Espresso pekat untuk energi instan.',
                                'img' => asset('frontend/img/menu-3.jpg'),
                            ],
                            [
                                'nama_produk' => 'Americano Dingin',
                                'harga' => 20000,
                                'kategori' => 'COLD',
                                'deskripsi_singkat' => 'Americano segar dengan es batu.',
                                'img' => asset('frontend/img/menu-4.jpg'),
                            ],
                            [
                                'nama_produk' => 'Latte Art',
                                'harga' => 28000,
                                'kategori' => 'HOT',
                                'deskripsi_singkat' => 'Latte creamy dengan seni latte art.',
                                'img' => asset('frontend/img/menu-5.jpg'),
                            ],
                            [
                                'nama_produk' => 'Snack Pendamping Kopi',
                                'harga' => 15000,
                                'kategori' => 'Snack',
                                'deskripsi_singkat' => 'Aneka kue kering rumahan sebagai teman ngopi.',
                                'img' => asset('frontend/img/menu-6.jpg'),
                            ],
                        ];
                    @endphp
                    @for($i = 0; $i < $missing; $i++)
                        @php
                            $item = $placeholderProduk[$i % count($placeholderProduk)];
                        @endphp
                        <div class="col-6 col-md-4 col-lg-3 mb-4">
                            <div class="card product-card h-100 border-0 shadow-sm">
                                <div class="position-relative overflow-hidden">
                                    <img src="{{ $item['img'] }}"
                                         alt="{{ $item['nama_produk'] }}"
                                         class="card-img-top product-image">
                                    @if(!empty($item['kategori']))
                                        <span class="badge bg-dark text-white product-badge">
                                            {{ strtoupper($item['kategori']) === 'HOT' ? 'Hot Coffee' : (strtoupper($item['kategori']) === 'COLD' ? 'Cold Coffee' : ucfirst($item['kategori'])) }}
                                        </span>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title mb-1 text-truncate">{{ $item['nama_produk'] }}</h5>
                                    <p class="card-text text-muted small mb-3">{{ \Illuminate\Support\Str::limit($item['deskripsi_singkat'], 80) }}</p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                <div class="text-muted small">Harga</div>
                                                <div class="h5 mb-0 text-primary fw-bold">Rp {{ number_format($item['harga'], 0, ',', '.') }}</div>
                                            </div>
                                            <div class="text-warning small">★★★★☆</div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <div class="d-flex justify-content-center w-100">
                                                <a href="{{ route('produk.index') }}" class="btn btn-secondary rounded-pill px-4">Lihat Produk</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
                <div class="col-12 text-center mt-3">
                    <a href="{{ route('produk.index') }}" class="btn btn-primary btn-lg rounded-pill px-4 shadow-sm">
                        Lihat semua produk
                    </a>
                </div>
            </div>
            
        </div>
    </div>
    <!-- Produk End -->

    <!-- Contact Start (styled like overlay section) -->
    <div class="container-fluid my-5" id="kontak">
      <div class="container">
        <div class="reservation position-relative overlay-top overlay-bottom">
          <div class="p-5 text-white">
            <div class="section-title text-center mb-4">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Kontak</h4>
                <h1 class="display-4 text-white">Hubungi Kami</h1>
            </div>

            <div class="row g-4">
                <div class="col-lg-12">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('kontak.kirim') }}" method="POST">
                        @csrf
                        <input type="hidden" name="sumber_halaman" value="landing_page">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap"
                                   class="form-control @error('nama_lengkap') is-invalid @enderror"
                                   value="{{ old('nama_lengkap') }}" required>
                            @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email (opsional)</label>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. Telepon / WhatsApp (opsional)</label>
                            <input type="text" name="no_telepon"
                                   class="form-control @error('no_telepon') is-invalid @enderror"
                                   value="{{ old('no_telepon') }}">
                            @error('no_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subjek (opsional)</label>
                            <input type="text" name="subjek"
                                   class="form-control @error('subjek') is-invalid @enderror"
                                   value="{{ old('subjek') }}">
                            @error('subjek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="isi_pesan" rows="4"
                                      class="form-control @error('isi_pesan') is-invalid @enderror"
                                      required>{{ old('isi_pesan') }}</textarea>
                            @error('isi_pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary px-4">
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->

    <div class="container-fluid my-5">
      <div class="container">
        <div id="tentang">
          <div class="py-5">
            <div class="section-title text-center mb-4">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Tentang Kami</h4>
                <h1 class="display-4">Tentang Bakeu Coffee</h1>
            </div>

            <div class="row">
              <div class="col-md-4 mb-4">
                <h4>Profil Usaha</h4>
                <ul class="list-unstyled mt-3">
                  <li><strong>Nama Usaha:</strong> {{ $profil->nama_usaha ?? 'Bakeu Coffee' }}</li>
                  <li><strong>Tahun Berdiri:</strong> {{ $profil->tahun_berdiri ?? '20XX' }}</li>
                  <li><strong>Jenis Usaha:</strong> Produksi kopi & olahan</li>
                  <li><strong>Alamat Produksi:</strong> {{ $profil->alamat_lengkap ?? 'Kota Sungai Penuh, Kerinci' }}</li>
                  <li><strong>Legalitas:</strong> {{ $profil->informasi_legal ?? 'NIB, PIRT, (Halal jika sudah)' }}</li>
                </ul>
              </div>

              <div class="col-md-4 mb-4">
                <h4>Kontak Resmi</h4>
                <p class="mt-3 mb-2">Silakan hubungi kami melalui kontak berikut:</p>
                <ul class="list-unstyled">
                  <li><strong>WhatsApp:</strong> <a href="{{ isset($profil->no_whatsapp) ? 'https://wa.me/'.preg_replace('/\D/', '', $profil->no_whatsapp) : '#' }}">{{ $profil->no_whatsapp ?? '+62 xxx xxxx xxxx' }}</a></li>
                  <li><strong>Email:</strong> {{ $profil->email ?? 'info@bakeucoffee.com' }}</li>
                  <li><strong>Instagram:</strong> @bakeucoffee</li>
                  <li><strong>Facebook:</strong> Bakeu Coffee</li>
                  <li><strong>Lokasi:</strong> <a href="{{ $profil->tautan_google_maps ?? 'https://maps.google.com' }}">Lihat di Google Maps</a></li>
                </ul>
                <a href="{{ isset($profil->no_whatsapp) ? 'https://wa.me/'.preg_replace('/\D/', '', $profil->no_whatsapp) : '#' }}" class="btn btn-primary mt-3">Hubungi via WhatsApp</a>
              </div>

              <div class="col-md-4 mb-4">
                <h4>Arah Bisnis UMKM</h4>
                <p class="mt-3">Bakeu Coffee berkomitmen untuk terus berkembang sebagai salah satu UMKM unggulan di Kota Sungai Penuh.</p>
                <ul>
                  <li>Memperluas pemasaran ke tingkat provinsi dan nasional.</li>
                  <li>Menambah varian produk kopi kemasan dan olahan.</li>
                  <li>Membangun jaringan reseller dan mitra penjualan.</li>
                  <li>Memperkuat branding melalui pemasaran digital.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title">
                <h4 class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimoni</h4>
                <h1 class="display-4">Testimoni Pelanggan</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                @forelse(($testimoni ?? collect()) as $t)
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
                @empty
                    <div class="testimonial-item">
                        <div class="d-flex align-items-center mb-3">
                            <img class="img-fluid rounded" src="{{ asset('frontend/img/testimonial-1.jpg') }}" alt="">
                            <div class="ml-3 text-left">
                                <h4 class="mb-1">Client Name</h4>
                                <i class="text-muted">Profession</i>
                            </div>
                        </div>
                        <p class="m-0">Sed ea amet kasd elitr stet, stet rebum et ipsum est duo elitr eirmod clita lorem.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


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
