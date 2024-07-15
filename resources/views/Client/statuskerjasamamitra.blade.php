@extends('Pengunjung.Components.app')

@section('style')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    h2 {
        margin-top: 20px;
        text-align: center;
        font-size: 30px;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f9f9f9;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    @include('Client.components.navbarclient')
    <h2>Status Penerimaan Kerja Sama Mitra Dengan PT Raja Perkasa</h2>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal Kirim</th>
                        <th>Status Kerja Sama Mitra</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ now()->format('Y-m-d') }}</td>
                        <td>{{ $defaultStatus }}</td>
                        <td>{{ $defaultKeterangan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
