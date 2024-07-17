@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')

<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .ck-editor__editable_inline {
        height: 300px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 28px;
    }
    .select2-container .select2-selection--single {
        height: 36px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
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
                <label>Status Testimoni</label>
                <select name="status_testimoni" class="select select2">
                  <option value="active">Active</option>
                  <option value="nonactive">In Active</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Nama Client PIC Perusahaan</label>
                <select name="user_id" class="select select2">
                  <option value="">Pilih Nama Client yang Sudah Ada</option>
                  @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Atau Masukkan Nama Perwakilan Mitra Perusahaan</label>
                <input type="text" name="new_user_name" class="form-control" placeholder="Nama Client Baru" />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Nama Mitra Perusahaan</label>
                <select name="mitra_id" class="select select2">
                  @foreach($mitras as $mitra)
                    <option value="{{ $mitra->id }}">{{ $mitra->name_mitra }}</option>
                  @endforeach
                </select>
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
                <input type="file" name="image" class="form-control" required />
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

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    ClassicEditor
        .create(document.querySelector('#comment'))
        .catch(error => {
            console.error(error);
        });

    $('.select2').select2({
        tags: true,
        placeholder: "Select or type",
        allowClear: true
    });
});
</script>
@endsection
