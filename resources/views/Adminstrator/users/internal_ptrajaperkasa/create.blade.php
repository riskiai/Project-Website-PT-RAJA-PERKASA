@extends('Adminstrator.Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
    <div class="content">
      <div class="page-header">
        <div class="page-title">
          <h4>Create Data Users Tentang PT Raja Perkasa</h4>
          {{-- <h6>Add/Update Expenses</h6> --}}
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <form action="" method="POST">
            @csrf
            <div class="row">
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Status PT Raja Perkasa</label>
                  <select name="expense_category" class="select">
                    <option value="">Active</option>
                    <option value="Category">In Active</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Date</label>
                  <div class="input-groupicon">
                    <input
                      type="text"
                      name="expense_date"
                      placeholder="Choose Date"
                      class="datetimepicker"
                    />
                    <div class="addonset">
                      <img src="{{ asset('assets/img/icons/calendars.svg') }}" alt="img" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>Title</label>
                  <div class="input-groupicon">
                    <input type="text" name="" />
                    {{-- <div class="addonset">
                      <img src="{{ asset('assets/img/icons/dollar.svg') }}" alt="img" />
                    </div> --}}
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-sm-6 col-12">
                <div class="form-group">
                  <label>File Image</label>
                  <input type="file" name="reference_no" />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Short Description</label>
                  <input type="text" name="expense_for" />
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>Detail Description</label>
                  <textarea class="form-control" name="description"></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <button type="submit" class="btn btn-submit me-2">Submit</button>
                <a href="expenselist.html" class="btn btn-cancel">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
