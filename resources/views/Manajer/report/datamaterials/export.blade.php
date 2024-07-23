@php
    $styleHeadMain = 'border: 1px solid black; vertical-align: center; text-align: center; font-weight: bold; font-size: 12px; width: 25px; height: 50px; background-color: black; color: white;';
    $styleBodyMain = 'border: 1px solid black; word-wrap: break-word;';
@endphp

<table>
    <thead>
        <tr>
            <th style="{{ $styleHeadMain }}">No</th>
            <th style="{{ $styleHeadMain }}">Nama Materials</th>
            <th style="{{ $styleHeadMain }}">Brand Materials</th>
            <th style="{{ $styleHeadMain }}">Country</th>
            <th style="{{ $styleHeadMain }}">TKDN</th>
            <th style="{{ $styleHeadMain }}">TKDN Certificate</th>
            <th style="{{ $styleHeadMain }}">Expired Date</th>
            <th style="{{ $styleHeadMain }}">Status List Materials</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->materials->nama_materials }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->brand_materials->nama_brand_materials }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->countries }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->tkdn }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->tknd_certificate)
                        <a href="{{ Storage::url($item->tknd_certificate) }}" target="_blank">
                            {{ 'tkdn_certificate_' . Str::slug($item->materials->nama_materials, '_') . '.pdf' }}
                        </a>
                    @else
                        N/A
                    @endif
                </td>
                <td style="{{ $styleBodyMain }}">{{ $item->expired_materials_date }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->status_list_materials == 'active')
                        Active
                    @else
                        Nonactive
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
