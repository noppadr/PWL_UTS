@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Penjualan yang terdaftar pada sistem</h3>
        <div class="card-tools">
            <div class="row">
                <button onclick="modalAction('{{ url('/stok/create') }}')" class="btn btn-primary mr-2">
                    Tambah Data
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table class="table table-bordered table-hover table-sm table-striped" id="table_penjualan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Penjualan</th>
                    <th>Tanggal</th>
                    <th>Pembeli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal container -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');

            $('#form-penjualan').on('submit', function (e) {
                e.preventDefault();

                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if (res.status) {
                            $('#myModal').modal('hide');
                            $('#table_penjualan').DataTable().ajax.reload();
                            Swal.fire('Sukses', res.message, 'success');
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                            console.log(res.msgField);
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan saat menyimpan data.', 'error');
                    }
                });
            });
        });
    }

    $(document).ready(function () {
        $('#table_penjualan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('penjualan/list') }}",
                type: 'POST'
            },
            columns: [
                { 
                    data: 'DT_RowIndex', 
                    className: "text-center", 
                    width: "5%", 
                    orderable: false, 
                    searchable: false 
                },
                { 
                    data: 'penjualan_kode', 
                    name: 'penjualan_kode', 
                    width: "15%" 
                },
                { 
                    data: 'penjualan_tanggal', 
                    name: 'penjualan_tanggal', 
                    width: "20%" 
                },
                { 
                    data: 'pembeli', 
                    name: 'pembeli', 
                    width: "20%" 
                },
                { 
                    data: 'aksi', 
                    className: "",
                    width: "15%", 
                    orderable: false, 
                    searchable: false 
                }
            ]
        });
    });
</script>
@endpush