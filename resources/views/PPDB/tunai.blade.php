@extends('Layout.app2')
@section('content')
    <section class="checkout">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12 col-12">
                    <img src="{{ asset('app/assets/images/ill_register.png') }}" height="300" class="mb-5" alt=" ">
                </div>
                <div class=" col-lg-12 col-12 header-wrap">
                    <p class="story">
                        Selamat!
                    </p>
                    <h2 class="primary-header ">
                        {{ $student->fullname }} Berhasil di Daftarkan
                    </h2>
                    <h5 class="content-desc">Silahkan datang ke sekolah untuk melakukan pembayaran
                        <strong>Tunai</strong> dan Konfirmasi langsung ke admin.
                    </h5>
                </div>
            </div>
        </div>
    </section>
@endsection
