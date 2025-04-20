<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil user pertama sebagai penjual
        $userId = DB::table('m_user')->value('user_id') ?? 1;

        $data = [
            [
                'user_id'            => 1,
                'pembeli'            => 'Kepin Bramasta',
                'penjualan_kode'     => 'PNJ001',
                'penjualan_tanggal'  => Carbon::now()->subDays(3),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'user_id'            => 1,
                'pembeli'            => 'Arvyto',
                'penjualan_kode'     => 'PNJ002',
                'penjualan_tanggal'  => Carbon::now()->subDays(2),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'user_id'            => 2,
                'pembeli'            => 'Nova Diana',
                'penjualan_kode'     => 'PNJ003',
                'penjualan_tanggal'  => Carbon::now()->subDay(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'user_id'            => 3,
                'pembeli'            => 'Nagumo',
                'penjualan_kode'     => 'PNJ004',
                'penjualan_tanggal'  => Carbon::now()->subDay(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
        ];

        DB::table('t_penjualan')->insert($data);
    }
}
