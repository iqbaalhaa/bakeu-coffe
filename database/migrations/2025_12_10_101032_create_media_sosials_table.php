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
        Schema::create('media_sosial', function (Blueprint $table) {
            $table->id();

            // Informasi utama media sosial
            $table->string('nama_platform');              // Contoh: Instagram, TikTok, Facebook
            $table->string('nama_tampilan')->nullable();  // Contoh: @bakeucoffee
            $table->string('url');                        // Link ke akun / page

            // Untuk ikon & tampilan
            $table->string('ikon_css')->nullable();       // Contoh: fab fa-instagram (kalau pakai Font Awesome)
            $table->unsignedInteger('urutan_tampil')->nullable(); // Mengatur urutan tampilan

            // Status
            $table->boolean('status_aktif')->default(true); // Ditampilkan di website atau tidak

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_sosial');
    }
};
