@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
  <div class="content">
    <div class="page-header">
      <div class="page-title">
        <h4>List Data Tentang PT Raja Perkasa</h4>
      </div>
      <div class="page-btn">
        <a href="{{ route('tentangcreate') }}" class="btn btn-added">
          <img src="{{ asset('assets/img/icons/plus.svg') }}" class="me-2" alt="img" />Tambah Data Tentang PT Raja Perkasa
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
                <th>Short Description</th>
                <th>Detail Description</th>
                <th>File Image</th>
                <th>Created Date</th>
                <th>Status Tentang PT Raja Perkasa</th>
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
                <td>{{ \Illuminate\Support\Str::limit($item->short_description, 20) }}</td>
                <td>{{ \Illuminate\Support\Str::limit(strip_tags($item->detail_description), 30) }}</td>
                <td>
                  @if(!empty($item->image))
                    @php
                      $images = explode(',', $item->image);
                    @endphp
                    @foreach($images as $image)
                      <img src="{{ asset('storage/photo-tentangpt/' . $image) }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px;">
                    @endforeach
                  @endif
                </td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>
                  @if($item->status_tentang == 'active')
                    <span class="badges bg-lightgreen">Active</span>
                  @else
                    <span class="badges bg-lightred">In Active</span>
                  @endif
                </td>
                <td>
                  <a class="me-3" href="{{ route('tentangedit', $item->id) }}">
                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" />
                  </a>
                  <form action="{{ route('tentangdelete', $item->id) }}" method="POST" style="display: inline;">
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
