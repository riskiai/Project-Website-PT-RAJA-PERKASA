<style>
    .profilesets {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-right: 20px !important; 
    }
  
    .profilesets .user-img img {
        width: 40px; 
        height: 40px; 
        border-radius: 50%;
        margin-left: 10px !important;
    }
  
    .profilesets h6, .profilesets h5 {
        margin-bottom: 2px;
        font-size: 16px;
        font-weight: bold;
        color: #666; /* Default color for h5 */
    }
  
    .card1 {
    
    }
  
    .profilesets h5 {
        font-size: 14px; /* Specific font size for h5 */
    }
  
    .dropdown-menu {
        padding: 5px;
        width: 20px;
        margin-right: auto;
        margin-left: -25px !important;
    }
  
    .dropdown-divider {
        margin: 10px 0;
    }
  
    .dropdown-item.logout, .dropdown-item.logout:hover {
        color: #f00; /* Default color */
    }
  
    .dropdown-item.logout:hover {
        color: #a00; /* Hover color */
    }
  
    /* Responsive Design for mobile devices */
    @media (max-width: 768px) {
        .profilesets {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-right: 0 !important; /* Adjust margin */
            text-align: center; /* Center align text */
        }
  
        .profilesets .user-img img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin: 0 auto; /* Center align image */
        }
  
        .profilesets h6, .profilesets h5 {
            margin-bottom: 5px; /* Adjust margin */
            font-size: 14px; /* Adjust font size */
            font-weight: bold;
            color: #666;
            text-align: center; /* Center align text */
        }
  
        .dropdown-menu {
            padding: 10px; /* Add padding */
            width: auto; /* Adjust width */
            margin-right: auto;
            margin-left: -10px !important;
            text-align: center; /* Center align text */
        }
  
        .dropdown-item.logout, .dropdown-item.logout:hover {
            color: #f00; /* Default color */
        }
  
        .dropdown-item.logout:hover {
            color: #a00; /* Hover color */
        }
    }
</style>
  
<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-orange" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
  
<div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center border-start border-end px-3">
                <small class="fa fa-phone-alt me-2"></small>
                <small>+012 345 6789</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center border-end px-3">
                <small class="far fa-envelope-open me-2"></small>
                <small>rajaperkasa@gmail.com</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center border-end px-3">
                <small class="far fa-clock me-2"></small>
                <small>Mon - Fri : 09 AM - 09 PM</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn btn-square border-end border-start" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-square border-end" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-square border-end" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-square border-end" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
  
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
    <a href="index.html" class="navbar-brand d-flex align-items-center">
        <img src="{{ asset('img/logo3.png') }}" style="height: 40px; width: 200px;" alt="">
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-4 py-lg-0">
            <a href="{{ url('/home') }}" class="nav-item nav-link">Beranda</a>
            <a href="{{ url('/tentang') }}" class="nav-item nav-link">Tentang</a>
            <a href="{{ url('/jasa') }}" class="nav-item nav-link">Jasa</a>
            <a href="{{ url('/project') }}" class="nav-item nav-link">Project</a>
            <a href="{{ url('/kontak') }}" class="nav-item nav-link">Kontak</a>
            @auth
            @if(Auth::user()->role->role_name === 'client')
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/img/profiles/avator1.jpg') }}" style="width: 40px; height: 40px; border-radius: 50%; min-width: 20px;" alt="">
                    </a>
                    {{-- <div class="card1"> --}}
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <div class="profilesets dropdown-item">
                                    <span class="user-img">
                                        <img src="{{ asset('assets/img/profiles/avator1.jpg') }}" alt="" />
                                        <span class="status online"></span>
                                    </span>
                                    <h6>{{ auth()->user()->name }}</h6>
                                    <h5>{{ auth()->user()->role_name }} mitra</h5>
                                </div>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('profileclient') }}">Data Diri Pribadi</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item logout pb-0">
                                        <img src="{{ asset('assets/img/icons/log-out.svg') }}" class="me-2" alt="img" />Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        @else
            <a href="{{ url('/login') }}" class="nav-item nav-link">Login</a>
            <a href="{{ url('register') }}" class="nav-item nav-link">Register</a>
        @endauth
        </div>
    </div>
</nav>
  
@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var navbarItems = document.querySelectorAll('.navbar-nav .nav-link');
    
            navbarItems.forEach(function(item) {
                if (item.href === window.location.href) {
                    item.classList.add('active');
                }
            });
        });
    </script> 
@endsection
