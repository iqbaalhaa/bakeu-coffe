@extends('layouts.master')

@section('title', 'Dashboard - Bakeu Coffee')

@section('content')
    <style>
        .card-hover-effect {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
        }
        .icon-shape-lg {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #262b40 0%, #10b981 100%);
        }
        .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); color: #0d6efd; }
        .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); color: #198754; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; }
        .bg-soft-info    { background-color: rgba(13, 202, 240, 0.1); color: #0dcaf0; }
    </style>

    <div class="py-4">
        {{-- Welcome Banner --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow overflow-hidden text-white" style="background: linear-gradient(to right, #1f2937, #111827);">
                    <div class="card-body p-4 p-md-5 position-relative">
                        <div class="d-flex justify-content-between align-items-center position-relative z-2">
                            <div>
                                <h2 class="h3 fw-bold mb-2">Halo, {{ auth()->user()->name ?? 'Admin' }}! 👋</h2>
                                <p class="mb-0 text-white-50 fs-5">Selamat datang kembali di Panel Admin Bakeu Coffee.</p>
                                <p class="mb-0 text-white-50 small mt-2">Kelola produk, pantau pesan, dan lihat statistik toko Anda di sini.</p>
                            </div>
                            <div class="d-none d-md-block opacity-50">
                                <i class="bi bi-shop text-white" style="font-size: 5rem;"></i>
                            </div>
                        </div>
                        {{-- Decorative circles --}}
                        <div class="position-absolute top-0 end-0 rounded-circle bg-white" style="width: 250px; height: 250px; margin-top: -50px; margin-right: -50px; opacity: 0.1;"></div>
                        <div class="position-absolute bottom-0 start-0 rounded-circle bg-primary" style="width: 250px; height: 150px; margin-bottom: -50px; margin-left: -50px; opacity: 0.1;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ringkasan kartu kecil --}}
        <div class="row g-4 mb-4">
            {{-- Total Produk --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 card-hover-effect">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="icon-shape-lg bg-soft-primary me-3">
                            <i class="bi bi-cup-hot fs-3"></i>
                        </div>
                        <div>
                            <span class="text-muted small text-uppercase fw-bold ls-1">Total Produk</span>
                            <h3 class="mb-0 fw-bold mt-1">{{ $totalProduk ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Produk Aktif --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 card-hover-effect">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="icon-shape-lg bg-soft-success me-3">
                            <i class="bi bi-bag-check fs-3"></i>
                        </div>
                        <div>
                            <span class="text-muted small text-uppercase fw-bold ls-1">Produk Aktif</span>
                            <h3 class="mb-0 fw-bold mt-1">{{ $totalProdukAktif ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Produk Favorit --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 card-hover-effect">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="icon-shape-lg bg-soft-warning me-3">
                            <i class="bi bi-star-fill fs-3"></i>
                        </div>
                        <div>
                            <span class="text-muted small text-uppercase fw-bold ls-1">Produk Favorit</span>
                            <h3 class="mb-0 fw-bold mt-1">{{ $totalFavorit ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pesan Pengunjung --}}
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm h-100 card-hover-effect">
                    <div class="card-body d-flex align-items-center p-4">
                        <div class="icon-shape-lg bg-soft-info me-3">
                            <i class="bi bi-chat-dots fs-3"></i>
                        </div>
                        <div>
                            <span class="text-muted small text-uppercase fw-bold ls-1">Pesan Masuk</span>
                            <h3 class="mb-0 fw-bold mt-1">{{ $totalPesan ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart Section --}}
        <div class="row g-4">
            {{-- Grafik Perkembangan Produk --}}
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-0 bg-white pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="fw-bold mb-1">Statistik Produk</h5>
                            <p class="text-muted small mb-0">Tren penambahan produk setiap bulan</p>
                        </div>
                        <div class="dropdown">
                            <i class="bi bi-graph-up text-primary fs-4"></i>
                        </div>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div style="height: 300px;">
                            <canvas id="produkChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Pesan --}}
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-0 bg-white pt-4 px-4 pb-0">
                        <h5 class="fw-bold mb-1">Aktivitas Pesan</h5>
                        <p class="text-muted small mb-0">Ringkasan pesan pengunjung</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div style="height: 200px;" class="mb-4">
                            <canvas id="pesanChart"></canvas>
                        </div>

                        <div class="vstack gap-3">
                            <div class="d-flex align-items-center justify-content-between p-3 rounded bg-light">
                                <div class="d-flex align-items-center">
                                    <span class="dot bg-primary me-2 rounded-circle" style="width:10px; height:10px;"></span>
                                    <span class="text-muted small">Hari ini</span>
                                </div>
                                <span class="fw-bold text-dark">{{ $totalPesanHariIni ?? 0 }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 rounded bg-light">
                                <div class="d-flex align-items-center">
                                    <span class="dot bg-success me-2 rounded-circle" style="width:10px; height:10px;"></span>
                                    <span class="text-muted small">7 Hari Terakhir</span>
                                </div>
                                <span class="fw-bold text-dark">{{ $totalPesan7Hari ?? 0 }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between p-3 rounded bg-light">
                                <div class="d-flex align-items-center">
                                    <span class="dot bg-info me-2 rounded-circle" style="width:10px; height:10px;"></span>
                                    <span class="text-muted small">30 Hari Terakhir</span>
                                </div>
                                <span class="fw-bold text-dark">{{ $totalPesan30Hari ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tips Section --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm bg-primary text-white overflow-hidden">
                    <div class="card-body p-4 position-relative">
                        <div class="row align-items-center position-relative z-2">
                            <div class="col-auto">
                                <div class="bg-white bg-opacity-25 rounded-circle p-3">
                                    <i class="bi bi-lightbulb fs-3 text-white"></i>
                                </div>
                            </div>
                            <div class="col">
                                <h5 class="fw-bold mb-1">Tips Mengelola Toko</h5>
                                <p class="mb-0 text-white-50 small">
                                    Pastikan katalog produk selalu up-to-date dan balas pesan pelanggan sesegera mungkin untuk meningkatkan kepercayaan.
                                    Lengkapi profil usaha Anda agar pengunjung mudah menemukan lokasi dan informasi kontak.
                                </p>
                            </div>
                        </div>
                         {{-- Decoration --}}
                         <i class="bi bi-stars position-absolute text-white opacity-10" style="font-size: 8rem; right: -20px; bottom: -30px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        @php
            $produkLabels = $produkChart['labels'] ?? [];
            $produkData   = $produkChart['data'] ?? [];
            $pesanDataArr = [
                $totalPesanHariIni ?? 0,
                $totalPesan7Hari ?? 0,
                $totalPesan30Hari ?? 0,
            ];
        @endphp
        // Data dari controller (pastikan variabel ada)
        const produkLabels = @json($produkLabels);
        const produkData   = @json($produkData);

        const ctxProduk = document.getElementById('produkChart');
        if (ctxProduk) {
            new Chart(ctxProduk, {
                type: 'line',
                data: {
                    labels: produkLabels,
                    datasets: [{
                        label: 'Produk Baru',
                        data: produkData,
                        fill: true,
                        backgroundColor: 'rgba(13, 110, 253, 0.1)',
                        borderColor: '#0d6efd',
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#0d6efd',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            titleFont: { size: 13 },
                            bodyFont: { size: 13 },
                            cornerRadius: 8,
                            displayColors: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0,
                            grid: {
                                borderDash: [2, 4],
                                color: '#e5e7eb',
                                drawBorder: false
                            },
                            ticks: {
                                padding: 10,
                                font: { size: 11 }
                            }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                padding: 10,
                                font: { size: 11 }
                            }
                        }
                    }
                }
            });
        }

        const ctxPesan = document.getElementById('pesanChart');
        if (ctxPesan) {
            const pesanData = @json($pesanDataArr);

            new Chart(ctxPesan, {
                type: 'doughnut',
                data: {
                    labels: ['Hari ini', '7 hari', '30 hari'],
                    datasets: [{
                        data: pesanData,
                        backgroundColor: [
                            '#0d6efd', // Primary
                            '#198754', // Success
                            '#0dcaf0'  // Info
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1f2937',
                            padding: 12,
                            cornerRadius: 8
                        }
                    }
                }
            });
        }
    </script>
@endpush
