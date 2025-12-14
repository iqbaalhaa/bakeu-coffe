@extends('layouts.master')

@section('title', 'Dashboard - Bakeu Coffee')

@section('content')
    <div class="py-4 px-3">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
            <div>
                <h2 class="h4 mb-1">Dashboard</h2>
                <p class="mb-0 text-muted">
                    Selamat datang, {{ auth()->user()->name ?? 'Admin' }}.
                    Ringkasan singkat aktivitas di Bakeu Coffee.
                </p>
            </div>
        </div>

        {{-- Ringkasan kartu kecil --}}
        <div class="row">
            <div class="col-6 col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-shape icon-sm rounded bg-primary text-white mr-3">
                            <i class="bi bi-cup-hot"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Total Produk</span>
                            <h4 class="mb-0">{{ $totalProduk ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-shape icon-sm rounded bg-success text-white mr-3">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Produk Aktif</span>
                            <h4 class="mb-0">{{ $totalProdukAktif ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-shape icon-sm rounded bg-warning text-white mr-3">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Produk Favorit</span>
                            <h4 class="mb-0">{{ $totalFavorit ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="icon-shape icon-sm rounded bg-info text-white mr-3">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Pesan Pengunjung</span>
                            <h4 class="mb-0">{{ $totalPesan ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Chart --}}
        <div class="row mt-3">
            <div class="col-lg-8 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Perkembangan Produk</h5>
                            <small class="text-muted">Jumlah produk yang ditambahkan per bulan</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="produkChart" height="140"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header border-0">
                        <h5 class="mb-0">Ringkasan Pesan Pengunjung</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="pesanChart" height="210"></canvas>

                        <ul class="list-unstyled mt-3 mb-0 small">
                            <li class="d-flex justify-content-between">
                                <span>Hari ini</span>
                                <strong>{{ $totalPesanHariIni ?? 0 }} pesan</strong>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>7 hari terakhir</span>
                                <strong>{{ $totalPesan7Hari ?? 0 }} pesan</strong>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>30 hari terakhir</span>
                                <strong>{{ $totalPesan30Hari ?? 0 }} pesan</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Info singkat di bawah (opsional) --}}
        <div class="row mt-3">
            <div class="col-lg-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="mb-2">Tips Penggunaan</h5>
                        <p class="mb-1 text-muted small">
                            • Tambahkan produk baru secara rutin agar katalog tetap up to date.
                        </p>
                        <p class="mb-1 text-muted small">
                            • Balas pesan pengunjung melalui WhatsApp / kontak resmi yang tertera di profil usaha.
                        </p>
                        <p class="mb-0 text-muted small">
                            • Perbarui profil usaha (alamat, legalitas, jam buka) jika ada perubahan.
                        </p>
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
                        label: 'Produk per Bulan',
                        data: produkData,
                        fill: false,
                        tension: 0.3,
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        }

        const ctxPesan = document.getElementById('pesanChart');
        if (ctxPesan) {
            const pesanData = @json($pesanDataArr);

            new Chart(ctxPesan, {
                type: 'bar',
                data: {
                    labels: ['Hari ini', '7 hari', '30 hari'],
                    datasets: [{
                        label: 'Jumlah Pesan',
                        data: pesanData,
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        }
    </script>
@endpush
