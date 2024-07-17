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
            color: grey;
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
                    <li class="breadcrumb-item"><a class="text-white" href="#">Pages</li>
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
                        <p class="mb-4" style="color: grey;">Hubungi kami untuk informasi lebih lanjut tentang layanan kami. Kami siap membantu Anda!</p>
                        <ul class="list-unstyled">
                            <button class="btn btn-one">Email</button>
                            <li class="mb-4 text-one"><u>{{ $kontak->email }}</u></li>
                            <button class="btn btn-one">Telefon</button>
                            <li class="mb-4"><u>{{ $kontak->phone }}</u></li>
                            <button class="btn btn-one">Alamat</button>
                            <li class="mb-4 text-one"><u>{{ $kontak->alamat }}</u></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <iframe class="position-absolute w-100 h-100" style="object-fit: cover;"
                        src="{{ $kontak->links }}" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

@endsection
