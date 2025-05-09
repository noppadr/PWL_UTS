@extends('layouts.template')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Barang yang terdaftar pada sistem</h3>
            <div class="card-tools">
                <div class="row">
                    <button onclick="modalAction('{{ url('/barang/create') }}')" class="btn btn-primary mr-2">
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
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <option value="">- Semua -</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Kategori Barang</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
        var dataBarang;
        $(document).ready(function() {
            dataBarang = $('#table_barang').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('barang/list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": function(data) {
                        data.kategori_id = $('#kategori_id').val();
                    }
                },
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "barang_kode",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "gambar",
                        className: "",
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return data ? '<img src="' + data + '" height="30" alt="' + row
                                .barang_nama + '">' : '-';
                        }
                    },
                    {
                        data: "kategori.kategori_nama",
                        className: "",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "barang_nama",
                        className: "",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "harga_jual",
                        className: "",
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row, meta) {
                            return formatRupiah(data);
                        }
                    },
                    {
                        data: "stok",
                        className: "text-center",
                        orderable: true,
                        searchable: true
                    },
                    
                    
                    {
                        data: "aksi",
                        className: "",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }
        });
    </script>
@endpush
