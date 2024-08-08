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
</style>
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Pengajuan Pengunduran Diri Karyawan</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(!$pengunduranTerakhir)
                    <div class="alert alert-info">
                        Anda belum mengajukan pengunduran diri. Silakan <a href="https://docs.google.com/document/d/1QlTFZ7MSEM6zxIXFlxzwmy7TmU8hbEGy/edit?usp=sharing&ouid=100067878945190770414&rtpof=true&sd=true" target="_blank">download contoh format pengunduran diri</a> dan ajukan permohonan pengunduran diri Anda.
                    </div>
                @endif

                <form action="{{ route('pengajuandirikaryawancreateprosess') }}" method="POST" enctype="multipart/form-data">
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
                                <label>Alasan Pengunduran Diri</label>
                                <textarea name="alasan_pengunduran_diri" class="form-control" required>{{ old('alasan_pengunduran_diri', $pengunduranTerakhir->alasan_pengunduran_diri ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>File Pengunduran Diri</label>
                                <input type="file" name="file_pengundurandiri" class="form-control" required />
                                @if(isset($pengunduranTerakhir->file_pengunduran_diri))
                                    <a href="{{ asset('storage/' . $pengunduranTerakhir->file_pengunduran_diri) }}" target="_blank">File Pengajuan Diri Anda</a>
                                @endif
                                    {{-- <a href="{{ url('/path/to/contoh-format-pengunduran-diri.pdf') }}" target="_blank">Contoh Surat Pengajuan Pengunduran Diri Karyawan</a>
                                @endif --}}
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>

                @if(isset($pengunduranTerakhir))
                    <div class="status-container {{ $pengunduranTerakhir->status_pengunduran_diri }}">
                        @if($pengunduranTerakhir->status_pengunduran_diri == 'belumdicek' || $pengunduranTerakhir->status_pengunduran_diri == 'tidak_disetujui')
                        <h5>Status Pengunduran Diri Anda</h5>
                        @else($pengunduranTerakhir->status_pengunduran_diri == 'disetujui')
                        <h5 class="text-success">Status Pengunduran Diri Anda</h5>
                        @endif

                        <p>Status: 
                            @if($pengunduranTerakhir->status_pengunduran_diri === 'belumdicek')
                                Belum Dicek
                            @elseif($pengunduranTerakhir->status_pengunduran_diri === 'disetujui')
                                Disetujui
                            @elseif($pengunduranTerakhir->status_pengunduran_diri === 'tidak_disetujui')
                                Tidak Disetujui
                            @endif
                        </p>
                        @if($pengunduranTerakhir->status_pengunduran_diri === 'disetujui' && isset($pengunduranTerakhir->file_balasan))
                            <p>Dokumen Balasan: <a href="{{ asset('storage/' . $pengunduranTerakhir->file_balasan) }}" target="_blank" class="text-success">Lihat Dokumen</a></p>
                        @elseif($pengunduranTerakhir->status_pengunduran_diri === 'tidak_disetujui')
                            <p>Pengunduran diri Anda ditolak. Silakan hubungi HRD untuk informasi lebih lanjut.</p>
                        @else
                            <p>Pengunduran diri Anda masih dalam proses pemeriksaan.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
