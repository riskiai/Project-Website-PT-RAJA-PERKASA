@extends('Pengunjung.Components.app')


@section('content')
@php
$profileCompleted = true;
@endphp

@if ($profileCompleted)
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-profile">Form Pengajuan Kerjasama Kepada PT Raja Perkasa</h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="ktp" class="form-label">File Pengajuan Kerja Sama Mitra</label>
                            <input class="form-control" type="file" id="ktp">
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">Tanggal Kirim</label>
                            <input type="date" class="form-control" id="nik" >
                        </div>
                        <div class="mb-3">
                            <p class="form-label">*Pastikan File Pengajuan Kerja Sama Mitra Dapat Dilihat Oleh Pihak PT Raja Perkasa</p>
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