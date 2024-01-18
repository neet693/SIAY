@extends('Layout.app')
@section('content')
    Page Halaman Tunai
    <div class="content">
        <div class="row">
            <div class="statistics-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column justify-content-between align-items-center">
                        <h5 class="content-desc">Selamat, putra anda sudah terdaftar</h5>
                        <h3 class="statistics-value">{{ $student->fullname }}</h3>
                        <h5 class="content-desc">Silahkan datang ke sekolah untuk melakukan pembayaran
                            <strong>Tunai</strong> dan Konfirmasi langsung ke admin.
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
