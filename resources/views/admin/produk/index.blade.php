@extends('layouts.master')

@section('title', 'Produk - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Produk</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">Tambah Produk</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Favorit</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($daftarProduk as $p)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if($p->path_gambar)
                                            <img src="{{ asset('storage/'.$p->path_gambar) }}" alt="{{ $p->nama_produk }}" style="height:40px;width:40px;object-fit:cover;border-radius:6px;" class="me-2">
                                        @else
                                            <img src="{{ asset('frontend/img/menu-1.jpg') }}" alt="Placeholder" style="height:40px;width:40px;object-fit:cover;border-radius:6px;" class="me-2">
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $p->nama_produk }}</div>
                                            <div class="text-muted small">{{ Str::limit($p->deskripsi_singkat, 60) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $p->kategori ?? '-' }}</td>
                                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($p->status_aktif)
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    @if($p->ditandai_favorit)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @else
                                        <i class="bi bi-star text-muted"></i>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('admin.produk.edit', $p) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('admin.produk.destroy', $p) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $daftarProduk->links() }}
        </div>
    </div>
</div>
@endsection
