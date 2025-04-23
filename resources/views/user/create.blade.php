@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('user') }}" id="form-create" class="form-horizontal">
                @csrf

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Level</label>
                    <div class="col-11">
                        <select class="form-control" id="level_id" name="level_id" required>
                            <option value="">- Pilih Level -</option>
                            @foreach ($level as $item)
                                <option value="{{ $item->level_id }}">{{ $item->level_nama }}</option>
                            @endforeach
                        </select>
                        @error('level_id')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Username</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="username" name="username"
                            value="{{ old('username') }}" maxlength="6" required>
                        @error('username')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Nama</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="nama" name="nama" 
                            value="{{ old('nama') }}" minlength="3" maxlength="50">
                        @error('nama')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Password</label>
                    <div class="col-11">
                        <input type="password" class="form-control" id="password" name="password" minlength="6">
                        @error('password')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('user') }}">Kembali</a>
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
    $(document).ready(function () {
        $('#form-create').validate({
            rules: {
                level_id: {
                    required: true
                },
                username: {
                    required: true,
                    maxlength: 6
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                level_id: {
                        required: "Level harus dipilih"
                    },
                username: {
                    required: "Username harus diisi",
                    maxlength: "Username maksimal 6 karakter"
                },
                nama: {
                    required: "Nama harus diisi",
                    minlength: "Nama minimal 3 karakter",
                    maxlength: "Nama maksimal 50 karakter"
                },
                password: {
                    required: "Password harus diisi",
                    minlength: "Password minimal 6 karakter"
                }
            },
            errorElement: "small",
            errorClass: "error-text form-text text-danger",
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endpush

