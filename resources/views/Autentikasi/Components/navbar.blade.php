 <!-- Spinner Start -->
 <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-orange" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->


<!-- Topbar Start -->
<div class="container-fluid bg-light p-0">
    <div class="row gx-0 d-none d-lg-flex">
      <div class="col-lg-7 px-5 text-start">
        <div
          class="h-100 d-inline-flex align-items-center border-start border-end px-3"
        >
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
          <a class="btn btn-square border-end border-start" href=""
            ><i class="fab fa-facebook-f"></i
          ></a>
          <a class="btn btn-square border-end" href=""
            ><i class="fab fa-twitter"></i
          ></a>
          <a class="btn btn-square border-end" href=""
            ><i class="fab fa-linkedin-in"></i
          ></a>
          <a class="btn btn-square border-end" href=""
            ><i class="fab fa-instagram"></i
          ></a>
        </div>
      </div>
    </div>
  </div>
  <!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 px-4 px-lg-5">
    <a href="index.html" class="navbar-brand d-flex align-items-center">
        <h2 class="m-0 text-orange">PT. RAJA PERKASA</h2>
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
            <!-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                    <a href="feature.html" class="dropdown-item">Feature</a>
                    <a href="quote.html" class="dropdown-item">Free Quote</a>
                    <a href="team.html" class="dropdown-item">Our Team</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div> -->
            <a href="{{ url('/kontak') }}" class="nav-item nav-link">Kontak</a>
            <a href="{{ url('/login') }}" class="nav-item nav-link">Login</a>
            <a href="{{ url('register') }}" class="nav-item nav-link">Register</a>
        </div>
        <!-- <div class="h-100 d-lg-inline-flex align-items-center d-none">
            <a class="btn btn-square rounded-circle bg-light text-primary me-2" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-square rounded-circle bg-light text-primary me-2" href=""><i class="fab fa-twitter"></i></a>
            <a class="btn btn-square rounded-circle bg-light text-primary me-2" href=""><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-square rounded-circle bg-light text-primary me-0" href=""><i class="fab fa-instagram"></i></a>
        </div> -->
    </div>
</nav>
<!-- Navbar End -->

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Ambil elemen navbar
            var navbarItems = document.querySelectorAll('.navbar-nav .nav-link');
    
            // Loop melalui setiap elemen navbar
            navbarItems.forEach(function(item) {
                // Periksa apakah URL saat ini sesuai dengan href dari elemen navbar
                if (item.href === window.location.href) {
                    // Tambahkan kelas 'active' jika sesuai
                    item.classList.add('active');
                }
            });
        });
    </script> 
@endsection