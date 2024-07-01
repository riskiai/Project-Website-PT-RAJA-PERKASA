@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<style type="text/css">
    .ck-editor__editable_inline {
        height: 300px;
    }
    .form-control[readonly] {
        background-color: #f9f9f9; /* Sesuaikan dengan warna yang diinginkan */
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Detail Data Proyek</h4>
      </div>
      <div class="page-btn">
        <a href="{{ route('proyeklist') }}" class="btn btn-added">
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
                <label>Title Proyek</label>
                <input type="text" class="form-control" value="{{ $proyek->title_proyek }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Nama Proyek</label>
                <input type="text" class="form-control" value="{{ $proyek->project_name }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Nama Klien</label>
                <input type="text" class="form-control" value="{{ $proyek->client_name }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Kontraktor Utama</label>
                <input type="text" class="form-control" value="{{ $proyek->main_contractor }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Scope</label>
                <input type="text" class="form-control" value="{{ $proyek->scope }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Start Date Proyek</label>
                <input type="date" class="form-control" value="{{ $proyek->start_date_proyek }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>End Date Proyek</label>
                <input type="date" class="form-control" value="{{ $proyek->end_date_proyek }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Value</label>
                <input type="text" class="form-control" value="{{ $proyek->value }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Status Progres Proyek</label>
                  <input type="text" class="form-control" value="{{ $proyek->status_progres_proyek == 'sedangberjalan' ? 'Sedang Berjalan' : 'Selesai' }}" readonly>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                  <label>Status Proyek</label>
                  <input type="text" class="form-control" value="{{ $proyek->status_proyek == 'disetujui' ? 'Disetujui' : ($proyek->status_proyek == 'tidak_disetujui' ? 'Tidak Disetujui' : 'Belum Dicek') }}" readonly>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Keterangan Status Proyek</label>
                <input type="text" class="form-control" value="{{ $proyek->keterangan_status_proyek }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>PO (PDF)</label>
                <a href="{{ Storage::url($proyek->po) }}" target="_blank" class="form-control" readonly>{{ 'po_' . Str::slug($proyek->project_name, '_') . '.pdf' }}</a>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Handover (PDF)</label>
                <a href="{{ Storage::url($proyek->handover) }}" target="_blank" class="form-control" readonly>{{ 'handover_' . Str::slug($proyek->project_name, '_') . '.pdf' }}</a>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
                <div class="form-group">
                    <label>Gambar Proyek</label>
                    @if($proyek->image)
                        @php
                            $images = json_decode($proyek->image, true);
                        @endphp
                        @foreach($images as $image)
                            <a href="{{ Storage::url($image) }}" target="_blank">
                                <img src="{{ Storage::url($image) }}" alt="Project Image" style="width:100px; height:auto; margin-right:10px;">
                            </a>
                        @endforeach
                    @else
                        <p>N/A</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Materials</label>
                <input type="text" class="form-control" value="{{ $proyek->materials->nama_materials ?? 'N/A' }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Brand Materials</label>
                <input type="text" class="form-control" value="{{ $proyek->brandMaterials->nama_brand_materials ?? 'N/A' }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Peralatan</label>
                <input type="text" class="form-control" value="{{ $proyek->peralatan->nama_peralatan ?? 'N/A' }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Brand Peralatan</label>
                <input type="text" class="form-control" value="{{ $proyek->brandPeralatan->nama_brand_peralatan ?? 'N/A' }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Created Date</label>
                <input type="text" class="form-control" value="{{ $proyek->created_at->format('Y-m-d') }}" readonly>
              </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-12">
              <div class="form-group">
                <label>Updated Date</label>
                <input type="text" class="form-control" value="{{ $proyek->updated_at->format('Y-m-d') }}" readonly>
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
