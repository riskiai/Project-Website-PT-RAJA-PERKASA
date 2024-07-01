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
                <h4>Edit Data Materials PT Raja Perkasa</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('materials.update', $materials->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Materials</label>
                                <input type="text" name="nama_materials" class="form-control" value="{{ $materials->nama_materials }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status Materials</label>
                                <select name="status_materials" class="select">
                                    <option value="tersedia" {{ $materials->status_materials == 'tersedia' ? 'selected' : '' }}>Berfungsi</option>
                                    <option value="tidak_tersedia" {{ $materials->status_materials == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Berfungsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{ route('materialslist') }}" class="btn btn-cancel">Cancel</a>
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
        ClassicEditor
            .create(document.querySelector('#detail_description'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
