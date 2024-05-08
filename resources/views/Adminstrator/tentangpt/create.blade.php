@extends('Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Create Data Tentang PT Raja Perkasa</h4>
          {{-- <h6>Add/Update Expenses</h6> --}}
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="{{ route('tentangcreateproses') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Status PT Raja Perkasa</label>
                  <select name="status_user" class="select">
                    <option value="active">Active</option>
                    <option value="nonactive">In Active</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="title" class="form-control" />
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                    <label>File Image</label>
                    <input type="file" name="image[]" class="form-control" multiple />
                </div>
            </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Short Description</label>
                  <input type="text" name="short_description" class="form-control" />
                </div>
              </div>
              
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Detail Description</label>
                  <textarea class="form-control" name="detail_description"></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="{{ route('tentanglist') }}" class="btn btn-cancel">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
