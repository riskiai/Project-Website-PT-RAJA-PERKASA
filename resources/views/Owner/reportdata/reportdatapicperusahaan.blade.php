@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')
<style>
    .bg-lightorange {
        background-color: orange;
        color: white;
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
    #filter_inputs {
        display: none; /* Initially hidden */
    }
    #filter_inputs.show {
        display: block; /* Show when class 'show' is added */
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Report Data Users PIC Perusahaan Dan Dokumen Kerja Sama Mitra PT Raja Perkasa</h4>
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
                                      <label for="">Filter Berdasarkan Perwakilan PIC Daftar</label>
                                      <input type="text" class="datetimepicker cal-icon" id="created_at_start" name="created_at_start" placeholder="Rentang Mulai PIC Mitra Daftar" />
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
                                      <input type="text" class="datetimepicker cal-icon" id="created_at_end" name="created_at_end" placeholder="Rentang Berakhir PIC Mitra Daftar" />
                                      {{-- <div class="addonset">
                                          <img src="{{ asset('assets/img/icons/calendars.svg') }}" alt="img" />
                                      </div> --}}
                                  </div>
                              </div>
                          </div>
                          
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Filter Berdasarkan Status PIC Perusahaan</label>
                                    <select class="select" id="status_pic_perusahaan" name="status_pic_perusahaan">
                                        <option value="">Pilih Status PIC Perusahaan</option>
                                        <option value="calon_client">Calon Client</option>
                                        <option value="client">Client</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Filter Berdasarkan Status Kerjasama Mitra</label>
                                    <select class="select" id="status_kerjasama" name="status_kerjasama">
                                        <option value="">Pilih Status Kerjasama Mitra</option>
                                        <option value="ditunggu">Ditunggu</option>
                                        <option value="diterima">Diterima</option>
                                        <option value="ditolak">Ditolak</option>
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
                                <th>Tanggal Perwakilan PIC Perusahaan Daftar</th>
                                <th>Nama PIC</th>
                                <th>Nama Perusahaan</th>
                                <th>Email</th>
                                <th>Nomor Handphone</th>
                                <th>Gambar Foto</th>
                                <th>Gambar KTP</th>
                                <th>Status User</th>
                                <th>Status PIC Perusahaan</th>
                                <th>Status Dokument Kerja Sama Mitra</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->mitra ? $item->mitra->name_mitra : '-' }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td class="text-center">
                                    @if(!empty($item->file_foto))
                                        <img src="{{ asset('storage/client/photo-profile/' . $item->file_foto) }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px; border-radius: 50%;">
                                    @else
                                        <img src="{{ asset('img/default.png') }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px; border-radius: 50%;">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(!empty($item->file_ktp))
                                        <img src="{{ asset('storage/client/file_ktp/' . $item->file_ktp) }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                                    @else
                                        <img src="{{ asset('img/ktp.jpg') }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->status_user == 'active')
                                        <span class="badges bg-lightgreen">Active</span>
                                    @else
                                        <span class="badges bg-lightred">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->status_pic_perusahaan == 'client')
                                        <span class="badges bg-lightgreen">Client</span>
                                    @else
                                        <span class="badges bg-lightyellow">Calon Client</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->documentKerjasamaClient)
                                        <span class="badges {{ $item->documentKerjasamaClient->status_kerjasama == 'diterima' ? 'bg-lightgreen' : ($item->documentKerjasamaClient->status_kerjasama == 'ditolak' ? 'bg-lightred' : 'bg-lightyellow') }}">
                                            {{ ucfirst($item->documentKerjasamaClient->status_kerjasama) }}
                                        </span>
                                    @else
                                        <span class="badges bg-lightred">No Data</span>
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
            status_pic_perusahaan: document.querySelector('select[name="status_pic_perusahaan"]').value,
            status_kerjasama: document.querySelector('select[name="status_kerjasama"]').value
        };

        // Save filters in session
        sessionStorage.setItem('filters', JSON.stringify(filters));

        // Redirect to the same route with query parameters
        window.location.href = `{{ route('ownerreportuserspicperusahaan') }}?${new URLSearchParams(filters).toString()}`;
    });

    // Reset filters
    document.getElementById('reset_filters').addEventListener('click', function () {
        sessionStorage.removeItem('filters');
        window.location.href = `{{ route('ownerreportuserspicperusahaan') }}`;
    });

    // Export functionality with filters
    document.getElementById('export_button').addEventListener('click', function () {
        const filters = JSON.parse(sessionStorage.getItem('filters') || '{}');
        // Redirect to the export route with query parameters
        window.location.href = `{{ route('ownerexportreportpicperusahaan') }}?${new URLSearchParams(filters).toString()}`;
    });
});
</script>
@endsection
