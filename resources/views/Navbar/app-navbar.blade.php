@auth
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('app/assets/images/logo-sky.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('program*') ? 'active' : '' }}" aria-current="page"
                            href="#">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mentor*') ? 'active' : '' }}" href="#">Mentor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('AcceptanceStudent*') ? 'active' : '' }}"
                            href="#AcceptedStudent">Tabel Penerimaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bussines*') ? 'active' : '' }}" href="#">Business</a>
                    </li>
                </ul>
                <div class="d-flex user-logged">
                    <a href="{{ route('dashboard') }}" class="text-white">
                        Halo, {{ Auth::user()->name }}!
                        <img src="{{ asset('app/assets/images/user_photo.png') }}" class="user-photo" alt="">
                    </a>
                </div>
            </div>
        </div>
    </nav>
@endauth

@guest
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('app/assets/images/logo-sky.png') }}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('program*') ? 'active' : '' }}" aria-current="page"
                            href="#">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('mentor*') ? 'active' : '' }}" href="#">Mentor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('AcceptanceStudent*') ? 'active' : '' }}"
                            href="#AcceptedStudent">Tabel Penerimaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('bussines*') ? 'active' : '' }}" href="#">Business</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="{{ route('login') }}" class="btn btn-master btn-success me-3">
                        Masuk
                    </a>
                    <a href="{{ route('ppdb.create') }}" class="btn btn-master btn-login">
                        Daftar PPDB
                    </a>
                </div>
            </div>
        </div>
    </nav>
@endguest
