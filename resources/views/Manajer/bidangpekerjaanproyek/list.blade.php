@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Bidang Pekerjaan Proyek</h4>
      </div>
      <div class="page-btn">
        <a href="{{ route('bidangpekerjaanproyek.create') }}" class="btn btn-added">
          Tambah Data Bidang Pekerjaan Proyek
        </a>
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

        <div class="table-responsive">
          <table class="table datanew text-center">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Bidang Pekerjaan Proyek</th>
                <th>Status Bidang Pekerjaan Proyek</th>
                <th>Di Input Tanggal</th>
                {{-- <th>Updated At</th> --}}
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_bidang_pekerjaan_proyek }}</td>
                <td>
                  @if($item->status_bidang_pekerjaan_proyek == 'active')
                  <span class="badges bg-lightgreen">Active</span>
                  @else
                  <span class="badges bg-lightred">Non Active</span>
                  @endif
                </td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                {{-- <td>{{ $item->updated_at->format('Y-m-d') }}</td> --}}
                <td>
                  <a class="me-3" href="{{ route('bidangpekerjaanproyek.edit', $item->id) }}">
                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                  </a>
                  <button type="button" class="btn btn-link text-dark btn-delete" data-id="{{ $item->id }}" title="Menghapus Data">
                    <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                  </button>
                  <form id="deleteForm-{{ $item->id }}" action="{{ route('bidangpekerjaanproyek.destroy', $item->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-dark">
                      <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" />
                    </button>
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
