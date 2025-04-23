<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\StokModel;
use App\Models\BarangModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    // Menampilkan halaman awal stok barang
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Stok',
            'list' => ['Home', 'Stok']
        ];
    
        $page = (object)[
            'title' => 'Daftar stok yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'stok'; // set menu yang sedang aktif
        $user = UserModel::all(); 
    
        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Ambil data user dalam bentuk json untuk datatables public function list(Request $request)
    public function list(Request $request)
    {
        $stok = StokModel::select('stok_id', 'barang_id', 'user_id', 'stok_tanggal', 'stok_jumlah')
            ->with(['barang', 'user']);
    
        // filter data user berdasarkan user_id
        if ($request->user_id) {
            $stok->where('user_id', $request->user_id);
        }
    
        return DataTables::of($stok)
             // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) { 
                $btn = '';
                // menambahkan kolom aksi
                //$btn = '<a href="'.url('/stok/' . $stok->stok_id).'" class="btn btn-info btn-sm">Detail</a> ';
                //$btn .= '<a href="'.url('/stok/' . $stok->stok_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
                //$btn .= '<form class="d-inline-block" method="POST" action="'. url('/stok/'.$stok->stok_id).'">'
                //    . csrf_field() . method_field('DELETE') .
                //    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                //return $btn;

                //$btn = '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/stok/' . $stok->stok_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;

            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    // Menampilkan halaman form tambah barang
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Stok',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object)[
            'title' => 'Tambah stok baru'
        ];

        $barang = Barang::all();
        $user = UserModel::all(); 
        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan data barang baru
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);

        StokModel::create([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil disimpan');
    }

    // Menampilkan detail barang
    public function show(string $id)
    {
        $stok = StokModel::with(['barang', 'user'])->find($id);

        $breadcrumb = (object)[
            'title' => 'Detail Stok',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object)[
            'title' => 'Detail stok'
        ];

        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page,'stok' => $stok, 'activeMenu' => $activeMenu]);
    }

    // Menampilkan halaman form edit barang
    public function edit(string $id)
    {
        $stok = StokModel::find($id);

        $breadcrumb = (object)[
            'title' => 'Edit Stok',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object)[
            'title' => 'Edit stok'
        ];

        $barang = Barang::all();
        $user = UserModel::all(); 
        $activeMenu = 'stok'; // set menu yang sedang aktif

        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'stok' => $stok, 'barang' => $barang, 'user' => $user, 'activeMenu' => $activeMenu]);
    }

    // Menyimpan perubahan data barang

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_id' => 'required|integer',
            'user_id' => 'required|integer',
            'stok_tanggal' => 'required|date',
            'stok_jumlah' => 'required|integer|min:1',
        ]);

        StokModel::find($id)->update([
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'stok_tanggal' => $request->stok_tanggal,
            'stok_jumlah' => $request->stok_jumlah,
        ]);

        return redirect('/stok')->with('success', 'Data stok berhasil diubah');
    }

    // Menghapus data barang
    public function destroy(string $id)
    {
        $check = StokModel::find($id);
        if (!$check) {  // untuk mengecek apakah data barang dengan id yang dimaksud ada atau tidak
            return redirect('/stok')->with('error', 'Data stok tidak ditemukan');
        }

        try {
            StokModel::destroy($id);  // Hapus data kategori
            return redirect('/stok')->with('success', 'Data stok berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {

            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('/stok')->with('error', 'Data stok gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}