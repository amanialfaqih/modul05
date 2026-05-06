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
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();

            // 🔥 RELASI KE USER
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 🔥 RELASI KE BOOK
            $table->foreignId('book_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->timestamps();

            // 🔥 BIAR GA DOUBLE (user ga bisa wishlist buku sama 2x)
            $table->unique(['user_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlists');
    }
};