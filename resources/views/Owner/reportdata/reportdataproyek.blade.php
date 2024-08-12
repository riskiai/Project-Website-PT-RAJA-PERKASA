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
                            <!-- Filter Inputs -->
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <div class="input-groupicon">
                                        <label for="">Filter Berdasarkan Tanggal Proyek Disetujui </label>
                                        <input type="text" class="datetimepicker cal-icon" id="updated_at" name="updated_at" placeholder="Disetujui Tanggal " />
                                        {{-- <div class="addonset">
                                            <img src="{{ asset('assets/img/icons/calendars.svg') }}" alt="img" />
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Filter Berdasarkan Bidang Proyek</label>
                                    <select class="select" id="bidangproyek_id" name="bidangproyek_id">
                                        <option value="">Pilih Bidang Proyek</option>
                                        @foreach($bidangProyeks as $bidang)
                                            <option value="{{ $bidang->id }}">{{ $bidang->nama_bidang_pekerjaan_proyek }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Filter Berdasarkan Status Progress Proyek</label>
                                    <select class="select" id="status_progres_proyek" name="status_progres_proyek">
                                        <option value="">Pilih Status Progres</option>
                                        <option value="sedangberjalan">Sedang Berjalan</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Filter Berdasarkan Status Proyek</label>
                                    <select class="select" id="status_proyek" name="status_proyek">
                                        <option value="">Pilih Status Proyek</option>
                                        <option value="disetujui">Disetujui</option>
                                        <option value="tidak_disetujui">Tidak Disetujui</option>
                                        <option value="belumdicek">Belum Dicek</option>
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
                                <th>Proyek Disetujui Tanggal</th>
                                <th>Nama Proyek</th>
                                <th>Bidang Pekerjaan Proyek</th>
                                <th>Client</th>
                                <th>Main Contractor</th>
                                <th>Nama Materials</th>
                                <th>Nama Peralatan</th>
                                <th>Status Progres</th>
                                <th>Status Proyek</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->updated_at->format('Y-m-d') }}</td>
                                <td>{{ $item->project_name }}</td>
                                <td>{{ $item->bidangproyeks->nama_bidang_pekerjaan_proyek ?? "Tidak Ada Data" }}</td>
                                <td>{{ $item->client_name }}</td>
                                <td>{{ $item->main_contractor }}</td>
                                <td>{{ $item->materials->nama_materials ?? 'N/A' }}</td>
                                <td>{{ $item->peralatan->nama_peralatan ?? 'N/A' }}</td>
                                <td>
                                    @if($item->status_progres_proyek == 'Perencanaan')
                                        <span class="badges bg-lightorange">Perencanaan</span>
                                    @elseif($item->status_progres_proyek == 'SedangBerlangsung')
                                        <span class="badges   bg-lightorange">Sedang Berlangsung</span>
                                    @elseif($item->status_progres_proyek == 'Penyelesaian')
                                        <span class="badges  bg-lightgreen">Penyelesaian</span>
                                    @elseif($item->status_progres_proyek == 'Pemeliharaan')
                                        <span class="badges bg-lightgreen">Pemeliharaan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->status_proyek == 'disetujui')
                                        <span class="badges bg-lightgreen">Disetujui</span>
                                    @elseif($item->status_proyek == 'tidak_disetujui')
                                        <span class="badges bg-lightred">Tidak Disetujui</span>
                                    @else
                                        <span class="badges bg-lightorange">Belum Dicek</span>
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
            updated_at: document.querySelector('input[name="updated_at"]').value,
            bidangproyek_id: document.querySelector('select[name="bidangproyek_id"]').value,
            status_progres_proyek: document.querySelector('select[name="status_progres_proyek"]').value,
            status_proyek: document.querySelector('select[name="status_proyek"]').value
        };

        // Save filters in session
        sessionStorage.setItem('filters', JSON.stringify(filters));

        // Redirect to the same route with query parameters
        window.location.href = `{{ route('reportownerproyek') }}?${new URLSearchParams(filters).toString()}`;
    });

    // Reset filters
    document.getElementById('reset_filters').addEventListener('click', function () {
        sessionStorage.removeItem('filters');
        window.location.href = `{{ route('reportownerproyek') }}`;
    });

    // Export functionality with filters
    document.getElementById('export_button').addEventListener('click', function () {
        const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
        // Redirect to the export route with query parameters
        window.location.href = `{{ route('exportreportownerproyek') }}?${new URLSearchParams(filters).toString()}`;
    });
});
</script>
@endsection
