<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!---<title> Responsive Login Form | CodingLab </title>--->
    <link href="{{ asset('user/css/auth.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoodie Station | Register</title>
</head>

<body>
    <div class="container">
        <form action="/register" method="post">
            @csrf
            <div class="title">Register</div>
            <div class="input-box underline">
                <input type="text" name="name" class="form-control" @error('name') is-invalid
          @enderror
                    id="name" placeholder="nama" value="{{ old('name') }}" autofocus>
                @error('name')
                    <div style="color:red; font-size:13px; font-style:italic;">
                        {{ $message }}
                    </div>
                @enderror
                <div class="underline"></div>
            </div>
            <div class="input-box underline">
                <input type="text" name="username" class="form-control"
                    @error('username') is-invalid
          @enderror id="username" placeholder="username"
                    value="{{ old('username') }}">
                <div class="underline"></div>
                @error('username')
                    <div style="color:red; font-size:13px; font-style:italic;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="input-box underline">
                <input type="email" name="email" class="form-control" @error('email') is-invalid
          @enderror
                    id="email" placeholder="email" value="{{ old('email') }}">
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
            <div class="input-box">
                <input type="password" name="confirm_password" class="form-control" id="confirm_password"
                    placeholder="konfirmasi password">
                {{-- <i class="toggle-password fas fa-eye"></i> --}}
                <div class="underline"></div>
                @error('confirm_password')
                    <div style="color:red; font-size:13px; font-style:italic;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="input-box">
                <input type="phone" name="phone" class="form-control" @error('phone') is-invalid
          @enderror
                    id="phone" placeholder="nomor Hp" value="{{ old('phone') }}">
                <div class="underline"></div>
                @error('phone')
                    <div style="color:red; font-size:13px; font-style:italic;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="input-box">
                <input type="address" name="address" class="form-control"
                    @error('address') is-invalid
          @enderror id="address" placeholder="alamat"
                    value="{{ old('address') }}">
                <div class="underline"></div>
                @error('address')
                    <div style="color:red; font-size:13px; font-style:italic;">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="input-box">
          <input type="confirm-password" name="password_confirmation" placeholder="Confirm Password">
          <div class="underline"></div>
        </div> --}}
            <div class="input-box button">
                <input type="submit" value="Register">
            </div>
            <p class="text0center">Sudah Mempunyai Akun? <a href="/login">Log In</a></p>
        </form>
</body>

</html>
{{-- <script>
  const togglePassword = document.querySelectorAll('.toggle-password');
  togglePassword.forEach((toggle) => {
    toggle.addEventListener('click', function () {
      const password = this.previousElementSibling;
      if (password.type === "password") {
        password.type = "text";
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
      } else {
        password.type = "password";
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
      }
    });
  });
</script> --}}
