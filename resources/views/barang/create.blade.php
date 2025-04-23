@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('barang') }}" id="form-create" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kategori</label>
                    <div class="col-11">
                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                            <option value="">- Pilih Kategori -</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Kode Barang</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="barang_kode" name="barang_kode"
                            value="{{ old('barang_kode') }}" maxlength="6" required>
                        <small class="form-text text-muted">Masukkan kode barang (maksimal 6 karakter)</small>
                        @error('barang_kode')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama Barang</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="barang_nama" name="barang_nama"
                            value="{{ old('barang_nama') }}" minlength="3" maxlength="50">
                        @error('barang_nama')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Harga Jual</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                            value="{{ old('harga_jual') }}" required>
                        @error('harga_jual')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Stok</label>
                    <div class="col-11">
                        <input type="number" class="form-control" id="stok" name="stok"
                            value="{{ old('stok') }}" required>
                        @error('stok')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Gambar</label>
                    <div class="col-11">
                        <input type="file" class="form-control-file" id="gambar" name="gambar">
                        <small class="form-text text-muted">Upload gambar produk (opsional)</small>
                        @error('gambar')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('barang') }}">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#form-create').validate({
                rules: {
                    kategori_id: {
                        required: true
                    },
                    barang_kode: {
                        required: true,
                        maxlength: 6
                    },
                    barang_nama: {
                        required: true,
                        minlength: 3,
                        maxlength: 50
                    },
                    harga_jual: {
                        required: true
                    },
                    stok: {
                        required: true
                    }
                },
                messages: {
                    kategori_id: {
                        required: "Kategori harus dipilih"
                    },
                    barang_kode: {
                        required: "Kode Barang harus diisi",
                        maxlength: "Kode Barang maksimal 6 karakter"
                    },
                    barang_nama: {
                        required: "Nama Barang harus diisi",
                        minlength: "Nama Barang minimal 3 karakter",
                        maxlength: "Nama Barang maksimal 50 karakter"
                    },
                    harga_jual: {
                        required: "Harga Jual harus diisi"
                    },
                    stok: {
                        required: "Stok harus diisi"
                    }
                },
                errorElement: "small",
                errorClass: "error-text form-text text-danger",
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            })
        })
    </script>
@endpush
