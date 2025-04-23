@extends('layouts.template')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Penjualan yang terdaftar pada sistem</h3>
        <div class="card-tools">
            <div class="row">
                <button onclick="modalAction('{{ url('/penjualan/create') }}')" class="btn btn-primary mr-2">
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
                    <th>Total Harga</th>
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

    function viewDetails(penjualan_id) {
        modalAction('{{ url('/penjualan/details') }}/' + penjualan_id);
    }

    function deleteData(penjualan_id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data penjualan akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ url("/penjualan/delete") }}/' + penjualan_id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        if (res.status) {
                            $('#table_penjualan').DataTable().ajax.reload();
                            Swal.fire('Sukses', res.message, 'success');
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function () {
                        Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
                    }
                });
            }
        });
    }

    $(document).ready(function () {
        $('#table_penjualan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('penjualan_detail/list') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                }
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
                    data: 'penjualan_id', 
                    name: 'penjualan_id', 
                    width: "15%" 
                },
                { 
                    data: 'barang_id', 
                    name: 'barang_id', 
                    width: "20%" 
                },
                { 
                    data: 'jumlah', 
                    name: 'jumlah', 
                    width: "20%" 
                },
                { 
                    data: 'harga', 
                    name: 'harga', 
                    width: "15%", 
                    render: function (data) {
                        return 'Rp ' + data.toLocaleString('id-ID');
                    }
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