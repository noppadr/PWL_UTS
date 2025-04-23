@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @empty($stok)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data stok yang Anda cari tidak ditemukan.
            </div>
            <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ url('/stok/'.$stok->stok_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label class="col-2 col-form-label">Barang ID</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="barang_id" value="{{ old('barang_id', $stok->barang_id) }}" required>
                        @error('barang_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">User ID</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="user_id" value="{{ old('user_id', $stok->user_id) }}" required>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">Tanggal Stok</label>
                    <div class="col-10">
                        <input type="datetime-local" class="form-control" name="stok_tanggal" value="{{ old('stok_tanggal', \Carbon\Carbon::parse($stok->stok_tanggal)->format('Y-m-d\TH:i:s')) }}" required>
                        @error('stok_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-2 col-form-label">Jumlah Stok</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="stok_jumlah" value="{{ old('stok_jumlah', $stok->stok_jumlah) }}" required>
                        @error('stok_jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ url('stok') }}" class="btn btn-sm btn-default">Kembali</a>
                    </div>
                </div>
            </form>
        @endempty
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
