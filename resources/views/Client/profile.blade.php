@extends('Pengunjung.Components.app')

@section('style')
<style>
    #imageProfilePreview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        display: block;
        margin: 0 auto 10px;
    }

    #imageKTPPreview {
        width: 200px;
        height: 120px;
        object-fit: cover;
        display: block;
        margin: 0 auto 10px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Data Diri</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('profileupdate', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 text-center">
                            <label for="imageProfile" class="form-label">Image Profile</label>
                            <div id="imageProfilePreviewContainer">
                                <img id="imageProfilePreview" src="{{ $user->file_foto ? asset('storage/client/photo-profile/' . $user->file_foto) : asset('img/default.png') }}" alt="your image" />
                            </div>
                            <input class="form-control" type="file" id="imageProfile" name="file_foto" onchange="previewImage('imageProfile', 'imageProfilePreview');">
                        </div>

                        <div class="mb-3 text-center">
                            <label for="imageKTP" class="form-label">File KTP</label>
                            <div id="imageKTPPreviewContainer">
                                <img id="imageKTPPreview" src="{{ $user->file_ktp ? asset('storage/client/file_ktp/' . $user->file_ktp) : asset('img/ktp.jpg') }}" alt="your image" />
                            </div>
                            <input class="form-control" type="file" id="imageKTP" name="file_ktp" onchange="previewImage('imageKTP', 'imageKTPPreview');">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama PIC</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Your Name PIC">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email PIC</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Your Email PIC">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Handphone</label>
                            <input type="tel" class="form-control" id="phone" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" placeholder="Your Phone Number" pattern="\d*" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik', $user->nik) }}" placeholder="Your NIK" pattern="\d*" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                        </div>

                        <div class="mb-3">
                            <p class="form-label">*Lengkapi Data Diri Anda Jika Ingin Melanjutkan Kerja Sama dengan Mitra PT Raja Perkasa!</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function previewImage(inputId, previewId) {
        var input = document.getElementById(inputId);
        var preview = document.getElementById(previewId);
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endsection
