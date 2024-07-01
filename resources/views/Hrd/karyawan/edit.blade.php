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
                <h4>Edit Data Karyawan PT Raja Perkasa</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('karyawan.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" name="nik" class="form-control" value="{{ old('nik', $user->nik) }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" />
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Divisi</label>
                                <select name="divisi_id" class="form-control" required>
                                    <option value="">Pilih Divisi</option>
                                    @foreach($divisi as $d)
                                    <option value="{{ $d->id }}" {{ old('divisi_id', $user->divisi_id) == $d->id ? 'selected' : '' }}>{{ $d->divisi_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $user->alamat) }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir', $user->tgl_lahir) }}" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select name="jk" class="form-control" required>
                                    <option value="L" {{ old('jk', $user->jk) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jk', $user->jk) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>File Foto</label>
                                <input type="file" name="file_foto" class="form-control" />
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>File KTP</label>
                                <input type="file" name="file_ktp" class="form-control" />
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah KTP</small>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Update</button>
                            <a href="{{ route('karyawanlist') }}" class="btn btn-cancel">Cancel</a>
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
