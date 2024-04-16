@extends('Componentsadminstrator.app')

@section('content')

<div class="page-wrapper">
    <div class="content">

      <div class="row">
        {{-- <div class="col-lg-3 col-sm-6 col-12">
          <div class="dash-widget">
            <div class="dash-widgetimg">
              <span
                ><img src="{{ asset('assets/img/icons/dash1.svg') }}" alt="img"
              /></span>
            </div>
            <div class="dash-widgetcontent">
              <h5>
                $<span class="counters" data-count="307144.00"
                  >$307,144.00</span
                >
              </h5>
              <h6>Total Purchase Due</h6>
            </div>
          </div>
        </div> --}}
        {{-- <div class="col-lg-3 col-sm-6 col-12">
          <div class="dash-widget dash1">
            <div class="dash-widgetimg">
              <span
                ><img src="{{ asset('assets/img/icons/dash2.svg') }}" alt="img"
              /></span>
            </div>
            <div class="dash-widgetcontent">
              <h5>
                $<span class="counters" data-count="4385.00"
                  >$4,385.00</span
                >
              </h5>
              <h6>Total Sales Due</h6>
            </div>
          </div>
        </div> --}}
        {{-- <div class="col-lg-3 col-sm-6 col-12">
          <div class="dash-widget dash2">
            <div class="dash-widgetimg">
              <span
                ><img src="{{ asset('assets/img/icons/dash3.svg') }}" alt="img"
              /></span>
            </div>
            <div class="dash-widgetcontent">
              <h5>
                $<span class="counters" data-count="385656.50"
                  >385,656.50</span
                >
              </h5>
              <h6>Total Sale Amount</h6>
            </div>
          </div>
        </div> --}}
        {{-- <div class="col-lg-3 col-sm-6 col-12">
          <div class="dash-widget dash3">
            <div class="dash-widgetimg">
              <span
                ><img src="{{ asset('assets/img/icons/dash4.svg') }}" alt="img"
              /></span>
            </div>
            <div class="dash-widgetcontent">
              <h5>
                $<span class="counters" data-count="40000.00">400.00</span>
              </h5>
              <h6>Total Sale Amount</h6>
            </div>
          </div>
        </div> --}}
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count">
            <div class="dash-counts">
              <h4>50</h4>
              <h5>Total Karyawan</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="user"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count das1">
            <div class="dash-counts">
              <h4>55</h4>
              <h5>Total Client</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="user-check"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count das2">
            <div class="dash-counts">
              <h4>40</h4>
              <h5>Total Mitra Kerja</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="file-text"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12 d-flex">
          <div class="dash-count das3">
            <div class="dash-counts">
              <h4>80</h4>
              <h5>Total Project Selesai</h5>
            </div>
            <div class="dash-imgs">
              <i data-feather="file"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-7 col-sm-12 col-12 d-flex">
          <div class="card flex-fill">
            <div
              class="card-header pb-0 d-flex justify-content-between align-items-center"
            >
              <h5 class="card-title mb-0">Rekap Proyek Yang Di Selesaikan</h5>
              <div class="graph-sets">
                <ul>
                  <li>
                    <span>On Going</span>
                  </li>
                  <li>
                    <span>Complete Proyek</span>
                  </li>
                </ul>
                <div class="dropdown">
                  <button
                    class="btn btn-white btn-sm dropdown-toggle"
                    type="button"
                    id="dropdownMenuButton"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                  >
                    2024
                    <img
                      src="{{ asset('assets/img/icons/dropdown.svg') }}"
                      alt="img"
                      class="ms-2"
                    />
                  </button>
                  <ul
                    class="dropdown-menu"
                    aria-labelledby="dropdownMenuButton"
                  >
                    <li>
                      <a href="javascript:void(0);" class="dropdown-item"
                        >2024</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="dropdown-item"
                        >2022</a
                      >
                    </li>
                    <li>
                      <a href="javascript:void(0);" class="dropdown-item"
                        >2023</a
                      >
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="sales_charts"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-sm-12 col-12 d-flex">
          <div class="card flex-fill">
            <div
              class="card-header pb-0 d-flex justify-content-between align-items-center"
            >
              <h4 class="card-title mb-0">Testimoni Client Untuk PT Raja Perkasa</h4>
              <div class="dropdown">
                <a
                  href="javascript:void(0);"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  class="dropset"
                >
                  <i class="fa fa-ellipsis-v"></i>
                </a>
                <ul
                  class="dropdown-menu"
                  aria-labelledby="dropdownMenuButton"
                >
                  <li>
                    <a href="productlist.html" class="dropdown-item"
                      >Name List</a
                    >
                  </li>
                  <li>
                    <a href="addproduct.html" class="dropdown-item"
                      >Product Add</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive dataview">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Client</th>
                      <th>Komentar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td class="productimgname">
                        <a href="productlist.html" class="product-img">
                          <img
                            src="{{ asset('assets/img/product/about.jpg') }}"
                            alt="product"
                          />
                        </a>
                        <a href="productlist.html">Riski Haidar</a>
                      </td>
                      <td>PT Raja Perkasa Perusahaan <br> Konstruksi Rekomended</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td class="productimgname">
                        <a href="productlist.html" class="product-img">
                          <img
                          src="{{ asset('assets/img/product/about.jpg') }}"
                            alt="product"
                          />
                        </a>
                        <a href="productlist.html">Riski Haidar</a>
                      </td>
                      <td>PT Raja Perkasa Perusahaan <br> Konstruksi Rekomended</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td class="productimgname">
                        <a href="productlist.html" class="product-img">
                          <img
                          src="{{ asset('assets/img/product/about.jpg') }}"
                            alt="product"
                          />
                        </a>
                        <a href="productlist.html">Riski Haidar</a>
                      </td>
                      <td>PT Raja Perkasa Perusahaan <br> Konstruksi Rekomended</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td class="productimgname">
                        <a href="productlist.html" class="product-img">
                          <img
                          src="{{ asset('assets/img/product/about.jpg') }}"
                            alt="product"
                          />
                        </a>
                        <a href="productlist.html">Riski Haidar</a>
                      </td>
                      <td>PT Raja Perkasa Perusahaan <br> Konstruksi Rekomended</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-0">
        <div class="card-body">
          <h4 class="card-title">PROYEK PT RAJA PERKASA</h4>
          <div class="table-responsive dataview">
            <table class="table datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Proyek</th>
                  <th>Dokumentasi Proyek</th>
                  <th>Description Proyek</th>
                  <th>Status Proyek</th>
                  <th>Tanggal Proyek Selesai</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td><a href="javascript:void(0);">IT0001</a></td>
                  <td class="productimgname">
                    <a class="product-img" href="productlist.html">
                      <img
                        src="{{ asset('assets/img/product/gambar20.png') }}"
                        alt="product"
                      />
                    </a>
                    <a href="productlist.html">Tangki</a>
                  </td>
                  <td>Tower Crane</td>
                  <td>Complete Proyek</td>
                  <td>12-12-2024</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td><a href="javascript:void(0);">IT0002</a></td>
                  <td class="productimgname">
                    <a class="product-img" href="productlist.html">
                      <img
                        src="{{ asset('assets/img/product/gambar20.png') }}"
                        alt="product"
                      />
                    </a>
                    <a href="productlist.html">Tangki</a>
                  </td>
                  <td>Tower Crane</td>
                  <td>Complete Proyek</td>
                  <td>12-12-2024</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td><a href="javascript:void(0);">IT0003</a></td>
                  <td class="productimgname">
                    <a class="product-img" href="productlist.html">
                      <img
                        src="{{ asset('assets/img/product/gambar20.png') }}"
                        alt="product"
                      />
                    </a>
                    <a href="productlist.html">Tangki</a>
                  </td>
                  <td>Tower Crane</td>
                  <td>Complete Proyek</td>
                  <td>12-12-2024</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td><a href="javascript:void(0);">IT0004</a></td>
                  <td class="productimgname">
                    <a class="product-img" href="productlist.html">
                      <img
                        src="{{ asset('assets/img/product/gambar20.png') }}"
                        alt="product"
                      />
                    </a>
                    <a href="productlist.html">Tangki</a>
                  </td>
                  <td>Tower Crane</td>
                  <td>Complete Proyek</td>
                  <td>12-12-2024</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection