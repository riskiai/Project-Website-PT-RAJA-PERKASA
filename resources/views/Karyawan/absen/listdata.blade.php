@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

@php
    use Carbon\Carbon;
@endphp


<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Absen Karyawan PT Raja Perkasa</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        @include('Karyawan.absen.components_absen.navbar')
        <div class="table-top mt-3">
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
        </div>

     
        <div class="table-responsive">
          <table class="table datanew text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Divisi</th>
                <th>Tanggal Absen</th>
                <th>Status Absen</th>
                <th>Waktu Datang</th>
                <th>Waktu Pulang</th>
                <th>Bukti Kehadiran</th>
                <th>Surat Izin/Sakit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($absens as $index => $item)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $item->user->name }}</td>
                  <td>{{ $item->user->divisi->divisi_name ?? 'Tidak ada divisi' }}</td>
                  <td>{{ \Carbon\Carbon::parse($item->tanggal_absen)->translatedFormat('j F Y') }}</td>
                  <td>
                    @if($item->waktu_pulang_kehadiran)
                      Hadir
                    @elseif($item->status_absensi == 'izin')
                      Izin
                    @elseif($item->status_absensi == 'sakit')
                      Sakit
                    @elseif(\Carbon\Carbon::parse($item->tanggal_absen)->diffInHours(\Carbon\Carbon::now()) >= 24 && \Carbon\Carbon::now()->gte(\Carbon\Carbon::today()->setTime(0, 46, 0)))
                      Tidak Hadir
                    @elseif(!$item->waktu_datang_kehadiran)
                      Tidak Hadir
                  @elseif(\Carbon\Carbon::parse($item->waktu_datang_kehadiran)->gt(Carbon::createFromTime(0, 45, 0)))
                      Terlambat Absen
                    @else
                      Belum Absen Waktu Pulang
                    @endif
                  </td>\
                  <td>{{ $item->waktu_datang_kehadiran ? \Carbon\Carbon::parse($item->waktu_datang_kehadiran)->format('H:i:s') : '-' }}</td>
                  <td>{{ $item->waktu_pulang_kehadiran ? \Carbon\Carbon::parse($item->waktu_pulang_kehadiran)->format('H:i:s') : '-' }}</td>
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
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    var deleteFormId = null;

    $('.btn-delete').click(function() {
        deleteFormId = $(this).data('id');
        $('#deleteConfirmModal').modal('show');
    });

    $('#confirmDeleteButton').click(function() {
        if (deleteFormId) {
            $('#deleteForm-' + deleteFormId).submit();
        }
    });

    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        
        $('#status_cuti').val(status);
        $('#editForm').attr('action', '/hrd/listcutikaryawanupdate/' + id);
        $('#editModal').modal('show');
    });
});
</script>
@endsection
