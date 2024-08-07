@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Kontak Di PT Raja Perkasa </h4>
        {{-- <h6>Manage your purchases</h6> --}}
      </div>
      <div class="page-btn">
        <a href="{{ route('kontakcreate') }}" class="btn btn-added">
          <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-2" alt="img" />
          Tambah Data Jasa Di PT Raja Perkasa
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
          <div class="wordset">
            {{-- <ul>
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
            </ul> --}}
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
                <th>
                  <label class="checkboxs">
                    <input type="checkbox" id="select-all" />
                    <span class="checkmarks"></span>
                  </label>
                </th>
                {{-- <th>No</th> --}}
                <th>Email</th>
                <th>Telefon</th>
                <th>Link</th>
                <th>Alamat</th>
                {{-- <th>Created Date</th> --}}
                <th>Status Kontak</th>
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
                {{-- <td>{{ $index + 1 }}</td> --}}
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>
                  <iframe src="{{ $item->links }}" width="100" height="100" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </td>
                <td>{!! $item->alamat !!}</td>
                {{-- <td>{{ $item->created_at->format('Y-m-d') }}</td> --}}
                <td>
                  @if($item->status_kontak == 'active')
                  <span class="badges bg-lightgreen">Active</span>
                  @else
                  <span class="badges bg-lightred">Non Active</span>
                  @endif
                </td>
                <td>
                  <a class="me-3" href="{{ route('kontakedit', ['id' => $item->id]) }}">
                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                  </a>
                  <form action="{{ route('kontakdelete', ['id' => $item->id]) }}" method="POST" style="display: inline;">
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
