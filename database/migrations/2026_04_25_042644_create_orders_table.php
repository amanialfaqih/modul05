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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            // 🔥 RELASI KE USER
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            // 🔥 TOTAL BELANJA
            $table->integer('total');

            // 🔥 METODE PEMBAYARAN
            $table->string('metode_pembayaran');

            // 🔥 STATUS ORDER
            $table->enum('status', ['pending', 'approved'])
                  ->default('pending');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};