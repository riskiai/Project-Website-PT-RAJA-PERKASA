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
                <form action="{{ route('prosesabsenkaryawan') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="form-group">
                                <label>Divisi Name</label>
                                <input type="text" name="divisi_name" class="form-control" value="{{ $user->divisi->divisi_name }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Status Absen</label>
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
                                <label>Tanggal Absen</label>
                                <input type="date" name="tanggal_absen" id="tanggal_absen" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Waktu Datang Kehadiran</label>
                                <input type="text" name="waktu_datang_kehadiran" id="waktu_datang_kehadiran" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Surat Izin/Sakit</label>
                                <input type="file" name="surat_izin_sakit" id="surat_izin_sakit" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 mt-4">
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
        const buktiKehadiran = document.getElementById('bukti_kehadiran');
        const suratIzinSakit = document.getElementById('surat_izin_sakit');

        if (statusAbsen === 'hadir') {
            buktiKehadiran.removeAttribute('disabled');
            suratIzinSakit.setAttribute('disabled', 'disabled');
        } else {
            buktiKehadiran.setAttribute('disabled', 'disabled');
            suratIzinSakit.removeAttribute('disabled');
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

    document.addEventListener('DOMContentLoaded', function () {
        toggleFields(); // Initial call to set the correct state on load
        updateTime(); // Set initial time
        setInterval(updateTime, 1000); // Update time every second

        // Video stream setup
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
    });
</script>
@endsection
