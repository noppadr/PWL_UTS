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
        Schema::create('m_barang', function (Blueprint $table) {
            $table->id('barang_id');
            $table->unsignedBigInteger('kategori_id')->index(); 
            $table->string('barang_kode', 10)->unique(); 
            $table->string('barang_nama', 100);
            $table->decimal('harga_jual', 15, 2); // Harga jual dengan 2 desimal
            $table->integer('stok')->default(0); // Kolom stok
            $table->string('gambar')->nullable(); // Path atau URL gambar, nullable
            $table->timestamps();
    
            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_barang');
    }
};