@extends('Autentikasi.Components.app')

@section('link')
    <link rel="stylesheet" href="css/register.css">
    <style>
        .disabled-input {
            background-color: #d3d3d3; /* Warna abu-abu tua */
            color: #888888; /* Warna teks yang sedikit lebih terang */
        }
        .custom-select-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .custom-select {
            display: block;
            width: 100%;
            height: 46px; /* Sesuaikan dengan tinggi input lainnya */
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            text-align: left; /* Align text to the left */
            position: relative;
        }
        .custom-select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        .dropdown {
            position: relative;
            display: inline-block;
            width: 100%;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100%;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            max-height: 200px;
            overflow-y: auto;
        }
        .dropdown-content div {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left; /* Align text to the left */
        }
        .dropdown-content div:hover {
            background-color: #f1f1f1;
        }
        .show {
            display: block;
        }
        .custom-select-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: #495057;
        }
    </style>
@endsection

@section('content')
<div class="container-fluid overflow-hidden my-5 px-5">
    <div class="login">
        <div class="container-data">
            <h1>Register</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="register-form" action="{{ route('registerproses') }}" method="POST">
                @csrf
                <!-- Hidden input for user ID -->
                <input type="hidden" id="user_id" name="user_id" value="{{ old('user_id') }}">

                <!-- Multi-select input for company name -->
                <div class="input-group mb-1">
                    <div class="dropdown custom-select-wrapper">
                        <input type="text" id="company_search" class="custom-select" placeholder="Pilih Nama Perusahaan..." name="company_name" value="{{ old('company_name') }}" required>
                        <i class="fas fa-caret-down custom-select-icon"></i>
                        <div id="company_dropdown" class="dropdown-content">
                            @foreach($mitras as $mitra)
                                <div data-value="{{ $mitra->name_mitra }}">{{ $mitra->name_mitra }}</div>
                            @endforeach
                            <div data-value="other">Perusahaan Tidak Terdaftar</div>
                        </div>
                    </div>
                    <label for="company_search" class="company-label" id="company-label">Cari Nama Perusahaan Anda Apakah Sudah Bekerjasama Atau Belum Bekerjasama!</label>
                </div>

                <!-- Input for new company name (hidden by default) -->
                <div class="input-group mb-1" id="new-company-group" style="display:none;">
                    <input type="text" id="new_company_name" name="new_company_name" class="input-field" placeholder="Nama Perusahaan Baru" value="{{ old('new_company_name') }}">
                </div>

                <!-- Additional Info Section -->
                <div id="additional-info">
                    <input type="text" id="name" name="name" class="input-field disabled-input" placeholder="Nama PIC" value="{{ old('name') }}" required disabled>
                    <input type="email" id="email" name="email" class="input-field disabled-input" placeholder="Email PIC" value="{{ old('email') }}" required disabled>
                    <input type="number" id="no_hp" name="no_hp" class="input-field disabled-input" placeholder="No Handphone" value="{{ old('no_hp') }}" required disabled>
                    <input type="password" id="password" name="password" class="input-field disabled-input" placeholder="Password" required disabled><br>
                </div>
                
                <input type="checkbox"><span>Remember me</span>
                <a href="#">Forgot password?</a>
                <button type="submit" id="submit-button" class="btn-register" disabled>Register</button> 
            </form>
            
            <hr><p>Or Connect With</p><hr>
            <ul>
                <li><i class="fab fa-facebook-f fa-2x"></i></li>
                <li><i class="fas fa-envelope fa-2x"></i></li>
                <li><i class="fab fa-linkedin-in fa-2x"></i></li>
            </ul>
            <div class="clearfix"></div>          
            <span class="copyright">&copy; PT Raja Perkasa 2024</span> 
        </div>
    </div>
    <div class="register">
        <div class="container">
            <i class="fas fa-user-plus fa-5x"></i>
            <h2>Selamat Datang Di Website PT Raja Perkasa</h2>
         
            <p>Daftarkan Segera Sebagai Client Mitra Kami! <br> Sudah Punya Akun? Silahkan Login Terlebih Dahulu!</p>
            <a href="{{ route('login') }}"><button>Login <i class="fas fa-arrow-circle-right"></i></button></a> 
        </div>
    </div>  
</div>

<!-- Footer Start -->
<div class="container-fluid bg-dark text-secondary footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-1">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4" style="font-size:15px;">Alamat PT Raja Perkasa</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Indramayu, Jawa Barat</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>rajaperkasa@gmail.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fas fa-envelope"></i></a>
                    <a class="btn btn-square btn-outline-secondary rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4" style="font-size:15px;">Jasa Kami</h5>
                <a class="btn btn-link" href="">Manajemen Proyek</a>
                <a class="btn btn-link" href="">Desain & Rekayasa</a>
                <a class="btn btn-link" href="">Konstruksi Umum</a>
                <a class="btn btn-link" href="">Konsultasi Proyek</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4" style="font-size:15px;">Quick Links</h5>
                <a class="btn btn-link" href="">Tentang</a>
                <a class="btn btn-link" href="">Jasa Kami</a>
                <a class="btn btn-link" href="">Project</a>
                <a class="btn btn-link" href="">Kontak</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="text-light mb-4" style="font-size:15px;">Hubungi Kami</h5>
                <p>Hubungi kami untuk informasi lebih lanjut tentang layanan kami.</p>
                <div class="position-relative w-100">
                    <input class="form-control bg-transparent border-secondary w-100 py-3 ps-4 pe-5" type="text" placeholder="Email Anda">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<!-- Copyright Start -->
