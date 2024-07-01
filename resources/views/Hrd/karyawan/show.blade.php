@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Detail Data Karyawan PT Raja Perkasa</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama Karyawan</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" value="{{ $user->nik }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Divisi</label>
                            <input type="text" class="form-control" value="{{ $user->divisi ? $user->divisi->divisi_name : '-' }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>No HP</label>
                            <input type="text" class="form-control" value="{{ $user->no_hp }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="{{ $user->alamat }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control" value="{{ $user->tgl_lahir->format('Y-m-d') }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{ $user->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}" disabled />
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>File Foto</label>
                            @if($user->file_foto)
                            <p><a href="{{ asset('storage/' . $user->file_foto) }}" target="_blank">Lihat Foto</a></p>
                            @else
                            <p>Tidak ada foto</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>File KTP</label>
                            @if($user->file_ktp)
                            <p><a href="{{ asset('storage/' . $user->file_ktp) }}" target="_blank">Lihat KTP</a></p>
                            @else
                            <p>Tidak ada KTP</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <a href="{{ route('karyawanlist') }}" class="btn btn-cancel">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection
