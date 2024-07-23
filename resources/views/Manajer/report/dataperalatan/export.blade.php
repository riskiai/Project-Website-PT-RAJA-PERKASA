@php
    $styleHeadMain = 'border: 1px solid black; vertical-align: center; text-align: center; font-weight: bold; font-size: 12px; width: 25px; height: 50px; background-color: black; color: white;';
    $styleBodyMain = 'border: 1px solid black; word-wrap: break-word;';
@endphp

<table>
    <thead>
        <tr>
            <th style="{{ $styleHeadMain }}">No</th>
            <th style="{{ $styleHeadMain }}">Nama Peralatan</th>
            <th style="{{ $styleHeadMain }}">Brand</th>
            <th style="{{ $styleHeadMain }}">Capacity</th>
            <th style="{{ $styleHeadMain }}">Ownership</th>
            <th style="{{ $styleHeadMain }}">Certificate By</th>
            <th style="{{ $styleHeadMain }}">Unit Quantity</th>
            <th style="{{ $styleHeadMain }}">Status List Peralatan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $index => $item)
            <tr>
                <td style="{{ $styleBodyMain }}">{{ $index + 1 }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->peralatan->nama_peralatan }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->brand_peralatan->nama_brand_peralatan }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->capacity }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->ownership }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->certificate_by }}</td>
                <td style="{{ $styleBodyMain }}">{{ $item->unit_qty }}</td>
                <td style="{{ $styleBodyMain }}">
                    @if($item->status_list_peralatans == 'active')
                        Active
                    @else
                        Nonactive
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
