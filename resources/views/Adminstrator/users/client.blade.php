@extends('Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Users Client PT Raja Perkasa</h4>
      </div>
      <div class="page-btn">
        <a href="{{ route('testimonicreate') }}" class="btn btn-added">
          <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-2" alt="img" />
          Tambah Data Users Client PT Raja Perkasa
        </a>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table datanew">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Client</th>
                <th>Email</th>
                <th>Nomor Handphone</th>
                <th>File Foto</th>
                <th>File KTP</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $index => $item)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->no_hp }}</td>
                <td>
                  @if(!empty($item->file_foto))
                    <img src="{{ $item->file_foto ? asset(str_replace('public/', 'storage/', $item->file_foto)) : asset('img/default.png') }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                  @endif
                </td>
                <td>
                  @if(!empty($item->file_ktp))
                    <img src="{{ $item->file_ktp ? asset(str_replace('public/', 'storage/', $item->file_ktp)) : asset('img/ktp.jpg') }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                  @endif
                </td>
                <td>
                  @if($item->status_user == 'active')
                    <span class="badges bg-lightgreen">Active</span>
                  @else
                    <span class="badges bg-lightred">Inactive</span>
                  @endif
                </td>
                <td>
                    <a class="me-3" href="">
                      <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                    </a>
                    <form action="" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-link" onclick="return confirm('Are you sure you want to delete this item?');">
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
</div>

@endsection
