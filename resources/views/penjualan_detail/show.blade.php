@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($detail)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data detail penjualan yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{ $detail->detail_id }}</td>
                </tr>
                <tr>
                    <th>Penjualan ID</th>
                    <td>{{ $detail->penjualan_id }}</td>
                </tr>
                <tr>
                    <th>Barang ID</th>
                    <td>{{ $detail->barang_id }}</td>
                </tr>
                <tr>
                    <th>Harga</th>
                    <td>{{ number_format($detail->harga, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td>{{ $detail->jumlah }}</td>
                </tr>
            </table>
        @endempty
        <a href="{{ url('detail') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush