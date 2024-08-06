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
        margin-bottom: 1.5rem;
    }
    .input-groupicon input {
        padding-right: 40px;
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .input-groupicon label {
        display: block;
        margin-bottom: .5rem;
        color: #495057;
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
        <h4>Report Data Cuti Karyawan PT Raja Perkasa</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <button class="btn btn-filter" id="filter_toggle">
                <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" /></span>
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
                    <a href="#" id="export_button" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
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
                  <label for="start_date">Filter Berdasarkan Tanggal Ambil Cuti</label>
                  <input type="date" class="form-control" id="start_date" name="start_date">
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label >Sampai Dengan Tanggal</label>
                  <input type="date" class="form-control" id="end_date" name="end_date">
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="status_cuti">Filter Berdasarkan Status Cuti</label>
                  <select class="select" id="status_cuti" name="status_cuti">
                    <option value="">Pilih Status Cuti</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="tidak_disetujui">Tidak Disetujui</option>
                    <option value="belumdicek">Belum Dicek</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="divisi_id">Filter Berdasarkan Divisi</label>
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
                <th>Alasan Cuti</th>
                <th>Status Cuti</th>
                <th>Lokasi Area Kerja</th>
                <th>Tanggal Pengambilan Cuti</th>
                <th>Tanggal Masuk Kembali</th>
                <th>File Cuti</th>
                <th>File Balasan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td>{{ $item->alasan_cuti }}</td>
                {{-- <td>{{ ucfirst($item->status_cuti) }}</td> --}}
                <td>
                  @if($item->status_cuti === 'belumdicek')
                      Belum Dicek
                  @elseif($item->status_cuti === 'disetujui')
                      Disetujui
                  @elseif($item->status_cuti === 'tidak_disetujui')
                      Tidak Disetujui
                  @endif
              </td>
                <td>{{ $item->lokasi_area_kerja }}</td>
                <td>{{ \Carbon\Carbon::parse($item->pengambilan_cuti_tgl)->translatedFormat('j F Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->masuk_kembali_tgl)->translatedFormat('j F Y') }}</td>
                <td>
                  @if($item->file_cuti)
                    <a href="{{ asset('storage/' . $item->file_cuti) }}" target="_blank">Lihat File</a>
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if($item->file_balasan)
                    <a href="{{ asset('storage/' . $item->file_balasan) }}" target="_blank">Lihat File</a>
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

  <!-- Modal Konfirmasi Hapus -->
  <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteConfirmModalLabel">Konfirmasi Penghapusan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin menghapus item ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
        </div>
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
            status_cuti: document.querySelector('select[name="status_cuti"]').value,
            divisi_id: document.querySelector('select[name="divisi_id"]').value,
            start_date: document.querySelector('input[name="start_date"]').value,
            end_date: document.querySelector('input[name="end_date"]').value
        };

        // Save filters in session
        sessionStorage.setItem('filters', JSON.stringify(filters));

        // Redirect to the same route with query parameters
        window.location.href = `{{ route('reportlistcutikaryawan') }}?${new URLSearchParams(filters).toString()}`;
    });

    // Reset filters
    document.getElementById('reset_filters').addEventListener('click', function () {
        sessionStorage.removeItem('filters');
        window.location.href = `{{ route('reportlistcutikaryawan') }}`;
    });

    // Export functionality with filters
    document.getElementById('export_button').addEventListener('click', function () {
        const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
        // Redirect to the export route with query parameters
        window.location.href = `{{ route('exportreportlistcutikaryawan') }}?${new URLSearchParams(filters).toString()}`;
    });
});
</script>
@endsection
