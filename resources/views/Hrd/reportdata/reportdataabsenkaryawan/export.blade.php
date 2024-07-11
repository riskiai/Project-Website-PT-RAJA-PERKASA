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
            <th style="{{ $styleHeadMain }}">Tanggal Absen</th>
            <th style="{{ $styleHeadMain }}">Status Absensi</th>
            <th style="{{ $styleHeadMain }}">Waktu Datang</th>
            <th style="{{ $styleHeadMain }}">Waktu Pulang</th>
            <th style="{{ $styleHeadMain }}">Surat Izin/Sakit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->tanggal_absen }}</td>
                <td style="{{ $styleBodyMain }}">{{ ucfirst($item->status_absensi) }}</td>
                <td style="{{ $styleBodyMain }}">
                    {{ $item->waktu_datang_kehadiran ? \Carbon\Carbon::parse($item->waktu_datang_kehadiran)->format('H:i:s') : '-' }}
                </td>
                <td style="{{ $styleBodyMain }}">
                    {{ $item->waktu_pulang_kehadiran ? \Carbon\Carbon::parse($item->waktu_pulang_kehadiran)->format('H:i:s') : '-' }}
                </td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->surat_izin_sakit)
                        <a href="{{ asset('storage/'.$item->surat_izin_sakit) }}" target="_blank">Lihat Surat</a>
                    @else
                        Tidak Ada Surat
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
