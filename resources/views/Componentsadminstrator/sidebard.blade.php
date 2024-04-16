<!-- Side Bard -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
      <div id="sidebar-menu" class="sidebar-menu">
        <ul>
          <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
            @if(auth()->check() && auth()->user()->role->role_name === 'admin')
                <a href="{{ route('dashboardadmin') }}">
                    <img src="{{ asset('assets/img/icons/dashboard.svg') }}" alt="img" /><span>
                        Dashboard</span
                    >
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
                  ><i data-feather="bar-chart-2"></i> <span>Project Proyek </span>
                  <span class="menu-arrow"></span
                ></a>
                <ul>
                  <li class="{{ Request::is('proyeklist*') ? 'active' : '' }}"><a href="{{ route('proyeklist') }}">List Data </a></li>
                  <li class="{{ Request::is('proyekcreate*') ? 'active' : '' }}"><a href="{{ route('proyekcreate') }}">Tambah Data </a></li>
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
                  ><img src="{{ asset('assets/img/icons/expense1.svg') }}" alt="img" /><span>
                    Mitra</span
                  >
                  <span class="menu-arrow"></span
                ></a>
                <ul>
                  <li class="{{ Request::is('mitralist*') ? 'active' : '' }}"><a href="{{ route('mitralist') }}">List Data </a></li>
                  <li class="{{ Request::is('mitracreate*') ? 'active' : '' }}"><a href="{{ route('mitracreate') }}">Tambah Data </a></li>
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
        @endif

          <li class="submenu">
            <a href="javascript:void(0);"
              ><img src="{{ asset('assets/img/icons/users1.svg') }}" alt="img" /><span>
               Users</span
              >
              <span class="menu-arrow"></span
            ></a>
            <ul>
              <li class="{{ Request::is('userslist*') ? 'active' : '' }}"><a href="{{ route('userslist') }}">List Data </a></li>
              <li class="{{ Request::is('userscreate*') ? 'active' : '' }}"><a href="{{ route('userscreate') }}">Tambah Data </a></li>
            </ul>
          </li>

          <li class="submenu">
            <a href="javascript:void(0);"
              ><img src="{{ asset('assets/img/icons/time.svg') }}" alt="img" /><span>
                Report Data</span
              >
              <span class="menu-arrow"></span
            ></a>
            <ul>
              <li class="{{ Request::is('reportproyek*') ? 'active' : '' }}"><a href="{{ route('reportproyek') }}">Report Data Proyek</a>
              </li>
              <li class="{{ Request::is('reportjasa*') ? 'active' : '' }}"><a href="{{ route('reportjasa') }}">Report Data Jasa</a></li>
              <li class="{{ Request::is('reportusers*') ? 'active' : '' }}"><a href="{{ route('reportusers') }}">Report Data Users</a></li>
              <li class="{{ Request::is('reportmitra*') ? 'active' : '' }}"><a href="{{ route('reportmitra') }}">Report Data Mitra</a></li>
              <li class="{{ Request::is('reporttestimoni*') ? 'active' : '' }}"><a href="{{ route('reporttestimoni') }}">Report Data Testimoni</a></li>
            </ul>
          </li>

          <li class="submenu">
            <a href="javascript:void(0);"
              ><img src="{{ asset('assets/img/icons/settings.svg') }}" alt="img" /><span>
               Settings</span
              >
              <span class="menu-arrow"></span
            ></a>
            <ul>
              <li class="{{ Request::is('settings*') ? 'active' : '' }}"><a href="{{ route('settings') }}">General Settings </a></li>
            </ul>
          </li>

         


</div>

@section('scripts')
        <script>
           $(document).ready(function() {
            // Fungsi untuk menetapkan kelas active pada submenu yang sesuai dengan URL saat ini
            function setActiveSubmenu() {
                var currentURL = window.location.href;
                var submenuLinks = $('.sidebar-menu .submenu a');

                // Loop melalui setiap tautan submenu
                submenuLinks.each(function() {
                    var submenuLink = $(this);
                    var submenuURL = submenuLink.attr('href');

                    // Memeriksa apakah URL saat ini cocok dengan href dari tautan submenu
                    if (currentURL.includes(submenuURL)) {
                        // Menambahkan kelas 'active' pada tautan submenu
                        submenuLink.addClass('active');
                        // Menambahkan kelas 'show' pada submenu
                        submenuLink.next('ul').addClass('show');

                        // Menambahkan kelas 'active' pada tautan parent submenu
                        submenuLink.closest('.submenu').children('a').addClass('active');
                    }
                });

                // Menambahkan kelas 'active' pada tautan Dashboard jika URL sesuai
                if (currentURL.includes("dashboard")) {
                    $('.sidebar-menu li').removeClass('active');
                    $('.sidebar-menu li').first().addClass('active');
                }
            }

            // Memanggil fungsi setActiveSubmenu ketika dokumen dimuat
            setActiveSubmenu();

            // Event listener untuk tautan sidebar yang mengaktifkan submenu
            $('.sidebar-menu .submenu > a').on('click', function(e) {
                e.preventDefault();
                // Menghapus kelas 'show' dari submenu yang lain
                $('.sidebar-menu .submenu > ul').not($(this).next('ul')).removeClass('show');
                // Toggle kelas 'show' pada submenu yang diklik
                $(this).next('ul').toggleClass('show');
            });
        });
        </script>
@endsection