@extends('Layout.app2')
@section('content')
    <section class="checkout">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12 col-12">
                    <img src="{{ asset('app/assets/images/ill_register.png') }}" height="400" class="mb-5" alt=" ">
                </div>
                <div class=" col-lg-12 col-12 header-wrap mt-4">
                    <p class="story">
                        Selamat! {{ $transaction->student->fullname }}
                    </p>
                    <h2 class="primary-header ">
                        {{-- Berhasil Checkout --}}
                        Status Payment anda adalah {{ $transaction->payment_status }}
                    </h2>
                    {{-- <a href="#" class="btn btn-primary mt-3">
                        My Dashboard
                    </a> --}}
                </div>
            </div>
        </div>
    </section>
@endsection
