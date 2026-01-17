@extends('layouts.master')

@section('title', 'Testimoni - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Testimoni</h2>
        <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary">
            + Tambah Testimoni
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body">
            @if($daftarTestimoni->isEmpty())
                <p class="mb-0">Belum ada testimoni. Silakan tambah testimoni pelanggan.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Klien</th>
                                <th>Produk</th>
                                <th>Rating</th>
                                <th>Cuplikan Pesan</th>
                                <th class="text-end">Status & Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarTestimoni as $t)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-flex align-items-center gap-2">
                                        @if($t->path_foto)
                                            <img src="{{ asset('storage/'.$t->path_foto) }}"
                                                 alt="{{ $t->nama_klien }}"
                                                 class="rounded-circle"
                                                 style="width:32px;height:32px;object-fit:cover;">
                                        @endif
                                        <div class="d-flex flex-column">
                                            <span>{{ $t->nama_klien }}</span>
                                            @if($t->profesi)
                                                <small class="text-muted">{{ $t->profesi }}</small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if($t->produk)
                                            <span class="badge bg-secondary text-white">
                                                {{ $t->produk->nama_produk }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($t->rating)
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $t->rating)
                                                    <span class="text-warning">★</span>
                                                @else
                                                    <span class="text-muted">☆</span>
                                                @endif
                                            @endfor
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ \Illuminate\Support\Str::limit($t->pesan_testimoni, 60) }}</td>
                                    <td class="text-end">
                                        @if($t->status_aktif)
                                            <span class="badge bg-success me-2">Aktif</span>
                                        @else
                                            @if($t->produk_id)
                                                <span class="badge bg-warning text-dark me-2">Menunggu</span>
                                            @else
                                                <span class="badge bg-secondary me-2">Nonaktif</span>
                                            @endif
                                        @endif
                                        <form action="{{ route('admin.testimoni.toggle-status', $t) }}"
                                              method="POST"
                                              class="d-inline">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-sm {{ $t->status_aktif ? 'btn-outline-secondary' : 'btn-outline-success' }}">
                                                {{ $t->status_aktif ? 'Off' : 'On' }}
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.testimoni.edit', $t) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.testimoni.destroy', $t) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus testimoni ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Del
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
