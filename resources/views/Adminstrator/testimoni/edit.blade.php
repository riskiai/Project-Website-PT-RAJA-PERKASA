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
          <h4>Update Testimoni Tentang PT Raja Perkasa</h4>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('testimoni.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="POST"> 
            <div class="row">
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Status Testimoni</label>
                  <select name="status_testimoni" class="select">
                    <option value="active" {{ $data->status_testimoni == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="nonactive" {{ $data->status_testimoni == 'nonactive' ? 'selected' : '' }}>Inactive</option>
                  </select>                
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Nama Client</label>
                  <select name="user_id" class="select">
                    @foreach($clients as $client)
                      <option value="{{ $client->id }}" {{ $data->user_id == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Nama Mitra</label>
                  <select name="mitra_id" class="select">
                    @foreach($mitras as $mitra)
                      <option value="{{ $mitra->id }}" {{ $data->mitra_id == $mitra->id ? 'selected' : '' }}>{{ $mitra->name_mitra }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Jabatan</label>
                  <input type="text" name="position" class="form-control" value="{{ $data->position }}" required />
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>File Image</label>
                  <input type="file" name="image[]" class="form-control" multiple />
                  @if($data->image)
                    <div class="mt-2">
                      @foreach(explode(',', $data->image) as $image)
                        <img src="{{ asset('storage/photo-testimoni/' . $image) }}" alt="Image" width="100" class="img-thumbnail">
                      @endforeach
                    </div>
                  @endif
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Komentar</label>
                  <textarea class="form-control" id="comment" name="comment" rows="4" required>{!! $data->comment !!}</textarea>
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
