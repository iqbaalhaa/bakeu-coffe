@extends('layouts.master')

@section('title', 'Profil Usaha - Bakeu Coffee')

@section('content')
<div class="py-4 px-3">
    <h2 class="h4 mb-4">Profil Usaha</h2>

    <div class="card border-0 shadow">
        <div class="card-body">
            <form action="{{ route('admin.profil_usaha.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Data Umum Usaha --}}
                <h5 class="mb-3">Data Umum Usaha</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Usaha</label>
                        <input type="text" name="nama_usaha"
                               class="form-control @error('nama_usaha') is-invalid @enderror"
                               value="{{ old('nama_usaha', $profil->nama_usaha) }}" required>
                        @error('nama_usaha') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Slogan / Tagline</label>
                        <input type="text" name="slogan" class="form-control"
                               value="{{ old('slogan', $profil->slogan) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul di Bagian Hero</label>
                        <input type="text" name="judul_hero" class="form-control"
                               value="{{ old('judul_hero', $profil->judul_hero) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subjudul di Bagian Hero</label>
                        <input type="text" name="subjudul_hero" class="form-control"
                               value="{{ old('subjudul_hero', $profil->subjudul_hero) }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tahun Berdiri</label>
                        <input type="text" name="tahun_berdiri" class="form-control"
                               value="{{ old('tahun_berdiri', $profil->tahun_berdiri) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kota / Kabupaten</label>
                        <input type="text" name="kota" class="form-control"
                               value="{{ old('kota', $profil->kota) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Informasi Legal (NIB, PIRT, dll)</label>
                        <input type="text" name="informasi_legal" class="form-control"
                               value="{{ old('informasi_legal', $profil->informasi_legal) }}">
                    </div>
                </div>

                <hr>

                {{-- Tentang Kami --}}
                <h5 class="mb-3">Tentang Kami</h5>
                <div class="mb-3">
                    <label class="form-label">Sejarah Usaha</label>
                    <textarea name="sejarah" rows="4" class="form-control">{{ old('sejarah', $profil->sejarah) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea name="visi" rows="3" class="form-control">{{ old('visi', $profil->visi) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Misi</label>
                    <textarea name="misi" rows="4" class="form-control">{{ old('misi', $profil->misi) }}</textarea>
                    <small class="text-muted">Jika ingin menjadi bullet list di landing page, pisahkan setiap misi dengan enter.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Arah Bisnis UMKM</label>
                    <textarea name="arah_bisnis" rows="3" class="form-control">{{ old('arah_bisnis', $profil->arah_bisnis) }}</textarea>
                </div>

                <hr>

                {{-- Alamat & Kontak --}}
                <h5 class="mb-3">Alamat & Kontak</h5>
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat_lengkap" rows="3" class="form-control">{{ old('alamat_lengkap', $profil->alamat_lengkap) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control"
                               value="{{ old('no_telepon', $profil->no_telepon) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">No. WhatsApp</label>
                        <input type="text" name="no_whatsapp" class="form-control"
                               value="{{ old('no_whatsapp', $profil->no_whatsapp) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Email Resmi</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ old('email', $profil->email) }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tautan Google Maps</label>
                        <input type="text" name="tautan_google_maps" class="form-control"
                               value="{{ old('tautan_google_maps', $profil->tautan_google_maps) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jam Buka (Hari Kerja)</label>
                        <input type="text" name="jam_buka_hari_kerja" class="form-control"
                               value="{{ old('jam_buka_hari_kerja', $profil->jam_buka_hari_kerja) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jam Buka (Akhir Pekan)</label>
                        <input type="text" name="jam_buka_akhir_pekan" class="form-control"
                               value="{{ old('jam_buka_akhir_pekan', $profil->jam_buka_akhir_pekan) }}">
                    </div>
                </div>

                <hr>

                {{-- Tombol di Hero --}}
                <h5 class="mb-3">Tombol di Bagian Hero</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teks Tombol "Lihat Produk"</label>
                        <input type="text" name="teks_tombol_lihat_produk" class="form-control"
                               value="{{ old('teks_tombol_lihat_produk', $profil->teks_tombol_lihat_produk) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tautan Tombol "Lihat Produk"</label>
                        <input type="text" name="tautan_tombol_lihat_produk" class="form-control"
                               value="{{ old('tautan_tombol_lihat_produk', $profil->tautan_tombol_lihat_produk) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teks Tombol WhatsApp</label>
                        <input type="text" name="teks_tombol_whatsapp" class="form-control"
                               value="{{ old('teks_tombol_whatsapp', $profil->teks_tombol_whatsapp) }}">
                    </div>
                </div>

                <hr>

                {{-- Logo & Gambar Hero --}}
                <h5 class="mb-3">Logo & Gambar Hero</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Logo Usaha</label>
                        @if($profil->path_logo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$profil->path_logo) }}" alt="Logo"
                                     style="max-height:60px;">
                            </div>
                        @endif
                        <input type="file" name="logo" class="form-control">
                        <small class="text-muted">Format: JPG, PNG, SVG. Maks 2 MB.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label d-block">Gambar Hero</label>
                        @if($profil->path_gambar_hero)
                            <div class="mb-2">
                                <img src="{{ asset('storage/'.$profil->path_gambar_hero) }}" alt="Gambar Hero"
                                     style="max-height:120px;">
                            </div>
                        @endif
                        <input type="file" name="gambar_hero" class="form-control">
                        <small class="text-muted">Format: JPG, PNG, SVG. Maks 4 MB.</small>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        Simpan Profil Usaha
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="card border-0 shadow mt-4">
    <div class="card-body">
        <h5 class="mb-3">Ringkasan Data Saat Ini</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-2"><strong>Nama Usaha:</strong> {{ $profil->nama_usaha ?? '-' }}</div>
                <div class="mb-2"><strong>Slogan:</strong> {{ $profil->slogan ?? '-' }}</div>
                <div class="mb-2"><strong>Judul Hero:</strong> {{ $profil->judul_hero ?? '-' }}</div>
                <div class="mb-2"><strong>Subjudul Hero:</strong> {{ $profil->subjudul_hero ?? '-' }}</div>
                <div class="mb-2"><strong>Teks Tombol Lihat Produk:</strong> {{ $profil->teks_tombol_lihat_produk ?? '-' }}</div>
                <div class="mb-2"><strong>Tautan Tombol Lihat Produk:</strong> {{ $profil->tautan_tombol_lihat_produk ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <div class="mb-2"><strong>Tahun Berdiri:</strong> {{ $profil->tahun_berdiri ?? '-' }}</div>
                <div class="mb-2"><strong>Kota/Kabupaten:</strong> {{ $profil->kota ?? '-' }}</div>
                <div class="mb-2"><strong>Informasi Legal:</strong> {{ $profil->informasi_legal ?? '-' }}</div>
                <div class="mb-2"><strong>No. Telepon:</strong> {{ $profil->no_telepon ?? '-' }}</div>
                <div class="mb-2"><strong>No. WhatsApp:</strong> {{ $profil->no_whatsapp ?? '-' }}</div>
                <div class="mb-2"><strong>Email:</strong> {{ $profil->email ?? '-' }}</div>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <strong>Alamat Lengkap:</strong>
            <div class="mt-1">{{ $profil->alamat_lengkap ?? '-' }}</div>
        </div>

        <div class="mb-3">
            <strong>Tautan Google Maps:</strong>
            <div class="mt-1">
                @if(!empty($profil->tautan_google_maps))
                    <a href="{{ $profil->tautan_google_maps }}" target="_blank" rel="noopener">Lihat di Google Maps</a>
                @else
                    -
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>Jam Buka (Hari Kerja):</strong>
                <div class="mt-1">{{ $profil->jam_buka_hari_kerja ?? '-' }}</div>
            </div>
            <div class="col-md-6 mb-3">
                <strong>Jam Buka (Akhir Pekan):</strong>
                <div class="mt-1">{{ $profil->jam_buka_akhir_pekan ?? '-' }}</div>
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <strong>Sejarah Usaha:</strong>
            <div class="mt-1">{{ $profil->sejarah ?? '-' }}</div>
        </div>

        <div class="mb-3">
            <strong>Visi:</strong>
            <div class="mt-1">{{ $profil->visi ?? '-' }}</div>
        </div>

        <div class="mb-3">
            <strong>Misi:</strong>
            <div class="mt-1">
                @php($misiList = !empty($profil->misi) ? preg_split('/\r?\n/', $profil->misi) : [])
                @if(!empty($misiList))
                    <ul class="mb-0">
                        @foreach($misiList as $m)
                            @if(trim($m) !== '')
                                <li>{{ $m }}</li>
                            @endif
                        @endforeach
                    </ul>
                @else
                    -
                @endif
            </div>
        </div>

        <div class="mb-3">
            <strong>Arah Bisnis UMKM:</strong>
            <div class="mt-1">{{ $profil->arah_bisnis ?? '-' }}</div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>Logo Usaha:</strong>
                <div class="mt-2">
                    @if(!empty($profil->path_logo))
                        <img src="{{ asset('storage/'.$profil->path_logo) }}" alt="Logo" style="max-height:60px;">
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <strong>Gambar Hero:</strong>
                <div class="mt-2">
                    @if(!empty($profil->path_gambar_hero))
                        <img src="{{ asset('storage/'.$profil->path_gambar_hero) }}" alt="Gambar Hero" style="max-height:120px;">
                    @else
                        -
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
