@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
<style type="text/css">
    .ck-editor__editable_inline {
        height: 160px;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Edit Data User Internal PT Raja Perkasa</h4>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <form action="{{ route('userupdate', $user->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ $user->nik }}" required />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Nomor Handphone</label>
                <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}" />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="{{ $user->tgl_lahir ? $user->tgl_lahir->format('Y-m-d') : '' }}" />
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jk" class="select">
                  <option value="L" {{ $user->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                  <option value="P" {{ $user->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Divisi Pekerjaan</label>
                <select name="divisi_id" class="select">
                  @foreach($divisis as $divisi)
                    <option value="{{ $divisi->id }}" {{ $user->divisi_id == $divisi->id ? 'selected' : '' }}>{{ $divisi->divisi_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Role Pekerjaan</label>
                <select name="role_id" class="select">
                  @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Status User</label>
                <select name="status_user" class="select">
                  <option value="active" {{ $user->status_user == 'active' ? 'selected' : '' }}>Active</option>
                  <option value="nonactive" {{ $user->status_user == 'nonactive' ? 'selected' : '' }}>Inactive</option>
                </select>
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>File Foto</label>
                <input type="file" name="file_foto" class="form-control" onchange="previewImage(event, 'preview_foto')" />
                @if ($user->file_foto)
                  <img id="preview_foto" src="{{ Storage::url('client/photo-profile/' . $user->file_foto) }}" alt="User Photo" style="max-height: 150px; margin-top: 10px;">
                @else
                  <img id="preview_foto" style="max-height: 150px; margin-top: 10px; display: none;">
                @endif
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>File KTP</label>
                <input type="file" name="file_ktp" class="form-control" onchange="previewImage(event, 'preview_ktp')" />
                @if ($user->file_ktp)
                  <img id="preview_ktp" src="{{ Storage::url('client/file_ktp/' . $user->file_ktp) }}" alt="User KTP" style="max-height: 150px; margin-top: 10px;">
                @else
                  <img id="preview_ktp" style="max-height: 150px; margin-top: 10px; display: none;">
                @endif
              </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control">{{ strip_tags($user->alamat) }}</textarea>
              </div>
            </div>
            <div class="col-lg-12">
              <button type="submit" class="btn btn-submit me-2">Submit</button>
              <a href="{{ route('userslist') }}" class="btn btn-cancel">Cancel</a>
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
        .create(document.querySelector('#alamat'))
        .catch(error => {
            console.error(error);
        });
});

/* Preview Image */
function previewImage(event, id) {
    var input = event.target;
    var reader = new FileReader();
    reader.onload = function() {
        var dataURL = reader.result;
        var output = document.getElementById(id);
        output.src = dataURL;
        output.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endsection
