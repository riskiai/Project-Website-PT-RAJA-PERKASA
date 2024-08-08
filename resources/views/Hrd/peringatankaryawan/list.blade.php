@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Peringatan Karyawan PT Raja Perkasa</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-top">
          <div class="search-set">
            {{-- <div class="search-path">
              <a class="btn btn-filter" id="filter_search">
                <img src="{{ asset('assets/img/icons/filter.svg') }}" alt="img" />
                <span><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img" /></span>
              </a>
            </div> --}}
            <div class="search-input">
              <a class="btn btn-searchset">
                <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img" />
              </a>
            </div>
          </div>
        </div>

        @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @foreach($data as $item)
          @if($item->jenis_peringatan == 'peringatan_peneguran')
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              Peringatan Peneguran: Karyawan {{ $item->name }} telah tidak hadir sebanyak {{ $item->tidak_hadirnya }} kali dan cuti sebanyak {{ $item->cuti_berapakali }} kali.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @elseif($item->jenis_peringatan == 'peringatan_pemanggilan')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              Peringatan Pemanggilan: Karyawan {{ $item->name }} telah tidak hadir sebanyak {{ $item->tidak_hadirnya }} kali dan cuti sebanyak {{ $item->cuti_berapakali }} kali.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @elseif($item->jenis_peringatan == 'peringatan_pemberhentian')  
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              Peringatan Pemberhentian: Karyawan {{ $item->name }} telah tidak hadir sebanyak {{ $item->tidak_hadirnya }} kali dan cuti sebanyak {{ $item->cuti_berapakali }} kali.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
        @endforeach

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
                <th>Action</th>
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
                <td>{{ $item->status_karyawan }}</td>
                <td>
                  @if($item->file_peringatan)
                    <a href="{{ asset('storage/'.$item->file_peringatan) }}" target="_blank">Lihat File</a>
                  @else
                    Tidak Ada File
                  @endif
                </td>
                <td>
                  <a class="me-3" href="#" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $item->user_id }}" data-jenis-peringatan="{{ $item->jenis_peringatan }}" data-status-karyawan="{{ $item->status_karyawan }}">
                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                  </a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Peringatan -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Update Peringatan Karyawan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              <input type="hidden" name="user_id" id="editUserId">
              <div class="mb-3">
                  <label for="jenis_peringatan" class="form-label">Jenis Peringatan</label>
                  <select class="form-control" name="jenis_peringatan" id="editJenisPeringatan">
                      <option value="peringatan_peneguran">Peringatan Peneguran</option>
                      <option value="peringatan_pemanggilan">Peringatan Pemanggilan</option>
                      <option value="peringatan_pemberhentian">Peringatan Pemberhentian</option>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="status_karyawan" class="form-label">Status Karyawan</label>
                  <select class="form-control" name="status_karyawan" id="editStatusKaryawan">
                      <option value="aktif">Aktif</option>
                      <option value="diberhentikan">Diberhentikan</option>
                  </select>
              </div>
              <div class="mb-3">
                  <label for="file_peringatan" class="form-label">File Peringatan</label>
                  <input type="file" class="form-control" name="file_peringatan" id="filePeringatan">
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
      </form>
      
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

    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');
        var jenisPeringatan = button.data('jenis-peringatan');
        var statusKaryawan = button.data('status-karyawan');

        var modal = $(this);
        modal.find('#editUserId').val(userId);
        modal.find('#editJenisPeringatan').val(jenisPeringatan);
        modal.find('#editStatusKaryawan').val(statusKaryawan);

        // Update form action with user ID
        var form = modal.find('#editForm');
        form.attr('action', '/hrd/updateperingatankaryawan/' + userId);
    });
});
</script>
@endsection
