@extends('Pengunjung.Components.app')

@section('style')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    h2 {
        margin-top: 20px; /* Added margin-top for spacing */
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
    <h2>Status Penerimaan Kerja Sama Mitra</h2> <!-- Added title above the table -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>File yang Dikirim</th>
                        <th>Tanggal Kirim</th>
                        <th>Status Kerja Sama Mitra</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>File Contoh.pdf</td>
                        <td>2022-10-15</td>
                        <td>Diterima</td>
                    </tr>
                    <tr>
                        <td>File Proposal.docx</td>
                        <td>2022-10-20</td>
                        <td>Ditolak</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

