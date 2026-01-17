@extends('layouts.master')

@section('title', 'Galeri - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Galeri</h2>
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">
            + Tambah Album
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body">
            @if($daftarAlbum->isEmpty())
                <p class="mb-0">Belum ada album galeri. Silakan tambah album untuk menampilkan foto atau video.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Judul Album</th>
                                <th>Deskripsi</th>
                                <th>Cover</th>
                                <th>Jumlah Item</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarAlbum as $album)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $album->judul }}</td>
                                    <td>{{ \Illuminate\Support\Str::limit($album->deskripsi, 60) }}</td>
                                    <td>
                                        @if($album->cover_path)
                                            <img src="{{ asset('storage/'.$album->cover_path) }}" alt="Cover" style="height:50px;border-radius:8px;">
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $album->items()->count() }}</td>
                                    <td>{{ $album->urutan_tampil ?? '-' }}</td>
                                    <td>
                                        @if($album->status_aktif)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.galeri.edit', $album) }}" class="btn btn-sm btn-outline-primary">
                                            Kelola
                                        </a>
                                        <form action="{{ route('admin.galeri.destroy', $album) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus album ini beserta semua itemnya?');">
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

