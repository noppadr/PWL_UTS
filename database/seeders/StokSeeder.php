<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua barang_id dari tabel m_barang
        $barangs = DB::table('m_barang')->pluck('barang_id', 'barang_kode');

        // Ambil user pertama (misalnya admin)
        $userId = DB::table('m_user')->value('user_id') ?? 1;

        $data = [
            [
                'barang_id'    => $barangs['BRG001'] ?? 1,
                'user_id'      => $userId,
                'stok_tanggal' => Carbon::now()->subDays(5),
                'stok_jumlah'  => 20,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'barang_id'    => $barangs['BRG002'] ?? 2,
                'user_id'      => $userId,
                'stok_tanggal' => Carbon::now()->subDays(4),
                'stok_jumlah'  => 15,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'barang_id'    => $barangs['BRG003'] ?? 3,
                'user_id'      => $userId,
                'stok_tanggal' => Carbon::now()->subDays(3),
                'stok_jumlah'  => 30,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'barang_id'    => $barangs['BRG004'] ?? 4,
                'user_id'      => $userId,
                'stok_tanggal' => Carbon::now()->subDays(2),
                'stok_jumlah'  => 10,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'barang_id'    => $barangs['BRG005'] ?? 5,
                'user_id'      => $userId,
                'stok_tanggal' => Carbon::now()->subDay(),
                'stok_jumlah'  => 25,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ];

        DB::table('t_stok')->insert($data);
    }
}
