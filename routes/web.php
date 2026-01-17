<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProfilUsahaController;
use App\Models\ProfilUsaha;
use App\Http\Controllers\Admin\ProdukController;
use App\Models\Produk;
use App\Http\Controllers\TestimoniPublikController;
use App\Http\Controllers\Admin\MediaSosialController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\PesanPengunjungController;
use App\Http\Controllers\Admin\HighlightController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\GaleriAlbumController;
use App\Models\Highlight;
use App\Models\Testimoni;
use App\Models\GaleriAlbum;



Route::get('/', function () {
    $profil = ProfilUsaha::first();
    $highlights = Highlight::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->take(9)
        ->get();

    return view('landing.index', compact('profil', 'highlights'));
});

//KONTAK
Route::post('/kontak', [KontakController::class, 'kirim'])->name('kontak.kirim');

// LOGIN
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN (harus login)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil-usaha', [ProfilUsahaController::class, 'edit'])->name('profil_usaha.edit');
    Route::put('/profil-usaha', [ProfilUsahaController::class, 'update'])->name('profil_usaha.update');

    Route::resource('produk', ProdukController::class)->except(['show']);
    Route::resource('media-sosial', MediaSosialController::class)->except(['show']);
    Route::resource('galeri', GaleriAlbumController::class)->except(['show']);
    Route::post('galeri/{galeri}/tambah-item', [GaleriAlbumController::class, 'tambahItem'])->name('galeri.tambah-item');
    Route::delete('galeri/{galeri}/hapus-item/{item}', [GaleriAlbumController::class, 'hapusItem'])->name('galeri.hapus-item');

    Route::resource('pesan-pengunjung', PesanPengunjungController::class)->only([
        'index', 'show', 'destroy'
    ]);
    // route tambahan untuk tandai sudah dibaca
    Route::post('pesan-pengunjung/{pesan_pengunjung}/tandai-dibaca', 
        [PesanPengunjungController::class, 'tandaiSudahDibaca']
    )->name('pesan-pengunjung.tandai_dibaca');

    Route::resource('highlight', HighlightController::class)->except(['show']);
    Route::resource('testimoni', TestimoniController::class)->except(['show']);
    Route::post('testimoni/{testimoni}/toggle-status', [TestimoniController::class, 'toggleStatus'])
        ->name('testimoni.toggle-status');

});

Route::get('/galeri', function () {
    $profil = ProfilUsaha::first();
    $albums = GaleriAlbum::with(['items' => function ($q) {
            $q->where('status_aktif', true)
                ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
                ->orderByDesc('created_at');
        }])
        ->where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->get();

    return view('landing.galeri', compact('profil', 'albums'));
})->name('galeri.index');
Route::get('/produk', function () {
    $profil = ProfilUsaha::first();
    $produk = Produk::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('ditandai_favorit')
        ->orderByDesc('created_at')
        ->get();

    $produk->load(['testimoni' => function ($q) {
        $q->where('status_aktif', true);
    }]);
    $totalProduk = $produk->count();

    $highlights = Highlight::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->take(9)
        ->get();

    return view('landing.produk', compact('profil', 'produk'));
})->name('produk.index');

Route::get('/produk/{produk}-{slug?}', function (\App\Models\Produk $produk, $slug = null) {
    $profil = \App\Models\ProfilUsaha::first();
    $testimoni = \App\Models\Testimoni::where('status_aktif', true)
        ->where('produk_id', $produk->id)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->get();

    return view('landing.produk-detail', compact('profil', 'produk', 'testimoni'));
})->where(['produk' => '[0-9]+'])->name('produk.show');

Route::post('/produk/{produk}/kirim-testimoni', [TestimoniPublikController::class, 'store'])
    ->name('produk.testimoni.store');
