@extends('Autentikasi.Components.app')

@section('link')
    <link rel="stylesheet" href="css/register.css">
@endsection

@section('content')
<div class="container-fluid overflow-hidden my-5 px-5">
    <div class="login">
        <div class="container">
            <h1>Register</h1>
            <form id="register-form" action="{{ route('registerproses') }}" method="POST">
                @csrf
                <!-- Hidden input for user ID -->
                <input type="hidden" id="user_id" name="user_id">

                <!-- Single input for company name -->
                <input type="text" id="company_name" name="company_name" class="input-field" placeholder="Nama Perusahaan" list="companies" required>
                <datalist id="companies">
                    @foreach($mitras as $mitra)
                        <option value="{{ $mitra->name_mitra }}">
                    @endforeach
                </datalist>

                <input type="text" id="name" name="name" class="input-field" placeholder="Nama PIC" required>
                <input type="email" id="email" name="email" class="input-field" placeholder="Email PIC" required>
                <input type="number" id="no_hp" name="no_hp" class="input-field" placeholder="No Handphone" required>
                <input type="password" id="password" name="password" class="input-field" placeholder="Password" required><br>
                <input type="checkbox"><span>Remember me</span>
                <a href="#">Forgot password?</a>
                <button type="submit" class="btn-register">Register</button> 
            </form>
            
            <hr><p>Or Connect With</p><hr>
            <ul>
                <li><i class="fab fa-facebook-f fa-2x"></i></li>
                {{-- <li><i class="fab fa-twitter fa-2x"></i></li> --}}
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
         
            <p>Daftarkan Segera Sebagai Client Mitra Kami! <br> Sudah Punya Akun ? Silahkan Login Terlebih Dahulu!</p>
            <a href="{{ route('login') }}"><button>Login <i class="fas fa-arrow-circle-right"></i></button></a> 
        </div>
    </div>  
</div>

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
    document.getElementById('company_name').addEventListener('input', function() {
        var companyName = this.value;
        var url = "{{ route('getpicdetails') }}";

        if (companyName) {
            fetch(`${url}?company_name=${companyName}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('user_id').value = data.user.id;
                        document.getElementById('name').value = data.user.name;
                        document.getElementById('email').value = data.user.email;
                        document.getElementById('no_hp').value = data.user.no_hp;
                    } else {
                        document.getElementById('user_id').value = '';
                        document.getElementById('name').value = '';
                        document.getElementById('email').value = '';
                        document.getElementById('no_hp').value = '';
                    }
                })
                .catch(error => console.error('Error fetching PIC details:', error));
        }
    });

    document.getElementById('register-form').addEventListener('submit', function(event) {
        event.preventDefault();
        var userId = document.getElementById('user_id').value;
        if (userId) {
            var modal = new bootstrap.Modal(document.getElementById('emailConfirmationModal'));
            modal.show();
        } else {
            this.submit();
        }
    });

    document.getElementById('email-confirmation-form').addEventListener('submit', function(e) {
        e.preventDefault();
        var email = document.getElementById('company_email').value;
        var userId = document.getElementById('user_id').value;

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
            var messageDiv = document.getElementById('email-confirmation-message');
            if (data.success) {
                document.getElementById('register-form').submit();
            } else {
                messageDiv.textContent = 'Email perusahaan tidak valid.';
                messageDiv.classList.add('text-danger');
            }
        })
        .catch(error => console.error('Error confirming email:', error));
    });
</script>

@endsection
