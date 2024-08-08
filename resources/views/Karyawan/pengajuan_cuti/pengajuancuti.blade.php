@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<style>
    .status-container {
        padding: 15px;
        border-radius: 5px;
        margin-top: 20px;
    }
    .status-container.belumdicek {
        background-color: #ffe6cc; /* Background color untuk belum dicek */
    }
    .status-container.disetujui {
        background-color: #d4edda; /* Background color untuk disetujui */
    }
    .status-container.tidak_disetujui {
        background-color: #f8d7da; /* Background color untuk tidak disetujui */
    }
    .status-container h5 {
        color: #ff8c1a; /* Text color yang sesuai */
    }
    .status-container p {
        color: #333; /* Text color untuk paragraf */
    }
    .countdown {
        font-weight: bold;
        color: red;
    }
</style>
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Pengajuan Cuti Karyawan</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if($pengajuan->isEmpty())
                    <div class="alert alert-info">
                        Anda belum mengajukan cuti. Silakan <a href="https://docs.google.com/document/d/1QlTFZ7MSEM6zxIXFlxzwmy7TmU8hbEGy/edit?usp=sharing&ouid=100067878945190770414&rtpof=true&sd=true" target="_blank">download contoh format izin cuti</a> dan ajukan permohonan cuti Anda.
                    </div>
                @endif

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @include('Karyawan.pengajuan_cuti.components.navbarcuti')

                <form action="{{ route('pengajuancutikaryawancreateprosess') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Nama Karyawan</label>
                                <input type="text" name="user_name" class="form-control" value="{{ $user->name }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Divisi Name</label>
                                <input type="text" name="divisi_name" class="form-control" value="{{ $user->divisi ? $user->divisi->divisi_name : 'N/A' }}" readonly />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Alasan Cuti</label>
                                <textarea name="alasan_cuti" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>File Cuti</label>
                                <input type="file" name="file_cuti" class="form-control" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Lokasi Area Kerja</label>
                                <input type="text" name="lokasi_area_kerja" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Pengambilan Cuti</label>
                                <input type="date" name="pengambilan_cuti_tgl" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Masuk Kembali</label>
                                <input type="date" name="masuk_kembali_tgl" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>

                @foreach($pengajuan as $item)
                    <div class="status-container {{ $item->status_cuti }}" id="statusCuti-{{ $item->id }}">
                        @if($item->status_cuti == 'belumdicek' || $item->status_cuti == 'tidak_disetujui')
                        <h5>Status Cuti Anda</h5>
                        @else($item->status_cuti == 'disetujui')
                        <h5 class="text-success">Status Cuti Anda</h5>
                        @endif

                        <p>Status: 
                            @if($item->status_cuti === 'belumdicek')
                                Belum Dicek
                            @elseif($item->status_cuti === 'disetujui')
                                Disetujui
                            @elseif($item->status_cuti === 'tidak_disetujui')
                                Tidak Disetujui
                            @endif
                        </p>
                        @if($item->status_cuti === 'disetujui' && $item->file_balasan)
                            <p>File Balasan: <a href="{{ asset('storage/' . $item->file_balasan) }}" target="_blank" class="text-success">Lihat File Balasan</a></p>
                            <p>Notifikasi ini akan hilang dalam <span class="countdown" id="countdown-{{ $item->id }}">60</span> detik</p>
                        @elseif($item->status_cuti === 'tidak_disetujui')
                            <p>Pengajuan cuti Anda ditolak. Silakan hubungi HRD untuk informasi lebih lanjut.</p>
                        @else
                            <p>Pengajuan cuti Anda masih dalam proses pemeriksaan.</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hide alert after 30 seconds
        setTimeout(function() {
            let alertElement = document.querySelector('.alert-success');
            if (alertElement) {
                alertElement.style.display = 'none';
            }
        }, 30000);

        // Enable close button for alert
        let closeButton = document.querySelector('.btn-close');
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                let alertElement = closeButton.closest('.alert');
                alertElement.style.display = 'none';
            });
        }

        // Hide status container after 60 seconds and show countdown
        document.querySelectorAll('.status-container.disetujui').forEach(function(element) {
            let countdownElement = element.querySelector('.countdown');
            let countdownTime = parseInt(countdownElement.innerHTML);

            let interval = setInterval(function() {
                countdownTime -= 1;
                countdownElement.innerHTML = countdownTime;

                if (countdownTime <= 0) {
                    clearInterval(interval);
                    localStorage.setItem('hideStatus' + element.id, true);
                    element.style.display = 'none';
                }
            }, 1000);
        });

        // Check localStorage to hide previously hidden status containers
        document.querySelectorAll('.status-container.disetujui').forEach(function(element) {
            if (localStorage.getItem('hideStatus' + element.id)) {
                element.style.display = 'none';
            }
        });
    });
</script>
@endsection
