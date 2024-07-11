@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Cuti Anda</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-top mt-3">
            <div class="search-set">
              <div class="search-path">
                <a class="btn btn-filter" id="filter_search">
                  <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                  <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" />
                </a>
              </div>
              <div class="search-input">
                <a class="btn btn-searchset">
                  <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img" />
                </a>
              </div>
            </div>
          </div>

        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="table-responsive">
          <table class="table datanew text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Divisi</th>
                <th>Alasan Cuti</th>
                <th>Lokasi Area Kerja</th>
                <th>Tanggal Pengambilan Cuti</th>
                <th>Tanggal Masuk Kembali</th>
                <th>Status</th>
                <th>File Cuti</th>
                <th>File Balasan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($cutis as $index => $cuti)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $cuti->user->name }}</td>
                <td>{{ $cuti->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td>{{ $cuti->alasan_cuti }}</td>
                <td>{{ $cuti->lokasi_area_kerja }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->pengambilan_cuti_tgl)->translatedFormat('j F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($cuti->masuk_kembali_tgl)->translatedFormat('j F Y') }}</td>
                <td>
                  @if($cuti->status_cuti == 'belumdicek')
                    <span class="badge bg-warning">Belum Dicek</span>
                  @elseif($cuti->status_cuti == 'disetujui')
                    <span class="badge bg-success">Disetujui</span>
                  @elseif($cuti->status_cuti == 'tidak_disetujui')
                    <span class="badge bg-danger">Tidak Disetujui</span>
                  @endif
                </td>
                <td>
                  @if($cuti->file_cuti)
                    <a href="{{ asset('storage/' . $cuti->file_cuti) }}" target="_blank">Lihat File</a>
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if($cuti->file_balasan)
                    <a href="{{ asset('storage/' . $cuti->file_balasan) }}" target="_blank">Lihat File</a>
                  @else
                    -
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

@endsection
