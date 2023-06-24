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
        Schema::create('log_pengajuan_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kode_buku')->nullable();
            $table->foreignId('id_pengguna')->nullable();
            $table->date('tgl_peminjaman')->nullable();
            $table->date('tgl_pengembalian')->nullable();
            $table->string('jml_buku_pinjam')->nullable();
            $table->foreignId('id_admin')->nullable();
            $table->enum('status', ['Y','N'])->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_pengajuan_models');
    }
};
