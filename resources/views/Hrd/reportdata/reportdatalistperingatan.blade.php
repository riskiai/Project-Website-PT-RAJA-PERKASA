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
        <h4>Report Data Peringatan Karyawan PT Raja Perkasa</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            <div class="search-path">
              <a class="btn btn-filter" id="filter_toggle">
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
                  <label for="jenis_peringatan">Filter Berdasarkan Jenis Peringatan</label>
                  <select class="select" id="jenis_peringatan" name="jenis_peringatan">
                    <option value="">Pilih Jenis Peringatan</option>
                    <option value="peringatan_peneguran">Peneguran</option>
                    <option value="peringatan_pemanggilan">Pemanggilan</option>
                    <option value="peringatan_pemberhentian">Pemberhentian</option>
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
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="status_karyawan">Filter Berdasarkan Status Karyawan</label>
                  <select class="select" id="status_karyawan" name="status_karyawan">
                    <option value="">Pilih Status</option>
                    <option value="aktif">Aktif</option>
                    <option value="non_aktif">Non-Aktif</option>
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
                <th>Cuti Berapa Kali</th>
                <th>Tidak Hadirnya</th>
                <th>Jenis Peringatan</th>
                <th>Status Karyawan</th>
                <th>File Peringatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->divisi_name }}</td>
                <td>{{ $item->cuti_berapakali }}</td>
                <td>{{ $item->tidak_hadirnya }}</td>
                <td>
                  @if($item->jenis_peringatan == 'peringatan_pemberhentian')
                    <span class="badge bg-danger">Peringatan Pemberhentian</span>
                  @elseif($item->jenis_peringatan == 'peringatan_pemanggilan')
                    <span class="badge bg-warning">Peringatan Pemanggilan</span>
                  @elseif($item->jenis_peringatan == 'peringatan_peneguran')
                    <span class="badge bg-info">Peringatan Peneguran</span>
                  @else
                    <span class="badge bg-secondary">Tidak Ada Peringatan</span>
                  @endif
                </td>
                <td>{{ ucfirst($item->status_karyawan) }}</td>
                <td>
                  @if($item->file_peringatan)
                    <a href="{{ asset('storage/'.$item->file_peringatan) }}" target="_blank">Lihat File</a>
                  @else
                    Tidak Ada File
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
            jenis_peringatan: document.querySelector('select[name="jenis_peringatan"]').value,
            divisi_id: document.querySelector('select[name="divisi_id"]').value,
            status_karyawan: document.querySelector('select[name="status_karyawan"]').value
        };

        // Save filters in session
        sessionStorage.setItem('filters', JSON.stringify(filters));

        // Redirect to the same route with query parameters
        window.location.href = `{{ route('reportlistperingatankaryawan') }}?${new URLSearchParams(filters).toString()}`;
    });

    // Reset filters
    document.getElementById('reset_filters').addEventListener('click', function () {
        sessionStorage.removeItem('filters');
        window.location.href = `{{ route('reportlistperingatankaryawan') }}`;
    });

    // Export functionality with filters
    document.getElementById('export_button').addEventListener('click', function () {
        const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
        // Redirect to the export route with query parameters
        window.location.href = `{{ route('exportreportlistperingatankaryawan') }}?${new URLSearchParams(filters).toString()}`;
    });
});
</script>
@endsection
