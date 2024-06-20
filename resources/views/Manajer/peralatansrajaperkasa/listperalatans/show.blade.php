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
        <h4>Detail Data Peralatan PT Raja Perkasa</h4>
      </div>
      <div class="page-btn">
        <a href="{{ route('listdataperalatan') }}" class="btn btn-added">
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
                <label>Nama Peralatan</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->peralatan->nama_peralatan }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Brand Peralatan</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->brand_peralatan->nama_brand_peralatan }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Capacity</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->capacity }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Tahun Beli</label>
                <input type="date" class="form-control" value="{{ $listPeralatan->tahun_beli_peralatans }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Ownership</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->ownership }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Tools Certificate (PDF)</label>
                @if($listPeralatan->tools_certificate)
                  <a href="{{ Storage::url($listPeralatan->tools_certificate) }}" target="_blank" class="form-control" readonly>{{ 'tools_certificate_' . Str::slug($listPeralatan->peralatan->nama_peralatan, '_') . '.pdf' }}</a>
                @else
                  <input type="text" class="form-control" value="N/A" readonly>
                @endif
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Certificate Expired Date</label>
                <input type="date" class="form-control" value="{{ $listPeralatan->certificate_expired_date }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Certificate By</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->certificate_by }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Unit Quantity</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->unit_qty }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Status Peralatan</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->status_list_peralatans }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Created Date</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->created_at->format('Y-m-d') }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Updated Date</label>
                <input type="text" class="form-control" value="{{ $listPeralatan->updated_at->format('Y-m-d') }}" readonly>
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
