@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Absen Karyawan</h4>
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
                                <input type="text" name="user_id" class="form-control" value="{{ $absen[0]['user_id'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" name="role_name" class="form-control" value="{{ $absen[0]['role_name'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Divisi Name</label>
                                <input type="text" name="divisi_name" class="form-control" value="{{ $absen[0]['divisi_name'] }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Status Absen</label>
                                <select name="status_absen" class="form-control">
                                    <option value="Hadir" {{ $absen[0]['status_absen'] == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                    <option value="Izin" {{ $absen[0]['status_absen'] == 'Izin' ? 'selected' : '' }}>Izin</option>
                                    <option value="Sakit" {{ $absen[0]['status_absen'] == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                    <option value="Tidak Hadir" {{ $absen[0]['status_absen'] == 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Mulai Absen</label>
                                <input type="date" name="date_start_absen" class="form-control" value="{{ $absen[0]['date_start_absen'] }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Selesai Absen</label>
                                <input type="date" name="date_end_absen" class="form-control" value="{{ $absen[0]['date_end_absen'] }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>File Muka Absen</label>
                                <input type="file" name="file_muka_absen" class="form-control" />
                                {{-- <a href="{{ asset($absen[0]['file_muka_absen']) }}" target="_blank">Contoh Surat Absen Karyawan</a> --}}
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
