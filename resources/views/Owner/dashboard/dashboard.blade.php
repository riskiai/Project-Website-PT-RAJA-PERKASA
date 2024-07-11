@extends('Adminstrator.Componentsadminstrator.app')

@section('styles')

<style>
  .bar-sedangberjalan {
    background-color: #FF0000 !important; /* Merah untuk 'sedangberjalan' */
  }

  .bar-selesai {
    background-color: #32CD32 !important; /* Hijau untuk 'selesai' */
  }

  .bar-default {
    background-color: #E4E4E4 !important; /* Default gray untuk lainnya */
  }

  .img-bulat {
    border-radius: 50%;
    max-width: 100px;
    max-height: 100px;
    margin-bottom: 10px;
  }

  .bg-lightorange {
      background-color: orange;
      color: white;
  }
  .bg-lightgreen {
      background-color: green;
      color: white;
  }
  .bg-lightred {
      background-color: red;
      color: white;
  }
  .badges {
      display: inline-block;
      padding: 0.35em 0.65em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: 0.25rem;
  }
</style>

@endsection

@section('content')

<div class="page-wrapper">
    <div class="content">

     {{-- Data Counting Dashboard --}}
     <div class="row">
      <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count">
          <div class="dash-counts">
            <h4>{{ $totalKaryawan }}</h4>
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
            <h4>{{ $totalMitraPerusahaan }}</h4>
            <h5>Total Mitra Perusahaan</h5>
          </div>
          <div class="dash-imgs">
            <i data-feather="user-check"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das2">
          <div class="dash-counts">
            <h4>{{ $totalProyekSedangBerjalan }}</h4>
            <h5>Total Proyek Sedang Berjalan</h5>
          </div>
          <div class="dash-imgs">
            <i data-feather="file-text"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das3">
          <div class="dash-counts">
            <h4>{{ $totalProyekSelesai }}</h4>
            <h5>Total Proyek Selesai</h5>
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
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Data Statistik Proyek Berdasarkan Status Progres dan Tahun</h5>
            <div class="graph-sets">
              {{-- <ul>
                <li>
                  <span>Sedang Berjalan</span>
                </li>
                <li>
                  <span>Selesai</span>
                </li>
              </ul> --}}
              <div class="dropdown">
                <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  {{ $currentYear }}
                  <img src="{{ asset('assets/img/icons/dropdown.svg') }}" alt="img" class="ms-2" />
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  @foreach ($proyekByStatusAndYear as $year => $data)
                    <li><a href="javascript:void(0);" class="dropdown-item">{{ $year }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div id="proyek_chart" style="max-width: 600px; margin: auto;"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-5 col-sm-12 col-12 d-flex">
        <div class="card flex-fill">
          <div class="card-header pb-0 d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Testimoni Client Untuk PT Raja Perkasa</h4>
            <div class="dropdown">
              <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="dropset">
                <i class="fa fa-ellipsis-v"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a href="productlist.html" class="dropdown-item">Name List</a></li>
                <li><a href="addproduct.html" class="dropdown-item">Product Add</a></li>
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
                    <th>Nama Mitra</th>
                    <th>Komentar</th>
                    <th>Gambar PIC Perusahaan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($testimonis as $testimoni)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $testimoni->nama_client }}</td>
                    <td>{{ $testimoni->nama_mitra }}</td>
                    <td>{!! $testimoni->comment !!}</td>
                    <td>
                      @if(!empty($testimoni->image))
                        @php
                          $images = explode(',', $testimoni->image);
                        @endphp
                        @foreach($images as $image)
                          <img src="{{ asset('storage/photo-testimoni/' . $image) }}" alt="img" style="max-width: 100px; max-height: 100px; margin-bottom: 10px; border-radius: 50%;" class="product-img">
                        @endforeach
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

    <!-- Data Proyek Section -->
    <div class="card mb-0">
      <div class="card-body">
        <h4 class="card-title">PROYEK PT RAJA PERKASA</h4>
        <div class="table-responsive dataview">
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Proyek</th>
                <th>Project Name</th>
                <th>Client Mitra Perusahaan</th>
                <th>Main Contractor</th>
                <th>Nama Materials</th>
                <th>Nama Peralatan</th>
                <th>Status Progres Proyek</th>
                <th>Status Proyek</th>
              </tr>
            </thead>
            <tbody>
              @foreach($proyeks as $proyek)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $proyek->title_proyek }}</td>
                <td>{{ $proyek->project_name }}</td>
                <td>{{ $proyek->client_name }}</td>
                <td>{{ $proyek->main_contractor }}</td>
                <td>{{ $proyek->materials->nama_materials ?? '-' }}</td>
                <td>{{ $proyek->peralatan->nama_peralatan ?? '-' }}</td>
                <td>
                  @if($proyek->status_progres_proyek == 'sedangberjalan')
                    <span class="badges bg-lightorange">Sedang Berjalan</span>
                  @else
                    <span class="badges bg-lightgreen">Selesai</span>
                  @endif
                </td>
                <td>
                  @if($proyek->status_proyek == 'disetujui')
                    <span class="badges bg-lightgreen">Disetujui</span>
                  @elseif($proyek->status_proyek == 'tidak_disetujui')
                    <span class="badges bg-lightred">Tidak Disetujui</span>
                  @else
                    <span class="badges bg-lightorange">Belum Dicek</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End of Data Proyek Section -->

  </div>
</div>

@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var dataValues = [];
    var categories = [];
    var colorClasses = [];

    @if (isset($proyekByStatusAndYear[$currentYear]) && $proyekByStatusAndYear[$currentYear]->isNotEmpty())
      @foreach ($proyekByStatusAndYear[$currentYear] as $data)
        dataValues.push({{ $data->total }});
        categories.push('{{ $data->status_progres_proyek }}');

        if ('{{ $data->status_progres_proyek }}' === 'sedangberjalan') {
          colorClasses.push('bar-sedangberjalan');
        } else if ('{{ $data->status_progres_proyek }}' === 'selesai') {
          colorClasses.push('bar-selesai');
        } else {
          colorClasses.push('bar-default');
        }
      @endforeach
    @endif

    var options = {
      series: [{
        name: 'Proyek',
        data: dataValues
      }],
      chart: {
        type: 'bar',
        height: 250,
        events: {
          dataPointMouseEnter: function(event, chartContext, config) {
            var pointClass = colorClasses[config.dataPointIndex];
            event.target.parentElement.setAttribute('class', pointClass);
          }
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          columnWidth: '40%',
          endingShape: 'rounded'
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
      },
      xaxis: {
        categories: categories
      },
      yaxis: {
        title: {
          text: 'Jumlah Proyek'
        }
      },
      fill: {
        opacity: 1
      },
      tooltip: {
        y: {
          formatter: function (val) {
            return val + " Proyek"
          }
        }
      }
    };

    var chart = new ApexCharts(document.querySelector("#proyek_chart"), options);
    chart.render();
  });
</script>
@endsection
