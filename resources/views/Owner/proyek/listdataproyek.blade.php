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
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>List Data Proyek PT Raja Perkasa</h4>
            </div>
            {{-- <div class="page-btn">
                <a href="{{ route('listdataproyekcreate') }}" class="btn btn-added">Tambah Data Proyek</a>
            </div> --}}
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
                    {{-- <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf">
                                    <img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img" />
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                                    <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img" />
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print">
                                    <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img" />
                                </a>
                            </li>
                        </ul> --}}
                    </div>
                </div>

                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <div class="input-groupicon">
                                        <input type="text" class="datetimepicker cal-icon" placeholder="Choose Date" />
                                        <div class="addonset">
                                            <img src="{{ asset('assets/img/icons/calendars.svg') }}" alt="img" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter Reference" />
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Category</option>
                                        <option>Computers</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6 col-12">
                                <div class="form-group">
                                    <select class="select">
                                        <option>Choose Status</option>
                                        <option>Complete</option>
                                        <option>Inprogress</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto">
                                        <img src="{{ asset('assets/img/icons/search-whites.svg') }}" alt="img" />
                                    </a>
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
                                <th>Nama Project Proyek</th>
                                <th>Bidang Pekerjaan Proyek</th>
                                <th>Client</th>
                                <th>Main Contractor</th>
                                <th>Nama Materials</th>
                                <th>Nama Peralatan</th>
                                <th>Status Progres</th>
                                <th>Status Proyek</th>
                                <th>Action</th>
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
                                    @if($item->status_progres_proyek == 'sedangberjalan')
                                        <span class="badges  bg-lightorange">Sedang Berjalan</span>
                                    @else
                                        <span class="badges bg-lightgreen">Selesai</span>
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
                                <td class="action-icons">
                                    <a href="#" class="btn btn-link btn-edit" data-id="{{ $item->id }}" title="Edit Status Proyek">
                                        <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                                    </a>
                                    <a href="{{ route('ownershowlistdataproyek',  ['id' => $item->id]) }}" title="Melihat Data Detail List Proyek">
                                        <i class="fas fa-eye text-dark"></i>
                                    </a>
                                    {{-- <button type="button" class="btn btn-link btn-delete" data-id="{{ $item->id }}" title="Menghapus Data">
                                        <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                                    </button>
                                    <form id="deleteForm-{{ $item->id }}" action="{{ route('listdataproyekdelete', $item->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit Proyek -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Update Data Proyek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="status_proyek" class="form-label">Status Proyek</label>
                            <select name="status_proyek" id="status_proyek" class="form-select">
                                <option value="disetujui">Disetujui</option>
                                <option value="tidak_disetujui">Tidak Disetujui</option>
                                <option value="belumdicek">Belum Dicek</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="keterangan_status_proyek" class="form-label">Keterangan Status Proyek</label>
                            <textarea name="keterangan_status_proyek" id="keterangan_status_proyek" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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

    $('.btn-edit').click(function() {
        var id = $(this).data('id');
        var url = "{{ route('getProyekData', ':id') }}";
        url = url.replace(':id', id);

        $.get(url, function(data) {
            $('#status_proyek').val(data.status_proyek);
            $('#keterangan_status_proyek').val(data.keterangan_status_proyek);
            $('#editForm').attr('action', "{{ route('ownerlistdataproyek.update', ':id') }}".replace(':id', id));
            $('#editModal').modal('show');
        });
    });
});
</script>
@endsection