<div class="container-fluid start"  style="background: #000000; height: 70px;">
      <br>
       <a class="border-bottom text-orange" href="#"> &copy; PT Raja Perkasa</a>, All Right Reserved.
</div>
<!-- Copyright End -->

<!-- Modal for email confirmation -->
<div class="modal fade" id="emailConfirmationModal" tabindex="-1" aria-labelledby="emailConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailConfirmationModalLabel">Konfirmasi Email Perusahaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="email-confirmation-form">
                    <div class="mb-3">
                        <label for="company_email" class="form-label">Email Perusahaan</label>
                        <input type="email" class="form-control" id="company_email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
                <div id="email-confirmation-message" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi elemen yang akan digunakan
        const companySearch = document.getElementById('company_search');
        const companyDropdown = document.getElementById('company_dropdown');
        const companyLabel = document.getElementById('company-label');
        const newCompanyGroup = document.getElementById('new-company-group');
        const url = "{{ route('getpicdetails') }}";

        // Menampilkan dropdown ketika input companySearch difokuskan
        companySearch.addEventListener('focus', function() {
            companyDropdown.classList.add('show');
        });

        // Filter dropdown berdasarkan input user
        companySearch.addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const items = companyDropdown.getElementsByTagName('div');

            Array.from(items).forEach(function(item) {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // Menangani klik pada dropdown item
        companyDropdown.addEventListener('click', function(event) {
            if (event.target && event.target.nodeName == "DIV") {
                const companyName = event.target.getAttribute('data-value');
                companySearch.value = event.target.textContent;
                companyDropdown.classList.remove('show');

                if (companyName) {
                    companyLabel.style.display = 'none';
                    if (companyName === 'other') {
                        // Jika perusahaan tidak terdaftar, tampilkan input untuk perusahaan baru
                        newCompanyGroup.style.display = 'block';
                        enableFields();
                        document.getElementById('user_id').value = ''; // Pastikan user_id kosong untuk perusahaan baru
                    } else {
                        // Jika perusahaan terdaftar, sembunyikan input untuk perusahaan baru dan fetch data user
                        newCompanyGroup.style.display = 'none';
                        fetch(`${url}?company_name=${companyName}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Jika data user ditemukan, isi input field dengan data user
                                    document.getElementById('user_id').value = data.user.id;
                                    document.getElementById('name').value = data.user.name;
                                    document.getElementById('email').value = data.user.email;
                                    document.getElementById('no_hp').value = data.user.no_hp;

                                    disableFields(false);
                                } else {
                                    // Jika data user tidak ditemukan, kosongkan input field
                                    document.getElementById('user_id').value = '';
                                    document.getElementById('name').value = '';
                                    document.getElementById('email').value = '';
                                    document.getElementById('no_hp').value = '';

                                    disableFields(false);
                                }
                            })
                            .catch(error => console.error('Error fetching PIC details:', error));
                    }
                }
            }
        });

        // Mengaktifkan input field untuk pengisian data
        function enableFields() {
            const fields = ['name', 'email', 'no_hp', 'password'];
            fields.forEach(function(field) {
                const inputField = document.getElementById(field);
                inputField.disabled = false;
                inputField.classList.remove('disabled-input');
            });
            document.getElementById('submit-button').disabled = false;
        }

        // Menonaktifkan input field untuk mencegah pengisian data
        function disableFields(enable = true) {
            const fields = ['name', 'email', 'no_hp', 'password'];
            fields.forEach(function(field) {
                const inputField = document.getElementById(field);
                inputField.disabled = enable;
                inputField.classList.toggle('disabled-input', enable);
            });
            document.getElementById('submit-button').disabled = enable;
        }

        // Menangani submit form register
        document.getElementById('register-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const userId = document.getElementById('user_id').value;
            if (userId) {
                // Jika user ID ditemukan, tampilkan modal konfirmasi email
                const modal = new bootstrap.Modal(document.getElementById('emailConfirmationModal'));
                modal.show();
            } else {
                // Jika user ID tidak ditemukan, submit form
                this.submit();
            }
        });

        // Menangani submit form konfirmasi email
        document.getElementById('email-confirmation-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.getElementById('company_email').value;
            const userId = document.getElementById('user_id').value;

            fetch("{{ route('confirmEmail') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ email: email, user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('email-confirmation-message');
                if (data.success) {
                    // Jika email valid, submit form register
                    document.getElementById('register-form').submit();
                } else {
                    // Jika email tidak valid, tampilkan pesan error
                    messageDiv.textContent = 'Email perusahaan tidak valid.';
                    messageDiv.classList.add('text-danger');
                }
            })
            .catch(error => console.error('Error confirming email:', error));
        });

        // Menutup dropdown jika klik di luar elemen input dan dropdown
        document.addEventListener('click', function(event) {
            if (!companySearch.contains(event.target) && !companyDropdown.contains(event.target)) {
                companyDropdown.classList.remove('show');
            }
        });

        // Mengembalikan nilai input jika ada error pada submit sebelumnya
        if ("{{ old('company_name') }}" === 'other') {
            newCompanyGroup.style.display = 'block';
            enableFields();
        } else if ("{{ old('company_name') }}") {
            disableFields(false);
        }
    });
</script>
@endsection
