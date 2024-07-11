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
            <th style="{{ $styleHeadMain }}">Alasan Pengunduran Diri</th>
            <th style="{{ $styleHeadMain }}">Status Pengunduran Diri</th>
            <th style="{{ $styleHeadMain }}">File Pengunduran Diri</th>
            <th style="{{ $styleHeadMain }}">File Balasan</th>
            <th style="{{ $styleHeadMain }}">Tanggal Pengajuan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->alasan_pengunduran_diri }}</td>
                <td style="{{ $styleBodyMain }}">{{ ucfirst($item->status_pengunduran_diri) }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->file_pengunduran_diri)
                        <a href="{{ asset('storage/'.$item->file_pengunduran_diri) }}" target="_blank">Lihat File</a>
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
                <td style="{{ $styleBodyMain }}">{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
