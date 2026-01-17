<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nama Klien</label>
        <input type="text" name="nama_klien"
               class="form-control @error('nama_klien') is-invalid @enderror"
               value="{{ old('nama_klien', $testimoni->nama_klien) }}" required>
        @error('nama_klien') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Profesi / Keterangan</label>
        <input type="text" name="profesi" class="form-control"
               value="{{ old('profesi', $testimoni->profesi) }}"
               placeholder="Contoh: Pelanggan Tetap, Barista, dsb.">
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">Pesan Testimoni</label>
        <textarea name="pesan_testimoni" rows="4"
                  class="form-control @error('pesan_testimoni') is-invalid @enderror"
                  required>{{ old('pesan_testimoni', $testimoni->pesan_testimoni) }}</textarea>
        @error('pesan_testimoni') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    @if(isset($daftarProduk) && $daftarProduk->count())
        <div class="col-md-6 mb-3">
            <label class="form-label">Terkait Produk</label>
            <select name="produk_id" class="form-select @error('produk_id') is-invalid @enderror">
                <option value="">Umum (tidak terkait produk tertentu)</option>
                @foreach($daftarProduk as $p)
                    <option value="{{ $p->id }}" {{ (int)old('produk_id', $testimoni->produk_id) === $p->id ? 'selected' : '' }}>
                        {{ $p->nama_produk }}
                    </option>
                @endforeach
            </select>
            @error('produk_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            <small class="text-muted">Pilih produk yang mendapat testimoni ini.</small>
        </div>
    @endif

    <div class="col-md-4 mb-3">
        <label class="form-label">Rating (1–5)</label>
        <select name="rating" class="form-select">
            <option value="">Tidak diisi</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}" {{ (int)old('rating', $testimoni->rating) === $i ? 'selected' : '' }}>
                    {{ $i }} bintang
                </option>
            @endfor
        </select>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan_tampil" class="form-control"
               value="{{ old('urutan_tampil', $testimoni->urutan_tampil) }}">
        <small class="text-muted">Semakin kecil, semakin di awal.</small>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label d-block">Status</label>
        <div class="form-check form-switch">
            <input type="hidden" name="status_aktif" value="0">
            <input class="form-check-input" type="checkbox" name="status_aktif" id="status_aktif" value="1"
                   {{ old('status_aktif', $testimoni->status_aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="status_aktif">Tampilkan di landing page</label>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label d-block">Foto Klien (opsional)</label>
        @if($testimoni->path_foto)
            <div class="mb-2">
                <img src="{{ asset('storage/'.$testimoni->path_foto) }}"
                     alt="{{ $testimoni->nama_klien }}"
                     class="rounded-circle"
                     style="width:60px;height:60px;object-fit:cover;">
            </div>
        @endif
        <input type="file" name="foto" class="form-control">
        <small class="text-muted">Format: JPG, PNG, WEBP. Maks 4 MB.</small>
    </div>
</div>

<div class="mt-3">
    <button type="submit" class="btn btn-primary">
        @if(isset($mode) && $mode === 'edit')
            Simpan Perubahan
        @else
            Simpan Testimoni
        @endif
    </button>
    <a href="{{ route('admin.testimoni.index') }}" class="btn btn-outline-secondary">
        Batal
    </a>
</div>
