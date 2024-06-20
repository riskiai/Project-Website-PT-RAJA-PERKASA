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
        <h4>Edit Data List Peralatan PT Raja Perkasa</h4>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <form action="{{ route('listdataperalatan.update', $listPeralatan->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Nama Peralatan</label>
                <select name="peralatans_id" class="select" required>
                  @foreach($peralatans as $peralatan)
                    <option value="{{ $peralatan->id }}" {{ $listPeralatan->peralatans_id == $peralatan->id ? 'selected' : '' }}>{{ $peralatan->nama_peralatan }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Brand Peralatan</label>
                <select name="brand__peralatans_id" class="select" required>
                  @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ $listPeralatan->brand__peralatans_id == $brand->id ? 'selected' : '' }}>{{ $brand->nama_brand_peralatan }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Capacity</label>
                <input type="text" name="capacity" class="form-control" value="{{ $listPeralatan->capacity }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Tahun Beli</label>
                <input type="date" name="tahun_beli_peralatans" class="form-control" value="{{ $listPeralatan->tahun_beli_peralatans }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Ownership</label>
                <input type="text" name="ownership" class="form-control" value="{{ $listPeralatan->ownership }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Tools Certificate (PDF)</label>
                <input type="file" name="tools_certificate" class="form-control" accept="application/pdf" />
                @if($listPeralatan->tools_certificate)
                  <a href="{{ Storage::url($listPeralatan->tools_certificate) }}" target="_blank">Lihat Sertifikat</a>
                @endif
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Certificate Expired Date</label>
                <input type="date" name="certificate_expired_date" class="form-control" value="{{ $listPeralatan->certificate_expired_date }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Certificate By</label>
                <input type="text" name="certificate_by" class="form-control" value="{{ $listPeralatan->certificate_by }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Unit Quantity</label>
                <input type="text" name="unit_qty" class="form-control" value="{{ $listPeralatan->unit_qty }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Status Peralatan</label>
                <select name="status_list_peralatans" class="select" required>
                  <option value="active" {{ $listPeralatan->status_list_peralatans == 'active' ? 'selected' : '' }}>Active</option>
                  <option value="nonactive" {{ $listPeralatan->status_list_peralatans == 'nonactive' ? 'selected' : '' }}>Nonactive</option>
                </select>
              </div>
            </div>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-submit me-2">Submit</button>
              <a href="{{ route('listdataperalatan') }}" class="btn btn-cancel">Cancel</a>
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
