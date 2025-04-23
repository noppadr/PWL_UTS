@extends('layouts.template')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Kategori yang terdaftar pada sistem</h3>
        <div class="card-tools">
            <div class="row">
                <a href="{{ url('/kategori/create') }}" class="btn btn-primary mr-2">
                    Tambah Data
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{session('success')}}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
        @endif

        <table class="table table-bordered table-striped table-hover table-sm" id="table_kategori">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori Kode</th>
                    <th>Kategori Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    var dataKategori;
    $(document).ready(function() {
        dataKategori = $('#table_kategori').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{url('kategori/list')}}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d._token = "{{ csrf_token() }}";
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "kategori_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori_nama",
                    className: "",
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
    });
</script>
@endpush