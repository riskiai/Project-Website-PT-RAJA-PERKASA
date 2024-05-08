@extends('Pengunjung.Components.app')


@section('content')
@php
$profileCompleted = true;
@endphp

@if ($profileCompleted)
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-profile">Form Pengajuan Kerjasama Kepada PT Raja Perkasa</h4>
                </div>
                <div class="card-body">
                    <form>
                        <label for="" class="form-label text-dark"><b>SUBJECT : INFO UMUM dan LEGALITAS</b></label>
                        <div class="mb-3">
                            <label for="nik" class="form-label text-dark">01. Situs Web Perusahaan</label>
                            <input type="text" class="form-control" id="nik" placeholder="">
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label text-dark">02. Email Perusahaan</label>
                            <input type="text" class="form-control" id="nik" placeholder="">
                        </div>
                        <div>
                            <label for="" class="form-label text-dark">03. Data Kontak Sales/Marketing</label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Lengkap</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No HP (mobile)</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Email</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. Jabatan</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark">04. Data Kontak Manajer</label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Lengkap</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No HP (mobile)</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Email</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. Jabatan</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark">05. Data Kontak Direktur Utama</label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Lengkap</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No HP (mobile)</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Email</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark">06. Kepemilikan Saham</label>
                            <div class="mb-3">
                                <p class="form-label text-dark">Presentase Kepemilikan Saham perusahaan di Akta terbaru (tuliskan nama pemilik dan % kepemilikan saham)</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark">07. Data Bank</label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Pemilik Rekening</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No Rekening</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Nama Bank</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. Kantor Cabang</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">5. Alamat Bank</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ktp" class="form-label text-dark">08. Legalitas</label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Akta Pendirian dan Perubahan Terakhir (tuliskan no Akta Pendirian)</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <input class="form-control" type="file" id="ktp">
                            <div class="mb-3">
                                <p class="form-label text-dark">2. SIUP (Surat Izin Usaha Perdagangan) (tuliskan no SIUP)</p>
                                <input type="text" class="form-control mb-3" id="nik" placeholder="">
                            </div>
                            <input class="form-control" type="file" id="ktp">
                            <div class="mb-3">
                                <p class="form-label text-dark">3. SIUP (Surat Izin Usaha Perdagangan) (tuliskan tanggal berakhir masa berlalu SIUP)</p>
                                <input type="date" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. TDP (Tanda Daftar Perusahaan)Company Registrasion (tuliskan no TDP)</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <input class="form-control" type="file" id="ktp">
                            <div class="mb-3">
                                <p class="form-label text-dark">5. TDP (Tanda Daftar Perusahaan) (tuliskan tanggal berakhir masa berlaku TDP)</p>
                                <input type="date" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">6. SKDP (Surat Keterangan Domisli Perusahaan) atau SITU (Surat Izin Tempat Usaha) (tuliskan no SKDP atau SITU)</p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <input class="form-control" type="file" id="ktp">
                            <div class="mb-3">
                                <p class="form-label text-dark">7. SKDP (Surat Keterangan Domisli Perusahaan) atau SITU (Surat Izin Tempat Usaha) (tuliskan tanggal berakhir masa berlaku SKDP atau SITU)</p>
                                <input type="date" class="form-control" id="nik" placeholder="">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">8. Surat Ijin Usaha (IUJK Konstruksi/Perencana, IUJPT, Surat Penunjukan PJIT, Surat Ijin Badan Usaha Jasa Pengamanan, dan lain-lain) </p>
                                <input type="text" class="form-control" id="nik" placeholder="">
                            </div>
                            <input class="form-control" type="file" id="ktp">
                            <p class="form-label text-dark">Revision Notes: Mohon agar menambahkan SIUJK (dokumen yang diberikan hanya SBU Konstruksi)</p>
                            <div class="mb-3">
                                <p class="form-label text-dark">9. Tuliskan tanggal berakhir masa berlaku Surat Ijin Usaha (IUJK Konstruksi/Perencana, IUJPT, Surat Penunjukan PJIT, Surat Ijin Badan Usaha Jasa Pengamanan, dan lain-lain)</p>
                                <input type="date" class="form-control" id="nik" placeholder="">
                            </div>
                        </div> 
                        <div class="mb-3">
                            <label for="ktp" class="form-label text-dark">09. Profil Perusahaan</label>
                            <p class="form-label">(Lampirkan Profile Perusahaan)</p>
                            <div class="mb-3">
                                <input class="form-control" type="file" id="ktp">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="ktp" class="form-label text-dark">10. Surat Pernyataan Kebeneran Dokumen & Informasi</label>
                            <p class="form-label">(Silahkan lampirkan surat pernyataan yang telah dilengkapi dan ditandatangani)</p>
                            <div class="mb-3">
                                <input class="form-control" type="file" id="ktp">
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="form-label">*Pastikan file pengajuan kerja sama mitra dapat di isi dengan benar sesuai dengan informasi di form pengajuan kerja sama dengan PT Raja Perkasa !</p>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Formulir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection