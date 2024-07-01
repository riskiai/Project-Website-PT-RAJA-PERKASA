@php
    $styleHeadMain = 'border: 1px solid black; vertical-align: center; text-align: center; font-weight: bold; font-size: 12px; width: 25px; height: 50px; background-color: black; color: white;';
    $styleBodyMain = 'border: 1px solid black; word-wrap: break-word;';
@endphp

<table>
    <thead>
        <tr>
            <th style="{{ $styleHeadMain }}">No</th>
            <th style="{{ $styleHeadMain }}">Nama</th>
            <th style="{{ $styleHeadMain }}">Email</th>
            <th style="{{ $styleHeadMain }}">No HP</th>
            <th style="{{ $styleHeadMain }}">Status User</th>
            <th style="{{ $styleHeadMain }}">Mitra</th>
            <th style="{{ $styleHeadMain }}">Status PIC Perusahaan</th>
            <th style="{{ $styleHeadMain }}">Keterangan Kerjasama</th>
            <th style="{{ $styleHeadMain }}">Status Dokument Kerja Sama Mitra</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $index => $user)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->email }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->no_hp }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->status_user }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->mitra->name_mitra ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->status_pic_perusahaan }}</td>
                <td style="{{ $styleBodyMain }}">
                    {{ $user->documentKerjasamaClient->keterangan_status_kerjasama ?? 'N/A' }}
                </td>
                <td style="{{ $styleBodyMain }}">
                    @if($user->documentKerjasamaClient)
                        {{ ucfirst($user->documentKerjasamaClient->status_kerjasama) }}
                    @else
                        No Data
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
