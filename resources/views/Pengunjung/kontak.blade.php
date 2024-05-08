@extends('Pengunjung.Components.app')

@section('style')
    <style>
        .btn-one {
            background-color: orange;
            color: white;
            width: 200px;
            font-size: 20px;
            font-weight: bold;
            margin-left: 0px;
        }

        .text-one {
            margin-left: 0px;
        }

        u {
        display: inline-block; /* Mengubah tata letak menjadi inline-block */
        text-decoration: none; /* Menghapus garis bawah default */
        border-bottom: 2px solid grey; /* Menambahkan garis bawah dengan warna biru */
        margin-top: 2px; /* Mengatur jarak atas dari teks */
        }
    </style>

@endsection

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container py-5">
            <h1 class="display-3 text-white mb-3 animated slideInDown">Kontak</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">Kontak</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Contact Start -->
    <div class="container-fluid bg-light overflow-hidden px-lg-0">
        <div class="container contact px-lg-0 mt-5">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 contact-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 ps-lg-0">
                        <div class="section-title text-start">
                            <h1 class="display-5 mb-4">Kontak Kami</h1>
                        </div>
                        <p class="mb-4">Hubungi kami untuk informasi lebih lanjut tentang layanan kami. Kami siap membantu Anda!</p>
                        <ul class="list-unstyled">
                            <button class="btn btn-one">Email</button>
                            <li class="mb-4 text-one"><u>rajaperkasa@gmail.com</u></li>
                            <button class="btn btn-one">Telefon</button>
                            <li class="mb-4"><u>+012 345 67890</u></li>
                            <button class="btn btn-one">Alamat</button>
                            <li class="mb-4 text-one"><u> Sukareja, Balongan, Indramayu Regency</u></li>
                           
                        </ul>


                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <iframe class="position-absolute w-100 h-100" style="object-fit: cover;"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.0901098106788!2d108.3685317748305!3d-6.382369993608008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6ebf0e7d1625c3%3A0xb2cc20dee5352265!2sPT.%20RAJA%20PERKASA!5e0!3m2!1sen!2sid!4v1709087374749!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>"
                        frameborder="0" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection