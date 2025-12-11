<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('highlights', function (Blueprint $table) {
            $table->id();

            // Konten highlight
            $table->string('judul');                 // Contoh: Produk Unggulan, Aktivitas UMKM
            $table->text('deskripsi')->nullable();  // Penjelasan singkat

            // Tampilan visual
            $table->string('ikon_css')->nullable();      // Contoh: fa fa-coffee (Font Awesome)
            $table->string('warna_tema')->nullable();    // Contoh: primary, warning, dll (opsional)

            // Pengelompokan & urutan
            $table->string('kategori')->nullable();      // Contoh: umum, produk, pelayanan (opsional)
            $table->unsignedInteger('urutan_tampil')->nullable(); // Urutan di section

            // Status
            $table->boolean('status_aktif')->default(true);

            $table->timestamps();
        });
    }

public function down(): void
{
    Schema::dropIfExists('highlights');
}
};
