@extends('layouts.master')

@section('title', 'Pesan Pengunjung - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-3">Pesan Pengunjung</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            @if($daftarPesan->isEmpty())
                <p class="mb-0">Belum ada pesan dari pengunjung.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email / WA</th>
                                <th>Subjek</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($daftarPesan as $pesan)
                                <tr class="{{ $pesan->sudah_dibaca ? '' : 'table-warning' }}">
                                    <td>{{ $loop->iteration + ($daftarPesan->currentPage()-1) * $daftarPesan->perPage() }}</td>
                                    <td>{{ $pesan->nama_lengkap }}</td>
                                    <td>
                                        @if($pesan->email)
                                            <div class="small">
                                                <i class="bi bi-envelope-fill me-1"></i>{{ $pesan->email }}
                                            </div>
                                        @endif
                                        @if($pesan->no_telepon)
                                            <div class="small">
                                                <i class="bi bi-telephone-fill me-1"></i>{{ $pesan->no_telepon }}
                                            </div>
                                        @endif
                                        @if(!$pesan->email && !$pesan->no_telepon)
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td>{{ $pesan->subjek ?: '-' }}</td>
                                    <td>{{ $pesan->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if($pesan->sudah_dibaca)
                                            <span class="badge bg-success">Sudah dibaca</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum dibaca</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.pesan-pengunjung.show', $pesan) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Detail
                                        </a>
                                        <form action="{{ route('admin.pesan-pengunjung.destroy', $pesan) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
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

                {{ $daftarPesan->links() }}
            @endif
        </div>
    </div>
</div>
@endsection
