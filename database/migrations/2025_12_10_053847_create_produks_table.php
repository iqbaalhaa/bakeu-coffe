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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();

            // Informasi utama produk
            $table->string('nama_produk');                   // Contoh: Black Coffee
            $table->string('kategori')->nullable();          // Contoh: hot / cold
            $table->decimal('harga', 12, 2)->default(0);     // Harga jual

            // Deskripsi
            $table->text('deskripsi_singkat')->nullable();   // Teks pendek di landing
            $table->text('deskripsi_lengkap')->nullable();   // Jika nanti butuh halaman detail

            // Gambar produk
            $table->string('path_gambar')->nullable();       // Path file gambar di storage

            // Status
            $table->boolean('status_aktif')->default(true);  // Tampil / tidak di landing
            $table->boolean('ditandai_favorit')->default(false); // Untuk produk unggulan (opsional)
            $table->unsignedInteger('urutan_tampil')->nullable(); // Untuk mengatur urutan manual

            $table->timestamps();

            // Index untuk pencarian berdasarkan kategori
            $table->index('kategori');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
