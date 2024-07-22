@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Users Client PIC Perusahaan Dan Dokumen Kerja Sama Mitra Perusahaan</h4>
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
      </div>

      <div class="table-responsive">
        <table class="table datanew">
          <thead>
            <tr>
              <th class="text-center">No</th>
              <th class="text-center">Nama PIC</th>
              <th class="text-center">Nama Perusahaan</th>
              <th class="text-center">Email PIC</th>
              <th class="text-center">Nomor Handphone</th>
              <th class="text-center">File Foto</th>
              <th class="text-center">File KTP</th>
              <th class="text-center">Status User</th>
              <th class="text-center">Status PIC Perusahaan</th>
              <th class="text-center">Status Dokumen <br> Kerja Sama Mitra</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
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
              <td class="text-center">
                <!-- Tombol Edit -->
                <a href="#" class="btn btn-link btn-edit" data-id="{{ $item->id }}" title="Edit Status Document Kerja Sama Mitra"
                   data-status="{{ $item->documentKerjasamaClient ? $item->documentKerjasamaClient->status_kerjasama : '' }}"
                   data-keterangan="{{ $item->documentKerjasamaClient ? $item->documentKerjasamaClient->keterangan_status_kerjasama : '' }}">
                  <i class="fas fa-edit text-dark"></i>
                </a>
                <!-- Tombol Lihat Detail -->
                <a class="me-3" href="{{ route('showclient', ['id' => $item->id]) }}" title="Melihat Data Document Users Client Dan Profile Client">
                  <i class="fas fa-eye text-dark"></i>
                </a>
                <!-- Tombol Hapus -->
                <button type="button" class="btn btn-link text-dark btn-delete" data-id="{{ $item->id }}" title="Menghapus Data">
                  <i class="fas fa-trash-alt text-dark"></i>
                </button>
                <!-- Form Hapus -->
                <form id="deleteForm-{{ $item->id }}" action="{{ route('userslistclientdelete', ['id' => $item->id]) }}" method="POST" style="display: none;">
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

  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="editForm" method="POST" action="">
          @csrf
          @method('POST')
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Update Data Kerja Sama Client Perusahaan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="status_kerjasama" class="form-label">Status Kerja Sama</label>
              <select name="status_kerjasama" id="status_kerjasama" class="form-select">
                <option value="ditunggu">Ditunggu</option>
                <option value="diterima">Diterima</option>
                <option value="ditolak">Ditolak</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="keterangan_status_kerjasama" class="form-label">Keterangan Status Kerja Sama</label>
              <textarea name="keterangan_status_kerjasama" id="keterangan_status_kerjasama" class="form-control" rows="3"></textarea>
            </div>
            <!-- Placeholder untuk pesan -->
            <div id="message_placeholder" class="mt-3"></div>
            <!-- Tempat untuk menampilkan riwayat update -->
            <div id="riwayat_update" class="mt-3"></div>
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

    function reinitializeEventListeners() {
      $('.btn-delete').off('click').on('click', function() {
        deleteFormId = $(this).data('id');
        $('#deleteConfirmModal').modal('show');
      });

      $('#confirmDeleteButton').off('click').on('click', function() {
        if (deleteFormId) {
          $('#deleteForm-' + deleteFormId).submit();
        }
      });

      $('.btn-edit').off('click').on('click', function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        var keterangan = $(this).data('keterangan');
        var url = "{{ route('userslistclienteditproses', ':id') }}";
        url = url.replace(':id', id);

        $('#status_kerjasama').val(status);
        $('#keterangan_status_kerjasama').val(keterangan);
        $('#editForm').attr('action', url);

        $('#editModal').modal('show');
      });
    }

    reinitializeEventListeners();

    $('#status_kerjasama').change(function() {
      var selectedStatus = $(this).val();
      var keterangan = '';

      if (selectedStatus == 'diterima') {
        keterangan = 'Selamat Anda Diterima Sebagai Client Mitra Kami, Selanjutnya Dari PT Raja Perkasa Akan Mengadakan Pertemuan Dengan PT Anda, Terimakasih.';
      } else if (selectedStatus == 'ditolak') {
        keterangan = 'Maaf data anda masih belum valid, silahkan di cek kembali dan bisa kirimkan kembali.';
      } else {
        keterangan = '';
      }

      $('#keterangan_status_kerjasama').val(keterangan);
    });

    // Reinitialize event listeners when the table is redrawn (e.g., after pagination)
    $('.datanew').on('draw.dt', function() {
      reinitializeEventListeners();
    });
  });
</script>
@endsection
