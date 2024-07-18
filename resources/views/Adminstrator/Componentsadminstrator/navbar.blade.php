<div id="global-loader">
    <div class="whirly-loader"></div>
  </div>
  
  <div class="main-wrapper">
    <div class="header">
        <div class="header-left active">
            <a href="index.html" class="logo">
                <img src="{{ asset('assets/img/logo3.png') }}" style="width: 180px; height:30px;" alt="" />
            </a>
            <a href="index.html" class="logo-small">
                <img src="assets/img/logo-small.png" alt="" />
            </a>
        </div>
  
        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
  
        <ul class="nav user-menu">
            <li class="nav-item">
                <div class="top-nav-search">
                    <a href="javascript:void(0);" class="responsive-search">
                        <i class="fa fa-search"></i>
                    </a>
                </div>
            </li>
  
            <li class="nav-item dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <img src="{{ asset('assets/img/icons/notification-bing.svg') }}" alt="img" />
                    <span class="badge rounded-pill">4</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="activities.html">
                                    <div class="media d-flex">
                                        <span class="avatar flex-shrink-0">
                                            <img alt="" src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" />
                                        </span>
                                        <div class="media-body flex-grow-1">
                                            <p class="noti-details">
                                                <span class="noti-title">John Doe</span> added new task
                                                <span class="noti-title">Patient appointment booking</span>
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time">4 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <!-- other notifications -->
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="activities.html">View all Notifications</a>
                    </div>
                </div>
            </li>
  
            <li class="nav-item dropdown has-arrow main-drop">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-img">
                        @php
                            $role = auth()->user()->role->role_name;
                            $imagePath = match($role) {
                                'admin' => 'storage/client/photo-profile/',
                                'manajer' => 'storage/manajer/photo-profile/',
                                'owner' => 'storage/owner/photo-profile/',
                                'hrd' => 'storage/hrd/photo-profile/',
                                'karyawan' => 'storage/karyawan/photo-profile/',
                                default => 'storage/unknown/photo-profile/',
                            };
                        @endphp
  
                        <img src="{{ auth()->user()->file_foto ? asset($imagePath . auth()->user()->file_foto) : asset('assets/img/customer/customer5.jpg') }}" alt="img" id="blah" />
                        <span class="status online"></span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profilename">
                        <div class="profileset">
                            <span class="user-img">
                                <img src="{{ auth()->user()->file_foto ? asset($imagePath . auth()->user()->file_foto) : asset('assets/img/customer/customer5.jpg') }}" alt="img" id="blah" />
                                <span class="status online"></span>
                            </span>
                            <div class="profilesets">
                                <h6>{{ auth()->user()->name }}</h6>
                                <h5>{{ auth()->user()->role->role_name }}</h5>
                            </div>
                        </div>
                        <hr class="m-0" />
                        @php
                            $profileRoute = match($role) {
                                'manajer' => route('editusersmanajerprofile', auth()->user()->id),
                                'admin' => route('editusersprofile', auth()->user()->id),
                                'owner' => route('editusersownerprofile', auth()->user()->id), 
                                'hrd' => route('editusershrdprofile', auth()->user()->id), 
                                'karyawan' => route('edituserskaryawanprofile', auth()->user()->id), 
                                default => '#',
                            };
                        @endphp
                        <a class="dropdown-item" href="{{ $profileRoute }}">
                            <i class="me-2" data-feather="user"></i> My Profile
                        </a>
                        @if(auth()->check() && auth()->user()->role->role_name === 'admin')
                        <a class="dropdown-item" href="{{ route('settings') }}">
                            <i class="me-2" data-feather="settings"></i>Settings
                        </a>
                      @endif
                    
                        <hr class="m-0" />
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item logout pb-0">
                                <img src="{{ asset('assets/img/icons/log-out.svg') }}" class="me-2" alt="img" />
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
  
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.html">My Profile</a>
                <a class="dropdown-item" href="generalsettings.html">Settings</a>
                <a class="dropdown-item" href="signin.html">Logout</a>
            </div>
        </div>
    </div>
  </div>
  