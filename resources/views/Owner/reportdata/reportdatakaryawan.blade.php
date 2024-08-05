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
                <h4>Report Data Proyek PT Raja Perkasa</h4>
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
                      <button class="btn btn-searchset" id="search_button">
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
                      <select class="select" id="jk" name="jk">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                      <select class="select" id="status_user" name="status_user">
                        <option value="">Pilih Status User</option>
                        <option value="active">Active</option>
                        <option value="nonactive">Non Active</option>
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
                    <th>Email</th>
                    <th>Divisi</th>
                    <th>Jenis Kelamin</th>
                    <th>Status User</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $index => $item)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->divisi ? $item->divisi->divisi_name : '-' }}</td>
                    <td>{{ $item->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td>{{ $item->status_user }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
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
              divisi_id: document.querySelector('select[name="divisi_id"]').value,
              jk: document.querySelector('select[name="jk"]').value,
              status_user: document.querySelector('select[name="status_user"]').value
          };
  
          // Save filters in session
          sessionStorage.setItem('filters', JSON.stringify(filters));
  
          // Redirect to the same route with query parameters
          window.location.href = `{{ route('reportdatakaryawan') }}?${new URLSearchParams(filters).toString()}`;
      });
  
      // Reset filters
      document.getElementById('reset_filters').addEventListener('click', function () {
          console.log('Filters reset'); // Debugging
          sessionStorage.removeItem('filters');
          window.location.href = `{{ route('reportdatakaryawan') }}`;
      });
  
      // Export functionality with filters
      document.getElementById('export_button').addEventListener('click', function () {
          const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
          console.log('Export with filters:', filters); // Debugging
          // Redirect to the export route with query parameters
          window.location.href = `{{ route('ownerexportreportdatakaryawan') }}?${new URLSearchParams(filters).toString()}`;
      });
  });
  </script>
@endsection
