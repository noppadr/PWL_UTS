<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PenjualanDetailModel;
use App\Models\BarangModel;
use App\Models\PenjualanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanDetailController extends Controller
{
    // menampilkan harga barang berdasarkan id barang
    public function getHargaBarang($id)
    {
        $barang = Barang::find($id);
        return response()->json([
            'harga_jual' => $barang ? $barang->harga_jual : 0
        ]);
    }

    public function index()
    {
        $activeMenu = 'penjualan_detail';
        $breadcrumb = (object)[
            'title' => 'Data Detail Penjualan',
            'list'  => ['Home', 'Penjualan', 'Detail']
        ];
        $barang    = Barang::select('barang_id', 'barang_nama')->get();
        $penjualan = PenjualanModel::select('penjualan_id', 'penjualan_kode')->get();

        return view('penjualan_detail.index', compact('activeMenu', 'breadcrumb', 'barang', 'penjualan'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $details = PenjualanDetailModel::with(['penjualan', 'barang']);

            if ($request->filled('penjualan_id')) {
                $details->where('penjualan_id', $request->penjualan_id);
            }

            return DataTables::of($details)
                ->addIndexColumn()
                ->addColumn('penjualan_kode', function ($row) {
                    return $row->penjualan->penjualan_kode ?? '-';
                })
                ->addColumn('barang_nama', function ($row) {
                    return $row->barang->barang_nama ?? '-';
                })
                ->addColumn('aksi', function ($row) {
                    return '<button onclick="modalAction(\''.
                        url("penjualan_detail/{$row->detail_id}/confirm_ajax").
                    '\')" class="btn btn-danger btn-sm">Hapus</button>';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    // public function store_ajax(Request $request)
    // {
    //     if (! $request->ajax()) {
    //         return redirect('/');
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'penjualan_id'      => 'required|exists:t_penjualan,penjualan_id',
    //         'barang_id'         => 'required|exists:m_barang,barang_id',
    //         'jumlah'            => 'required|integer|min:1',
    //         'metode_pembayaran' => 'required|string'
    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status'   => false,
    //             'message'  => 'Validasi Gagal',
    //             'msgField' => $validator->errors()
    //         ]);
    //     }

    //     // mengambil stok barang berdasarkan barang_id
    //     $barang = Barang::find($request->barang_id);
    //     $stok   = DB::table('t_stok')
    //                 ->where('barang_id', $barang->barang_id)
    //                 ->first();

    //     if (! $stok || $stok->stok_jumlah < $request->jumlah) {
    //         return response()->json([
    //             'status'  => false,
    //             'message' => 'Stok tidak mencukupi atau tidak ditemukan'
    //         ]);
    //     }

    //     DB::transaction(function () use ($request, $barang) {
    //         PenjualanDetailModel::create([
    //             'penjualan_id'      => $request->penjualan_id,
    //             'barang_id'         => $barang->barang_id,
    //             'harga'             => $barang->harga_jual,
    //             'jumlah'            => $request->jumlah,
    //         ]);
            
    //         // pengurangan stok
    //         DB::table('t_stok')
    //             ->where('barang_id', $barang->barang_id)
    //             ->decrement('stok_jumlah', $request->jumlah);
    //     });
        
    //     return response()->json([
    //         'status'  => true,
    //         'message' => 'Data detail penjualan berhasil disimpan'
    //     ]);        
    // }

    // public function confirm_ajax($id)
    // {
    //     $detail = PenjualanDetailModel::with(['barang', 'penjualan'])->findOrFail($id);
    //     return view('penjualan_detail.confirm_ajax', ['PenjualanDetail' => $detail]);
    // }

    // public function delete_ajax(Request $request, $id)
    // {
    //     if (! $request->ajax()) {
    //         return redirect('/penjualan_detail');
    //     }

    //     $detail = PenjualanDetailModel::find($id);
    //     if (! $detail) {
    //         return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);
    //     }

    //     $detail->delete();
    //     return response()->json(['status' => true, 'message' => 'Data berhasil dihapus']);
    // }
}