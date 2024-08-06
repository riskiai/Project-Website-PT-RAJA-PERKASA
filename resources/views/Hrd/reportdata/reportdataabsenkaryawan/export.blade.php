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
            <th style="{{ $styleHeadMain }}">Tanggal Rekapitulasi Kehadiran</th>
            <th style="{{ $styleHeadMain }}">Status Kehadiran</th>
            <th style="{{ $styleHeadMain }}">Mulai Kehadiran</th>
            <th style="{{ $styleHeadMain }}">Mengkahiri Kehadiran</th>
            <th style="{{ $styleHeadMain }}">Bukti Kehadiran</th>
            <th style="{{ $styleHeadMain }}">Surat Izin/Sakit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->name ?? 'Tidak Ada' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->user->divisi->divisi_name ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ \Carbon\Carbon::parse($item->tanggal_absen)->translatedFormat('j F Y') ?? '-' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->status_absensi === 'tidak_hadir' ? 'Tidak Hadir' : ucfirst($item->status_absensi) }}</td>
                <td style="{{ $styleBodyMain }}">{{ \Carbon\Carbon::parse($item->waktu_datang_kehadiran)->translatedFormat('j F Y H:i:s') ?? '-' }}</td>
                <td style="{{ $styleBodyMain }}">{{ \Carbon\Carbon::parse($item->waktu_pulang_kehadiran)->translatedFormat('j F Y H:i:s') ?? '-' }}</td>
                <td style="{{ $styleBodyMain }}">
                  @if($item->bukti_kehadiran)
                    <a href="{{ asset('storage/' . $item->bukti_kehadiran) }}" target="_blank">Lihat Bukti</a>
                  @else
                    -
                  @endif
                </td>
                <td style="{{ $styleBodyMain }}">
                  @if($item->surat_izin_sakit)
                    <a href="{{ asset('storage/' . $item->surat_izin_sakit) }}" target="_blank">Lihat Surat Izin/Sakit</a>
                  @else
                    -
                  @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
