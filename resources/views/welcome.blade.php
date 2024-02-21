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
                                Discover <span class="text-purple">SMART <br> Learning</span> With Us!
                            </h1>
                            <p class="support">
                                Empowering Students to Thrive in a Balanced, Progressive, Scripture-based, Friendly, and
                                Disciplined Environment
                            </p>
                            <p class="cta">
                                <a href="{{ route('ppdb.create') }}" class="btn btn-master btn-primary">
                                    Enroll Now
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
            <div class="row brands">
                <div class="col-lg-12 col-12 text-center">
                    <img src="{{ asset('app/assets/images/brands.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="benefits" id="Keunggulan">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        Why Choose Sekolah Kristen Yahya?
                    </p>
                    <h2 class="primary-header">
                        Experience SMART Excellence With Us!
                    </h2>
                </div>
            </div>
            <div class="row justify-items-center justify-content-center">
                <div class="col-lg-3 col-12">
                    <div class="item-benefit">
                        <img src="{{ asset('app/assets/images/ic_globe.png') }}" class="icon" alt="">
                        <h3 class="title">
                            Seimbang (Balanced)
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
                            Maju (Progressive)
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
                            Alkitabiah (Scripture-based)
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
                            Ramah (Friendly)
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
                            Tertib (Disciplined)
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
                        Effortless PPDB Enrollment in 3 Simple Steps
                    </p>
                    <h2 class="primary-header">
                        Join Our SMART Learning Community with Ease
                    </h2>
                </div>
            </div>
            <div class="row item-step pb-70">
                <div class="col-lg-6 col-12 text-center">
                    <img src="{{ asset('app/assets/images/step1.png') }}" class="cover" alt="">
                </div>
                <div class="col-lg-6 col-12 text-left copywriting">
                    <p class="story">
                        Explore
                    </p>
                    <h2 class="primary-header">
                        Explore Our Program
                    </h2>
                    <p class="support">
                        Find the perfect fit <br> for your interests and goals.
                    </p>
                    <p class="mt-5">
                        <a href="#" class="btn btn-master btn-secondary me-3">
                            Learn More
                        </a>
                    </p>
                </div>
            </div>
            <div class="row item-step pb-70">
                <div class="col-lg-6 col-12 text-left copywriting pl-150">
                    <p class="story">
                        Apply
                    </p>
                    <h2 class="primary-header">
                        Apply with ease
                    </h2>
                    <p class="support">
                        Just fillout the School Information, Student Information, and Parent Information.
                    </p>
                    <p class="mt-5">
                        <a href="#" class="btn btn-master btn-secondary me-3">
                            View Demo
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
                        Confirm
                    </p>
                    <h2 class="primary-header">
                        Pay and Await Confirmation
                    </h2>
                    <p class="support">
                        You can pay it via Online or Offiline. Afterwards <br>
                        Sit back, relax, and await confirmation through the PPDB application or website
                    </p>
                    <p class="mt-5">
                        <a href="#" class="btn btn-master btn-secondary me-3">
                            Showcase
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="AcceptedStudent" class="pricing">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        OUR SUPER BENEFITS
                    </p>
                    <h2 class="primary-header text-white">
                        Learn Faster & Better
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
    </section>

    <section class="testimonials">
        <div class="container">
            <div class="row text-center pb-70">
                <div class="col-lg-12 col-12 header-wrap">
                    <p class="story">
                        SUCCESS STUDENTS
                    </p>
                    <h2 class="primary-header">
                        We Really Love Laracamp
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
                                    I was not really into code but after they teach me how to train my logic then I was
                                    really fall in love with code
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/fanny_photo.png') }}" class="photo"
                                        alt="">
                                    <div class="info">
                                        <h4 class="name">
                                            Fanny
                                        </h4>
                                        <p class="role">
                                            Developer at Google
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="">
                                <p class="message">
                                    Code is really important if we want to build a company and strike to the win
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/angga.png') }}" class="photo" alt="">
                                    <div class="info">
                                        <h4 class="name">
                                            Angga
                                        </h4>
                                        <p class="role">
                                            CEO at BWA Corp
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="item-review">
                                <img src="{{ asset('app/assets/images/stars.svg') }}" alt="">
                                <p class="message">
                                    My background is design and art but I do really love how to make my design working
                                    in the development phase
                                </p>
                                <div class="user">
                                    <img src="{{ asset('app/assets/images/beatrice.png') }}" class="photo"
                                        alt="">
                                    <div class="info">
                                        <h4 class="name">
                                            Beatrice
                                        </h4>
                                        <p class="role">
                                            QA at Facebook
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row copyright">
                        <div class="col-lg-12 col-12">
                            <p>
                                All Rights Reserved. Copyright Laracamp BWA Indonesia.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $('#ppdbTable').DataTable();
        });
    </script>
@endsection
