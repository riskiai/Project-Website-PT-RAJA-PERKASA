@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<style type="text/css">
    .ck-editor__editable_inline {
        height: 300px;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Data Settings Title di PT Raja Perkasa</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('settings_title.update', $settingTitle->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Title Judul Fitur Website</label>
                                <input type="text" name="title_nama" class="form-control" value="{{ $settingTitle->title_nama }}" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{ route('settings_title') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi CKEditor pada modal tambah data
    ClassicEditor
        .create(document.querySelector('#alamat'))
        .catch(error => {
            console.error(error);
        });
});
</script>
@endsection
