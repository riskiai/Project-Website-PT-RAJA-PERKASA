@php
function breakText($text, $length = 40) {
    return wordwrap($text, $length, "\n", true);
}
@endphp

@extends('Pengunjung.Components.app')

@section('style')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<style>
/* Testimonial CSS */
.testimonial-container {
    position: relative;
    text-align: center; 
    width: 100%; 
    max-width: 800px;
    margin: 0 auto;
    overflow: hidden;
}

.testimonial-item-wrapper {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.testimonial-item {
    min-width: 100%;
    max-width: 600px; 
    margin: 0 auto;
    box-sizing: border-box;
    padding: 20px; 
    background-color: #fff;
    border-radius: 10px;
}

.testimonial-navigation {
    position: absolute;
    top: 52%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-38%) !important;
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

/* Media query for mobile devices */
@media (max-width: 768px) {
    .testimonial-item p {
        font-size: 13px !important; /* Adjust the font size as needed */
        word-break: break-word;
        white-space: pre-wrap;
    }

    .testimonial-item {
        padding: 10px !important; /* Adjust the padding if needed */
    }

    .testimonial-navigation button {
        background-color: #FE7A36;
        border: none;
        padding: 10px 20px;
        color: white;
        cursor: pointer;
        font-size: 14px;
    }

    .testimonial-item h4 {
        font-size: 16px !important; /* Adjust the name font size if needed */
    }

    .testimonial-item span {
        font-size: 14px !important; /* Adjust the position font size if needed */
    }
}

/* Project Detail Modal CSS */
.modal-body .detail-item {
    display: flex;
    justify-content: space-between;
    padding: 0.3rem 0; /* Adjust padding as needed */
}
.modal-body .detail-item strong {
    min-width: 120px;
}
.modal-body .detail-item span {
    padding-left: 5px; /* Adjust padding as needed */
}
.modal-dialog {
    max-width: 600px; /* Set maximum modal size */
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
                    <p class="mb-4">PT Raja Perkasa menyediakan layanan manajemen proyek komprehensif untuk mengelola dan mengkoordinasikan setiap tahap proyek konstruksi Anda.</p>
                    <a class="btn" href="{{ route('jasalink') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                <div class="service-item border h-100 p-5">
                    <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                        <img class="img-fluid" src="{{ asset('img/icon/graphic-design.png') }}" alt="Icon">
                    </div>
                    <h4 class="mb-3">Desain & Rekayasa</h4>
                    <p class="mb-4">PT Raja Perkasa menawarkan layanan desain dan rekayasa yang inovatif untuk memenuhi kebutuhan proyek konstruksi Anda.</p>
                    <a class="btn" href="{{ route('jasalink') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="service-item border h-100 p-5">
                    <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                        <img class="img-fluid" src="{{ asset('img/icon/fix.png') }}" alt="Icon">
                    </div>
                    <h4 class="mb-3">Konstruksi Umum</h4>
                    <p class="mb-4">PT Raja Perkasa adalah mitra terpercaya dalam layanan konstruksi umum. Kami menyediakan solusi terbaik untuk berbagai proyek, dari bangunan komersial hingga infrastruktur publik.</p>
                    <a class="btn" href="{{ route('jasalink') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                <div class="service-item border h-100 p-5">
                    <div class="btn-square bg-light rounded-circle mb-4" style="width: 64px; height: 64px;">
                        <img class="img-fluid" src="{{ asset('img/icon/labour-consulting.png') }}" alt="Icon">
                    </div>
                    <h4 class="mb-3">Konsultasi Proyek</h4>
                    <p class="mb-4">PT Raja Perkasa adalah mitra terpercaya dalam layanan konstruksi umum. Kami menyediakan solusi terbaik untuk berbagai proyek, dari bangunan komersial hingga infrastruktur publik.</p>
                    <a class="btn" href="{{ route('jasalink') }}"><i class="fa fa-arrow-right text-white me-3"></i>Baca Selengkapnya</a>
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
                        <div id="carousel{{ $proyek->id }}" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if(is_array($proyek->image) && count($proyek->image) > 0)
                                    @foreach($proyek->image as $index => $img)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <a href="{{ Storage::url($img) }}" data-lightbox="carousel-{{ $proyek->id }}">
                                                <img class="img-fluid" src="{{ Storage::url($img) }}" alt="Project Image">
                                            </a>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item active">
                                        <a href="img/default.jpg" data-lightbox="carousel-{{ $proyek->id }}">
                                            <img class="img-fluid" src="img/default.jpg" alt="Default Image">
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carousel{{ $proyek->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carousel{{ $proyek->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="text-center p-4">
                            <p class="text-orange mb-2" style="font-size: 15px;">{{ $proyek->title_proyek }}</p>
                            <h2 class="lh-base mb-3" style="font-size: 15px; !important">{{ $proyek->project_name }}</h2>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <p class="text-orange mb-2" style="font-size: 15px;">{{ $proyek->title_proyek }}</p>
                            <h2 class="lh-base mb-3" style="font-size: 15px; !important">{{ $proyek->project_name }}</h2>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary view-details" data-id="{{ $proyek->id }}" data-bs-toggle="modal" data-bs-target="#detailModal{{ $proyek->id }}">Detail Data Proyek</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="detailModal{{ $proyek->id }}" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel{{ $proyek->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $proyek->id }}">Detail Proyek</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="detail-item"><strong>Nama Proyek:</strong> <span>{{ $proyek->project_name }}</span></div>
                                <div class="detail-item"><strong>Nama Klien:</strong> <span>{{ $proyek->client_name }}</span></div>
                                <div class="detail-item"><strong>Kontraktor Utama:</strong> <span>{{ $proyek->main_contractor }}</span></div>
                                <div class="detail-item"><strong>Scope:</strong> <span>{{ $proyek->scope }}</span></div>
                                <div class="detail-item"><strong>Tanggal Mulai:</strong> <span>{{ $proyek->start_date_proyek }}</span></div>
                                <div class="detail-item"><strong>Tanggal Selesai:</strong> <span>{{ $proyek->end_date_proyek }}</span></div>
                                <div class="detail-item"><strong>Nilai Proyek:</strong> <span>{{ format_indo_currency($proyek->value) }}</span></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                        <p class="fs-2 mb-1 comments">{!! breakText($testimoni->comment) !!}</p>
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
                            <img src="{{ asset($image == 'default.png' ? 'img/' . $image : 'storage/photo-mitra/' . $image) }}" alt="" style="max-width: 420px; max-height: 420px; margin-bottom: 10px; gap:20px !important;">
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

document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function() {
            const projectId = this.getAttribute('data-id');
            console.log('Button clicked for project ID:', projectId); // Tambahkan ini
            $('#detailModal' + projectId).modal('show');
        });
    });

</script>
@endsection
