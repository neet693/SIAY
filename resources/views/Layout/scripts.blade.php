{{-- Script Untuk Table --}}
<script>
    $(document).ready(function() {
        $('#transactionTable').DataTable();
    });
    $(document).ready(function() {
        $('#studentTable').DataTable();
    });
    $(document).ready(function() {
        $('#examsTable').DataTable();
    });
    $(document).ready(function() {
        $('#questionsTable').DataTable();
    });
    $(document).ready(function() {
        $('#studentsAssignTable').DataTable();
    });
</script>

{{-- Script untuk Navbar --}}
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

{{-- Script Untuk CDN --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="{{ asset('template/assets/script.js') }}"></script>
