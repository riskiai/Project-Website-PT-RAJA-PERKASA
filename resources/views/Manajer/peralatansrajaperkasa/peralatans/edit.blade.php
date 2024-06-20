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
                <h4>Edit Data Peralatan PT Raja Perkasa</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('peralatan.update', $peralatan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Peralatan</label>
                                <input type="text" name="nama_peralatan" class="form-control" value="{{ $peralatan->nama_peralatan }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status Peralatan</label>
                                <select name="status_peralatans" class="select">
                                    <option value="berfungsi" {{ $peralatan->status_peralatans == 'berfungsi' ? 'selected' : '' }}>Berfungsi</option>
                                    <option value="tidakberfungsi" {{ $peralatan->status_peralatans == 'tidakberfungsi' ? 'selected' : '' }}>Tidak Berfungsi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('peralatanlist') }}" class="btn btn-cancel">Cancel</a>
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
        // Inisialisasi CKEditor jika diperlukan
        ClassicEditor
            .create(document.querySelector('#detail_description'))
            .catch(error => {
                console.error(error);
            });
    });
</script>
@endsection
