<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimoni', function (Blueprint $table) {
            if (!Schema::hasColumn('testimoni', 'produk_id')) {
                $table->unsignedBigInteger('produk_id')->nullable()->after('id');
                $table->foreign('produk_id')
                    ->references('id')
                    ->on('produk')
                    ->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('testimoni', function (Blueprint $table) {
            if (Schema::hasColumn('testimoni', 'produk_id')) {
                $table->dropForeign(['produk_id']);
                $table->dropColumn('produk_id');
            }
        });
    }
};

