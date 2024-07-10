@extends('Pengunjung.Components.app')

@section('content')
@php
$user = Auth::user();
$profileCompleted = $user->file_foto !== null;
@endphp

@if ($profileCompleted)
<div class="container mt-5">
    @include('Client.components.navbarclient')
    <div class="row mt-3">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 style="text-profile">Form Pengajuan Kerjasama Mitra Kepada PT Raja Perkasa</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if ($dataKerjasama)
                        <form action="{{ route('updatekerjasama', $dataKerjasama->id) }}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                    @else
                        <form action="{{ route('submitkerjasama') }}" method="POST" enctype="multipart/form-data">
                    @endif
                        @csrf
                        <label for="" class="form-label text-dark"><b>SUBJECT : INFO UMUM dan LEGALITAS</b></label>
                        <div class="mb-3">
                            <label for="situs_web" class="form-label text-dark"><strong>01. Situs Web Perusahaan</strong></label>
                            <input type="text" class="form-control" id="situs_web" name="situs_web" placeholder="" value="{{ old('situs_web', $dataKerjasama->situs_web ?? '') }}">
                        </div>
                        <div class="mb-3">
                            <label for="email_perusahaan" class="form-label text-dark"><strong>02. Email Perusahaan</strong></label>
                            <input type="text" class="form-control" id="email_perusahaan" name="email_perusahaan" placeholder="" value="{{ old('email_perusahaan', $dataKerjasama->email_perusahaan ?? '') }}">
                        </div>
                        <div>
                            <label for="" class="form-label text-dark"><strong>03. Data Kontak Sales/Marketing</strong></label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Lengkap</p>
                                <input type="text" class="form-control" id="sales_nama_lengkap" name="sales_nama_lengkap" placeholder="" value="{{ old('sales_nama_lengkap', $dataKerjasama->dataSales->name_lengkap ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No HP (mobile)</p>
                                <input type="text" class="form-control" id="sales_no_hp" name="sales_no_hp" placeholder="" value="{{ old('sales_no_hp', $dataKerjasama->dataSales->no_hp ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Email</p>
                                <input type="text" class="form-control" id="sales_email" name="sales_email" placeholder="" value="{{ old('sales_email', $dataKerjasama->dataSales->email ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. Jabatan</p>
                                <input type="text" class="form-control" id="sales_jabatan" name="sales_jabatan" placeholder="" value="{{ old('sales_jabatan', $dataKerjasama->dataSales->jabatan ?? '') }}">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark"><strong>04. Data Kontak Manajer</strong></label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Lengkap</p>
                                <input type="text" class="form-control" id="manajer_nama_lengkap" name="manajer_nama_lengkap" placeholder="" value="{{ old('manajer_nama_lengkap', $dataKerjasama->dataManajer->nama_lengkap ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No HP (mobile)</p>
                                <input type="text" class="form-control" id="manajer_no_hp" name="manajer_no_hp" placeholder="" value="{{ old('manajer_no_hp', $dataKerjasama->dataManajer->no_hp ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Email</p>
                                <input type="text" class="form-control" id="manajer_email" name="manajer_email" placeholder="" value="{{ old('manajer_email', $dataKerjasama->dataManajer->email ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. Jabatan</p>
                                <input type="text" class="form-control" id="manajer_jabatan" name="manajer_jabatan" placeholder="" value="{{ old('manajer_jabatan', $dataKerjasama->dataManajer->jabatan ?? '') }}">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark"><strong>05. Data Kontak Direktur Utama</strong></label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Lengkap</p>
                                <input type="text" class="form-control" id="direktur_nama_lengkap" name="direktur_nama_lengkap" placeholder="" value="{{ old('direktur_nama_lengkap', $dataKerjasama->dataDirektur->nama_lengkap ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No HP (mobile)</p>
                                <input type="text" class="form-control" id="direktur_no_hp" name="direktur_no_hp" placeholder="" value="{{ old('direktur_no_hp', $dataKerjasama->dataDirektur->no_hp ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Email</p>
                                <input type="text" class="form-control" id="direktur_email" name="direktur_email" placeholder="" value="{{ old('direktur_email', $dataKerjasama->dataDirektur->email ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. Jabatan</p>
                                <input type="text" class="form-control" id="direktur_jabatan" name="direktur_jabatan" placeholder="" value="{{ old('direktur_jabatan', $dataKerjasama->dataDirektur->jabatan ?? '') }}">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark"><strong>06. Kepemilikan Saham</strong></label>
                            <div class="mb-3">
                                <p class="form-label text-dark">Presentase Kepemilikan Saham perusahaan di Akta terbaru (tuliskan nama pemilik dan % kepemilikan saham)</p>
                                <input type="text" class="form-control" id="pemilik_saham" name="pemilik_saham" placeholder="" value="{{ old('pemilik_saham', $dataKerjasama->data_kepemilikan_saham ?? '') }}">
                            </div>
                        </div>
                        <div>
                            <label for="" class="form-label text-dark"><strong>07. Data Bank</strong></label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Nama Pemilik Rekening</p>
                                <input type="text" class="form-control" id="bank_nama_pemilik" name="bank_nama_pemilik" placeholder="" value="{{ old('bank_nama_pemilik', $dataKerjasama->dataBank->nama_pemilik_rekening ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">2. No Rekening</p>
                                <input type="text" class="form-control" id="bank_no_rekening" name="bank_no_rekening" placeholder="" value="{{ old('bank_no_rekening', $dataKerjasama->dataBank->no_rekening ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">3. Nama Bank</p>
                                <input type="text" class="form-control" id="bank_nama_bank" name="bank_nama_bank" placeholder="" value="{{ old('bank_nama_bank', $dataKerjasama->dataBank->nama_bank ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. Kantor Cabang</p>
                                <input type="text" class="form-control" id="bank_cabang_bank" name="bank_cabang_bank" placeholder="" value="{{ old('bank_cabang_bank', $dataKerjasama->dataBank->cabang_bank ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">5. Alamat Bank</p>
                                <input type="text" class="form-control" id="bank_alamat_bank" name="bank_alamat_bank" placeholder="" value="{{ old('bank_alamat_bank', $dataKerjasama->dataBank->alamat_bank ?? '') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="legalitas_no_akta" class="form-label text-dark"><strong>08. Legalitas</strong></label>
                            <div class="mb-3">
                                <p class="form-label text-dark">1. Akta Pendirian dan Perubahan Terakhir (tuliskan no Akta Pendirian)</p>
                                <input type="text" class="form-control" id="legalitas_no_akta" name="legalitas_no_akta" placeholder="" value="{{ old('legalitas_no_akta', $dataKerjasama->dataLegalitas->no_akta ?? '') }}">
                            </div>
                            <input class="form-control" type="file" id="legalitas_file_akta" name="legalitas_file_akta">
                            <div class="mb-3">
                                <p class="form-label text-dark">2. SIUP (Surat Izin Usaha Perdagangan) (tuliskan no SIUP)</p>
                                <input type="text" class="form-control mb-3" id="legalitas_no_siup" name="legalitas_no_siup" placeholder="" value="{{ old('legalitas_no_siup', $dataKerjasama->dataLegalitas->no_siup ?? '') }}">
                            </div>
                            <input class="form-control" type="file" id="legalitas_file_siup" name="legalitas_file_siup">
                            <div class="mb-3">
                                <p class="form-label text-dark">3. SIUP (Surat Izin Usaha Perdagangan) (tuliskan tanggal berakhir masa berlalu SIUP)</p>
                                <input type="date" class="form-control" id="legalitas_date_end_siup" name="legalitas_date_end_siup" placeholder="" value="{{ old('legalitas_date_end_siup', $dataKerjasama->dataLegalitas->date_end_siup ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">4. TDP (Tanda Daftar Perusahaan)Company Registrasion (tuliskan no TDP)</p>
                                <input type="text" class="form-control" id="legalitas_no_tdp" name="legalitas_no_tdp" placeholder="" value="{{ old('legalitas_no_tdp', $dataKerjasama->dataLegalitas->no_tdp ?? '') }}">
                            </div>
                            <input class="form-control" type="file" id="legalitas_file_tdp" name="legalitas_file_tdp">
                            <div class="mb-3">
                                <p class="form-label text-dark">5. TDP (Tanda Daftar Perusahaan) (tuliskan tanggal berakhir masa berlaku TDP)</p>
                                <input type="date" class="form-control" id="legalitas_date_end_tdp" name="legalitas_date_end_tdp" placeholder="" value="{{ old('legalitas_date_end_tdp', $dataKerjasama->dataLegalitas->date_end_tdp ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">6. SKDP (Surat Keterangan Domisli Perusahaan) atau SITU (Surat Izin Tempat Usaha) (tuliskan no SKDP atau SITU)</p>
                                <input type="text" class="form-control" id="legalitas_no_skdp" name="legalitas_no_skdp" placeholder="" value="{{ old('legalitas_no_skdp', $dataKerjasama->dataLegalitas->no_skdp ?? '') }}">
                            </div>
                            <input class="form-control" type="file" id="legalitas_file_skdp" name="legalitas_file_skdp">
                            <div class="mb-3">
                                <p class="form-label text-dark">7. SKDP (Surat Keterangan Domisli Perusahaan) atau SITU (Surat Izin Tempat Usaha) (tuliskan tanggal berakhir masa berlaku SKDP atau SITU)</p>
                                <input type="date" class="form-control" id="legalitas_date_end_skdp" name="legalitas_date_end_skdp" placeholder="" value="{{ old('legalitas_date_end_skdp', $dataKerjasama->dataLegalitas->date_end_skdp ?? '') }}">
                            </div>
                            <div class="mb-3">
                                <p class="form-label text-dark">8. Surat Ijin Usaha (IUJK Konstruksi/Perencana, IUJPT, Surat Penunjukan PJIT, Surat Ijin Badan Usaha Jasa Pengamanan, dan lain-lain)</p>
                                <input type="text" class="form-control" id="legalitas_no_iujk" name="legalitas_no_iujk" placeholder="" value="{{ old('legalitas_no_iujk', $dataKerjasama->dataLegalitas->no_iujk ?? '') }}">
                            </div>
                            <input class="form-control" type="file" id="legalitas_file_iujk" name="legalitas_file_iujk">
                            <div class="mb-3">
                                <p class="form-label text-dark">9. Tuliskan tanggal berakhir masa berlaku Surat Ijin Usaha (IUJK Konstruksi/Perencana, IUJPT, Surat Penunjukan PJIT, Surat Ijin Badan Usaha Jasa Pengamanan, dan lain-lain)</p>
                                <input type="date" class="form-control" id="legalitas_date_end_iujk" name="legalitas_date_end_iujk" placeholder="" value="{{ old('legalitas_date_end_iujk', $dataKerjasama->dataLegalitas->date_end_iujk ?? '') }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="legalitas_file_profile_perusahaan" class="form-label text-dark"><strong>09. Profil Perusahaan</strong></label>
                            <p class="form-label">(Lampirkan Profile Perusahaan)</p>
                            <div class="mb-3">
                                <input class="form-control" type="file" id="legalitas_file_profile_perusahaan" name="legalitas_file_profile_perusahaan">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="legalitas_file_dokumen_kebenaran" class="form-label text-dark"><strong>10. Surat Pernyataan Kebeneran Dokumen & Informasi</strong></label>
                            <p class="form-label">(Silahkan lampirkan surat pernyataan yang telah dilengkapi dan ditandatangani)</p>
                            <div class="mb-3">
                                <input class="form-control" type="file" id="legalitas_file_dokumen_kebenaran" name="legalitas_file_dokumen_kebenaran">
                            </div>
                        </div>
                        <div class="mb-3">
                            <p class="form-label">*Pastikan file pengajuan kerja sama mitra dapat di isi dengan benar sesuai dengan informasi di form pengajuan kerja sama dengan PT Raja Perkasa !</p>
                        </div>
                        <button type="submit" class="btn btn-primary">{{ $dataKerjasama ? 'Update Formulir' : 'Kirim Formulir' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-5">
    <div class="alert alert-warning">
        Lengkapi profil Anda terlebih dahulu untuk mengajukan kerjasama mitra. <a href="{{ route('profileclient') }}">Lengkapi Profil</a>
    </div>
</div>
@endif
@endsection
