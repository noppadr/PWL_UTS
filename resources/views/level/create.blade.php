@extends('layouts.template')

@section('content')
    <div class="card card-outpine card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('level') }}" id="form-create" class="form-horizontal">
                @csrf
                
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Level Kode</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_kode" name="level_kode" 
                            value="{{ old('level_kode') }}" maxlength="5">
                        @error('level_kode')
                            <small class="error-text form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Level Nama</label>
                    <div class="col-11">
                        <input type="text" class="form-control" id="level_nama" name="level_nama" 
                            value="{{ old('level_nama') }}" minlength="3" maxlength="50">
                        @error('level_nama')
                            <small class="error-text form-text text-danger"></small>
                        @enderror   
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-1 control-label col-form-label"></label>
                    <div class="col-11">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a class="btn btn-sm btn-default ml-1" href="{{ url('level') }}">Kembali</a>
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
                level_kode: {required: true,maxlength: 5},
                level_nama: {required: true, minLength: 3, maxlength: 50}
            }, 
            messages: {
                level_kode: {
                    required: "Level Kode harus diisi",
                    maxlength: "Level Kode maksimal 5 karakter"
                },
                level_nama: {
                    required: "Level Nama harus diisi",
                    minlength: "Level Nama minimal 3 karakter",
                    maxlength: "Level Nama maksimal 50 karakter"
                }
            },
            errorElement: "small",
            errorClass: "error-text form-text text-danger",
            
        })
    })
</script>
@endpush