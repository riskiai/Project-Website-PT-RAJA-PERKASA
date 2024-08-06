@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')
<style>
    .bg-lightorange {
        background-color: orange;
        color: white;
    }
    .action-icons a, .action-icons button {
        margin-right: 10px;
    }
    .action-icons img {
        vertical-align: middle;
    }
    .action-icons .btn-delete img {
        filter: invert(0);
    }
    #filter_inputs {
        display: none; /* Initially hidden */
    }
    #filter_inputs.show {
        display: block; /* Show when class 'show' is added */
    }
    .filter-reset-buttons {
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        gap: 10px;
    }
    @media (max-width: 576px) {
        .filter-reset-buttons {
            flex-direction: column;
            align-items: flex-end;
        }
        .filter-reset-buttons .btn {
            margin-right: 0;
            margin-bottom: 10px;
        }
    }
    .input-groupicon {
        position: relative;
    }
    .input-groupicon input {
        padding-right: 40px;
    }
    .input-groupicon input::-webkit-calendar-picker-indicator {
        position: absolute;
        right: 10px;
        top: 70%;
        transform: translateY(-50%);
        z-index: 2;
        cursor: pointer;
    }
    .addonset {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
</style>
@endsection

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
              <button class="btn btn-filter" id="filter_toggle">
                <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" />
              </button>
            </div>
            <div class="search-input">
              <button class="btn btn-searchset">
                <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img" />
              </button>
            </div>
          </div>
          <div class="wordset">
            <ul>
                <li>
                    <a href="{{ route('exportreportlistabsenkaryawan') }}" id="export_button" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                        <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img" />
                    </a>
                </li>
            </ul>
          </div>
        </div>

        <div class="card" id="filter_inputs">
          <div class="card-body pb-0">
            <div class="row">
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <div class="input-groupicon">
                    <label for="">Filter Berdasarkan Bulan Kehadiran</label>
                    <input id="bulan_rekap" class="form-control" name="bulan_rekap" type="month" placeholder="Pilih Bulan Rekap">
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="">Filter Berdasarkan Rekapitulasi Kehadiran</label>
                  <select class="select" id="status_absensi" name="status_absensi">
                    <option value="">Pilih Status Kehadiran</option>
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                    <option value="sakit">Sakit</option>
                    <option value="tidak_hadir">Tidak Hadir</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="">Filter Berdasarkan Divisi</label>
                  <select class="select" id="divisi_id" name="divisi_id">
                    <option value="">Pilih Divisi</option>
                    @foreach($divisis as $divisi)
                      <option value="{{ $divisi->id }}">{{ $divisi->divisi_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              
              <div class="col-lg-3 col-sm-6 col-12 ms-auto filter-reset-buttons">
                <div class="form-group">
                  <button class="btn btn-filters" id="apply_filters">
                    <img src="{{ asset('assets/img/icons/search-whites.svg') }}" alt="img" />
                  </button>
                </div>
                <div class="form-group">
                  <button class="btn btn-reset" id="reset_filters">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
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
                <th>Tanggal Rekapitulasi Kehadiran</th>
                <th>Status Kehadiran</th>
                <th>Mulai Kehadiran</th>
                <th>Mengkahiri Kehadiran</th>
                <th>Bukti Kehadiran</th>
                <th>Surat Izin/Sakit</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->name ?? "Tidak Ada" }}</td>
                <td>{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_absen)->translatedFormat('j F Y') ?? '-' }}</td>
                <td>{{ $item->status_absensi === 'tidak_hadir' ? 'Tidak Hadir' : ucfirst($item->status_absensi) }}</td>
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Toggle filter visibility
    document.getElementById('filter_toggle').addEventListener('click', function () {
        document.getElementById('filter_inputs').classList.toggle('show');
    });

    // Apply filters
    document.getElementById('apply_filters').addEventListener('click', function () {
        const filters = {
            status_absensi: document.querySelector('select[name="status_absensi"]').value,
            divisi_id: document.querySelector('select[name="divisi_id"]').value,
            bulan_rekap: document.querySelector('input[name="bulan_rekap"]').value
        };

        // Save filters in session
        sessionStorage.setItem('filters', JSON.stringify(filters));

        // Redirect to the same route with query parameters
        window.location.href = `{{ route('reportlistabsenkaryawan') }}?${new URLSearchParams(filters).toString()}`;
    });

    // Reset filters
    document.getElementById('reset_filters').addEventListener('click', function () {
        sessionStorage.removeItem('filters');
        window.location.href = `{{ route('reportlistabsenkaryawan') }}`;
    });

    // Export functionality with filters
    document.getElementById('export_button').addEventListener('click', function (e) {
        e.preventDefault();
        const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
        // Redirect to the export route with query parameters
        window.location.href = `{{ route('exportreportlistabsenkaryawan') }}?${new URLSearchParams(filters).toString()}`;
    });
});
</script>
@endsection
