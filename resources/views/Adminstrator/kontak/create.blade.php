@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<style type="text/css">
    .ck-editor__editable_inline {
        height: 300px;
    }
    .map-container {
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')

<div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Create Data Kontak Di PT Raja Perkasa</h4>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('kontakcreateproses') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Telefon</label>
                  <input type="text" name="phone" class="form-control" />
                </div>
              </div>
              <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                  <label>Status Kontak</label>
                  <select name="status_kontak" class="form-control select">
                    <option value="active">Active</option>
                    <option value="nonactive">Non Active</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Link</label>
                  <input type="url" name="links" class="form-control" id="link" />
                </div>
              </div>
              <div class="col-lg-12 map-container" id="map-container" style="display: none;">
                <label>Map Preview</label>
                <iframe id="map-preview" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" id="alamat" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="{{ route('kontaklist') }}" class="btn btn-cancel">Cancel</a>
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

    // Tampilkan pratinjau peta saat URL dimasukkan
    $('#link').on('input', function() {
        const url = $(this).val();
        if (url) {
            $('#map-container').show();
            $('#map-preview').attr('src', url);
        } else {
            $('#map-container').hide();
            $('#map-preview').attr('src', '');
        }
    });
});
</script>
@endsection
