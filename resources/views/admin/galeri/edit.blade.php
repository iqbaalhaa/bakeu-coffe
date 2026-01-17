@extends('layouts.master')

@section('title', 'Edit Album Galeri - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Edit Album Galeri</h2>

    <div class="card border-0 shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.galeri.update', $album) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Judul Album</label>
                            <input type="text" name="judul" class="form-control" value="{{ old('judul', $album->judul) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" class="form-control">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Urutan Tampil</label>
                                <input type="number" name="urutan_tampil" class="form-control" value="{{ old('urutan_tampil', $album->urutan_tampil) }}" min="1">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-check mt-4">
                                    <input type="hidden" name="status_aktif" value="0">
                                    <input class="form-check-input" type="checkbox" id="status_aktif" name="status_aktif" value="1" {{ old('status_aktif', $album->status_aktif) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status_aktif">Aktif</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label d-block">Cover Album</label>
                        @if($album->cover_path)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$album->cover_path) }}" alt="Cover" style="max-height:120px;border-radius:10px;">
                            </div>
                        @else
                            <div class="mb-2 text-muted small">Belum ada cover.</div>
                        @endif
                        <input type="file" name="cover" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah cover.</small>
                    </div>
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Item di Album Ini</h5>
            </div>

            <form action="{{ route('admin.galeri.tambah-item', $album) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-2 mb-3">
                        <label class="form-label">Tipe</label>
                        <select name="tipe" class="form-control">
                            <option value="image">Gambar</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Judul/Caption</label>
                        <input type="text" name="judul" class="form-control" placeholder="Opsional">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">File Gambar</label>
                        <input type="file" name="file" class="form-control">
                        <small class="text-muted">Wajib diisi untuk gambar.</small>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">URL Video</label>
                        <input type="text" name="url_video" class="form-control" placeholder="Embed YouTube, opsional">
                    </div>
                    <div class="col-md-1 mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="urutan_tampil" class="form-control" min="1">
                    </div>
                    <div class="col-md-12 mb-3 text-end">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Tambah Item
                        </button>
                    </div>
                </div>
            </form>

            @if($album->items->isEmpty())
                <p class="mb-0">Belum ada item pada album ini.</p>
            @else
                <div class="row">
                    @foreach($album->items as $item)
                        <div class="col-md-3 mb-4">
                            <div class="border rounded h-100 d-flex flex-column">
                                <div class="p-2">
                                    @if($item->tipe === 'image' && $item->path_file)
                                        <img src="{{ asset('storage/'.$item->path_file) }}" alt="{{ $item->judul ?? '' }}" style="width:100%;height:150px;object-fit:cover;border-radius:6px;">
                                    @elseif($item->tipe === 'video' && $item->url_video)
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{ $item->url_video }}" allowfullscreen></iframe>
                                        </div>
                                    @else
                                        <div class="text-muted small p-3">Item tidak memiliki konten.</div>
                                    @endif
                                </div>
                                <div class="p-2 border-top d-flex flex-column flex-grow-1">
                                    <div class="small fw-bold mb-1">{{ $item->judul ?? '-' }}</div>
                                    <div class="small text-muted mb-2">
                                        Tipe: {{ strtoupper($item->tipe) }},
                                        Urutan: {{ $item->urutan_tampil ?? '-' }}
                                    </div>
                                    <div class="mt-auto text-end">
                                        <form action="{{ route('admin.galeri.hapus-item', [$album, $item]) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus item ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

