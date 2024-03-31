@extends('Pengunjung.Components.app')

@section('content')

     <!-- Page Header Start -->
     <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Project</h1>
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
            <h1 class="display-5 mb-5">Project Kami</h1>
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
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-0">Building Construction</h5>
                    </div>
                    <div class="portfolio-text text-center bg-white p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-3">Building Construction</h5>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/portfolio-1.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.3s">
                <div class="portfolio-inner">
                    <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                    <div class="text-center p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-0">Building Construction</h5>
                    </div>
                    <div class="portfolio-text text-center bg-white p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-3">Building Construction</h5>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/portfolio-2.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.5s">
                <div class="portfolio-inner">
                    <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                    <div class="text-center p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-0">Building Construction</h5>
                    </div>
                    <div class="portfolio-text text-center bg-white p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-3">Building Construction</h5>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/portfolio-3.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.1s">
                <div class="portfolio-inner">
                    <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                    <div class="text-center p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-0">Building Construction</h5>
                    </div>
                    <div class="portfolio-text text-center bg-white p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-3">Building Construction</h5>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/portfolio-4.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item first wow fadeInUp" data-wow-delay="0.3s">
                <div class="portfolio-inner">
                    <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                    <div class="text-center p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-0">Building Construction</h5>
                    </div>
                    <div class="portfolio-text text-center bg-white p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-3">Building Construction</h5>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/portfolio-5.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.5s">
                <div class="portfolio-inner">
                    <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                    <div class="text-center p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-0">Building Construction</h5>
                    </div>
                    <div class="portfolio-text text-center bg-white p-4">
                        <p class="text-orange mb-2">Business Konstruksi</p>
                        <h5 class="lh-base mb-3">Building Construction</h5>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/portfolio-6.jpg" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                            <a class="btn btn-square btn-primary rounded-circle mx-1" href=""><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Projects End -->

@endsection