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
        <h4>Detail Data Materials PT Raja Perkasa</h4>
      </div>
      <div class="page-btn">
        <a href="{{ route('listdatamaterials') }}" class="btn btn-added">
          Kembali
        </a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <form>
          <div class="row">
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Nama Materials</label>
                <input type="text" class="form-control" value="{{ $listMaterial->materials->nama_materials }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Brand Materials</label>
                <input type="text" class="form-control" value="{{ $listMaterial->brand_materials->nama_brand_materials }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Country</label>
                <input type="text" class="form-control" value="{{ $listMaterial->countries }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>TKDN</label>
                <input type="text" class="form-control" value="{{ $listMaterial->tkdn }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>TKDN Certificate (PDF)</label>
                @if($listMaterial->tknd_certificate)
                  <a href="{{ Storage::url($listMaterial->tknd_certificate) }}" target="_blank" class="form-control" readonly>{{ 'tkdn_certificate_' . Str::slug($listMaterial->materials->nama_materials, '_') . '.pdf' }}</a>
                @else
                  <input type="text" class="form-control" value="N/A" readonly>
                @endif
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Tools Certificate Materials</label>
                @if($listMaterial->tools_certificate_materials)
                  <a href="{{ Storage::url($listMaterial->tools_certificate_materials) }}" target="_blank" class="form-control" readonly>{{ 'tools_certificate_materials_' . Str::slug($listMaterial->materials->nama_materials, '_') . '.pdf' }}</a>
                @else
                  <input type="text" class="form-control" value="N/A" readonly>
                @endif
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Expired Date</label>
                <input type="date" class="form-control" value="{{ $listMaterial->expired_materials_date }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Status</label>
                <input type="text" class="form-control" value="{{ $listMaterial->status_list_materials }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Created Date</label>
                <input type="text" class="form-control" value="{{ $listMaterial->created_at->format('Y-m-d') }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Updated Date</label>
                <input type="text" class="form-control" value="{{ $listMaterial->updated_at->format('Y-m-d') }}" readonly>
              </div>
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
        .create(document.querySelector('#comment'))
        .catch(error => {
            console.error(error);
        });
});
</script>
@endsection
