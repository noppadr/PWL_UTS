@empty($penjualan)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang anda cari tidak ditemukan
            </div>
            <a href="{{ url('/penjualan') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="{{ url('/penjualan/' . $penjualan->penjualan_id) }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" type="text" name="penjualan_kode" id="penjualan_kode" class="form-control @error('penjualan_kode') is-invalid @enderror" required>
                    @error('penjualan_kode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Pembeli</label>
                    <input type="text" name="pembeli" id="pembeli" class="form-control @error('pembeli') is-invalid @enderror" value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                    @error('pembeli')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>User (Pegawai)</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->nama }}" readonly>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @error('user_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="date" class="form-control @error('penjualan_tanggal') is-invalid @enderror" name="penjualan_tanggal"
                        value="{{ old('penjualan_tanggal', \Carbon\Carbon::parse($penjualan->penjualan_tanggal)->format('Y-m-d')) }}" required>
                    @error('penjualan_tanggal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
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
        $("#form-edit").validate({
            rules: {
                penjualan_kode: { required: true },
                pembeli: { required: true },
                penjualan_tanggal: { required: true, date: true }
            },
            messages: {
                penjualan_kode: { required: "Kode penjualan wajib diisi" },
                pembeli: { required: "Pembeli wajib diisi" },
                penjualan_tanggal: { 
                    required: "Tanggal penjualan wajib diisi", 
                    date: "Format tanggal tidak valid" 
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
        
        // If redirected with session message, close modal and display success message
        @if(session('success'))
            $('#myModal').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}"
            });
        @endif
    });
</script>
@endempty