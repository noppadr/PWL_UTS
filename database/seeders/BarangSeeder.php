<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil ID kategori dari m_kategori (misalnya berdasarkan kode kategori)
        $kategori = DB::table('m_kategori')->pluck('kategori_id', 'kategori_kode');

        $data = [
            [
                'kategori_id'  => $kategori['WRD01'] ?? 1, // Facial Wash
                'barang_kode'  => 'BRG001',
                'barang_nama'  => 'Wardah Lightening Facial Wash',
                'harga_jual'   => 25000.00,
                'stok'         => 100,
                'gambar'       => 'images/facial_wash.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'kategori_id'  => $kategori['WRD02'] ?? 2, // Moisturizer
                'barang_kode'  => 'BRG002',
                'barang_nama'  => 'Wardah Perfect Bright Moisturizer',
                'harga_jual'   => 30000.00,
                'stok'         => 80,
                'gambar'       => 'images/moisturizer.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'kategori_id'  => $kategori['WRD03'] ?? 3, // Sunscreen
                'barang_kode'  => 'BRG003',
                'barang_nama'  => 'Wardah UV Shield Sunscreen Gel SPF 30',
                'harga_jual'   => 35000.00,
                'stok'         => 60,
                'gambar'       => 'images/sunscreen.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'kategori_id'  => $kategori['WRD04'] ?? 4, // Serum
                'barang_kode'  => 'BRG004',
                'barang_nama'  => 'Wardah C-Defense Serum',
                'harga_jual'   => 75000.00,
                'stok'         => 40,
                'gambar'       => 'images/serum.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
            [
                'kategori_id'  => $kategori['WRD05'] ?? 5, // Toner
                'barang_kode'  => 'BRG005',
                'barang_nama'  => 'Wardah Hydrating Toner',
                'harga_jual'   => 28000.00,
                'stok'         => 50,
                'gambar'       => 'images/toner.jpg',
                'created_at'   => Carbon::now(),
                'updated_at'   => Carbon::now(),
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}
