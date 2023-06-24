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
        Schema::create('buku_models', function (Blueprint $table) {
            $table->id();
            $table->string('kode_buku', 4);
            $table->string('judul_buku', 150);
            $table->year('tahun_terbit');
            $table->string('penulis', 150);
            $table->string('stok', 4);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_models');
    }
};
