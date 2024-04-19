@extends('Pengunjung.Components.app')

@section('content')

    <!-- Carousel Start -->
   <div class="container-fluid p-0 pb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('img/kosn.jpg') }}" alt="" >
            <div class="carousel-inner">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8 text-center">
                            <h1 class="display-3 text-white animated slideInDown mb-4">Perusahaan Konstruksi & Renovasi</h1>
                            <p class="fs-5 text-white mb-4 pb-2">Kami adalah perusahaan konstruksi dan renovasi yang berpengalaman, siap membantu Anda mewujudkan proyek impian Anda. </p>
                            <a href="" class="btn btn-primary rounded-pill py-md-3 px-md-5 me-3 animated slideInLeft">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('img/kosn.jpg') }}" alt="">
            <div class="carousel-inner">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-8 text-center">
                            <h1 class="display-3 text-white animated slideInDown mb-4">Jasa Profesional Tiling & Painting</h1>
                            <p class="fs-5 text-white mb-4 pb-2">Kami menyediakan layanan tiling & painting profesional untuk mempercantik ruangan Anda. Dengan tim ahli kami, hasil akhirnya memuaskan dan sesuai dengan ekspektasi.</p>
                            <a href="" class="btn btn-primary rounded-pill py-md-3 px-md-5 me-3 animated slideInLeft">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
            <!-- <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="img/carousel-3.jpg" alt="">
                <div class="carousel-inner">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-8 text-center">
                                <h1 class="display-3 text-white animated slideInDown mb-4">Innovative Solution For Security System</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea elitr.</p>
                                <a href="" class="btn btn-primary rounded-pill py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                <a href="" class="btn btn-light rounded-pill py-md-3 px-md-5 animated slideInRight">Free Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
    <!-- Carousel End -->


    <!-- Facts Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center project-unggulan wow fadeInUp" data-wow-delay="0.1s">
                <div class="mb-3 mx-auto" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                <h1 class="display-5 mb-5">Proyek Unggulan Kami</h1>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100 bg-dark p-4 p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="btn-square rounded-circle" style="width: 64px; height: 64px; background: #000000;">
                                <img class="img-fluid"  src="img/icon/building.png" alt="Icon">
                            </div>
                            <h1 class="display-1 mb-0" style="color: #000000;">01</h1>
                        </div>

                        <h5 class="text-white" style="font-size: 20px;">Pembangunan Gedung</h5>
                        <hr class="w-25">
                        
                        <span>Vero elitr justo clita lorem ipsum dolor at sed stet sit diam rebum ipsum et diam justo clita et</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="h-100 bg-dark p-4 p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="btn-square rounded-circle" style="width: 64px; height: 64px; background: #000000;">
                                <img class="img-fluid" src="{{ asset('img/icon/energy-development.png') }}" alt="Icon">
                            </div>
                            <h1 class="display-1 mb-0" style="color: #000000;">02</h1>
                        </div>
                        <h5 class="text-white" style="font-size: 20px;">Pembangunan Infrastruktur Energi</h5>
                        <hr class="w-25">
                        <span>Vero elitr justo clita lorem ipsum dolor at sed stet sit diam rebum ipsum et diam justo clita et</span>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100 bg-dark p-4 p-xl-5">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="btn-square rounded-circle" style="width: 64px; height: 64px; background: #000000;">
                                <img class="img-fluid" src="{{ asset('img/icon/oil-pump.png') }}" alt="Icon">
                            </div>
                            <h1 class="display-1 mb-0" style="color: #000000;">03</h1>
                        </div>
                        <h5 class="text-white" style="font-size: 20px;">Pembangunan Infrastruktur Perminyakan & Gas</h5>
                        <hr class="w-25">
                        <span>Vero elitr justo clita lorem ipsum dolor at sed stet sit diam rebum ipsum et diam justo clita et</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts Start -->


    <!-- About Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('img/kons21.jpg') }}" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="mb-3" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                        <h1 class="display-5 mb-4">Tentang Kami</h1>
                        <p class="mb-4 pb-2">PT Raja Perkasa adalah Perusahaan yang bergerak dibidang Industrial Supplier, General Contraktor dan Mekanikal. Telah mendapat kepercayaan yang tinggi dari Relasi dan Client perusahaan, terbukti telah berhasil dalam bekerja sama dan bermitra dengan Perusahaan Nasional seperti dengan PT.</p>
                        <div class="row g-4 mb-4 pb-3">
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="{{ asset('img/icon/happy-client.png') }}" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1" data-toggle="counter-up">20</h2>
                                        <p class="fw-medium text-orange mb-0">Happy Clients</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="{{ asset('img/icon/checkmark.png') }}" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1" data-toggle="counter-up">20</h2>
                                        <p class="fw-medium text-orange mb-0">Projects Done</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('tentang') }}" class="btn btn-primary rounded-pill py-3 px-5">Baca Selangkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Jasa Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center">
                <div class=" mb-3 mx-auto" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                <h1 class="display-5 mb-5">Jasa Kami</h1>
            </div>
            <div class="row g-0 service-row">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <div class="service-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="{{ asset('img/icon/project-management.png') }}" alt="Icon">
                        </div>
                        <h4 class="mb-3">Manajemen Proyek</h4>
                        <p class="mb-4">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem</p>
                        <a class="btn" href="{{ route('jasa') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="service-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="{{ asset('img/icon/graphic-design.png') }}" alt="Icon">
                        </div>
                        <h4 class="mb-3">Desain & Rekayasa</h4>
                        <p class="mb-4">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem</p>
                        <a class="btn" href="{{ route('jasa') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="service-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="{{ asset('img/icon/fix.png') }}" alt="Icon">
                        </div>
                        <h4 class="mb-3">Konstruksi Umum</h4>
                        <p class="mb-4">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem</p>
                        <a class="btn" href="{{ route('jasa') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="service-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="{{ asset('img/icon/labour-consulting.png') }}" alt="Icon">
                        </div>
                        <h4 class="mb-3">Konsultasi Proyek</h4>
                        <p class="mb-4">Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem</p>
                        <a class="btn" href="{{ route('jasa') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jasa End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class=" mb-3" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                        <h1 class="display-5 mb-5">Kenapa Harus Memilih Kami ?</h1>
                        <p class="mb-4 pb-2">Kami adalah pilihan terbaik untuk Anda yang menginginkan hasil terbaik dan layanan berkualitas tinggi. Kami berkomitmen untuk memberikan solusi terbaik untuk setiap kebutuhan konstruksi Anda.</p>
                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="{{ asset('img/icon/helmet.png') }}" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-orange mb-2">Keamanan Terpercaya</p>
                                        <h5 class="mb-0">Kami memberikan prioritas tertinggi pada keamanan proyek Anda.</h5>

                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="{{ asset('img/icon/quality.png') }}" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-orange mb-2">Layanan Berkualitas</p>
                                        <h5 class="mb-0">Kami menjamin layanan berkualitas tinggi untuk kebutuhan Anda.</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="{{ asset('img/icon/excavator.png') }}" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-orange mb-2">Sistem Teknologi</p>
                                        <h5 class="mb-0">Kami menggunakan teknologi terbaru untuk hasil yang lebih baik dan efisien.</h5>
                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="{{ asset('img/icon/customer-service.png') }}" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-orange mb-2">Dukungan 24/7</p>
                                        <h5 class="mb-0">Kami siap membantu Anda kapan pun Anda membutuhkan.</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/konsfix.jpg" style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Projects Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="mb-3 mx-auto" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                <h1 class="display-5 mb-5">Project Proyek Kami</h1>
            </div>
            <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-12 text-center">
                    <ul class="list-inline mb-5" id="portfolio-flters">
                        <li class="mx-2 active" data-filter="*">All</li>
                        <li class="mx-2" data-filter=".first">Complete Projects</li>
                        <li class="mx-2" data-filter=".second">Ongoing Projects</li>
                    </ul>
                </div>
            </div>
            <div class="row g-4 portfolio-container">
                <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner">
                        <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                        <div class="text-center p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-0">OVERHAUL TANKI 42-T-501 A</h5>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-3">OVERHAUL TANKI 42-T-501 A</h5>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar1.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar2.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar3.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar4.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner">
                        <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                        <div class="text-center p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-0">PATCHING BOTTOM TANK 42-T-107 C</h5>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-5">PATCHING BOTTOM TANK 42-T-107 C</h5>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar5.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar6.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar7.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar8.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner">
                        <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                        <div class="text-center p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-0">PENGGANTIAN COLUMN GRIDER DAN PENGECATAN INTERNATIONAL ROOF (BACK SIDE) 42-T-304 B
                            </h5>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-3">PENGGANTIAN COLUMN GRIDER DAN PENGECATAN INTERNATIONAL ROOF (BACK SIDE) 42-T-304 B
                            </h5>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar9.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar10.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar11.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar12.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner">
                        <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                        <div class="text-center p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-0">PENGGANTIAN PARTIAL ROOF & NOZZLE 24-T-102</h5>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-3">PENGGANTIAN PARTIAL ROOF & NOZZLE 24-T-102</h5>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar13.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar14.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner">
                        <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                        <div class="text-center p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-0">RECOATING TANGKI DEMIN WATER 55-T-101 A,B, & C DI PERTAMINA RU VI BALONGAN
                            </h5>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-3">RECOATING TANGKI DEMIN WATER 55-T-101 A,B, & C DI PERTAMINA RU VI BALONGAN
                            </h5>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar15.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar16.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar17.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner">
                        <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                        <div class="text-center p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-0">REPAINTING SPERICAL TANK D-2101 A/B DAN REPAINTING PIPING
                            </h5>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2">Proyek Konstruksi</p>
                            <h5 class="lh-base mb-3">REPAINTING SPERICAL TANK D-2101 A/B DAN REPAINTING PIPING
                            </h5>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar18.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar19.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar20.png" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/gambar21.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Projects End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class=" mb-3 mx-auto" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                <h1 class="display-5 mb-5">Pekerja Handal Kami</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="img/team-1.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Leornadi</h5>
                            <span class="text-orange">Engineer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Leornadi</h5>
                            <span class="text-orange">Engineer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="img/team-3.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Leornadi</h5>
                            <span class="text-orange">Engineer</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        <div class="overflow-hidden position-relative">
                            <img class="img-fluid" src="img/team-2.jpg" alt="">
                            <div class="team-social">
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square btn-dark rounded-circle m-1" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Leornadi</h5>
                            <span class="text-orange">Engineer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class="mb-3 mx-auto" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                <h1 class="display-5 mb-5">Apa Kata Client ?</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-1.jpg' alt=''>">
                    <p class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                    <h4>Riski Ahmad Ilham</h4>
                    <span class="text-orange">Manager PT Pertamina</span>
                </div>
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-2.jpg' alt=''>">
                    <p class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                    <h4>Saeful Rahman</h4>
                    <span class="text-orange">CEO PT Elnusa</span>
                </div>
                <div class="testimonial-item text-center" data-dot="<img class='img-fluid' src='img/testimonial-3.jpg' alt=''>">
                    <p class="fs-5">Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea clita.</p>
                    <h4>Samsul Rahman</h4>
                    <span class="text-orange">CEO PT IndoPelita</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <!-- Mitra Kerja Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <div class=" mb-3 mx-auto" style="width: 100px; height: 2px; background-color: #FE7A36;"></div>
                <h1 class="display-5 mb-5" style="margin-bottom: 70px;">Mitra Kerja</h1>
            </div>
            <div class="image-mitra" style="margin-bottom: 50px;">
                <img src="img/Picture1.png" alt="">
                <img style="margin-left: 50px;" src="img/Picture2.png" alt="">
                <img style="margin-left: 50px;" src="img/Picture3.png" alt="">
                <img style="margin-left: 50px;" src="img/Picture4.png" alt="">
            </div>
            <div class="image-mitra" style="margin-bottom: 50px;">
                <img src="img/Picture9.png" alt="">
                <img style="margin-left: 170px;" src="img/Picture5.png" alt="">
                <img style="margin-left: 120px;" src="img/Picture6.png" alt="">
                <img style="margin-left: 100px; width: 315px;" src="img/Picture7.png" alt="">
            </div>
            <div class="image-mitra">
                <img src="img/Picture8.png" alt="">
                <img style="margin-left: 150px; width: 300px;" src="img/Picture10.png" alt="">
                <img style="margin-left: 130px;" src="img/Picture11.png" alt="">
            </div>
        </div>
    </div>
    <!-- Mitra Kerja End -->

@endsection