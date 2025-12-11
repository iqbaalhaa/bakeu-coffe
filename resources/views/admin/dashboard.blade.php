@extends('layouts.master')

@section('title', 'Dashboard - Bakeu Coffee')

@section('content')
    <div class="py-4 px-3">
        <h2 class="h4 mb-4">Dashboard</h2>

        <div class="row">
            {{-- Di sini kamu bisa taruh card ringkasan: total produk, pesan, dsb --}}
            {{-- Untuk awal boleh kosong dulu / simple text --}}
            <div class="col-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="mb-1">Selamat datang, {{ auth()->user()->name ?? 'Admin' }}</h5>
                        <p class="mb-0 text-muted">
                            Ini adalah panel admin Bakeu Coffee. Dari sini Anda bisa mengelola profil usaha, produk,
                            media sosial, dan pesan pengunjung.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
