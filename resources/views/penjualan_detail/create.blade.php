@extends('layouts.template')

@section('content')

<form action="{{ url('/detail') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Detail Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                {{-- Penjualan ID (Dropdown) --}}
                <div class="form-group row">
                    <label for="penjualan_id" class="col-sm-3 col-form-label text-right">Penjualan</label>
                    <div class="col-sm-9">
                        <select name="penjualan_id" id="penjualan_id" class="form-control @error('penjualan_id') is-invalid @enderror" required>
                            <option value="">Pilih Penjualan</option>
                            <!-- Assume Penjualan data is passed from controller -->
                            @foreach ($penjualans as $penjualan)
                                <option value="{{ $penjualan->id }}">{{ $penjualan->penjualan_kode }}</option>
                            @endforeach
                        </select>
                        @error('penjualan_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Barang ID (Dropdown) --}}
                <div class="form-group row">
                    <label for="barang_id" class="col-sm-3 col-form-label text-right">Barang</label>
                    <div class="col-sm-9">
                        <select name="barang_id" id="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                            <option value="">Pilih Barang</option>
                            <!-- Assume Barang data is passed from controller -->
                            @foreach ($barangs as $barang)
                                <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Harga --}}
                <div class="form-group row">
                    <label for="harga" class="col-sm-3 col-form-label text-right">Harga</label>
                    <div class="col-sm-9">
                        <input type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" required>
                        @error('harga')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Jumlah --}}
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-3 col-form-label text-right">Jumlah</label>
                    <div class="col-sm-9">
                        <input type="number" name="jumlah" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror" required>
                        @error('jumlah')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function () {
    $("#form-tambah").validate({
        rules: {
            penjualan_id: {
                required: true
            },
            barang_id: {
                required: true
            },
            harga: {
                required: true,
                number: true,
                min: 1
            },
            jumlah: {
                required: true,
                number: true,
                min: 1
            }
        },
        messages: {
            penjualan_id: {
                required: "Penjualan wajib dipilih"
            },
            barang_id: {
                required: "Barang wajib dipilih"
            },
            harga: {
                required: "Harga wajib diisi",
                number: "Harga harus berupa angka",
                min: "Harga minimal 1"
            },
            jumlah: {
                required: "Jumlah wajib diisi",
                number: "Jumlah harus berupa angka",
                min: "Jumlah minimal 1"
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>

@endsection