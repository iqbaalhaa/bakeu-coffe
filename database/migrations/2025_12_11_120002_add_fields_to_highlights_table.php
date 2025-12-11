<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->string('kategori')->nullable()->after('deskripsi');
            $table->string('warna_tema')->nullable()->after('ikon_css');
        });
    }

    public function down(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $table->dropColumn(['kategori', 'warna_tema']);
        });
    }
};

