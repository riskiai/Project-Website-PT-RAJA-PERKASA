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
                <h4>Pengajuan Cuti Karyawan</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if($pengajuan->isEmpty())
                    <div class="alert alert-info">
                        Anda belum mengajukan cuti. Silakan <a href="{{ url('/path/to/contoh-format-izin-cuti.pdf') }}" target="_blank">download contoh format izin cuti</a> dan ajukan permohonan cuti Anda.
                    </div>
                @endif

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
                                <textarea name="alasan_cuti" class="form-control" required>{{ old('alasan_cuti', $pengajuanTerakhir->alasan_cuti ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>File Cuti</label>
                                <input type="file" name="file_cuti" class="form-control" />
                                @if(isset($pengajuanTerakhir->file_cuti))
                                    <a href="{{ asset('storage/' . $pengajuanTerakhir->file_cuti) }}" target="_blank">Lihat File Cuti</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Lokasi Area Kerja</label>
                                <input type="text" name="lokasi_area_kerja" class="form-control" required value="{{ old('lokasi_area_kerja', $pengajuanTerakhir->lokasi_area_kerja ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Pengambilan Cuti</label>
                                <input type="date" name="pengambilan_cuti_tgl" class="form-control" required value="{{ old('pengambilan_cuti_tgl', $pengajuanTerakhir->pengambilan_cuti_tgl ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Tanggal Masuk Kembali</label>
                                <input type="date" name="masuk_kembali_tgl" class="form-control" required value="{{ old('masuk_kembali_tgl', $pengajuanTerakhir->masuk_kembali_tgl ?? '') }}" />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>

                @foreach($pengajuan as $item)
                    <div class="status-container {{ $item->status_cuti }}">
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
