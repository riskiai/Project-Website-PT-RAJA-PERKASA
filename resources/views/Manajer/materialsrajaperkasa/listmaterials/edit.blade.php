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
                <h4>Edit Data List Materials PT Raja Perkasa</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('listdatamaterials.update', $listMaterial->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Materials</label>
                                <select name="materials_id" class="select" required>
                                    @foreach($materials as $material)
                                        <option value="{{ $material->id }}" {{ $listMaterial->materials_id == $material->id ? 'selected' : '' }}>{{ $material->nama_materials }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Brand Materials</label>
                                <select name="brand__materials_id" class="select" required>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $listMaterial->brand__materials_id == $brand->id ? 'selected' : '' }}>{{ $brand->nama_brand_materials }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="countries" class="form-control" value="{{ $listMaterial->countries }}" required />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>TKDN</label>
                                <input type="text" name="tkdn" class="form-control" value="{{ $listMaterial->tkdn }}" required />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>TKDN Certificate (PDF)</label>
                                <input type="file" name="tknd_certificate" class="form-control" accept="application/pdf" />
                                @if($listMaterial->tknd_certificate)
                                    <a href="{{ Storage::url($listMaterial->tknd_certificate) }}" target="_blank">Download</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tools Certificate Materials</label>
                                <input type="file" name="tools_certificate_materials" class="form-control" accept="application/pdf" />
                                @if($listMaterial->tools_certificate_materials)
                                    <a href="{{ Storage::url($listMaterial->tools_certificate_materials) }}" target="_blank">Download</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Expired Date</label>
                                <input type="date" name="expired_materials_date" class="form-control" value="{{ $listMaterial->expired_materials_date }}" required />
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status Materials</label>
                                <select name="status_list_materials" class="select" required>
                                    <option value="active" {{ $listMaterial->status_list_materials == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="nonactive" {{ $listMaterial->status_list_materials == 'nonactive' ? 'selected' : '' }}>Nonactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{ route('listdatamaterials') }}" class="btn btn-cancel">Cancel</a>
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
        .create(document.querySelector('#detail_description'))
        .catch(error => {
            console.error(error);
        });
});
</script>
@endsection
