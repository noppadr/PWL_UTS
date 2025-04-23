@empty($level)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/level') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/level/' . $level->level_id) }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-ban"></i> Peringatan!</h5>
                        Apakah Anda ingin menghapus data seperti di bawah ini?
                    </div>
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <th class="text-right col-3">Level Kode :</th>
                            <td class="col-9">{{ $level->level_kode }}</td>
                        </tr>
                        <tr>
                            <th class="text-right col-3">Level Nama :</th>
                            <td class="col-9">{{ $level->level_nama }}</td>
                        </tr>
                    </table>
                    
                    @if(session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Anda yakin ingin menghapus data level ini?')">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </form>
    
    @if(session('success'))
    <script>
        $(document).ready(function() {
            // Display success message after redirect
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}"
            });
            
            // Close modal if it exists
            if ($('#myModal').length) {
                $('#myModal').modal('hide');
            }
            
            // Redirect back to index page after short delay
            setTimeout(function() {
                window.location.href = "{{ url('/level') }}";
            }, 1500);
        });
    </script>
    @endif
@endempty