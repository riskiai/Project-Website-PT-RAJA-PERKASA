@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Report Data Absen Karyawan PT Raja Perkasa</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <a class="btn btn-filter" id="filter_search">
                <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" /></span>
              </a>
            </div>
            <div class="search-input">
              <a class="btn btn-searchset">
                <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img" />
              </a>
            </div>
          </div>
          <div class="wordset">
            <ul>
                <li>
                    <a href="{{ route('exportreportlistabsenkaryawan') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                        <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img" />
                    </a>
                </li>
            </ul>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table datanew text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Divisi</th>
                <th>Status Absensi</th>
                <th>Mulai Absen</th>
                <th>Mengakhiri Absen</th>
                <th>Bukti Kehadiran</th>
                <th>Surat Izin/Sakit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td>{{ ucfirst($item->status_absensi) }}</td>
                <td>{{ \Carbon\Carbon::parse($item->waktu_datang_kehadiran)->translatedFormat('j F Y H:i:s') ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->waktu_pulang_kehadiran)->translatedFormat('j F Y H:i:s') ?? '-' }}</td>
                <td>
                  @if($item->bukti_kehadiran)
                    <a href="{{ asset('storage/' . $item->bukti_kehadiran) }}" target="_blank">Lihat Bukti</a>
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if($item->surat_izin_sakit)
                    <a href="{{ asset('storage/' . $item->surat_izin_sakit) }}" target="_blank">Lihat Surat Izin/Sakit</a>
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
