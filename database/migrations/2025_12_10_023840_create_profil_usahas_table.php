<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_usaha', function (Blueprint $table) {
        $table->id();

        // Data umum usaha
        $table->string('nama_usaha');                        // Contoh: Bakeu Coffee
        $table->string('slogan')->nullable();                // Contoh: Authentic Local Coffee...
        $table->string('judul_hero')->nullable();            // Judul besar di bagian atas
        $table->string('subjudul_hero')->nullable();         // Subjudul di bagian hero

        // Tentang kami
        $table->year('tahun_berdiri')->nullable();           // Tahun mulai usaha
        $table->text('sejarah')->nullable();                 // Sejarah singkat usaha
        $table->text('visi')->nullable();                    // Visi usaha
        $table->text('misi')->nullable();                    // Misi usaha (bisa beberapa poin)

        // Arah pengembangan usaha
        $table->text('arah_bisnis')->nullable();             // Arah bisnis UMKM ke depan

        // Alamat & kontak
        $table->text('alamat_lengkap')->nullable();          // Alamat lengkap
        $table->string('kota')->nullable();                  // Kota / kabupaten
        $table->string('tautan_google_maps')->nullable();    // URL Google Maps
        $table->string('no_telepon')->nullable();
        $table->string('no_whatsapp')->nullable();
        $table->string('email')->nullable();
        $table->string('informasi_legal')->nullable();       // NIB, PIRT, Halal, dll

        // Jam operasional
        $table->string('jam_buka_hari_kerja')->nullable();   // Senin–Jumat
        $table->string('jam_buka_akhir_pekan')->nullable();  // Sabtu–Minggu

        // Tombol di hero
        $table->string('teks_tombol_lihat_produk')->nullable();    // Contoh: Lihat Produk
        $table->string('tautan_tombol_lihat_produk')->nullable();  // Contoh: /produk atau #produk
        $table->string('teks_tombol_whatsapp')->nullable();        // Contoh: Pesan via WhatsApp

        // Berkas gambar
        $table->string('path_logo')->nullable();              // Path logo usaha
        $table->string('path_gambar_hero')->nullable();       // Path gambar background hero

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_usaha');
    }
};
