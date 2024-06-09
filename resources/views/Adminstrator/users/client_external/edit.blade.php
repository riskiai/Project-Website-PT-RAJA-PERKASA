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
          <h4>Edit Data Kerja Sama Client</h4>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('userslistclienteditproses', $dataKerjasama->user_id) }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Status Kerja Sama</label>
                  <select name="status_kerjasama" class="select">
                    <option value="ditunggu" {{ $dataKerjasama->status_kerjasama == 'ditunggu' ? 'selected' : '' }}>Ditunggu</option>
                    <option value="diterima" {{ $dataKerjasama->status_kerjasama == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ $dataKerjasama->status_kerjasama == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>                
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Keterangan Status Kerja Sama</label>
                  <input type="text" name="keterangan_status_kerjasama" class="form-control" value="{{ $dataKerjasama->keterangan_status_kerjasama }}" />
                </div>
              </div>
              <!-- Tambahkan elemen input lainnya sesuai dengan kebutuhan -->
              <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="{{ route('userslisteclient') }}" class="btn btn-cancel">Cancel</a>
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
