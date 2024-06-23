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
                          <li class="{{ Request::is('tentangcreate*') ? 'active' : '' }}"><a href="{{ route('tentangcreate') }}">Tambah Data </a></li>
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
                        <li class="{{ Request::is('mitracreate*') ? 'active' : '' }}"><a href="{{ route('mitracreate') }}">Tambah Data </a></li>
                    </ul>
                </li>
              @endif

              @if(auth()->check() && !in_array(auth()->user()->role->role_name, ['manajer', 'karyawan', 'owner']))
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
                          <a href="{{ route('userslisteclient') }}">Data Users PIC Client External PT Raja Perkasa</a>
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
                  <li class="{{ Request::is('reportproyeklist*') ? 'active' : '' }}"><a href="">Report Data List Proyek PT Raja Perkasa</a></li>
                  <li class="{{ Request::is('reportkaryawanlist*') ? 'active' : '' }}"><a href="">Report Data Karyawan PT Raja Perkasa</a></li>
                  <li class="{{ Request::is('reportcalonclientmitralist*') ? 'active' : '' }}"><a href="">Report Data Calon Client Mitra PT Raja Perkasa</a></li>
                  <li class="{{ Request::is('reportmitralist*') ? 'active' : '' }}"><a href="">Report Data Mitra PT Raja Perkasa</a></li>
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
              <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                <a href="{{ route('settings') }}">Settings Title</a>
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
                <li class="{{ Request::is('userslist*') ? 'active' : '' }}">
                    <a href="">Data Users Internal PT Raja Perkasa</a>
                </li>
                <li class="{{ Request::is('userslisteclient*') ? 'active' : '' }}">
                    <a href="">Data Users Client External PT Raja Perkasa</a>
                </li>
            </ul>
        </li>

          <li class="submenu">
            <a href="javascript:void(0);"
               ><i data-feather="bar-chart-2"></i> <span>List Data Proyek</span>
                <span class="menu-arrow"></span
            ></a>
            <ul>
                <li class="{{ Request::is('listdataproyek*') ? 'active' : '' }}"><a href="">List Data </a></li>
            </ul>
        </li>

        <li class="submenu">
            <a href="javascript:void(0);"
               ><i data-feather="file-text"></i> <span>Report Data</span>
                <span class="menu-arrow"></span
            ></a>
            <ul>
                <li class="{{ Request::is('reportproyeklist*') ? 'active' : '' }}"><a href="">Report Data List Proyek PT Raja Perkasa</a></li>
                <li class="{{ Request::is('reportkaryawanlist*') ? 'active' : '' }}"><a href="">Report Data Karyawan PT Raja Perkasa</a></li>
                <li class="{{ Request::is('reportcalonclientmitralist*') ? 'active' : '' }}"><a href="">Report Data Calon Client Mitra PT Raja Perkasa</a></li>
                <li class="{{ Request::is('reportmitralist*') ? 'active' : '' }}"><a href="">Report Data Mitra PT Raja Perkasa</a></li>
            </ul>
        </li>
          @endif

              
              @if(auth()->check() && auth()->user()->role->role_name === 'hrd')
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="user-x"></i>
                      <span>Data Pengunduran <br> Diri Karyawan</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
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
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
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
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
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
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
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
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">Report Data Pengunduran Diri</a>
                      </li>
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">Report Data Cuti</a>
                      </li>
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">Report Data List Peringatan Karyawan</a>
                      </li>
                  </ul>
              </li>
          @endif

          @if(auth()->check() && auth()->user()->role->role_name === 'karyawan')
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="user-x"></i>
                      <span>Pengajuan Pengunduran Diri</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
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
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
                      </li>
                  </ul>
              </li>
          
              <li class="submenu">
                  <a href="javascript:void(0);">
                      <i data-feather="clipboard"></i>
                      <span>Absen Karyawan</span>
                      <span class="menu-arrow"></span>
                  </a>
                  <ul>
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
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
                      <li class="{{ Request::is('settings*') ? 'active' : '' }}">
                          <a href="{{ route('settings') }}">List Data</a>
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
                         ><i data-feather="bar-chart-2"></i> <span>List Data Proyek</span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('listdataproyek*') ? 'active' : '' }}"><a href="{{ route('listdataproyek') }}">List Data</a></li>
                      </ul>
                  </li>

                  <li class="submenu">
                      <a href="javascript:void(0);"
                         ><i data-feather="file-text"></i> <span>Report Data Proyek</span>
                          <span class="menu-arrow"></span
                      ></a>
                      <ul>
                          <li class="{{ Request::is('reportperalatanlist*') ? 'active' : '' }}"><a href="">Report Data Peralatan</a></li>
                          <li class="{{ Request::is('reportmateriallist*') ? 'active' : '' }}"><a href="">Report Data Materials</a></li>
                          <li class="{{ Request::is('reportproyeklist*') ? 'active' : '' }}"><a href="">Report Data Proyek</a></li>
                      </ul>
                  </li>
              @endif
          </ul>
      </div>
  </div>
</div>
