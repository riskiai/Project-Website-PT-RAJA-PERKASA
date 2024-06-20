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
            <h4>Create Data Proyek PT Raja Perkasa</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('listdataproyekcreateproses') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Proyek</label>
                            <input type="text" name="title_proyek" class="form-control" value="{{ old('title_proyek') }}" required />
                            @error('title_proyek')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Project Proyek</label>
                            <input type="text" name="project_name" class="form-control" value="{{ old('project_name') }}" required />
                            @error('project_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Client Name</label>
                            <input type="text" name="client_name" class="form-control" value="{{ old('client_name') }}" required />
                            @error('client_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg_6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Main Contractor</label>
                            <input type="text" name="main_contractor" class="form-control" value="{{ old('main_contractor') }}" required />
                            @error('main_contractor')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Scope</label>
                            <input type="text" name="scope" class="form-control" value="{{ old('scope') }}" required />
                            @error('scope')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Mulai Proyek</label>
                            <input type="date" name="start_date_proyek" class="form-control" value="{{ old('start_date_proyek') }}" required />
                            @error('start_date_proyek')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Akhir Proyek</label>
                            <input type="date" name="end_date_proyek" class="form-control" value="{{ old('end_date_proyek') }}" required />
                            @error('end_date_proyek')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Value</label>
                            <input type="text" name="value" class="form-control" value="{{ old('value') }}" required />
                            @error('value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>PO (PDF)</label>
                            <input type="file" name="po" class="form-control" accept="application/pdf" required />
                            @error('po')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Handover (PDF)</label>
                            <input type="file" name="handover" class="form-control" accept="application/pdf" required />
                            @error('handover')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Images</label>
                            <input type="file" name="image[]" class="form-control" accept="image/*" multiple required />
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    
                    <!-- Select for materials -->
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Materials</label>
                            <select name="materials_id" class="select" required>
                                @foreach($materials as $material)
                                    <option value="{{ $material->id }}" {{ old('materials_id') == $material->id ? 'selected' : '' }}>
                                        {{ $material->nama_materials }}
                                    </option>
                                @endforeach
                            </select>
                            @error('materials_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Select for brand materials -->
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Brand Materials</label>
                            <select name="brand__materials_id" class="select" required>
                                @foreach($brand_materials as $brand_material)
                                    <option value="{{ $brand_material->id }}" {{ old('brand__materials_id') == $brand_material->id ? 'selected' : '' }}>
                                        {{ $brand_material->nama_brand_materials }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand__materials_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Select for peralatan -->
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Peralatan</label>
                            <select name="peralatans_id" class="select" required>
                                @foreach($peralatans as $peralatan)
                                    <option value="{{ $peralatan->id }}" {{ old('peralatans_id') == $peralatan->id ? 'selected' : '' }}>
                                        {{ $peralatan->nama_peralatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('peralatans_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Select for brand peralatans -->
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Brand Peralatan</label>
                            <select name="brand__peralatans_id" class="select" required>
                                @foreach($brand_peralatans as $brand_peralatan)
                                    <option value="{{ $brand_peralatan->id }}" {{ old('brand__peralatans_id') == $brand_peralatan->id ? 'selected' : '' }}>
                                        {{ $brand_peralatan->nama_brand_peralatan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand__peralatans_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                        <a href="{{ route('listdataproyek') }}" class="btn btn-cancel">Cancel</a>
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
