@extends('Pengunjung.Components.app')

@section('style')
<style>
    #imagePreview {
        width: 100px;
        height: 100px;
        border-radius: 50%;
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
                    <h4 style="text-profile">My Profile</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3 text-center">
                            <label for="imageProfile" class="form-label">Image Profile</label>
                            <div id="imagePreviewContainer">
                                <img id="imagePreview" src="{{ asset('img/default.png') }}" alt="your image" />
                            </div>
                            <input class="form-control" type="file" id="imageProfile" onchange="previewImage();">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" placeholder="Your Address">
                        </div>
                        <div class="mb-3">
                            <label for="ktp" class="form-label">File KTP</label>
                            <input class="form-control" type="file" id="ktp">
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" placeholder="Your NIK">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" placeholder="Your Phone Number">
                        </div>
                        <div class="mb-3">
                            <p class="form-label">*Lengkapi Data Profil Anda Jika Ingin Melanjutkan Kerja Sama dengan Mitra PT Raja Perkasa!</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@php
$profileCompleted = true;
@endphp

@if ($profileCompleted)
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-profile">Form Calon Mitra PT Raja Perkasa</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="ktp" class="form-label">File Colaboration Mitra</label>
                            <input class="form-control" type="file" id="ktp">
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">Tanggal Kirim</label>
                            <input type="date" class="form-control" id="nik" >
                        </div>
                        <div class="mb-3">
                            <p class="form-label">*Pastikan File Colaboration Mitra Dapat Dilihat Oleh Pihak PT Raja Perkasa</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Formulir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@section('script')

<script>
    function previewImage() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(document.getElementById('imageProfile').files[0]);
    }
</script>


@endsection
