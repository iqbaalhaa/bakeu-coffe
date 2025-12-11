<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ProfilUsahaController;
use App\Models\ProfilUsaha;
use App\Http\Controllers\Admin\ProdukController;
use App\Models\Produk;
use App\Http\Controllers\Admin\MediaSosialController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\PesanPengunjungController;
use App\Http\Controllers\Admin\HighlightController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Models\Highlight;
use App\Models\Testimoni;



Route::get('/', function () {
    $profil = ProfilUsaha::first();
    $produk = Produk::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('ditandai_favorit')
        ->orderByDesc('created_at')
        ->take(8)
        ->get();

    $totalProduk = Produk::where('status_aktif', true)->count();

    $highlights = Highlight::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->take(9)
        ->get();

    $testimoni = Testimoni::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->take(12)
        ->get();

    return view('landing.index', compact('profil', 'produk', 'highlights', 'testimoni', 'totalProduk'));
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

    Route::resource('pesan-pengunjung', PesanPengunjungController::class)->only([
        'index', 'show', 'destroy'
    ]);
    // route tambahan untuk tandai sudah dibaca
    Route::post('pesan-pengunjung/{pesan_pengunjung}/tandai-dibaca', 
        [PesanPengunjungController::class, 'tandaiSudahDibaca']
    )->name('pesan-pengunjung.tandai_dibaca');

    Route::resource('highlight', HighlightController::class)->except(['show']);

     Route::resource('testimoni', TestimoniController::class)->except(['show']);

});
Route::get('/produk', function () {
    $profil = ProfilUsaha::first();
    $produk = Produk::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('ditandai_favorit')
        ->orderByDesc('created_at')
        ->get();
    $totalProduk = $produk->count();

    $highlights = Highlight::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->take(9)
        ->get();

    $testimoni = Testimoni::where('status_aktif', true)
        ->orderByRaw('COALESCE(urutan_tampil, 9999) ASC')
        ->orderByDesc('created_at')
        ->take(12)
        ->get();

    return view('landing.produk', compact('profil', 'produk'));
})->name('produk.index');

Route::get('/produk/{produk}-{slug?}', function (\App\Models\Produk $produk, $slug = null) {
    $profil = \App\Models\ProfilUsaha::first();
    return view('landing.produk-detail', compact('profil', 'produk'));
})->where(['produk' => '[0-9]+'])->name('produk.show');
