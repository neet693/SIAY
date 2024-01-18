@extends('Layout.app')
@section('content')
    Page Halaman Transfer
    <div class="content">
        <div class="row">
            {{-- Student Statistics --}}
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-center">
                            <h5 class="content-desc">Selamat, putra anda sudah terdaftar</h5>

                            <h3 class="statistics-value">{{ $student->fullname }}</h3>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                    </div>
                    <button>Bayar Sekarang</button>
                </div>

            </div>
        </div>
    </div>
@endsection
