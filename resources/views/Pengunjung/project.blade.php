@extends('Pengunjung.Components.app')

@section('content')

     <!-- Page Header Start -->
     <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Project Proyek</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Projects</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


 <!-- Projects Start -->
 <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="mb-3 mx-auto" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
            <h1 class="display-5 mb-5">Project Proyek Kami</h1>
        </div>
        <div class="row mt-n2 wow fadeInUp" data-wow-delay="0.3s">
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
            <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.3s">
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
            <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.5s">
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
            <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.3s">
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
            <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.5s">
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

@endsection