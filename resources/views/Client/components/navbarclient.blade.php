<style>
    .navbar-client {
        margin-left: 220px;
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

    /* Responsive Design for mobile devices */
    @media (max-width: 768px) {
        .navbar-client {
            margin-left: 0; /* Reset margin for small screens */
            display: flex;
            flex-direction: column;
            gap: 10px; /* Adjust gap for small screens */
        }

        .navbar-client a {
            padding: 10px; /* Adjust padding for small screens */
            font-size: 14px; /* Adjust font size for small screens */
        }
    }
</style>

@php
$user = Auth::user();
$profileComplete = $user->name && $user->email && $user->no_hp && $user->nik && $user->file_ktp && $user->file_foto;
@endphp

<div class="navbar-client">
    <div>
        <a href="{{ route('profileclient') }}">Data Diri Pribadi</a>
    </div>
    <div>
        <a href="{{ $profileComplete ? route('pengajuankerjasama') : '#' }}" class="{{ $profileComplete ? '' : 'disabled' }}">Pengajuan Kerja Sama</a>
    </div>
    <div>
        <a href="{{ $profileComplete ? route('statuskerjasama') : '#' }}" class="{{ $profileComplete ? '' : 'disabled' }}">Status Kerja Sama</a>
    </div>
</div>
