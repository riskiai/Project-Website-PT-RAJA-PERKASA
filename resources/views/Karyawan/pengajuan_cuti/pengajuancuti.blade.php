@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Pengajuan Cuti Karyawan</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text" name="user_id" class="form-control" value="{{ $pengajuan[0]['user_id'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" name="role_name" class="form-control" value="{{ $pengajuan[0]['role_name'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Divisi Name</label>
                                <input type="text" name="divisi_name" class="form-control" value="{{ $pengajuan[0]['divisi_name'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Alasan Cuti</label>
                                <textarea name="alasan_cuti" class="form-control" required>{{ $pengajuan[0]['alasan_cuti'] }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Status Pengajuan Cuti</label>
                                <input type="text" name="status_pengajuan_cuti" class="form-control" value="{{ $pengajuan[0]['status_pengajuan_cuti'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>File Pengajuan Cuti</label>
                                <input type="file" name="file_pengajuan_cuti" class="form-control" />
                                <a href="{{ asset($pengajuan[0]['file_pengajuan_cuti']) }}" target="_blank">Contoh Surat Pengajuan Cuti Karyawan</a>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
