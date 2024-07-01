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
                @foreach($data as $proyek)
                    <div class="col-lg-4 col-md-6 portfolio-item {{ $proyek->status_progres_proyek == 'selesai' ? 'first' : 'second' }} wow fadeInUp" data-wow-delay="0.1s">
                        <div class="portfolio-inner">
                            {{-- @if(is_array($proyek->image) && count($proyek->image) > 0)
                                <img class="img-fluid w-100" src="{{ Storage::url($proyek->image[0]) }}" alt="">
                            @else
                                
                            @endif --}}
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

@endsection
