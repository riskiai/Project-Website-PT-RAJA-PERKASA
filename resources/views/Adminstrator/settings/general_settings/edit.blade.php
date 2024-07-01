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
          <h4>Edit Data Setting APK</h4>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('settings.update', $setting->id) }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="{{ $setting->email }}" required />
                </div>
              </div>
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Telefon</label>
                  <input type="text" name="phone" class="form-control" value="{{ $setting->phone }}" required />
                </div>
              </div>
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Tanggal Kerja</label>
                  <input type="text" name="tanggal_kerja" class="form-control" value="{{ $setting->tanggal_kerja }}" required />
                </div>
              </div>
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Copyright</label>
                  <input type="text" name="copyright" class="form-control" value="{{ $setting->copyright }}" required />
                </div>
              </div>
              <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="{{ route('settings') }}" class="btn btn-cancel">Cancel</a>
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
          .create(document.querySelector('#comment'))
          .catch(error => {
              console.error(error);
          });
  });
</script>
@endsection
