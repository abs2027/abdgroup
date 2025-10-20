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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Misal: "Excavator EX-01", "Gedung Kantor A"
            
            // Relasi ke tabel jenis aset
            $table->foreignId('asset_category_id')->constrained('asset_categories');
            
            $table->string('location')->nullable(); // Lokasi (Kantor Pusat, Cilegon, dll)
            
            // KUNCI FLEKSIBILITAS:
            // Semua data unik (Hour Meter, Luas, NoPol) masuk sini.
            $table->json('specifications')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
