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
                    <h5 class="content-desc">Silahkan Transfer ke rekening berikut BCA <strong>0083481002 </strong>
                        a.n <strong>YAYASAN PENDIDIKAN KRISTEN YAHYA </strong></h5>
                    <h5 class="content-desc">Berikut ini adalah nomor kontak yang dapat Anda hubungi untuk proses pengiriman
                        bukti transfer dan konfirmasi pembayaran:
                        <strong>0813-2210-8575</strong> dan
                        <strong>0852-9011-8600</strong>.
                    </h5>
                    <a class="btn btn-master btn-warning text-white "
                        href="{{ route('print-formmulir-ppdb', ['unique_code' => $student->unique_code]) }}">
                        Print Formulir PPDB
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
