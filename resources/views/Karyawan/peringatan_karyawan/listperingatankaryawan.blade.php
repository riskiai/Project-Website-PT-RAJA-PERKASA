@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Peringatan Anda</h4>
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
        </div>

        <div class="table-responsive">
          <table class="table datanew text-center">
            <thead>
              <tr>
                {{-- <th>No</th> --}}
                <th>Nama Karyawan</th>
                <th>Divisi</th>
                <th>Cuti Berapa Kali</th>
                <th>Tidak Hadirnya</th>
                <th>Jenis Peringatan</th>
                <th>Status Karyawan</th>
                <th>File Peringatan</th>
                {{-- <th>Created At</th>
                <th>Updated At</th> --}}
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                {{-- <td>{{ $index + 1 }}</td> --}}
                <td>{{ $item->name }}</td>
                <td>{{ $item->divisi_name }}</td>
                <td>{{ $item->cuti_berapakali }}</td>
                <td>{{ $item->tidak_hadirnya }}</td>
                <td>{{ $item->jenis_peringatan }}</td>
                <td>{{ $item->status_karyawan }}</td>
                <td><a href="{{ asset('storage/'.$item->file_peringatan) }}" target="_blank">{{ $item->file_peringatan }}</a></td>
                {{-- <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('Y-m-d') }}</td> --}}
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
});
</script>
@endsection
