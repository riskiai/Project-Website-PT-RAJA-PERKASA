<!-- Side Bar -->
<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
          <ul>
              <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                  @if(auth()->check() && auth()->user()->role->role_name === 'admin')
                      <a href="{{ route('dashboardadmin') }}">
                          <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img" /><span>
                              Dashboard</span>
                      </a>
                  @elseif(auth()->check() && auth()->user()->role->role_name === 'owner')
                      <a href="{{ route('dashboardowner') }}">
                          <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img" /><span>
                              Dashboard</span
                          >
                      </a>
                  @elseif(auth()->check() && auth()->user()->role->role_name === 'hrd')
                      <a href="{{ route('dashboardhrd') }}">
                          <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img" /><span>
                              Dashboard</span
                          >
                      </a>
                  @elseif(auth()->check() && auth()->user()->role->role_name === 'karyawan')
                      <a href="{{ route('dashboardkaryawan') }}">
                          <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img" /><span>
                              Dashboard</span
                          >
                      </a>
                  @elseif(auth()->check() && auth()->user()->role->role_name === 'manajer')
                      <a href="{{ route('dashboardmanajer') }}">
                          <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img" /><span>
                              Dashboard</span
                          >
                      </a>
                  @endif
              </li>

              @if(auth()->check() && !in_array(auth()->user()->role->role_name, ['owner', 'hrd', 'karyawan', 'manajer']))
                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><img src="{{ asset('assets/img/icons/product.svg') }}" alt="img" /><span>
                          Tentang PT Raja Perkasa </span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('tentanglist*') ? 'active' : '' }}"><a href="{{ route('tentanglist') }}">List Data </a></li>
                          {{-- <li class="{{ Request::is('tentangcreate*') ? 'active' : '' }}"><a href="{{ route('tentangcreate') }}">Tambah Data </a></li> --}}
                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><i data-feather="award"></i><span>Jasa </span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('jasalist*') ? 'active' : '' }}"><a href="{{ route('jasalist') }}">List Data </a></li>
                          <li class="{{ Request::is('jasacreate*') ? 'active' : '' }}"><a href="{{ route('jasacreate') }}">Tambah Data </a></li>
                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><img src="{{ asset('assets/img/icons/purchase1.svg') }}" alt="img" /><span>
                          Kontak</span
                          >
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('kontaklist*') ? 'active' : '' }}"><a href="{{ route('kontaklist') }}">List Data </a></li>
                          <li class="{{ Request::is('kontakcreate*') ? 'active' : '' }}"><a href="{{ route('kontakcreate') }}">Tambah Data </a></li>
                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><img src="{{ asset('assets/img/icons/places.svg') }}" alt="img" /><span>
                          Testimoni</span
                          >
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('testimonilist*') ? 'active' : '' }}"><a href="{{ route('testimonilist') }}">List Data </a></li>
                          <li class="{{ Request::is('testimonicreate*') ? 'active' : '' }}"><a href="{{ route('testimonicreate') }}">Tambah Data </a></li>
                      </ul>
                  </li>

                  <li class="submenu">
                    <a href="javascript:void(0);"
                       ><i data-feather="bar-chart-2"></i> <span>List Data Proyek</span>
                        <span class="menu-arrow"></span
                    ></a>
                    <ul>
                        <li class="{{ Request::is('listdataproyek*') ? 'active' : '' }}"><a href="{{ route('proyeklist') }}">List Data </a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="javascript:void(0);"
                       ><img src="{{ asset('assets/img/icons/expense1.svg') }}" alt="img" /><span>
                        Mitra Perusahaan <br> PT Raja Perkasa</span
                        > 
                        <span class="menu-arrow"></span
                    ></a>
                    <ul>
                        <li class="{{ Request::is('mitralist*') ? 'active' : '' }}"><a href="{{ route('mitralist') }}">List Data </a></li>
                        {{-- <li class="{{ Request::is('mitracreate*') ? 'active' : '' }}"><a href="{{ route('mitracreate') }}">Tambah Data </a></li> --}}
                    </ul>
                </li>
              @endif

              @if(auth()->check() && !in_array(auth()->user()->role->role_name, ['manajer', 'karyawan', 'owner', 'hrd']))
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img" />
                      <span>Users</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('userslist*') ? 'active' : '' }}">
                          <a href="{{ route('userslist') }}">Data Users Internal PT Raja Perkasa</a>
                      </li>
                      <li class="{{ Request::is('userslisteclient*') ? 'active' : '' }}">
                          <a href="{{ route('userslisteclient') }}">Data Users PIC Perusahaan External PT Raja Perkasa</a>
                      </li>
                  </ul>
              </li>
          @endif

          @if(auth()->check() && auth()->user()->role->role_name === 'admin')
          <li class="submenu">
              <a href="javascript:void(0);"
                 ><i data-feather="file-text"></i> <span>Report Data</span>
                  <span class="menu-arrow"></span
              ></a>
              <ul>
                  <li class="{{ Request::is('reportproyek*') ? 'active' : '' }}"><a href="{{ route('reportproyek') }}">Report Data List Proyek PT Raja Perkasa</a></li>
                  {{-- <li class="{{ Request::is('reportkaryawanlist*') ? 'active' : '' }}"><a href="">Report Data Karyawan PT Raja Perkasa</a></li> --}}
                  <li class="{{ Request::is('reportuserspicperusahaan*') ? 'active' : '' }}"><a href="{{ route('reportuserspicperusahaan') }}">Report Data PIC Perusahaan Client Mitra PT Raja Perkasa</a></li>
                  {{-- <li class="{{ Request::is('reportmitralist*') ? 'active' : '' }}"><a href="">Report Data Mitra PT Raja Perkasa</a></li> --}}
              </ul>
          </li>
      @endif

      @if(auth()->check() && auth()->user()->role->role_name === 'admin')
      <li class="submenu">
          <a href="javascript:void(0);">
              <img src="{{ asset('assets/img/icons/settings.svg') }}" alt="img" />
              <span>Settings</span>
              <span class="menu-arrow"></span>
          </a>
          <ul>
              <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                  <a href="{{ route('settings') }}">General Settings</a>
              </li>
              <li class="{{ Request::is('settings_title*') ? 'active' : '' }}">
                <a href="{{ route('settings_title') }}">Settings Title</a>
            </li>
          </ul>
      </li>
    @endif

          @if(auth()->check() && auth()->user()->role->role_name === 'owner')
          <li class="submenu">
            <a href="javascript:void(0);">
                <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img" />
                <span>Users</span>
                <span class="menu-arrow"></span>
            </a>
            <ul>
                <li class="{{ Request::is('ownerkaryawanlist*') ? 'active' : '' }}">
                    <a href="{{ route('ownerkaryawanlist') }}">Data Karyawan PT Raja Perkasa</a>
                </li>
                <li class="{{ Request::is('picperusahaanlist*') ? 'active' : '' }}">
                    <a href="{{ route('picperusahaanlist') }}">Data Users PIC Perusahaan External PT Raja Perkasa</a>
                </li>
            </ul>
        </li>

          <li class="submenu">
            <a href="javascript:void(0);"
               ><i data-feather="bar-chart-2"></i> <span>List Data Proyek</span>
                <span class="menu-arrow"></span
            ></a>
            <ul>
                <li class="{{ Request::is('proyeklistowner*') ? 'active' : '' }}"><a href="{{ route('proyeklistowner') }}">List Data </a></li>
            </ul>
        </li>

        <li class="submenu">
            <a href="javascript:void(0);"
               ><i data-feather="file-text"></i> <span>Report Data</span>
                <span class="menu-arrow"></span
            ></a>
            <ul>
                <li class="{{ Request::is('reportownerproyek*') ? 'active' : '' }}"><a href="{{ route('reportownerproyek') }}">Report Data List Proyek PT Raja Perkasa</a></li>
                <li class="{{ Request::is('reportdatakaryawan*') ? 'active' : '' }}"><a href="{{ route('reportdatakaryawan') }}">Report Data Karyawan PT Raja Perkasa</a></li>
                <li class="{{ Request::is('ownerreportuserspicperusahaan*') ? 'active' : '' }}"><a href="{{ route('ownerreportuserspicperusahaan') }}">Report Data PIC Perusahaan Client Mitra PT Raja Perkasa</a></li>
                {{-- <li class="{{ Request::is('reportmitralist*') ? 'active' : '' }}"><a href="">Report Data Mitra Perusahaan PT Raja Perkasa</a></li> --}}
            </ul>
        </li>
          @endif

              
              @if(auth()->check() && auth()->user()->role->role_name === 'hrd')
              <li class="submenu">
                <a href="javascript:void(0);">
                    <img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img" />
                    <span>Data Karyawan <br> PT Raja Perkasa</span>
                    <span class="menu-arrow"></span>
                </a>
                <ul>
                    <li class="{{ Request::is('divisilist*') ? 'active' : '' }}">
                        <a href="{{ route('divisilist') }}">List Data Divisi Pekerjaan PT Raja Perkasa</a>
                    </li>
                    <li class="{{ Request::is('karyawanlist*') ? 'active' : '' }}">
                        <a href="{{ route('karyawanlist') }}">List Data Karyawan PT Raja Perkasa</a>
                    </li>
                </ul>
            </li>

              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="user-x"></i>
                      <span>Data Pengunduran <br> Diri Karyawan</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('listpengundurandirikaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('listpengundurandirikaryawan') }}">List Data</a>
                      </li>
                  </ul>
              </li>
          
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="calendar"></i>
                      <span>Data Cuti Karyawan</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('listcutikaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('listcutikaryawan') }}">List Data</a>
                      </li>
                  </ul>
              </li>
          
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="clipboard"></i>
                      <span>Data List Absen Karyawan</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('listabsenkaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('listabsenkaryawan') }}">List Data</a>
                      </li>
                  </ul>
              </li>
          
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="alert-triangle"></i>
                      <span>Data List Peringatan Karyawan</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('listperingatankaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('listperingatankaryawan') }}">List Data</a>
                      </li>
                  </ul>
              </li>
          
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="bar-chart-2"></i>
                      <span>Report Data Internal <br> Karyawan PT Raja Perkasa</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                    <li class="{{ Request::is('reportlistabsenkaryawan*') ? 'active' : '' }}">
                        <a href="{{ route('reportlistabsenkaryawan') }}">Report Data Absen</a>
                    </li>
                      <li class="{{ Request::is('reportlistpengundurandirikaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('reportlistpengundurandirikaryawan') }}">Report Data Pengunduran Diri</a>
                      </li>
                      <li class="{{ Request::is('reportlistcutikaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('reportlistcutikaryawan') }}">Report Data Cuti</a>
                      </li>
                      <li class="{{ Request::is('reportlistperingatankaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('reportlistperingatankaryawan') }}">Report Data List Peringatan Karyawan</a>
                      </li>
                  </ul>
              </li>
          @endif

          @if(auth()->check() && auth()->user()->role->role_name === 'karyawan')
          <li class="submenu">
            <a href="javascript:void(0);">
                <i data-feather="clipboard"></i>
                <span>Absen Karyawan</span>
                <span class="menu-arrow"></span>
            </a>
            <ul>
                <li class="{{ Request::is('absenkaryawan*') ? 'active' : '' }}">
                    <a href="{{ route('absenkaryawan') }}">Absen</a>
                </li>
            </ul>
        </li>

              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="user-x"></i>
                      <span>Pengajuan Pengunduran Diri</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('pengajuandirikaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('pengajuandirikaryawan') }}">Ajukan Data Pengunduran diri</a>
                      </li>
                  </ul>
              </li>
          
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="calendar"></i>
                      <span>Pengajuan Cuti </span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('pengajuancutikaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('pengajuancutikaryawan') }}">Ajukan Data Cuti</a>
                      </li>
                  </ul>
              </li>
          
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="alert-triangle"></i>
                      <span>Data Peringatan Karyawan</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('peringatankaryawan*') ? 'active' : '' }}">
                          <a href="{{ route('peringatankaryawan') }}">List Data</a>
                      </li>
                  </ul>
              </li>
          @endif

             
          

              @if(auth()->check() && auth()->user()->role->role_name === 'manajer')
                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><i data-feather="box"></i> <span>Peralatans PT Raja Perkasa</span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('peralatanlist*') ? 'active' : '' }}"><a href="{{ route('peralatanlist') }}">Peralatan</a></li>
                          <li class="{{ Request::is('brandperalatanlist*') ? 'active' : '' }}"><a href="{{ route('brandperalatanlist') }}">Brand Peralatan</a></li>
                          <li class="{{ Request::is('listdataperalatan*') ? 'active' : '' }}"><a href="{{ route('listdataperalatan') }}">List Data Peralatans</a></li>
                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><i data-feather="archive"></i> <span>Material PT Raja Perkasa</span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('materialslist*') ? 'active' : '' }}"><a href="{{ route('materialslist') }}">Material</a></li>
                          <li class="{{ Request::is('brandmateriallist*') ? 'active' : '' }}"><a href="{{ route('brandmaterialslist') }}">Brand Material</a></li>
                          <li class="{{ Request::is('materiallistdata*') ? 'active' : '' }}"><a href="{{ route('listdatamaterials') }}">List Data Material</a></li>
                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><i data-feather="bar-chart-2"></i> <span>Data Proyek</span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('listdataproyek*') ? 'active' : '' }}"><a href="{{ route('listdataproyek') }}">List Data Proyek</a></li>
                          <li class="{{ Request::is('bidangpekerjaanproyek.list*') ? 'active' : '' }}"><a href="{{ route('bidangpekerjaanproyek.list') }}">Bidang Pekerjaan Proyek</a></li>
                          
                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><i data-feather="file-text"></i> <span>Report Data Proyek PT Raja Perkasa</span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('reportlistperalatan*') ? 'active' : '' }}"><a href="{{ route('reportlistperalatan') }}">Report Data List Peralatan</a></li>
                          <li class="{{ Request::is('reportlistmaterials*') ? 'active' : '' }}"><a href="{{ route('reportlistmaterials') }}">Report Data List Materials</a></li>
                          <li class="{{ Request::is('reportlistproyek*') ? 'active' : '' }}"><a href="{{ route('reportlistproyek') }}">Report Data List Proyek</a></li>
                      </ul>
                  </li>
              @endif
          </ul>
      </div>
  </div>
</div>
