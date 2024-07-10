<style>
    .navbar-client {
        margin-left: 0px;
        display: flex;
        flex-basis: row;
        gap: 15px;
    }

    .navbar-client a {
        color: white;
        background-color: orange;
        padding: 10px 20px; 
        border-radius: 10px;
        text-align: center; 
        display: block; 
        white-space: nowrap; 
        text-decoration: none;
    }

    .navbar-client a.disabled {
        background-color: gray; /* Warna tombol yang dinonaktifkan */
        pointer-events: none; /* Menonaktifkan klik */
    }
</style>

{{-- @php
$user = Auth::user();
$profileComplete = $user->name && $user->email && $user->no_hp && $user->nik && $user->file_ktp && $user->file_foto;
@endphp --}}

<div class="navbar-client">
    <div>
        <a href="{{ route('absenkaryawan') }}">Absen Masuk</a>
    </div>
    <div>
        <a href="{{ route('absenkaryawanpulang') }}">Absen Pulang</a>
    </div>
    <div>
        <a href="{{ route('listdataabsenkaryawan') }}">Lihat Data Absen Saya</a>
    </div>
</div>
