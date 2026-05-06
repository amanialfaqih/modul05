<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration (tambah kolom harga)
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {

            // 🔥 cek kalau kolom belum ada
            if (!Schema::hasColumn('books', 'harga')) {
                $table->integer('harga')->default(0)->after('stok');
            }

        });
    }

    /**
     * Rollback (hapus kolom harga)
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {

            if (Schema::hasColumn('books', 'harga')) {
                $table->dropColumn('harga');
            }

        });
    }
};