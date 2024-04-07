@extends('Pengunjung.Components.app')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Jasa</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Jasa</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Service Start -->
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
                            <img class="img-fluid" src="img/icon/project-management.png" alt="Icon">
                        </div>
                        <h4 class="mb-3">Manajemen Proyek</h4>
                        <p class="mb-4" style="text-align: justify;">
                            PT Raja Perkasa menyediakan layanan manajemen proyek komprehensif untuk mengelola dan mengkoordinasikan setiap tahap proyek konstruksi Anda. Tim kami, dengan pengalaman dan keahlian yang luas, memastikan proyek Anda berjalan lancar, tepat waktu, dan sesuai anggaran. Dari perencanaan hingga pelaksanaan, kami membantu Anda mencapai kesuksesan dalam setiap proyek konstruksi.
                        </p>
                        
                        
                        {{-- <a class="btn" href=""><i class="fa fa-arrow-right text-white me-3"></i>Read More</a> --}}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <div class="service-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="img/icon/graphic-design.png" alt="Icon">
                        </div>
                        <h4 class="mb-3">Desain & Rekayasa</h4>
                        <p class="mb-4" style="text-align: justify;">PT Raja Perkasa menawarkan layanan desain dan rekayasa yang inovatif untuk memenuhi kebutuhan proyek konstruksi Anda. Dengan tim ahli yang berpengalaman, kami menyediakan solusi terbaik dalam desain arsitektur, rekayasa struktural, dan sipil. Kami berkomitmen untuk memberikan hasil terbaik yang sesuai dengan harapan Anda, menjadikan setiap proyek konstruksi menjadi sebuah karya yang membanggakan.</p>
                        
                        {{-- <a class="btn" href=""><i class="fa fa-arrow-right text-white me-3"></i>Read More</a> --}}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <div class="service-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="img/icon/fix.png" alt="Icon">
                        </div>
                        <h4 class="mb-3">Konstruksi Umum</h4>
                        <p class="mb-4" style="text-align: justify;">PT Raja Perkasa adalah mitra terpercaya dalam layanan konstruksi umum. Kami menyediakan solusi terbaik untuk berbagai proyek, dari bangunan komersial hingga infrastruktur publik. Dengan pengalaman dan komitmen untuk keunggulan, kami memastikan setiap proyek diselesaikan dengan kualitas, waktu, dan anggaran terbaik. Percayakan proyek Anda kepada kami untuk hasil yang memuaskan.</p>                        
                        {{-- <a class="btn" href=""><i class="fa fa-arrow-right text-white me-3"></i>Read More</a> --}}
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <div class="service-item border h-100 p-5">
                        <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                            <img class="img-fluid" src="img/icon/labour-consulting.png" alt="Icon">
                        </div>
                        <h4 class="mb-3">Konsultasi Proyek</h4>
                        <p class="mb-4" style="text-align: justify;">PT Raja Perkasa menyediakan layanan konsultasi proyek profesional dan terpercaya. Tim ahli kami membantu Anda merencanakan, mengembangkan, dan mengelola proyek konstruksi dengan baik. Dengan pengalaman luas dan pengetahuan mendalam dalam industri, kami hadir untuk memberikan solusi terbaik untuk setiap tantangan proyek Anda, Percayakan proyek Anda kepada kami.</p>                        
                        {{-- <a class="btn" href=""><i class="fa fa-arrow-right text-white me-3"></i>Read More</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

@endsection