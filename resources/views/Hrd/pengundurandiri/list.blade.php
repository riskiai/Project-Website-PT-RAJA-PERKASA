@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Pengunduran Diri Karyawan PT Raja Perkasa</h4>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        @if(session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="table-responsive">
          <table class="table datanew text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Divisi</th>
                <th>Alasan Pengunduran Diri</th>
                <th>Status Pengunduran Diri</th>
                <th>File Pengunduran Diri</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->divisi->divisi_name }}</td>
                <td>{{ $item->alasan_pengunduran_diri }}</td>
                <td>
                    @if($item->status_pengunduran_diri === 'belumdicek')
                        Belum Dicek
                    @elseif($item->status_pengunduran_diri === 'disetujui')
                        Disetujui
                    @elseif($item->status_pengunduran_diri === 'tidak_disetujui')
                        Tidak Disetujui
                    @endif
                </td>
                <td><a href="{{ asset('storage/'.$item->file_pengunduran_diri) }}" target="_blank">Lihat File</a></td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ $item->updated_at->format('Y-m-d') }}</td>
                <td>
                  <a class="me-3 edit-btn" href="#" data-id="{{ $item->id }}" data-status="{{ $item->status_pengunduran_diri }}">
                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                  </a>
                  <button type="button" class="btn btn-link text-dark btn-delete" data-id="{{ $item->id }}" title="Menghapus Data">
                    <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                  </button>
                  <form id="deleteForm-{{ $item->id }}" action="{{ route('karyawandelete', $item->id) }}" method="POST" style="display: none;">
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

   <!-- Modal -->
   <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Update Status Pengunduran Diri</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-group mb-3">
              <label for="status_pengunduran_diri" class="form-label">Status Pengunduran Diri</label>
              <select name="status_pengunduran_diri" id="status_pengunduran_diri" class="form-select">
                <option value="belumdicek">Belum Dicek</option>
                <option value="disetujui">Disetujui</option>
                <option value="tidak_disetujui">Tidak Disetujui</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="file_balasan" class="form-label">File Balasan (Opsional)</label>
              <input type="file" name="file_balasan" id="file_balasan" class="form-control">
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

    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        var status = $(this).data('status');
        
        $('#status_pengunduran_diri').val(status);
        $('#editForm').attr('action', '/hrd/listpengundurandirikaryawanupdate/' + id);
        $('#editModal').modal('show');
    });
});
</script>
@endsection
