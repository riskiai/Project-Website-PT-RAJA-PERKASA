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

  /* CSS untuk menjaga tinggi chart tetap stabil */
  #proyek_chart {
    height: 300px; /* atau nilai tinggi lainnya yang diinginkan */
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
                <h4>{{ $totalKehadiranKeseluruhan }}</h4>
                <h5>Total Kehadiran Keseluruhan</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="user-check"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das2">
            <div class="dash-counts">
                <h4>{{ $totalCuti }}</h4>
                <h5>Total Cuti</h5>
            </div>
            <div class="dash-imgs">
                <i data-feather="file-text"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12 d-flex">
        <div class="dash-count das3">
            <div class="dash-counts">
                <h4>{{ $totalPengundurandiri }}</h4>
                <h5>Total Pengunduran Diri</h5>
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
                  <h5 class="card-title mb-0">Data Statistik Kehadiran Seluruh Karyawan PT Raja Perkasa</h5>
                  <div class="graph-sets">
                      <div class="dropdown">
                          <button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                              {{ $currentMonth }}
                              <img src="{{ asset('assets/img/icons/dropdown.svg') }}" alt="img" class="ms-2" />
                          </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              @foreach ($kehadiranByMonth as $month => $data)
                                  <li><a href="javascript:void(0);" class="dropdown-item">{{ $month }}</a></li>
                              @endforeach
                          </ul>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <div id="kehadiran_chart" style="max-width: 600px; margin: auto;"></div>
              </div>
          </div>
      </div>
      <div class="col-lg-5 col-sm-12 col-12 d-flex">
          <div class="card flex-fill">
              <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                  <h4 class="card-title mb-0">Data Cuti Seluruh Karyawan</h4>
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
                                  <th>Nama Karyawan</th>
                                  <th>Divisi</th>
                                  <th>Total Cuti</th>
                                  <th>Status Cuti</th>
                              </tr>
                          </thead>
                          <tbody>
                              @foreach($cutiKaryawan as $cuti)
                                  <tr>
                                      <td>{{ $loop->iteration }}</td>
                                      <td>{{ $cuti->user->name }}</td>
                                      <td>{{ $cuti->user->divisi->divisi_name }}</td>
                                      <td>{{ $cuti->total_cuti }}</td>
                                      <td>{{ ucwords(str_replace('_', ' ', $cuti->status_cuti)) }}</td>
                                  </tr>
                              @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <!-- Data Peringatan Karyawan Section -->
    <div class="card mb-0">
      <div class="card-body">
        <h4 class="card-title">Data Peringatan Karyawan PT Raja Perkasa</h4>
        <div class="table-responsive dataview">
          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Jenis Peringatan</th>
                <th>Status Karyawan</th>
                <th>Total Peringatan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($peringatanKaryawan as $peringatan)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peringatan->user->name ?? "Tidak Ada Data" }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $peringatan->jenis_peringatan)) }}</td>
                <td>{{ ucwords($peringatan->status_karyawan) }}</td>
                <td>{{ $peringatan->total_peringatan }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- End of Data Peringatan Karyawan Section -->
  </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dataValues = [];
        var categories = [];
        var colorClasses = [];

        @if (isset($kehadiranByMonth[$currentMonth]) && $kehadiranByMonth[$currentMonth]->isNotEmpty())
            @foreach ($kehadiranByMonth[$currentMonth] as $data)
                dataValues.push({{ $data->total }});
                categories.push('{{ $data->status_absensi }}');

                if ('{{ $data->status_absensi }}' === 'Hadir') {
                    colorClasses.push('bar-hadir');
                } else if ('{{ $data->status_absensi }}' === 'Tidak Hadir') {
                    colorClasses.push('bar-tidak-hadir');
                } else {
                    colorClasses.push('bar-default');
                }
            @endforeach
        @endif

        var options = {
            series: [{
                name: 'Absensi',
                data: dataValues
            }],
            chart: {
                type: 'bar',
                height: 350,
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
                    columnWidth: '20%',
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
                    text: 'Jumlah Kehadiran'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val + " Kehadiran"
                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#kehadiran_chart"), options);
        chart.render();
    });
</script>
@endsection
