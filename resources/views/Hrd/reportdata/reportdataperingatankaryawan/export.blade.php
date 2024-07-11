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
            <th style="{{ $styleHeadMain }}">Jenis Peringatan</th>
            <th style="{{ $styleHeadMain }}">Status Karyawan</th>
            <th style="{{ $styleHeadMain }}">Cuti Berapa Kali</th>
            <th style="{{ $styleHeadMain }}">Tidak Hadir</th>
            <th style="{{ $styleHeadMain }}">File Peringatan</th>
            <th style="{{ $styleHeadMain }}">Tanggal Peringatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->divisi_name }}</td>
                <td style="{{ $styleBodyMain }}">{{ ucfirst(str_replace('_', ' ', $item->jenis_peringatan)) }}</td>
                <td style="{{ $styleBodyMain }}">{{ ucfirst($item->status_karyawan) }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->cuti_berapakali }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->tidak_hadirnya }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->file_peringatan)
                        <a href="{{ asset('storage/'.$item->file_peringatan) }}" target="_blank">Lihat File</a>
                    @else
                        Tidak Ada File
                    @endif
                </td>
                <td style="{{ $styleBodyMain }}">{{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
