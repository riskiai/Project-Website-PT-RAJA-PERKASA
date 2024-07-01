@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>List Data Users Internal PT Raja Perkasa</h4>
            </div>
            <div class="page-btn">
                <a href="{{ route('userscreate') }}" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-2" alt="img" />
                    Tambah Data Users PT Raja Perkasa
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                      <div class="search-path">
                        <a class="btn btn-filter" id="filter_search">
                          <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                          <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" />
                          </span>
                        </a>
                      </div>
                      <div class="search-input">
                        <a class="btn btn-searchset">
                          <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img" />
                        </a>
                      </div>
                    </div>
                    <div class="wordset">
                      {{-- <ul>
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
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Divisi Pekerjaan</th>
                                <th class="text-center">Role Pekerjaan</th>
                                <th class="text-center">Status User</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $item->name }}</td>
                                <td class="text-center">{{ $item->email }}</td>
                                <td class="text-center">{{ $item->divisi ? $item->divisi->divisi_name : '-' }}</td>
                                <td class="text-center">{{ $item->role ? $item->role->role_name : '-' }}</td>
                                <td class="text-center">
                                    @if($item->status_user == 'active')
                                        <span class="badges bg-lightgreen">Active</span>
                                    @else
                                        <span class="badges bg-lightred">Inactive</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('usersedit', $item->id) }}" class="btn btn-link btn-edit" title="Edit Data Pegawai">
                                        <i class="fas fa-edit text-dark"></i>
                                    </a>
                                    <a class="me-3" href="{{ route('showpegawai', ['id' => $item->id]) }}" title="Melihat Data Detail Pegawai PT Raja Perkasa">
                                        <i class="fas fa-eye text-dark"></i>
                                    </a>
                                    <button type="button" class="btn btn-link text-dark btn-delete" data-id="{{ $item->id }}" title="Menghapus Data">
                                        <i class="fas fa-trash-alt text-dark"></i>
                                    </button>
                                    <form id="deleteForm-{{ $item->id }}" action="{{ route('userslistpegawaidelete', ['id' => $item->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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
});
</script>
@endsection
