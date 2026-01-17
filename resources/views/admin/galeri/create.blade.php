@extends('layouts.master')

@section('title', 'Tambah Album Galeri - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Tambah Album Galeri</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Judul Album</label>
                    <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Urutan Tampil</label>
                        <input type="number" name="urutan_tampil" class="form-control" value="{{ old('urutan_tampil') }}" min="1">
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-check mt-4">
                            <input type="hidden" name="status_aktif" value="0">
                            <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" value="1" {{ old('status_aktif', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_aktif">Aktif</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Cover Album</label>
                    <input type="file" name="cover" class="form-control">
                    <small class="text-muted">Format: JPG, PNG, WEBP. Maks 4 MB.</small>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

