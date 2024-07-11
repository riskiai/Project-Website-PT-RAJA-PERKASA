@php
    $styleHeadMain = 'border: 1px solid black; vertical-align: center; text-align: center; font-weight: bold; font-size: 12px; width: 25px; height: 50px; background-color: black; color: white;';
    $styleBodyMain = 'border: 1px solid black; word-wrap: break-word;';
@endphp

<table>
    <thead>
        <tr>
            <th style="{{ $styleHeadMain }}">No</th>
            <th style="{{ $styleHeadMain }}">Nama Karyawan</th>
            <th style="{{ $styleHeadMain }}">Divisi</th>
            <th style="{{ $styleHeadMain }}">Alasan Cuti</th>
            <th style="{{ $styleHeadMain }}">Status Cuti</th>
            <th style="{{ $styleHeadMain }}">Lokasi Area Kerja</th>
            <th style="{{ $styleHeadMain }}">Pengambilan Cuti</th>
            <th style="{{ $styleHeadMain }}">Masuk Kembali</th>
            <th style="{{ $styleHeadMain }}">File Cuti</th>
            <th style="{{ $styleHeadMain }}">File Balasan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->alasan_cuti }}</td>
                <td style="{{ $styleBodyMain }}">{{ ucfirst($item->status_cuti) }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->lokasi_area_kerja }}</td>
                <td style="{{ $styleBodyMain }}">{{ \Carbon\Carbon::parse($item->pengambilan_cuti_tgl)->translatedFormat('j F Y') }}</td>
                <td style="{{ $styleBodyMain }}">{{ \Carbon\Carbon::parse($item->masuk_kembali_tgl)->translatedFormat('j F Y') }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->file_cuti)
                        <a href="{{ asset('storage/'.$item->file_cuti) }}" target="_blank">Lihat File</a>
                    @else
                        Tidak Ada File
                    @endif
                </td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->file_balasan)
                        <a href="{{ asset('storage/'.$item->file_balasan) }}" target="_blank">Lihat File</a>
                    @else
                        Tidak Ada File
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
