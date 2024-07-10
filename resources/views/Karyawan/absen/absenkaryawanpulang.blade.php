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
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
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
                            <div class="form-group">
                                <label>Divisi Name</label>
                                <input type="text" name="divisi_name" class="form-control" value="{{ $user->divisi->divisi_name }}" readonly />
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
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateTime(); // Set initial time
        setInterval(updateTime, 1000); // Update time every second
    });
</script>
@endsection
