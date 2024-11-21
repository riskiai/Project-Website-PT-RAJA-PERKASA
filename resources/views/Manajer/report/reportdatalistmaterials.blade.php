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
        <h4>Report Data Materials PT Raja Perkasa</h4>
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
                    <label for="">Filter Berdasarkan Input Data Materials</label>
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
                  <div class="input-groupicon">
                    <label for="">Filter Berdasarkan Kadaluarsa Materials</label>
                    <input type="text" class="datetimepicker cal-icon" id="expired_materials_start" name="expired_materials_start" placeholder="Tanggal Kadaluarsa Mulai" />
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
                    <input type="text" class="datetimepicker cal-icon" id="expired_materials_end" name="expired_materials_end" placeholder="Tanggal Kadaluarsa Akhir" />
                    {{-- <div class="addonset">
                      <img src="{{ asset('assets/img/icons/calendars.svg') }}" alt="img" />
                    </div> --}}
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label for="">Filter Berdasarka Brand Materials</label>
                  <select class="select" id="brand_materials_id" name="brand_materials_id">
                    <option value="">Pilih Brand Materials</option>
                    @foreach($brandMaterials as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->nama_brand_materials }}</option>
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
                <th>Nama Materials</th>
                <th>Jumlah Stok Materials</th>
                <th>Brand Materials</th>
                <th>Country</th>
                <th>TKDN</th>
                <th>TKDN Certificate</th>
                <th>Tanggal Kadaluarsa Material</th>
                <th>Status List Materials</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ $item->materials->nama_materials }}</td>
                <td>{{ $item->materials->qty }}</td>
                <td>{{ $item->brand_materials->nama_brand_materials }}</td>
                <td>{{ $item->countries }}</td>
                <td>{{ $item->tkdn }}</td>
                <td>
                  @if($item->tknd_certificate)
                    <a href="{{ Storage::url($item->tknd_certificate) }}" target="_blank">
                      {{ 'tkdn_certificate_' . Str::slug($item->materials->nama_materials, '_') . '.pdf' }}
                    </a>
                  @else
                    N/A
                  @endif
                </td>
                <td>{{ $item->expired_materials_date }}</td>
                <td>
                  @if($item->status_list_materials == 'active')
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
            expired_materials_start: document.querySelector('input[name="expired_materials_start"]').value,
            expired_materials_end: document.querySelector('input[name="expired_materials_end"]').value,
            brand_materials_id: document.querySelector('select[name="brand_materials_id"]').value,
        };

        // Save filters in session
        sessionStorage.setItem('filters', JSON.stringify(filters));

        // Redirect to the same route with query parameters
        window.location.href = `{{ route('reportlistmaterials') }}?${new URLSearchParams(filters).toString()}`;
    });

    // Reset filters
    document.getElementById('reset_filters').addEventListener('click', function () {
        sessionStorage.removeItem('filters');
        window.location.href = `{{ route('reportlistmaterials') }}`;
    });

    // Export functionality with filters
    document.getElementById('export_button').addEventListener('click', function () {
        const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
        // Redirect to the export route with query parameters
        window.location.href = `{{ route('exportreportlistmaterials') }}?${new URLSearchParams(filters).toString()}`;
    });
});
</script>
@endsection
