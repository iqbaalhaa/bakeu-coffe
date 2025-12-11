<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimoni', function (Blueprint $table) {
            $table->id();

            // Identitas pemberi testimoni
            $table->string('nama_klien');                 // Contoh: Client Name
            $table->string('profesi')->nullable();        // Contoh: Barista, Pelanggan Setia, dll

            // Isi testimoni
            $table->text('pesan_testimoni');              // Isi testimoni

            // Rating (opsional)
            $table->unsignedTinyInteger('rating')->nullable(); // 1–5 bintang

            // Foto & tampilan
            $table->string('path_foto')->nullable();      // Path foto klien (opsional)
            $table->unsignedInteger('urutan_tampil')->nullable(); // Urutan tampil di carousel

            // Status
            $table->boolean('status_aktif')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimoni');
    }
};
