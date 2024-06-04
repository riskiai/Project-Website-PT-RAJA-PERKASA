@extends('Autentikasi.Components.app')

@section('link')
    <link rel="stylesheet" href="css/register.css">
@endsection

@section('content')

     <!-- Register Page  -->
     <div class="container-fluid overflow-hidden my-5 px-5">
        <div class="login">
           <div class="container">
                <h1>Register</h1>
                <form action="{{ route('registerproses') }}" method="POST">
                    @csrf 
                    <input type="text" name="name" class="input-field" placeholder="Nama PIC">
                    <input type="email" name="email" class="input-field" placeholder="Email PIC">
                    <input type="number" name="no_hp" class="input-field" placeholder="No Handphone">
                    <input type="password" name="password" class="input-field" placeholder="Password"><br>
                    <input type="checkbox"><span>Remember me</span>
                    <a href="#">Forgot password?</a>
                    <button class="btn-register">Register</button> 
                </form>
                
                <hr><p>Or Connect With</p><hr>
                <ul>
                    <li><i class="fab fa-facebook-f fa-2x"></i></li>
                    {{-- <li><i class="fab fa-twitter fa-2x"></i></li> --}}
                    <li><i class="fas fa-envelope fa-2x"></i></li>
                    <li><i class="fab fa-linkedin-in fa-2x"></i></li>
                </ul>
                <div class="clearfix"></div>          
                <span class="copyright">&copy; PT Raja Perkasa 2024</span> 
           </div>
        </div>
        <div class="register">
            <div class="container">
                <i class="fas fa-user-plus fa-5x"></i>
                <h2>Selamat Datang Di Website PT Raja Perkasa</h2>
             
                <p>Daftarkan Segera Sebagai Calon Mitra Kami! <br> Sudah Punya Akun ? Silahkan Login Terlebih Dahulu!</p>
                <a href="{{ route('login') }}"><button>Login <i class="fas fa-arrow-circle-right"></i></button></a> 
            </div>
        </div>  
      </div>
  
       <!-- Footer Start -->
       <div class="container-fluid bg-dark text-secondary footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-1">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4" style="font-size:15px;">Alamat PT Raja Perkasa</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Indramayu, Jawa Barat</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>rajaperkasa@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fas fa-envelope"></i></a>
                        <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4" style="font-size:15px;">Jasa Kami</h5>
                    <a class="btn btn-link" href="">Manajemen Proyek</a>
                    <a class="btn btn-link" href="">Desain & Rekayasa</a>
                    <a class="btn btn-link" href="">Konstruksi Umum</a>
                    <a class="btn btn-link" href="">Konsultasi Proyek</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4" style="font-size:15px;">Quick Links</h5>
                    <a class="btn btn-link" href="">Tentang</a>
                    <a class="btn btn-link" href="">Jasa Kami</a>
                    <a class="btn btn-link" href="">Project</a>
                    <a class="btn btn-link" href="">Kontak</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4" style="font-size:15px;">Hubungi Kami</h5>
                    <p>Hubungi kami untuk informasi lebih lanjut tentang layanan kami.</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-transparent border-secondary w-100 py-3 ps-4 pe-5" type="text" placeholder="Email Anda">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
  
  
    <!-- Copyright Start -->
    <div class="container-fluid start"  style="background: #000000; height: 70px;">
          <br>
           <a class="border-bottom text-orange" href="#"> &copy; PT Raja Perkasa</a>, All Right Reserved.
    </div>
    <!-- Copyright End -->

@endsection