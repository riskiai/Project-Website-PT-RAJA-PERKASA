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
          <h4>Update Data Jasa Di PT Raja Perkasa</h4>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('mitra.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                  <label>Status PT Raja Perkasa</label>
                  <select name="status_mitra" class="select">
                    <option value="active" {{ $data->status_mitra == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="nonactive" {{ $data->status_mitra == 'nonactive' ? 'selected' : '' }}>In Active</option>
                  </select>
                </div>
              </div>
              {{-- <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" value="{{ $data->title }}" />
                </div>
              </div> --}}

              <div class="col-lg-6 col-sm-6 col-12">
                <div class="form-group">
                    <label>File Image</label>
                    <input type="file" name="image[]" class="form-control" multiple />
                    @if($data->image)
                    <div class="mt-2">
                      @foreach(explode(',', $data->image) as $image)
                        <img src="{{ asset('storage/photo-mitra/' . $image) }}" alt="Image" width="100" class="img-thumbnail">
                      @endforeach
                    </div>
                  @endif
                </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-12">
              <div class="form-group">
                  <label>Nama Mitra</label>
                  <input type="text" name="name_mitra" class="form-control" value="{{ $data->name_mitra }}" />
              </div>
          </div>
            
              <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="{{ route('tentanglist') }}" class="btn btn-cancel">Cancel</a>
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
          .create(document.querySelector('#detail_description'))
          .catch(error => {
              console.error(error);
          });

  });
</script>

@endsection
