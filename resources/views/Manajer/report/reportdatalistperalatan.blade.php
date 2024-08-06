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
    }
    .filter-reset-buttons .btn {
        margin-right: 20px;
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
</style>
@endsection

@section('content')
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Report Data Peralatan PT Raja Perkasa</h4>
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
                <a id="export_button" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
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
                    <label for="">Filter Berdasarkan Input Data Peralatan</label>
                    <input type="text" class="datetimepicker cal-icon" id="created_at_start" name="created_at_start" placeholder="Tanggal Input Mulai" />
                    {{-- <div class="addonset">
                      <img src="{{ asset('assets/img/icons/calendars.svg') }}" alt="img" />
                    </div> --}}
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <div class="input-groupicon">
                    <label for="">Sampai Dengan Tanggal</label>
                    <input type="text" class="datetimepicker cal-icon" id="created_at_end" name="created_at_end" placeholder="Tanggal Input Akhir" />
                    {{-- <div class="addonset">
                      <img src="{{ asset('assets/img/icons/calendars.svg') }}" alt="img" />
                    </div> --}}
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="">Filter Berdasarkan Brand Peralatan</label>
                  <select class="select" id="brand_peralatan_id" name="brand_peralatan_id">
                    <option value="">Pilih Brand Peralatan</option>
                    @foreach($brandPeralatans as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->nama_brand_peralatan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="">Filter Berdasarkan Tahun Beli Peralatan</label>
                  <select class="select" id="tahun_beli_peralatans" name="tahun_beli_peralatans">
                    <option value="">Pilih Tahun Beli Peralatan</option>
                    @foreach($tahunBeliPeralatans as $tahun)
                      <option value="{{ $tahun }}">{{ $tahun }}</option>
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
                <th>Di Input Tanggal</th>
                <th>Nama Peralatan</th>
                <th>Brand Peralatan</th>
                <th>Capacity</th>
                <th>Ownership</th>
                <th>Certificate By</th>
                <th>Unit Quantity</th>
                <th>Tahun Beli Peralatan</th>
                <th>Status List Peralatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ $item->peralatan->nama_peralatan }}</td>
                <td>{{ $item->brand_peralatan->nama_brand_peralatan }}</td>
                <td>{{ $item->capacity }}</td>
                <td>{{ $item->ownership }}</td>
                <td>{{ $item->certificate_by }}</td>
                <td>{{ $item->unit_qty }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tahun_beli_peralatans)->format('Y') }}</td>
                <td>
                  @if($item->status_list_peralatans == 'active')
                  <span class="badges bg-lightgreen">Active</span>
                  @else
                  <span class="badges bg-lightred">Nonactive</span>
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
document.addEventListener('DOMContentLoaded', function () {
    // Toggle filter visibility
    document.getElementById('filter_toggle').addEventListener('click', function () {
        document.getElementById('filter_inputs').classList.toggle('show');
    });

    // Apply filters
    document.getElementById('apply_filters').addEventListener('click', function () {
        const filters = {
            created_at_start: document.querySelector('input[name="created_at_start"]').value,
            created_at_end: document.querySelector('input[name="created_at_end"]').value,
            brand_peralatan_id: document.querySelector('select[name="brand_peralatan_id"]').value,
            tahun_beli_peralatans: document.querySelector('select[name="tahun_beli_peralatans"]').value,
        };

        // Save filters in session
        sessionStorage.setItem('filters', JSON.stringify(filters));

        // Redirect to the same route with query parameters
        window.location.href = `{{ route('reportlistperalatan') }}?${new URLSearchParams(filters).toString()}`;
    });

    // Reset filters
    document.getElementById('reset_filters').addEventListener('click', function () {
        sessionStorage.removeItem('filters');
        window.location.href = `{{ route('reportlistperalatan') }}`;
    });

    // Export functionality with filters
    document.getElementById('export_button').addEventListener('click', function () {
        const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
        // Redirect to the export route with query parameters
        window.location.href = `{{ route('exportreportlistperalatan') }}?${new URLSearchParams(filters).toString()}`;
    });
});
</script>
@endsection
