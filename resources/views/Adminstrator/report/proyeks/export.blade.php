@php
    $styleHeadMain = 'border: 1px solid black; vertical-align: center; text-align: center; font-weight: bold; font-size: 12px; width: 25px; height: 50px; background-color: black; color: white;';
    $styleBodyMain = 'border: 1px solid black; word-wrap: break-word;';
@endphp

<table>
    <thead>
        <tr>
            <th style="{{ $styleHeadMain }}">No</th>
            <th style="{{ $styleHeadMain }}">Proyek Disetujui Tanggal</th>
            <th style="{{ $styleHeadMain }}">Nama Proyek</th>
            <th style="{{ $styleHeadMain }}">Bidang Pekerjaan Proyek</th>
            <th style="{{ $styleHeadMain }}">Client</th>
            <th style="{{ $styleHeadMain }}">Main Contractor</th>
            <th style="{{ $styleHeadMain }}">Nama Materials</th>
            <th style="{{ $styleHeadMain }}">Nama Brand Materials</th>
            <th style="{{ $styleHeadMain }}">Nama Peralatan</th>
            <th style="{{ $styleHeadMain }}">Nama Brand Peralatan</th>
            <th style="{{ $styleHeadMain }}">Status Progres</th>
            <th style="{{ $styleHeadMain }}">Status Proyek</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($proyeks as $index => $proyek)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->updated_at->format('Y-m-d')}}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->project_name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->bidangproyeks->nama_bidang_pekerjaan_proyek ?? "Tidak Ada Data" }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->client_name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->main_contractor }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->materials->nama_materials ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->brandMaterials->nama_brand_materials ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->peralatan->nama_peralatan ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $proyek->brandPeralatan->nama_brand_peralatan ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($proyek->status_progres_proyek == 'Perencanaan')
                        Perencanaan
                    @elseif($proyek->status_progres_proyek == 'SedangBerlangsung')
                        Sedang Berlangsung
                    @elseif($proyek->status_progres_proyek == 'Penyelesaian')
                        Penyelesaian
                    @elseif($proyek->status_progres_proyek == 'Pemeliharaan')
                        Pemeliharaan
                    @else
                        Tidak Diketahui
                    @endif
                </td> 
                <td style="{{ $styleBodyMain }}">
                    @if($proyek->status_proyek == 'disetujui')
                        Disetujui
                    @elseif($proyek->status_proyek == 'tidak_disetujui')
                        Tidak Disetujui
                    @else
                        Belum Dicek
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
