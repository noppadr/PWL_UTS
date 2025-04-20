<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';
    protected $fillable = [
        'barang_kode',
        'barang_nama',
        'harga_jual',
        'stok',
        'kategori_id',
        'level_id'
    ];
    public $timestamps = true;
}
