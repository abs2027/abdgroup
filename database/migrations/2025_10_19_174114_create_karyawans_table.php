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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nomer_induk_karyawan')->unique();
            $table->string('nama_panjang');
            $table->string('nik_ktp')->unique();
            $table->text('alamat_domisili');
            
            // Relasi ke tabel lain
            $table->foreignId('lokasi_penempatan_id')->constrained('lokasi_penempatans');
            $table->foreignId('jabatan_posisi_id')->constrained('jabatan_posisis');
            
            $table->string('nomer_hp');
            $table->date('tanggal_masuk');
            $table->enum('status_karyawan', ['Tetap', 'Kontrak', 'Magang']);

            // Kontak Darurat
            $table->string('nama_kontak_darurat');
            $table->string('hp_kontak_darurat');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
