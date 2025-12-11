<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Nama Platform</label>
        <select name="nama_platform" class="form-select @error('nama_platform') is-invalid @enderror" required>
            @php
                $platforms = ['Instagram', 'Facebook', 'TikTok', 'YouTube', 'WhatsApp', 'Twitter/X', 'LinkedIn', 'Website Lain'];
                $selectedPlatform = old('nama_platform', $mediaSosial->nama_platform);
            @endphp
            <option value="">-- Pilih Platform --</option>
            @foreach($platforms as $platform)
                <option value="{{ $platform }}" {{ $selectedPlatform === $platform ? 'selected' : '' }}>
                    {{ $platform }}
                </option>
            @endforeach
        </select>
        @error('nama_platform') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Nama Tampilan / Username</label>
        <input type="text" name="nama_tampilan" class="form-control"
               value="{{ old('nama_tampilan', $mediaSosial->nama_tampilan) }}"
               placeholder="@bakeucoffee">
    </div>

    <div class="col-md-12 mb-3">
        <label class="form-label">URL Akun</label>
        <input type="url" name="url"
               class="form-control @error('url') is-invalid @enderror"
               value="{{ old('url', $mediaSosial->url) }}"
               placeholder="https://instagram.com/nama_akun" required>
        @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Kelas Ikon (opsional)</label>
        <input type="text" name="ikon_css" class="form-control"
               value="{{ old('ikon_css', $mediaSosial->ikon_css) }}"
               placeholder="Contoh: fab fa-instagram">
        <small class="text-muted">Jika menggunakan Font Awesome, isikan kelas ikon di sini.</small>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="urutan_tampil" class="form-control"
               value="{{ old('urutan_tampil', $mediaSosial->urutan_tampil) }}">
        <small class="text-muted">Semakin kecil, semakin muncul di urutan awal.</small>
    </div>

    <div class="col-md-3 mb-3">
        <label class="form-label d-block">Status</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" name="status_aktif" id="status_aktif"
                   {{ old('status_aktif', $mediaSosial->status_aktif ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="status_aktif">Tampilkan di website</label>
        </div>
    </div>
</div>

<div class="mt-3">
    <button type="submit" class="btn btn-primary">
        @if(isset($mode) && $mode === 'edit')
            Simpan Perubahan
        @else
            Simpan Media Sosial
        @endif
    </button>
    <a href="{{ route('admin.media-sosial.index') }}" class="btn btn-outline-secondary">
        Batal
    </a>
</div>
