@extends('Pengunjung.Components.app')

@section('style')
<style>
    .modal-body .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.3rem 0; /* Sesuaikan padding sesuai kebutuhan */
    }
    .modal-body .detail-item strong {
        min-width: 120px;
    }
    .modal-body .detail-item span {
        padding-left: 5px; /* Kurangi padding sesuai kebutuhan */
    }

    .modal-dialog {
        max-width: 610px; /* Atur ukuran maksimum modal */
    }
</style>
@endsection

@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5">
    <div class="container py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Proyek</h1>
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
            <h1 class="display-5 mb-5">Portfolio Proyek Kami</h1>
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
                            <label for="" class="lh-base" style="font-size: 15px; color:#000000; font-weight:bold;">Nama Proyek :</label>
                            <h2 class="lh-base mb-3" style="font-size: 15px; !important">{{ $proyek->project_name }}</h2>
                            <label for="" class="lh-base text-orange"  style="font-size: 15px;  ">Bidang Pekerjaan Proyek : </label>
                            <p class="text-orange mb-2" style="font-size: 15px;">{{ $proyek->bidangproyeks->nama_bidang_pekerjaan_proyek ?? "Tidak Ada Data" }}</p>
                        </div>
                        <div class="portfolio-text text-center bg-white p-4">
                            <label for="" class="lh-base" style="font-size: 15px; color:#000000; font-weight:bold;">Nama Project Proyek :</label>
                            <h2 class="lh-base mb-3" style="font-size: 15px; !important">{{ $proyek->project_name }}</h2>
                            <label for="" class="lh-base text-orange"  style="font-size: 15px;  ">Bidang Pekerjaan Proyek : </label>
                            <p class="text-orange mb-2" style="font-size: 15px;">{{ $proyek->bidangproyeks->nama_bidang_pekerjaan_proyek ?? "Tidak Ada Data" }}</p>
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
                                <div class="detail-item"><strong>Bidang Pekerjaan Proyek:</strong> <span>{{ $proyek->bidangproyeks->nama_bidang_pekerjaan_proyek ?? "Tidak Ada Data" }}</span></div>
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

@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.getAttribute('data-id');
                $('#detailModal' + projectId).modal('show');
            });
        });
    });
</script>
@endsection
