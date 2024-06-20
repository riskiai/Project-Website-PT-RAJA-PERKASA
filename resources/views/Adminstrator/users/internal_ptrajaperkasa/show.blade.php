@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Detail Data Pegawai PT Raja Perkasa</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Data Profil Pegawai</h5>
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control" value="{{ $user->nik }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Nomor Handphone</label>
                            <input type="text" class="form-control" value="{{ $user->no_hp }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="{{ strip_tags($user->alamat) }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control" value="{{ $user->tgl_lahir_formatted }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <input type="text" class="form-control" value="{{ $user->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Divisi Pekerjaan</label>
                            <input type="text" class="form-control" value="{{ $user->divisi ? $user->divisi->divisi_name : '-' }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Role Pekerjaan</label>
                            <input type="text" class="form-control" value="{{ $user->role ? $user->role->role_name : '-' }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Status User</label>
                            <input type="text" class="form-control" value="{{ $user->status_user == 'active' ? 'Active' : 'Inactive' }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Foto Profil</label>
                            @if($user->file_foto)
                                <p><a href="{{ asset('storage/client/photo-profile/' . $user->file_foto) }}" target="_blank">Lihat Foto</a></p>
                            @else
                                <p style="color: red; font-weight: bold;">Foto Profil tidak ditemukan</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>File KTP</label>
                            @if($user->file_ktp)
                                <p><a href="{{ asset('storage/client/file_ktp/' . $user->file_ktp) }}" target="_blank">Lihat KTP</a></p>
                            @else
                                <p style="color: red; font-weight: bold;">File KTP tidak ditemukan</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tanggal Dibuat</label>
                            <input type="text" class="form-control" value="{{ $user->created_at }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-12">
                        <div class="form-group">
                            <label>Tanggal Diperbarui</label>
                            <input type="text" class="form-control" value="{{ $user->updated_at }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12 text-right">
                        <a href="{{ route('userslist') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
