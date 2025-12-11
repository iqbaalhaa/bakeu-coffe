@extends('layouts.master')

@section('title', 'Highlight - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Highlight</h2>
        <a href="{{ route('admin.highlight.create') }}" class="btn btn-primary">
            + Tambah Highlight
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="mb-4">
                <div class="p-3 bg-light rounded">
                    <h6 class="mb-3">Preview di Landing</h6>
                    <div class="row">
                        @forelse($daftarHighlight as $h)
                            <div class="col-md-4 mb-3">
                                <h5 class="mb-2">
                                    <i class="{{ $h->ikon_css ?? 'fa fa-star' }} text-{{ $h->warna_tema ?? 'primary' }} me-2"></i>
                                    {{ $h->judul }}
                                </h5>
                                @if($h->deskripsi)
                                    <p class="mb-0">{{ $h->deskripsi }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="col-12 text-muted">Belum ada highlight untuk ditampilkan.</div>
                        @endforelse
                    </div>
                </div>
            </div>
            @if($daftarHighlight->isEmpty())
                <p class="mb-0">Belum ada data highlight. Silakan tambah beberapa highlight untuk ditampilkan di landing page.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Ikon</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarHighlight as $h)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $h->judul }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($h->deskripsi, 60) }}</td>
                                    <td>{{ $h->kategori ?: '-' }}</td>
                                    <td>
                                        @if($h->ikon_css)
                                            <code>{{ $h->ikon_css }}</code>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $h->urutan_tampil ?? '-' }}</td>
                                    <td>
                                        @if($h->status_aktif)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.highlight.edit', $h) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.highlight.destroy', $h) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus highlight ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
