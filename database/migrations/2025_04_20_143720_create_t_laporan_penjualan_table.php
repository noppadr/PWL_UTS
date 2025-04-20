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
        Schema::create('t_laporan_penjualan', function (Blueprint $table) {
            $table->id('laporan_id');
            $table->unsignedBigInteger('penjualan_id')->index();
            $table->unsignedBigInteger('barang_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('kategori_id')->index();
            $table->string('penjualan_kode', 20);
            $table->dateTime('penjualan_tanggal');
            $table->string('pembeli', 50);
            $table->string('barang_nama', 100);
            $table->string('kategori_nama', 100);
            $table->decimal('harga', 15, 2);
            $table->integer('jumlah');
            $table->decimal('total', 15, 2); // harga × jumlah
            $table->string('username', 20);
            $table->timestamps();

            $table->foreign('penjualan_id')->references('penjualan_id')->on('t_penjualan')->onDelete('cascade');
            $table->foreign('barang_id')->references('barang_id')->on('m_barang')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('m_user')->onDelete('cascade');
            $table->foreign('kategori_id')->references('kategori_id')->on('m_kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_laporan_penjualan');
    }
};