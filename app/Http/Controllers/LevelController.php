<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        DB::table('m_level')->insert([
            'level_kode' => 'CUS',
            'level_nama' => 'Pelanggan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return 'Insert data baru berhasil';
    }
}
