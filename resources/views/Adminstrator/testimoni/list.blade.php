@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Testimoni Di PT Raja Perkasa</h4>
      </div>
      <div class="page-btn">
        <a href="{{ route('testimonicreate') }}" class="btn btn-added">
          <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-2" alt="img" />
          Tambah Data Testimoni Di PT Raja Perkasa
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
                <span
                  ><img src="{{ asset('assets/img/icons/closes.svg') }}" alt="img"
                /></span>
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
          <table class="table datanew">
            <thead>
              <tr>
                <th>
                  <label class="checkboxs">
                    <input type="checkbox" id="select-all" />
                    <span class="checkmarks"></span>
                  </label>
                </th>
                <th>No</th>
                <th>Nama PIC Client Perusahaan</th>
                <th>Nama Mitra Perusahaan</th>
                <th>Jabatan</th>
                <th>Komentar</th>
                <th>Gambar Testimoni Client</th>
                {{-- <th>Created Date</th> --}}
                <th>Status Testimoni</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>
                  <label class="checkboxs">
                    <input type="checkbox" />
                    <span class="checkmarks"></span>
                  </label>
                </td>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_client }}</td>
                <td>{{ $item->nama_mitra }}</td>
                <td>{{ $item->position }}</td>
                <td>{!! $item->comment !!}</td>
                <td>
                  @if(!empty($item->image))
                    @php
                      $images = explode(',', $item->image);
                    @endphp
                    @foreach($images as $image)
                      <img src="{{ asset('storage/photo-testimoni/' . $image) }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                    @endforeach
                  @endif
                </td>
                {{-- <td>{{ $item->created_at->format('Y-m-d') }}</td> --}}
                <td>
                  @if($item->status_testimoni == 'active')
                    <span class="badges bg-lightgreen">Active</span>
                  @else
                    <span class="badges bg-lightred">In Active</span>
                  @endif
                </td>
                <td>
                  <a class="me-3" href="{{ route('testimoniedit', $item->id) }}">
                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                  </a>
                  <button type="button" class="btn btn-link text-dark btn-delete" data-id="{{ $item->id }}" title="Menghapus Data">
                    <i class="fas fa-trash-alt text-dark"></i>
                  </button>
                  <form id="deleteForm-{{ $item->id }}" action="{{ route('testimonidelete', ['id' => $item->id]) }}" method="POST" style="display: none;">
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
