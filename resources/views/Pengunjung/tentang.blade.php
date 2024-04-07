@extends('Pengunjung.Components.app')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Tentang</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Tentang</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 ps-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="img/kons21.jpg" style="object-fit: cover;" alt="">
                    </div>
                </div>
                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">
                        <div class="mb-3" style="width: 60px; height: 2px; background-color: #FE7A36;"></div>
                        <h1 class="display-6 mb-4">Tentang Kami</h1>
                        <p class="mb-4 pb-2" style="text-align: justify;">PT Raja Perkasa adalah Perusahaan yang bergerak dibidang Industrial Supplier, General Contraktor dan Mekanikal. Telah mendapat kepercayaan yang tinggi dari Relasi dan Client perusahaan, terbukti telah berhasil dalam bekerja sama dan bermitra dengan Perusahaan Nasional seperti dengan PT. Kilang Pertamina Internasional RU VI Balongan khususnya dalam menangani Proyek-proyek dan pengadaan barang serta jasa di PT. Kilang Pertamina Internasional RU VI Balongan Perusahaan kami berdiri dengan motto “ Memberikan Kepuasan Kepada Relasi dan Client“ sebagai acuan dalam bekerja sehingga kami mendapat kepercayaan penuh dalam mengembangkan bisnis konstruksi dan supplier. Oleh karena kepercayaan yang telah diberikan oleh para Relasi dan Client  kami dan atas dasar itu pula kami terus mengembangkan Sumber Daya Manusia agar dapat menjalankan tugas dan pekerjaannya dengan baik dan trampil. Keterampilan dan Keuletan para Staf dan karyawan tetap maupun karyawan tidak tetap dapat menghasilkan pola management yang lebih efektif dan ekonomis. Para tenaga ahli kami akan terus mengembangkan metode metode mutahir agar tetap mengikuti perkembangan teknologi yang terus berjalan seperti arus deras menghantam waktu dan kesempatan. “suatu kehormatan besar apabila para Relasi dan Client kami yang baru dapat kiranya mengikut sertakan kami dalam menerima segala bentuk kepercayaan untuk kerja sama, sehingga dapat dibuktikan kinerja PT. RAJA PERKASA.”
                        </p>

                        <div class="row g-4 mb-4 pb-3">

                           

                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="img/icon/happy-client.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1" data-toggle="counter-up">20</h2>
                                        <p class="fw-medium text-orange mb-0">Happy Clients</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 portfolio-item second wow fadeInUp" data-wow-delay="0.5s">
                                <div class="portfolio-inner">
                                    <img class="img-fluid w-100" src="img/sertif1.png" alt="">
                                    <div class="text-center p-4">
                                        <p class="text-orange mb-2">Sertifikat Penghargaan PT Raja Perkasa</p>
                                        <h5 class="lh-base mb-0">Perusahaan Jasa Konstruksi</h5>
                                    </div>
                                    <div class="portfolio-text text-center bg-white p-4">
                                        <p class="text-orange mb-2">Sertifikat Penghargaan PT Raja Perkasa</p>
                                        <h5 class="lh-base mb-3">Perusahaan Jasa Konstruksi</h5>
                                        <div class="d-flex justify-content-center">
                                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/sertif1.png"  data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/sertif2.png"  data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-square btn-primary rounded-circle mx-1" href="img/sertif3.png"  data-lightbox="portfolio"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                                <div class="d-flex align-items-center">
                                    <div class="btn-square bg-white rounded-circle" style="width: 64px; height: 64px;">
                                        <img class="img-fluid" src="img/icon/checkmark.png" alt="Icon">
                                    </div>
                                    <div class="ms-4">
                                        <h2 class="mb-1" data-toggle="counter-up">20</h2>
                                        <p class="fw-medium text-orange mb-0">Projects Done</p>
                                    </div>
                                </div>
                            </div>

                            <p class="mb-0 pb-2" style="text-align: justify;">PT Raja Perkasa memiliki anak perusahaan yang berdedikasi untuk memberikan layanan terbaik kepada Anda. Mereka siap bekerja sama dan berkomunikasi secara efektif untuk memastikan kepuasan klien. Anak perusahaan kami antara lain:
                                <ul class="" style="text-align: justify; margin-left:20px;">
                                    <li>PT BINTANG MAS BERSAMA</li>
                                    <li>PT. RATIKA FEBRIAN ABADI</li>
                                    <li>PT. TAHTA JAYA ABADI</li>
                                </ul>
                            
                            </p>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection