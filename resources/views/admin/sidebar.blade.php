<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin | Hoodie Station</title>
    <link rel="icon" href="{{ asset('storage/img/logo.png') }}" type="image">
    <link rel="stylesheet" href="/user/css/sidebar.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet" />
</head>
<nav>
    <div class="logo1">
        <i class="bx bx-menu menu-icon p-3"></i>
        <img class="mr-5" src="{{ asset('storage/img/logo.png') }}" width="30px">
        <span class="logo1-name p-3">Hoodie Station</span>
    </div>
    <div class="sidebar">
        <div class="logo">
            <i class="bx bx-menu menu-icon"></i>
            <span class="logo-name">Hoodie Station</span>
        </div>
        <div class="sidebar-content">
            <ul class="lists">
                {{-- <li class="list">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="bx bx-home-alt icon"></i>
                        <span class="link">Dashboard</span>
                    </a>
                </li> --}}
                <li class="list">
                    <a href="/produk" class="nav-link {{ Request::is('produk') ? 'active' : '' }}">
                        <i class="bx bx-package icon"></i>
                        <span class="link">Produk Saya</span>
                    </a>
                <li class="list">
                    <a href="/create" class="nav-link {{ Request::is('create') ? 'active' : '' }}">
                        <i class="bx bx-plus-circle icon"></i>
                        <span class="link">Tambah Produk</span>
                    </a>
                </li>
                <li class="list">
                    <a href="/history" class="nav-link {{ Request::is('history') ? 'active' : '' }}">
                        <i class="bx bx-history icon"></i>
                        <span class="link">Riwayat</span>
                    </a>
                </li>
            </ul>
            <li class="list">
                <a class="nav-link">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bx bx-log-out icon"></i> <span
                                class="link">Keluar</span></button>
                    </form>
                </a>
            </li>
        </div>
    </div>
    </div>
</nav>

<section class="overlay"></section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
</script>
<script>
    const navBar = document.querySelector("nav"),
        menuBtns = document.querySelectorAll(".menu-icon"),
        overlay = document.querySelector(".overlay");

    menuBtns.forEach((menuBtn) => {
        menuBtn.addEventListener("click", () => {
            navBar.classList.toggle("open");
        });
    });

    overlay.addEventListener("click", () => {
        navBar.classList.remove("open");
    });
</script>
<script src="{{ asset('js/app.js') }}"></script>

</html>
@yield('admin')
