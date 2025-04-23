@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(empty($penjualan))
                    <div class="card-header">Kesalahan</div>
                    <div class="card-body">
                        <div class="alert alert-danger">
                            <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                            Data yang anda cari tidak ditemukan
                        </div>
                        <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
                    </div>
                @else
                    <div class="card-header">Detail Data Penjualan</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Kode Penjualan</label>
                            <input type="text" class="form-control" value="{{ $penjualan->penjualan_kode }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Pembeli</label>
                            <input type="text" class="form-control" value="{{ $penjualan->pembeli }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Penjualan</label>
                            <input type="text" class="form-control" value="{{ $penjualan->penjualan_tanggal }}" readonly>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ url('/penjualan') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection