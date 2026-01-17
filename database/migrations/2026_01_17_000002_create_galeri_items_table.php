<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galeri_album_id')->constrained('galeri_albums')->onDelete('cascade');
            $table->string('tipe')->default('image');
            $table->string('judul')->nullable();
            $table->string('path_file')->nullable();
            $table->string('url_video')->nullable();
            $table->unsignedInteger('urutan_tampil')->nullable();
            $table->boolean('status_aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_items');
    }
};

