@extends('layouts.master')

@section('title', 'Tambah Produk - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Tambah Produk</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" step="0.01" name="harga" class="form-control" value="{{ old('harga') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi_singkat" rows="3" class="form-control">{{ old('deskripsi_singkat') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea name="deskripsi_lengkap" rows="5" class="form-control">{{ old('deskripsi_lengkap') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input type="hidden" name="status_aktif" value="0">
                            <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" value="1" {{ old('status_aktif') ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_aktif">Aktif</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-check">
                            <input type="hidden" name="ditandai_favorit" value="0">
                            <input class="form-check-input" type="checkbox" id="ditandai_favorit" name="ditandai_favorit" value="1" {{ old('ditandai_favorit') ? 'checked' : '' }}>
                            <label class="form-check-label" for="ditandai_favorit">Jadikan Favorit</label>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan_tampil" class="form-control" value="{{ old('urutan_tampil') }}" min="1">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Gambar Produk</label>
                    <input type="file" name="gambar" class="form-control">
                    <small class="text-muted">Format: JPG, PNG, WEBP. Maks 4 MB.</small>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
