@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Profile Role Owner PT Raja Perkasa</h4>
          <h6>
            @foreach($ownerUsers as $owner)
              {{ $owner->name }}@if(!$loop->last), @endif
            @endforeach
          </h6>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <form action="{{ route('updateownerprofile', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="profile-set">
              <div class="profile-head"></div>
              <div class="profile-top">
                <div class="profile-content">
                  <div class="profile-contentimg">
                    <img
                      src="{{ $user->file_foto ? asset('storage/manajer/photo-profile/' . $user->file_foto) : asset('assets/img/customer/customer5.jpg') }}"
                      alt="img"
                      id="blah"
                    />
                    <div class="profileupload">
                      <input type="file" id="imgInp" name="file_foto" />
                      <a href="javascript:void(0);"
                        ><img src="{{ asset('assets/img/icons/edit-set.svg') }}" alt="img"
                      /></a>
                    </div>
                  </div>
                  <div class="profile-contentname">
                    {{-- <h2>{{ $user->name }}</h2> --}}
                    {{-- <h4>Updates Your Photo and Personal Details.</h4> --}}
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" name="name" class="form-control" value="{{ $user->name }}" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="{{ $user->email }}" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="no_hp" class="form-control" value="{{ $user->no_hp }}" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="alamat" class="form-control" value="{{ strip_tags($user->alamat) }}" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Date of Birth</label>
                  <input type="date" name="tgl_lahir" class="form-control" value="{{ $user->tgl_lahir ? $user->tgl_lahir->format('Y-m-d') : '' }}" />
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
                  <label>Gender</label>
                  <select name="jk" class="form-control">
                    <option value="L" {{ $user->jk == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $user->jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
