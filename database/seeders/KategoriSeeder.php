<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_kode' => 'WRD01',
                'kategori_nama' => 'Facial Wash',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'WRD02',
                'kategori_nama' => 'Moisturizer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'WRD03',
                'kategori_nama' => 'Sunscreen',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'WRD04',
                'kategori_nama' => 'Serum',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kategori_kode' => 'WRD05',
                'kategori_nama' => 'Toner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('m_kategori')->insert($data);
    }
}
