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
        <h4>Create Data Testimoni Tentang PT Raja Perkasa</h4>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <form action="{{ route('testimonicreateproses') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Status PT Raja Perkasa</label>
                <select name="status_testimoni" class="select">
                  <option value="active">Active</option>
                  <option value="nonactive">In Active</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Nama Client</label>
                <input type="text" name="name_client" class="form-control" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Jabatan</label>
                <input type="text" name="position" class="form-control" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>File Image</label>
                <input type="file" name="image[]" class="form-control" multiple required />
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>Komentar</label>
                <textarea class="form-control" id="comment" name="comment"></textarea>
              </div>
            </div>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-submit me-2">Submit</button>
              <a href="{{ route('testimonilist') }}" class="btn btn-cancel">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

{{-- CKEDITOR --}}
@section('scripts')

<script>
$(document).ready(function() {
    // Inisialisasi CKEditor pada modal tambah data
    ClassicEditor
        .create(document.querySelector('#comment'))
        .catch(error => {
            console.error(error);
        });

});
</script>
@endsection