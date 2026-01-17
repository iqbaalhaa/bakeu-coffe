<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            if (!Schema::hasColumn('highlights', 'kategori')) {
                $table->string('kategori')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('highlights', 'warna_tema')) {
                $table->string('warna_tema')->nullable()->after('ikon_css');
            }
        });
    }

    public function down(): void
    {
        Schema::table('highlights', function (Blueprint $table) {
            $columnsToDrop = [];
            if (Schema::hasColumn('highlights', 'kategori')) {
                $columnsToDrop[] = 'kategori';
            }
            if (Schema::hasColumn('highlights', 'warna_tema')) {
                $columnsToDrop[] = 'warna_tema';
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};
