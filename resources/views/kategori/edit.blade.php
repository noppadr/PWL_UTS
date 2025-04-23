@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
            @endif
            
            <form method="POST" action="{{ url('kategori/' . $kategori->kategori_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-2 control-label col-form-label">Kategori Kode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kategori_kode" name="kategori_kode"
                            value="{{ old('kategori_kode', $kategori->kategori_kode) }}" required maxlength="5">
                        <small class="form-text text-muted">Masukkan kode kategori (maksimal 5 karakter)</small>
                        @error('kategori_kode')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 control-label col-form-label">Kategori Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="kategori_nama" name="kategori_nama"
                            value="{{ old('kategori_nama', $kategori->kategori_nama) }}" required>
                        @error('kategori_nama')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a class="btn btn-default ml-1" href="{{ url('kategori') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush