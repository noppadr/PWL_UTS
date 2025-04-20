<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil data yang diperlukan dengan join antar tabel
        $penjualanDetails = DB::table('t_penjualan_detail as pd')
            ->join('t_penjualan as p', 'pd.penjualan_id', '=', 'p.penjualan_id')
            ->join('m_barang as b', 'pd.barang_id', '=', 'b.barang_id')
            ->join('m_kategori as k', 'b.kategori_id', '=', 'k.kategori_id')
            ->join('m_user as u', 'p.user_id', '=', 'u.user_id')
            ->select(
                'p.penjualan_id',
                'b.barang_id',
                'u.user_id',
                'k.kategori_id',
                'p.penjualan_kode',
                'p.penjualan_tanggal',
                'p.pembeli',
                'b.barang_nama',
                'k.kategori_nama',
                'pd.harga',
                'pd.jumlah',
                DB::raw('pd.harga * pd.jumlah as total'),
                'u.username'
            )
            ->get();

        $data = [];

        foreach ($penjualanDetails as $detail) {
            $data[] = [
                'penjualan_id'      => $detail->penjualan_id,
                'barang_id'         => $detail->barang_id,
                'user_id'           => $detail->user_id,
                'kategori_id'       => $detail->kategori_id,
                'penjualan_kode'    => $detail->penjualan_kode,
                'penjualan_tanggal' => $detail->penjualan_tanggal,
                'pembeli'           => $detail->pembeli,
                'barang_nama'       => $detail->barang_nama,
                'kategori_nama'     => $detail->kategori_nama,
                'harga'             => $detail->harga,
                'jumlah'            => $detail->jumlah,
                'total'             => $detail->total,
                'username'          => $detail->username,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }

        DB::table('t_laporan_penjualan')->insert($data);
    }
}
