@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Absen Masuk Karyawan</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if(!$alreadyAbsence)
                <div id="absenTimeAlert" class="alert alert-danger" style="display:none;">
                    Absen masuk Sebentar lagi Segera Absen. Waktu toleransi telat hanya 10 menit.
                </div>
                @endif
                <form id="absenForm" action="{{ route('prosesabsenkaryawan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @include('Karyawan.absen.components_absen.navbar')
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text" name="user_name" class="form-control" value="{{ $user->name }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            @if($user->divisi)
                            <div class="form-group">
                                <label>Nama Divisi</label>
                                <input type="text" name="divisi_name" class="form-control" value="{{ $user->divisi->divisi_name }}" readonly />
                            </div>
                        @else
                            <div class="form-group">
                                <label>Nama Divisi</label>
                                <input type="text" name="divisi_name" class="form-control" value="N/A" readonly />
                            </div>
                        @endif                        
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Status Kehadiran</label>
                                <select name="status_absen" id="status_absen" class="form-control" required onchange="toggleFields()">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="tidak_hadir">Tidak Hadir</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Tanggal Rekapitulasi Kehadiran</label>
                                <input type="date" name="tanggal_absen" id="tanggal_absen" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4" id="waktu_datang_container">
                            <div class="form-group">
                                <label>Waktu Datang Kehadiran</label>
                                <input type="text" name="waktu_datang_kehadiran" id="waktu_datang_kehadiran" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4" id="surat_izin_sakit_container">
                            <div class="form-group">
                                <label>Surat Izin/Sakit</label>
                                <input type="file" name="surat_izin_sakit" id="surat_izin_sakit" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 mt-4" id="bukti_kehadiran_container">
                            <div class="form-group">
                                <label>Bukti Kehadiran</label>
                                <div class="camera-container" style="display: flex; align-items: center;">
                                    <div>
                                        <button type="button" id="start-camera" class="btn btn-primary">Aktifkan Kamera</button>
                                        <video id="video" width="320" height="240" autoplay style="display:none;"></video>
                                        <button type="button" id="snap" class="btn btn-success" style="display:none;">Ambil Foto</button>
                                        <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                        <input type="hidden" name="bukti_kehadiran" id="bukti_kehadiran">
                                    </div>
                                    <div style="margin-left: 20px;">
                                        <img id="photo" src="" alt="Hasil Foto" style="display:none;" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
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

@section('scripts')
<script>
    function toggleFields() {
        const statusAbsen = document.getElementById('status_absen').value;
        const buktiKehadiranContainer = document.getElementById('bukti_kehadiran_container');
        const waktuDatangContainer = document.getElementById('waktu_datang_container');
        const suratIzinSakitContainer = document.getElementById('surat_izin_sakit_container');

        if (statusAbsen === 'hadir') {
            buktiKehadiranContainer.style.display = 'block';
            waktuDatangContainer.style.display = 'block';
            suratIzinSakitContainer.style.display = 'none';
        } else {
            buktiKehadiranContainer.style.display = 'none';
            waktuDatangContainer.style.display = 'none';
            suratIzinSakitContainer.style.display = 'block';
        }
    }

    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const formattedTime = `${hours}:${minutes}:${seconds}`;
        document.getElementById('waktu_datang_kehadiran').value = formattedTime;
    }

    function checkAbsenTime() {
        const now = new Date();
        const minAbsenTime = new Date();
        minAbsenTime.setHours(13, 45, 0);
        const maxAbsenTime = new Date();
        maxAbsenTime.setHours(13, 50, 0);

        const absenTimeAlert = document.getElementById('absenTimeAlert');
        const alreadyAbsence = @json($alreadyAbsence);
        
        if (!alreadyAbsence && now >= minAbsenTime && now <= maxAbsenTime) {
            const minutesLeft = Math.floor((maxAbsenTime - now) / 60000);
            const secondsLeft = Math.floor((maxAbsenTime - now) / 1000) % 60;
            absenTimeAlert.textContent = `Absen masuk Sebentar lagi Segera Absen. Sekarang sudah memasuki waktu ${now.getHours()}:${now.getMinutes()}:${now.getSeconds()} WIB. Waktu toleransi telat hanya ${minutesLeft} menit ${secondsLeft} detik.`;
            absenTimeAlert.style.display = 'block';
        } else {
            absenTimeAlert.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        toggleFields();
        updateTime();
        setInterval(updateTime, 1000);
        setInterval(checkAbsenTime, 1000);

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById('snap');
        const photo = document.getElementById('photo');
        const buktiKehadiran = document.getElementById('bukti_kehadiran');
        const startCamera = document.getElementById('start-camera');

        startCamera.addEventListener('click', function() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.style.display = 'block';
                    snap.style.display = 'block';
                    video.srcObject = stream;
                })
                .catch(error => {
                    console.error('Error accessing camera: ', error);
                });
        });

        snap.addEventListener('click', function() {
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, 320, 240);
            const dataURL = canvas.toDataURL('image/png');
            buktiKehadiran.value = dataURL;
            photo.src = dataURL;
            photo.style.display = 'block';
        });

        document.getElementById('absenForm').addEventListener('submit', function(event) {
            const now = new Date();
            const minAbsenTime = new Date();
            minAbsenTime.setHours(13, 45, 0);
            const maxAbsenTime = new Date();
            maxAbsenTime.setHours(13, 50, 0);

            if (now < minAbsenTime) {
                alert('Absen masuk hanya dapat dilakukan mulai pukul 08:10 WIB.');
                event.preventDefault();
            }

            if (now > maxAbsenTime) {
                alert('Anda terlambat lebih dari 10 menit. Anda dianggap tidak hadir.');
                event.preventDefault();
            }
        });
    });
</script>
@endsection
