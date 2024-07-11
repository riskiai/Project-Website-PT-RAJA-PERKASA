@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>Report Data Pengunduran Diri Karyawan PT Raja Perkasa</h4>
      </div>
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

          <div class="wordset">
            <ul>
                <li>
                    <a href="{{ route('exportreportlistpengundurandirikaryawan') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                        <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img" />
                    </a>
                </li>
            </ul>
          </div>
        </div>

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
                <th>File Balasan</th>
                {{-- <th>Created At</th>
                <th>Updated At</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td>{{ $item->alasan_pengunduran_diri }}</td>
                <td>{{ ucfirst($item->status_pengunduran_diri) }}</td>
                <td>
                  @if($item->file_pengunduran_diri)
                    <a href="{{ asset('storage/' . $item->file_pengunduran_diri) }}" target="_blank">Lihat File</a>
                  @else
                    -
                  @endif
                </td>
                <td>
                  @if($item->file_balasan)
                    <a href="{{ asset('storage/' . $item->file_balasan) }}" target="_blank">Lihat File</a>
                  @else
                    -
                  @endif
                </td>
                {{-- <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>{{ $item->updated_at->format('Y-m-d') }}</td> --}}
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
