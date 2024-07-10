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
            <th style="{{ $styleHeadMain }}">NIK</th>
            <th style="{{ $styleHeadMain }}">Divisi</th>
            <th style="{{ $styleHeadMain }}">No HP</th>
            <th style="{{ $styleHeadMain }}">Alamat</th>
            <th style="{{ $styleHeadMain }}">Tanggal Lahir</th>
            <th style="{{ $styleHeadMain }}">Jenis Kelamin</th>
            <th style="{{ $styleHeadMain }}">File Foto</th>
            <th style="{{ $styleHeadMain }}">File KTP</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $user)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->name }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->email }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->nik }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->divisi->divisi_name ?? 'N/A' }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->no_hp }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->alamat }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->tgl_lahir }}</td>
                <td style="{{ $styleBodyMain }}">{{ $user->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($user->file_foto)
                        <a href="{{ asset('storage/' . $user->file_foto) }}" target="_blank">Lihat Foto</a>
                    @else
                        Tidak ada foto
                    @endif
                </td>
                <td style="{{ $styleBodyMain }}">
                    @if($user->file_ktp)
                        <a href="{{ asset('storage/' . $user->file_ktp) }}" target="_blank">Lihat KTP</a>
                    @else
                        Tidak ada KTP
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
