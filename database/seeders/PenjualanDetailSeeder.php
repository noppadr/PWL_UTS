<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua ID penjualan dan barang berdasarkan kode
        $penjualans = DB::table('t_penjualan')->pluck('penjualan_id', 'penjualan_kode');
        $barangs = DB::table('m_barang')->pluck('barang_id', 'barang_kode');

        $data = [
            [
                'penjualan_id' => $penjualans['PNJ001'] ?? 1,
                'barang_id'    => $barangs['BRG001'] ?? 1,
                'harga'        => 25000,
                'jumlah'       => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'penjualan_id' => $penjualans['PNJ001'] ?? 1,
                'barang_id'    => $barangs['BRG002'] ?? 2,
                'harga'        => 30000,
                'jumlah'       => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'penjualan_id' => $penjualans['PNJ002'] ?? 2,
                'barang_id'    => $barangs['BRG003'] ?? 3,
                'harga'        => 35000,
                'jumlah'       => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'penjualan_id' => $penjualans['PNJ003'] ?? 3,
                'barang_id'    => $barangs['BRG004'] ?? 4,
                'harga'        => 75000,
                'jumlah'       => 1,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'penjualan_id' => $penjualans['PNJ004'] ?? 4,
                'barang_id'    => $barangs['BRG005'] ?? 5,
                'harga'        => 28000,
                'jumlah'       => 2,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        DB::table('t_penjualan_detail')->insert($data);
    }
}
