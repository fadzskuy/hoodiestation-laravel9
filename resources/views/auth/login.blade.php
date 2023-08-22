<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="{{ asset('user/css/auth.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>

<body>
    <div class="container">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill p-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill p-2"></i>{{ session('loginError') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="/login" method="post">
            @csrf
            <div class="title">Login</div>
            <div class="input-box underline">
                <input type="email" name="email" class="form-control" @error('email') is-invalid
          @enderror
                    id="email" placeholder="email" value="{{ old('email') }}" autofocus>
                <div class="underline"></div>
                @error('email')
                    <div style="color:red; font-size:13px; font-style:italic;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="input-box">
                <input type="password" name="password" class="form-control" id="password" placeholder="password">
                {{-- <i class="toggle-password fas fa-eye"></i> --}}
                <div class="underline"></div>
                @error('password')
                    <div style="color:red; font-size:13px; font-style:italic;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="input-box button">
                <input type="submit" value="Login">
            </div>
        </form>
        {{-- <div class="option">Or Connect With</div>
        <div class="facebook">
          <a href="#"><i class="fab fa-facebook-f"></i>Sign in With Facebook</a>
        </div>
        <div class="google">
          <a href="#"><i class="fab fa-google"></i>Sign in With Google</a>
        </div> --}}
        <p class="message">Tidak Mempunyai Akun? <a href="{{ url('/register') }}">Registrasi</a></p>
    </div>
</body>

</html>
{{-- <script>
  const togglePassword = document.querySelector('.toggle-password');
  const passwordInput = document.querySelector('#password');

  togglePassword.addEventListener('click', function() {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
  });
</script> --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
</script>
