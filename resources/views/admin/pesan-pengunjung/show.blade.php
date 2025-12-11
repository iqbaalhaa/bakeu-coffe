@extends('layouts.master')

@section('title', 'Detail Pesan Pengunjung - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h4 mb-0">Detail Pesan Pengunjung</h2>
        <a href="{{ route('admin.pesan-pengunjung.index') }}" class="btn btn-outline-secondary btn-sm">
            « Kembali
        </a>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3">Nama</dt>
                <dd class="col-sm-9">{{ $pesan->nama_lengkap }}</dd>

                <dt class="col-sm-3">Email</dt>
                <dd class="col-sm-9">{{ $pesan->email ?: '-' }}</dd>

                <dt class="col-sm-3">No. Telepon / WA</dt>
                <dd class="col-sm-9">{{ $pesan->no_telepon ?: '-' }}</dd>

                <dt class="col-sm-3">Subjek</dt>
                <dd class="col-sm-9">{{ $pesan->subjek ?: '-' }}</dd>

                <dt class="col-sm-3">Tanggal Kirim</dt>
                <dd class="col-sm-9">{{ $pesan->created_at->format('d/m/Y H:i') }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">
                    @if($pesan->sudah_dibaca)
                        <span class="badge bg-success">Sudah dibaca</span>
                    @else
                        <span class="badge bg-warning text-dark">Belum dibaca</span>
                    @endif
                </dd>

                @if($pesan->sumber_halaman)
                    <dt class="col-sm-3">Sumber Halaman</dt>
                    <dd class="col-sm-9">{{ $pesan->sumber_halaman }}</dd>
                @endif

                <dt class="col-sm-3">Isi Pesan</dt>
                <dd class="col-sm-9">
                    <p class="mb-0" style="white-space: pre-line;">{{ $pesan->isi_pesan }}</p>
                </dd>
            </dl>

            <div class="mt-4 d-flex gap-2">
                @if(! $pesan->sudah_dibaca)
                    <form action="{{ route('admin.pesan-pengunjung.tandai_dibaca', $pesan) }}"
                          method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">
                            Tandai Sudah Dibaca
                        </button>
                    </form>
                @endif

                <form action="{{ route('admin.pesan-pengunjung.destroy', $pesan) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
