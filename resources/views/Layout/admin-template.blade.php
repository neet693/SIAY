<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Bootstrap Icons CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">

    {{-- Datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <div class="screen-cover d-none d-xl-none"></div>

    <div class="row">
        <div class="col-12 col-lg-3 col-navbar d-none d-xl-block">
            {{-- @auth --}}
            @include('Navbar.sidebar')
            {{-- @include('Navbar.navbar') --}}
            {{-- @endauth --}}
        </div>


        <div class="col-12 col-xl-9">
            @include('Navbar.navbar')
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    {{-- <script>
        const navbar = document.querySelector('.col-navbar')
        const cover = document.querySelector('.screen-cover')

        const sidebar_items = document.querySelectorAll('.sidebar-item')

        function toggleNavbar() {
            navbar.classList.toggle('d-none')
            cover.classList.toggle('d-none')
        }

        function toggleActive(e) {
            sidebar_items.forEach(function(v, k) {
                v.classList.remove('active')
            })
            e.closest('.sidebar-item').classList.add('active')

        }
    </script> --}}
    <script src="{{ asset('template/assets/script.js') }}"></script>

    <script>
        const navbar = document.querySelector('.col-navbar')
        const cover = document.querySelector('.screen-cover')

        const sidebarItems = document.querySelectorAll('.sidebar-item')

        function toggleNavbar() {
            navbar.classList.toggle('d-none')
            cover.classList.toggle('d-none')
        }

        function toggleActive(element) {
            // Menghapus kelas 'active' dari semua elemen dengan kelas 'sidebar-item'
            sidebarItems.forEach(item => item.classList.remove('active'));

            // Menentukan route dari href elemen yang diklik
            const route = element.getAttribute('href');

            // Menambahkan kelas 'active' pada elemen yang sesuai dengan route saat ini
            if (window.location.pathname === route) {
                element.classList.add('active');
            }
        }
    </script>

    <script>
        function updateTitle(userId) {
            if (userId) {
                // Mengambil nama user berdasarkan id user yang dipilih
                const userName = document.querySelector(`option[value='${userId}']`).text;

                // Mengupdate nilai atribut value dari elemen input dengan id 'title'
                document.querySelector('#title').value = `Interview PPDB - ${userName}`;
            } else {
                // Jika user belum dipilih, maka judul akan dikembalikan ke kondisi awal
                document.querySelector('#title').value = '';
            }
        }
    </script>

</body>

</html>
