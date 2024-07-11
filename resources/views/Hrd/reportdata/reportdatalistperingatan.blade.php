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
        @foreach($data as $item)
          @if($item->jenis_peringatan == 'peringatan_peneguran')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              Peringatan Peneguran: Karyawan {{ $item->name }} telah tidak hadir sebanyak {{ $item->tidak_hadirnya }} kali dan cuti sebanyak {{ $item->cuti_berapakali }} kali.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @elseif($item->jenis_peringatan == 'peringatan_pemanggilan')
            <div class="alert alert-dark alert-dismissible fade show" role="alert">
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
                    <a href="{{ route('exportreportlistperingatankaryawan') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
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
                <th>Cuti Berapa Kali</th>
                <th>Tidak Hadirnya</th>
                <th>Jenis Peringatan</th>
                <th>Status Karyawan</th>
                <th>File Peringatan</th>
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
                <td>{{ ucfirst($item->status_karyawan) }}</td>
                <td>
                  @if($item->file_peringatan)
                    <a href="{{ asset('storage/'.$item->file_peringatan) }}" target="_blank">Lihat File</a>
                  @else
                    Tidak Ada File
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
