@extends('Layout.app2')
@section('content')
    <section class="banner">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-12 copywriting">
                            <p class="story">
                                Sekolah Kristen Yahya
                            </p>
                            <h1 class="header">
                                Temukan <span class="text-purple">Pembelajaran <br> CERDAS </span> Bersama Kami!
                            </h1>
                            <p class="support">
                                Memberdayakan Siswa untuk Berkembang di Lingkungan yang Seimbang, Progresif, Berdasarkan
                                Kitab Suci, Ramah, dan Disiplin
                            </p>
                            <p class="cta">
                                <a href="{{ route('ppdb.create') }}" class="btn btn-master btn-login">
                                    Daftar Sekarang
                                </a>
                            </p>
                        </div>
                        <div class="col-lg-6 col-12 text-center">
                            <a href="#">
                                <img src="{{ asset('app/assets/images/banner.png') }}" class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="benefits" id="Keunggulan">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        Mengapa Memilih Sekolah Kristen Yahya?
                    </p>
                    <h2 class="primary-header">
                        Rasakan Keunggulan CERDAS Bersama Kami!
                    </h2>
                </div>
            </div>
            <div class="row justify-items-center justify-content-center">
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic_globe.png') }}" class="icon" alt="">
                        <h3 class="title">
                            Seimbang
                        </h3>
                        <p class="support">
                            Pendekatan pembelajaran yang menekankan keseimbangan kecerdasan intelektual, emosional, dan
                            spiritual.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic_globe-1.png') }}" class="icon" alt="">
                        <h3 class="title">
                            Maju
                        </h3>
                        <p class="support">
                            Pengajaran terkini yang mengikuti perkembangan teknologi dan metode pembelajaran terbaru.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic_globe-2.png') }}" class="icon" alt="">
                        <h3 class="title">
                            Alkitabiah
                        </h3>
                        <p class="support">
                            Integrasi nilai-nilai Kristen dan ajaran Alkitab dalam seluruh aspek pembelajaran.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-items-center justify-content-center">
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic_globe-3.png') }}" class="icon" alt="">
                        <h3 class="title">
                            Ramah
                        </h3>
                        <p class="support">
                            Kolaborasi antara siswa, guru, dan orang tua untuk menciptakan atmosfer positif.
                        </p>
                    </div>
                </div>
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic_globe-3.png') }}" class="icon" alt="">
                        <h3 class="title">
                            Tertib
                        </h3>
                        <p class="support">
                            Disiplin yang diajarkan dengan pendekatan pedagogis yang mendukung perkembangan pribadi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="steps">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        Pendaftaran PPDB yang Mudah dalam 3 Langkah Sederhana
                    </p>
                    <h2 class="primary-header">
                        Bergabunglah dengan Komunitas Pembelajaran CERDAS Kami dengan Mudah
                    </h2>
                </div>
            </div>
            <div class="row item-step pb-70">
                <div class="col-lg-6 col-12 text-center">
                    <img src="{{ asset('app/assets/images/step1.png') }}" class="cover" alt="">
                </div>
                <div class="col-lg-6 col-12 text-left copywriting">
                    <p class="story">
                        Jelajahi
                    </p>
                    <h2 class="primary-header">
                        Jelajahi Program Kami
                    </h2>
                    <p class="support">
                        Temukan kesesuaian yang tepat <br> untuk minat dan tujuan Anda.
                    </p>
                    <p class="mt-5">
                        <a href="#" class="btn btn-master btn-secondary me-3">
                            Jelajahi Program
                        </a>
                    </p>
                </div>
            </div>
            <div class="row item-step pb-70">
                <div class="col-lg-6 col-12 text-left copywriting pl-150">
                    <p class="story">
                        Daftar
                    </p>
                    <h2 class="primary-header">
                        Daftar dengan Mudah
                    </h2>
                    <p class="support">
                        Cukup isi Informasi Sekolah, Informasi Siswa, dan Informasi Orang Tua.
                    </p>
                    <p class="mt-5">
                        <a href="{{ route('ppdb.create') }}" class="btn btn-master btn-login">
                            Daftar PPDB
                        </a>
                    </p>
                </div>
                <div class="col-lg-6 col-12 text-center">
                    <img src="{{ asset('app/assets/images/step2.png') }}" class="cover" alt="">
                </div>

            </div>
            <div class="row item-step">
                <div class="col-lg-6 col-12 text-center">
                    <img src="{{ asset('app/assets/images/step3.png') }}" class="cover" alt="">
                </div>
                <div class="col-lg-6 col-12 text-left copywriting">
                    <p class="story">
                        Konfirmasi
                    </p>
                    <h2 class="primary-header">
                        Bayar dan Tunggu Konfirmasi
                    </h2>
                    <p class="support">
                        Anda dapat membayarnya secara Online atau Offline. Kemudian <br>
                        Duduklah, bersantailah, dan tunggu konfirmasi melalui aplikasi atau situs web PPDB
                    </p>
                    <p class="mt-5">
                        <a href="{{ route('login') }}" class="btn btn-master btn-secondary me-3">
                            Login Akun Perdik
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- <section id="AcceptedStudent" class="pricing">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        Lihat siapa saja yang sudah diterima
                    </p>
                    <h2 class="primary-header text-white">
                        Tabel Penerimaan
                    </h2>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="table-pricing">
                            <table id="ppdbTable" class="table table-striped"
                                style="width:100%; justify-content: center">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Jenjang</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->fullname }}</td>
                                            <td>{{ $student->schoolInformation->educationLevel->level_name }}</td>
                                            <td>
                                                <p style="color: green">{{ $student->status_penerimaan }}
                                                </p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Jenjang</th>
                                        <th>Status</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </section> --}}

    <section class="brands">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        SPONSOR KAMI
                    </p>
                    <h2 class="primary-header">
                        Sekolah Kristen Yahya bekerja sama dengan
                    </h2>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-6 col-12 text-center">
                <img src="{{ asset('app/assets/images/ovs-es.png') }}" alt="">
            </div>
            <div class="col-lg-6 col-12 text-center">
                <img src="{{ asset('app/assets/images/g-suite.png') }}" alt="">
            </div>
        </div>
    </div>
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        CERITA SUKSES SISWA
                    </p>
                    <h2 class="primary-header">
                        Kami Benar-benar Mencintai Sekolah Kristen Yahya
                    </h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="">
                                <p class="message">
                                    Yahya adalah lingkungan ideal untuk mengembangkan ilmu pengetahuan. Dengan guru-guru yang berpengalaman dan teman-teman yang suportif, serta fasilitas yang memadai, Yahya adalah pilihan terpercaya. Pengembangan karakter menjadi fokus utama di sini.
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/fanny_photo.png') }}" class="photo"
                                        alt="">
                                    <div class="info">
                                        <h4 class="name">
                                            Mishel Bryna Nathania
                                        </h4>
                                        <p class="role">
                                            Universitas Padjajaran
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="">
                                <p class="message">
                                    Setiap pelajaran di Yahya dihiasi dengan keberagaman guru-guru yang menghadirkan cerita-cerita bermakna. Hal ini menjadikan setiap jam pelajaran menjadi pengalaman yang tidak monoton.
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/angga.png') }}" class="photo" alt="">
                                    <div class="info">
                                        <h4 class="name">
                                           Steven Nathanael Setiawan
                                        </h4>
                                        <p class="role">
                                            Universitas Diponegoro
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="">
                                <p class="message">
                                    Merasa sangat bahagia dan bersyukur di Yahya, tempat di mana belajar tidak hanya tentang akademik, tapi juga tentang kepemimpinan dan organisasi. Guru-gurunya sangat komunikatif dan teman-temannya baik, tanpa adanya intimidasi. Semoga Yahya terus menjadi berkat bagi banyak orang.
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/beatrice.png') }}" class="photo"
                                        alt="">
                                    <div class="info">
                                        <h4 class="name">
                                            Keisha Grace Kristian
                                        </h4>
                                        <p class="role">
                                            Program Pendidikan IT BCA
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row copyright">
                        <div class="col-lg-12 col-12">
                            <p>
                                Hak Cipta Dilindungi. Dibuat Dengan ❤️ Oleh Departemen IT Yahya
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <script>
        $(document).ready(function() {
            $('#ppdbTable').DataTable();
        });
    </script> --}}
@endsection
