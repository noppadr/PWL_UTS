<?php
namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\PenjualanModel;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Data Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar Transaksi Penjualan'
        ];

        $activeMenu = 'penjualan';

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $penjualan = PenjualanModel::select(
            'penjualan_id',
            'user_id',
            'pembeli',
            'penjualan_kode',
            'penjualan_tanggal',
            'created_at',
            'updated_at'
        )->with('user'); // Jika relasi ke User diset

        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<a href="/penjualan/'. $penjualan->penjualan_id .'/show" class="btn btn-info btn-sm mr-1">Detail</a>';
                $btn .= '<a href="/penjualan/'. $penjualan->penjualan_id .'/edit" class="btn btn-warning btn-sm mr-1">Edit</a>';
                $btn .= '<a href="/penjualan/'. $penjualan->penjualan_id .'/delete" class="btn btn-danger btn-sm mr-1">Delete</a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Form Tambah Penjualan'
        ];

        $users = User::all();
        $activeMenu = 'penjualan';

        return view('penjualan.create', compact('breadcrumb', 'page', 'users', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:100',
            'penjualan_kode' => 'required|string|unique:penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date'
        ]);

        PenjualanModel::create($request->all());

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil disimpan');
    }

    public function show(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Detail Penjualan',
            'list' => ['Home', 'Penjualan', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Transaksi'
        ];

        $penjualan = PenjualanModel::with('user')->findOrFail($id);
        $activeMenu = 'penjualan';

        return view('penjualan.show', compact('breadcrumb', 'page', 'penjualan', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $breadcrumb = (object) [
            'title' => 'Edit Penjualan',
            'list' => ['Home', 'Penjualan', 'Edit']
        ];

        $page = (object) [
            'title' => 'Form Edit Penjualan'
        ];

        $penjualan = PenjualanModel::findOrFail($id);
        $users = User::all();
        $activeMenu = 'penjualan';

        return view('penjualan.edit', compact('breadcrumb', 'page', 'penjualan', 'users', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'pembeli' => 'required|string|max:100',
            'penjualan_kode' => 'required|string|unique:penjualan,penjualan_kode,' . $id . ',penjualan_id',
            'penjualan_tanggal' => 'required|date'
        ]);

        $penjualan = PenjualanModel::findOrFail($id);
        $penjualan->update($request->all());

        return redirect('/penjualan')->with('success', 'Data penjualan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $penjualan = PenjualanModel::find($id);

        if (!$penjualan) {
            return redirect('/penjualan')->with('error', 'Data penjualan tidak ditemukan');
        }

        $penjualan->delete();
        return redirect('/penjualan')->with('success', 'Data penjualan berhasil dihapus');
    }
}
