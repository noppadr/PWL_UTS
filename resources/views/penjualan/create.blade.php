
<form action="{{ url('/penjualan') }}" method="POST" id="form-tambah">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                {{-- Kode Penjualan --}}
                <div class="form-group row">
                    <label for="penjualan_kode" class="col-sm-3 col-form-label text-right">Kode Penjualan</label>
                    <div class="col-sm-9">
                        <input type="text" name="penjualan_kode" id="penjualan_kode" class="form-control @error('penjualan_kode') is-invalid @enderror" required>
                        @error('penjualan_kode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Nama Pembeli (input teks) --}}
                <div class="form-group row">
                    <label for="pembeli" class="col-sm-3 col-form-label text-right">Pembeli</label>
                    <div class="col-sm-9">
                        <input type="text" name="pembeli" id="pembeli" class="form-control @error('pembeli') is-invalid @enderror" required>
                        @error('pembeli')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Penjualan --}}
                <div class="form-group row">
                    <label for="penjualan_tanggal" class="col-sm-3 col-form-label text-right">Tanggal</label>
                    <div class="col-sm-9">
                        <input type="date" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control @error('penjualan_tanggal') is-invalid @enderror" required>
                        @error('penjualan_tanggal')
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
            penjualan_kode: {
                required: true,
                minlength: 3,
                maxlength: 20
            },
            pembeli: {
                required: true,
                maxlength: 50
            },
            penjualan_tanggal: {
                required: true,
                date: true
            }
        },
        messages: {
            penjualan_kode: {
                required: "Kode penjualan wajib diisi",
                maxlength: "Maksimal 20 karakter"
            },
            pembeli: {
                required: "Nama pembeli wajib diisi",
                maxlength: "Maksimal 50 karakter"
            },
            penjualan_tanggal: {
                required: "Tanggal penjualan wajib diisi"
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