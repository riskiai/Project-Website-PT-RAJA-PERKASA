@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Edit Data Bidang Pekerjaan Proyek</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('bidangpekerjaanproyek.update', $bidangProyek->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Bidang Pekerjaan Proyek</label>
                                <input type="text" name="nama_bidang_pekerjaan_proyek" class="form-control" value="{{ $bidangProyek->nama_bidang_pekerjaan_proyek }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status Bidang Pekerjaan Proyek</label>
                                <select name="status_bidang_pekerjaan_proyek" class="select">
                                    <option value="active" {{ $bidangProyek->status_bidang_pekerjaan_proyek == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="nonactive" {{ $bidangProyek->status_bidang_pekerjaan_proyek == 'nonactive' ? 'selected' : '' }}>Non Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{ route('bidangpekerjaanproyek.list') }}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
