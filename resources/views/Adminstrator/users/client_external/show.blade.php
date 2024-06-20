@extends('Adminstrator.Componentsadminstrator.app')

@section('content')
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Detail Data Client</h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Data Profil Client</h5>
                <form action="{{ route('updateStatusUser', $user->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama PIC (Penanggung Jawab)</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nomor Handphone</label>
                                <input type="text" class="form-control" value="{{ $user->no_hp }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" value="{{ $user->nik }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status User</label>
                                <div style="position: relative;">
                                    <select name="status_user" class="form-control">
                                        <option value="active" {{ $user->status_user === 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="nonactive" {{ $user->status_user === 'nonactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <i class="fas fa-caret-down" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); pointer-events: none;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Foto Profil</label>
                                @if($user->file_foto)
                                    <p><a href="{{ asset('storage/client/photo-profile/' . $user->file_foto) }}" target="_blank">Lihat Foto</a></p>
                                @else
                                    <p style="color: red; font-weight: bold;">Foto Profil tidak ditemukan</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>File KTP</label>
                                @if($user->file_ktp)
                                    <p><a href="{{ asset('storage/client/file_ktp/' . $user->file_ktp) }}" target="_blank">Lihat KTP</a></p>
                                @else
                                <p style="color: red; font-weight: bold;">File KTP tidak ditemukan</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <h5>Data Document Kerja Sama Mitra PT Raja Perkasa</h5>
                    @if ($dataKerjasama)
                    <div class="row">
                        <!-- Data Kerja Sama -->
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Status Kerja Sama</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->status_kerjasama }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Keterangan Status Kerja Sama</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->keterangan_status_kerjasama }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Kepemilikan Saham</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->data_kepemilikan_saham }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Situs Web</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->situs_web }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email Perusahaan</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->email_perusahaan }}" readonly>
                            </div>
                        </div>
                        
                        <!-- Data Sales -->
                        <div class="col-lg-12 col-sm-12 col-12">
                            <h5>Data Sales</h5>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataSales->name_lengkap }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataSales->no_hp }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataSales->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataSales->jabatan }}" readonly>
                            </div>
                        </div>

                        <!-- Data Manajer -->
                        <div class="col-lg-12 col-sm-12 col-12">
                            <h5>Data Manajer</h5>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataManajer->nama_lengkap }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataManajer->no_hp }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataManajer->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataManajer->jabatan }}" readonly>
                            </div>
                        </div>

                        <!-- Data Direktur -->
                        <div class="col-lg-12 col-sm-12 col-12">
                            <h5>Data Direktur</h5>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataDirektur->nama_lengkap }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No HP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataDirektur->no_hp }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataDirektur->email }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataDirektur->jabatan }}" readonly>
                            </div>
                        </div>

                        <!-- Data Bank -->
                        <div class="col-lg-12 col-sm-12 col-12">
                            <h5>Data Bank</h5>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Pemilik Rekening</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataBank->nama_pemilik_rekening }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No Rekening</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataBank->no_rekening }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Nama Bank</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataBank->nama_bank }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Cabang Bank</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataBank->cabang_bank }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label>Alamat Bank</label>
                                <textarea class="form-control" readonly>{{ $dataKerjasama->dataBank->alamat_bank }}</textarea>
                            </div>
                        </div>

                        <!-- Data Legalitas -->
                        <div class="col-lg-12 col-sm-12 col-12">
                            <h5>Data Legalitas</h5>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No Akta</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->no_akta }}" readonly>
                                @if($dataKerjasama->dataLegalitas->file_akta)
                                    <p><a href="{{ asset('storage/' . $dataKerjasama->dataLegalitas->file_akta) }}" target="_blank">Lihat Akta</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No SIUP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->no_siup }}" readonly>
                                @if($dataKerjasama->dataLegalitas->file_siup)
                                    <p><a href="{{ asset('storage/'.$dataKerjasama->dataLegalitas->file_siup) }}" target="_blank">Lihat SIUP</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tanggal Berakhir SIUP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->date_end_siup }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No TDP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->no_tdp }}" readonly>
                                @if($dataKerjasama->dataLegalitas->file_tdp)
                                    <p><a href="{{ asset('storage/'.$dataKerjasama->dataLegalitas->file_tdp) }}" target="_blank">Lihat TDP</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tanggal Berakhir TDP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->date_end_tdp }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No SKDP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->no_skdp }}" readonly>
                                @if($dataKerjasama->dataLegalitas->file_skdp)
                                    <p><a href="{{ asset('storage/'.$dataKerjasama->dataLegalitas->file_skdp) }}" target="_blank">Lihat SKDP</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tanggal Berakhir SKDP</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->date_end_skdp }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>No IUJK</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->no_iujk }}" readonly>
                                @if($dataKerjasama->dataLegalitas->file_iujk)
                                    <p><a href="{{ asset('storage/'.$dataKerjasama->dataLegalitas->file_iujk) }}" target="_blank">Lihat IUJK</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Tanggal Berakhir IUJK</label>
                                <input type="text" class="form-control" value="{{ $dataKerjasama->dataLegalitas->date_end_iujk }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Profil Perusahaan</label>
                                @if($dataKerjasama->dataLegalitas->file_profile_perusahaan)
                                    <p><a href="{{ asset('storage/'.$dataKerjasama->dataLegalitas->file_profile_perusahaan) }}" target="_blank">Lihat Profil Perusahaan</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Dokumen Kebenaran</label>
                                @if($dataKerjasama->dataLegalitas->file_dokumen_kebenaran)
                                    <p><a href="{{ asset('storage/'.$dataKerjasama->dataLegalitas->file_dokumen_kebenaran) }}" target="_blank">Lihat Dokumen Kebenaran</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <p>Data kerja sama tidak ditemukan.</p>
                    @endif

                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-primary">Update Status</button>
                            <a href="{{ route('userslisteclient') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
