@extends('layouts.master')

@section('title', 'Media Sosial - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Media Sosial</h2>
        <a href="{{ route('admin.media-sosial.create') }}" class="btn btn-primary">
            + Tambah Media Sosial
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body">
            @if($daftarMediaSosial->isEmpty())
                <p class="mb-0">Belum ada data media sosial. Silakan tambahkan akun media sosial usaha.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Platform</th>
                                <th>Nama Tampilan</th>
                                <th>URL</th>
                                <th>Ikon</th>
                                <th>Urutan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarMediaSosial as $ms)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ms->nama_platform }}</td>
                                    <td>{{ $ms->nama_tampilan ?: '-' }}</td>
                                    <td>
                                        <a href="{{ $ms->url }}" target="_blank">
                                            {{ \Illuminate\Support\Str::limit($ms->url, 40) }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($ms->ikon_css)
                                            <code>{{ $ms->ikon_css }}</code>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $ms->urutan_tampil ?? '-' }}</td>
                                    <td>
                                        @if($ms->status_aktif)
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.media-sosial.edit', $ms) }}" class="btn btn-sm btn-outline-primary">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.media-sosial.destroy', $ms) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
