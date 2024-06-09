@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Users Calon Client PT Raja Perkasa</h4>
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
            </ul>
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
                    <img src="{{ asset('storage/client/photo-profile/' . $item->file_foto) }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                  @else
                    <img src="{{ asset('img/default.png') }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                  @endif
                </td>
                <td>
                  @if(!empty($item->file_ktp))
                    <img src="{{ asset('storage/client/file_ktp/' . $item->file_ktp) }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                  @else
                    <img src="{{ asset('img/ktp.jpg') }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
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
                  <a class="me-3" href="{{ route('userslistclientedit', ['id' => $item->id]) }}">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a class="me-3" href="{{ route('showclient', ['id' => $item->id]) }}">
                    <i class="fas fa-eye"></i>
                  </a>
                  <form action="" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-link text-dark" onclick="return confirm('Are you sure you want to delete this item?');">
                      <i class="fas fa-trash-alt"></i>
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
