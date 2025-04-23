<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar Barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $barang = Barang::select('barang_id', 'barang_kode', 'barang_nama', 'harga_jual', 'stok', 'gambar', 'kategori_id')->with('kategori');

        if ($request->kategori_id) {
            $barang->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($barang)
            ->addIndexColumn()

            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="/barang/'. $barang->barang_id .'/show" class="btn btn-info btn-sm mr-1">Detail</a>';
                $btn .= '<a href="/barang/'. $barang->barang_id .'/edit" class="btn btn-warning btn-sm mr-1">Edit</a>';
                $btn .= '<a href="/barang/'. $barang->barang_id .'/delete" class="btn btn-danger btn-sm mr-1">Delete</a>';

                return $btn;
            })

            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang Baru'
        ];

        $kategori = KategoriModel::all();
        $activeMenu = 'barang';

        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_kode'   => 'required|string|min:3|unique:m_barang,barang_kode',
            'barang_nama'   => 'required|string|max:100',
            'harga_jual'    => 'required|integer',
            'stok'          => 'required|integer',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id'   => 'required|integer'
        ]);

        $data = [
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama,
            'harga_jual'    => $request->harga_jual,
            'stok'          => $request->stok,
            'kategori_id'   => $request->kategori_id
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['gambar'] = 'images/' . $imageName;
        }

        Barang::create($data);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function show(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Detail Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $barang = Barang::with('kategori')->find($id);
        $activeMenu = 'barang';

        return view('barang.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $barang = Barang::find($id);
        $kategori = KategoriModel::all();

        $activeMenu = 'barang';

        return view('barang.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'barang' => $barang, 'kategori' => $kategori, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang_kode'   => 'required|string|min:3|unique:m_barang,barang_kode,' . $id . ',barang_id',
            'barang_nama'   => 'required|string|max:100',
            'harga_jual'    => 'required|integer',
            'stok'          => 'required|integer',
            'gambar'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori_id'   => 'required|integer'
        ]);

        $barang = Barang::find($id);
        
        $data = [
            'barang_kode'   => $request->barang_kode,
            'barang_nama'   => $request->barang_nama,
            'harga_jual'    => $request->harga_jual,
            'stok'          => $request->stok,
            'kategori_id'   => $request->kategori_id
        ];

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if it exists
            if ($barang->gambar && file_exists(public_path($barang->gambar))) {
                unlink(public_path($barang->gambar));
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['gambar'] = 'images/' . $imageName;
        }

        $barang->update($data);

        return redirect('/barang')->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(string $id)
    {
        $check = Barang::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            // Delete image if it exists
            if ($check->gambar && file_exists(public_path($check->gambar))) {
                unlink(public_path($check->gambar));
            }
            
            Barang::destroy($id);

            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang 
                gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}