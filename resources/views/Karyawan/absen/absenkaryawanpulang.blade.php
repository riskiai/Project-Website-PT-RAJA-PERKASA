@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Absen Pulang Karyawan</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(!$alreadyCheckedOut)
                <div id="pulangTimeAlert" class="alert alert-warning alert-dismissible fade show" style="display:none;" role="alert">
                    Sekarang sudah memasuki waktu setelah jam 14:20. Anda bisa pulang sekarang atau melanjutkan lembur.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{ route('prosesabsenkaryawanpulang') }}" method="POST" enctype="multipart/form-data">
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
                                <label>Divisi Name</label>
                                <input type="text" name="divisi_name" class="form-control" value="{{ $user->divisi->divisi_name }}" readonly />
                            </div>
                            @else
                            <div class="form-group">
                                <label>Divisi Name</label>
                                <input type="text" name="divisi_name" class="form-control" value="N/A" readonly />
                            </div>
                            @endif   
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Tanggal Absen</label>
                                <input type="date" name="tanggal_absen" id="tanggal_absen" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 mt-4">
                            <div class="form-group">
                                <label>Waktu Pulang Kehadiran</label>
                                <input type="text" name="waktu_pulang_kehadiran" id="waktu_pulang_kehadiran" class="form-control" readonly />
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
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const formattedTime = `${hours}:${minutes}:${seconds}`;
        document.getElementById('waktu_pulang_kehadiran').value = formattedTime;

        @if(!$alreadyCheckedOut)
        const pulangTimeAlert = document.getElementById('pulangTimeAlert');
        const today = now.toISOString().split('T')[0]; // Format YYYY-MM-DD
        const alertClosedDate = localStorage.getItem('pulangTimeAlertClosedDate');

        if ((now.getHours() > 1 || (now.getHours() === 1 && now.getMinutes() >= 58)) && alertClosedDate !== today) {
            pulangTimeAlert.style.display = 'block';
            setTimeout(() => {
                pulangTimeAlert.style.display = 'none';
            }, 10000); // Notifikasi akan hilang setelah 10 detik
        } else {
            pulangTimeAlert.style.display = 'none';
        }
        @endif
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateTime(); // Set initial time
        setInterval(updateTime, 1000); // Update time every second

        @if(!$alreadyCheckedOut)
        const pulangTimeAlert = document.getElementById('pulangTimeAlert');
        const closeButton = pulangTimeAlert.querySelector('.btn-close');
        
        closeButton.addEventListener('click', function () {
            const now = new Date();
            const today = now.toISOString().split('T')[0]; // Format YYYY-MM-DD
            localStorage.setItem('pulangTimeAlertClosedDate', today);
        });
        @endif
    });
</script>
@endsection
