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
            $table->increments('kode_buku');
            $table->string('judul_buku', 150)->nullable();
            $table->year('tahun_terbit')->nullable();
            $table->string('penulis', 150)->nullable();
            $table->string('stok', 4)->nullable();
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
