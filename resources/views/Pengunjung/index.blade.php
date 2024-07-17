@extends('Pengunjung.Components.app')

@section('style')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
    .testimonial-container {
    position: relative;
    text-align: center; /* Memusatkan teks secara horizontal */
    width: 100%; /* Mengatur lebar container sesuai kebutuhan */
    max-width: 600px; /* Tentukan lebar maksimum untuk container */
    margin: 0 auto; /* Pusatkan container di halaman */
    overflow: hidden;
   
}
    
    .testimonial-item-wrapper {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }
    
    .testimonial-item {
        min-width: 100%;
        max-width: 600px; /* Tentukan lebar maksimum untuk testimoni */
        margin: 0 auto; /* Pusatkan elemen testimoni */
        box-sizing: border-box;
        padding: 20px; /* Tambahkan padding untuk spasi internal */
        background-color: #fff; /* Latar belakang testimoni */
        border-radius: 10px; /* Opsional: Tambahkan border-radius untuk tampilan lebih halus */
    }
    
    .testimonial-navigation {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
    }
    
    .testimonial-navigation button {
        background-color: #FE7A36;
        border: none;
        padding: 10px 20px;
        color: white;
        cursor: pointer;
        font-size: 18px;
    }
    
    .testimonial-navigation button:focus {
        outline: none;
    }
    
    </style>

@endsection

@section('content')

<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5">
    <div class="owl-carousel header-carousel position-relative">
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="{{ asset('img/kosn.jpg') }}" alt="">
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
                            <img class="img-fluid" src="img/icon/building.png" alt="Icon">
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
<!-- Facts End -->

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
                    <a href="{{ route('tentangpengunjung') }}" class="btn btn-primary rounded-pill py-3 px-5">Baca Selengkapnya</a>
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
            @foreach($data as $proyek)
                <div class="col-lg-4 col-md-6 portfolio-item {{ $proyek->status_progres_proyek == 'selesai' ? 'first' : 'second' }} wow fadeInUp" data-wow-delay="0.1s">
                    <div class="portfolio-inner">
                        <img class="img-fluid w-100" src="img/service-1.jpg" alt="">
                        <div class="text-center p-4">
                            <p class="text-orange mb-2">{{ $proyek->title_proyek }}</p>
                            <h5 class="lh-base mb-0">{{ $proyek->project_name }}</h5>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2">{{ $proyek->title_proyek }}</p>
                            <h5 class="lh-base mb-3">{{ $proyek->project_name }}</h5>
                            <div class="d-flex justify-content-center">
                                @if(is_array($proyek->image))
                                    @foreach($proyek->image as $img)
                                        <a class="btn btn-square btn-primary rounded-circle mx-1" href="{{ Storage::url($img) }}" data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Projects End -->

<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="mb-3 mx-auto" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
            <h1 class="display-5 mb-5">Apa Kata Client ?</h1>
        </div>
        <div class="testimonial-container">
            <div class="testimonial-item-wrapper">
                @foreach ($testimonis as $testimoni)
                    <div class="testimonial-item text-center bg-light p-4">
                        @if($testimoni->image)
                            <img class="img-fluid rounded-circle mb-3" src="{{ asset('storage/photo-testimoni/' . $testimoni->image) }}" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                        @endif
                        <p class="fs-5 mb-3">{!! $testimoni->comment !!}</p>
                        <h4>{{ $testimoni->user ? $testimoni->user->name : $testimoni->new_user_name }}</h4>
                        <span class="text-orange">{{ $testimoni->position }}</span>
                    </div>
                @endforeach
            </div>
            <div class="testimonial-navigation">
                <button class="prev">❮</button>
                <button class="next">❯</button>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<!-- Mitra Kerja Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <div class="mb-3 mx-auto" style="width: 100px; height: 2px; background-color: #FE7A36;"></div>
            <h1 class="display-5 mb-5" style="margin-bottom: 70px;">Mitra Kerja</h1>
        </div>
        @if ($mitras->isNotEmpty())
            @foreach ($mitras->chunk(4) as $chunk)
                <div class="image-mitra" style="margin-bottom: 50px;">
                    @foreach ($chunk as $mitra)
                        @php
                            $images = !empty($mitra->image) ? explode(',', $mitra->image) : ['default.png'];
                        @endphp
                        @foreach($images as $image)
                            <img src="{{ asset($image == 'default.png' ? 'img/' . $image : 'storage/photo-mitra/' . $image) }}" alt="" style="max-width: 390px; max-height: 300px; margin-bottom: 10px; gap:20px !important;">
                        @endforeach
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</div>
<!-- Mitra Kerja End -->

@endsection

@section('script')
<script>
$(document).ready(function(){
    $(".header-carousel").owlCarousel({
        singleItem: true,
        autoPlay: 5000,
        navigation: true,
        pagination: true,
        transitionStyle: "fade"
    });

    let currentIndex = 0;
    const items = document.querySelectorAll('.testimonial-item');
    const totalItems = items.length;

    document.querySelector('.next').addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % totalItems;
        updateTestimonial();
    });

    document.querySelector('.prev').addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        updateTestimonial();
    });

    function updateTestimonial() {
        const offset = -currentIndex * 100;
        document.querySelector('.testimonial-item-wrapper').style.transform = `translateX(${offset}%)`;
    }

    $("#portfolio-flters li").on('click', function () {
        $("#portfolio-flters li").removeClass('active');
        $(this).addClass('active');
        var filterValue = $(this).attr('data-filter');
        $(".portfolio-container").isotope({
            filter: filterValue
        });
    });

    var $grid = $('.portfolio-container').isotope({
        itemSelector: '.portfolio-item',
        layoutMode: 'fitRows'
    });

    $grid.imagesLoaded().progress(function() {
        $grid.isotope('layout');
    });
});
</script>
@endsection
