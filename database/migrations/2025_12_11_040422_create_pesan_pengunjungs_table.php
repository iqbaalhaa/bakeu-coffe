<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
    {
        Schema::create('pesan_pengunjung', function (Blueprint $table) {
            $table->id();

            $table->string('nama_lengkap');              // Nama pengirim
            $table->string('email')->nullable();         // Email (opsional)
            $table->string('no_telepon')->nullable();    // No telepon / WhatsApp (opsional)
            $table->string('subjek')->nullable();        // Subjek pesan (opsional)
            $table->text('isi_pesan');                   // Isi pesan

            $table->boolean('sudah_dibaca')->default(false); // Status sudah dibaca admin atau belum
            $table->string('sumber_halaman')->nullable();    // Dari halaman mana (opsional, misal: landing/kontak)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesan_pengunjung');
    }
};
