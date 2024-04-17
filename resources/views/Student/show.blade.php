@extends('Layout.admin-template')
@section('title', 'Student Detail')
@section('content')
    <div class="content">
        <div class="row">
            {{-- Student Statistics --}}
            <div class="col-12 col-md-8 col-lg-8">
                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h3 class="statistics-value">{{ $student->fullname }}</h3>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                    </div>

                    <div class="d-flex align-items-center">
                        {{-- Student Level and Academic Year --}}
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            {{ $student->schoolInformation->academicYear->name ?? 'Not available' }}
                            •
                            {{ $student->schoolInformation->educationLevel->level_name ?? 'Not available' }}</span>
                            •
                            {{ $student->payment_method ?? 'Not available' }}</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center">
                        {{-- Button Student Info --}}
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#contactModal">
                            Contact Info
                        </button>

                        <!-- Modal Student Info -->
                        @include('components.modal-show-student-info ')

                        {{-- Button Info orangtua --}}
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#parentModal">
                            Info Orangtua
                        </button>

                        <!-- Modal Info Orangtua -->
                        @include('components.modal-show-parent')

                        <!-- Modal edit orangtua -->
                        @include('components.modal-edit-parent')

                        {{-- Button Wali --}}
                        @if (!empty($student->wali))
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#waliModal">
                                Info Wali
                            </button>
                        @endif

                        <!-- Modal Wali -->
                        @include('components.modal-show-wali')

                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            Data Sekolah
                        </div>
                    </div>

                    <div class="statistics-list">
                        <img class="statistics-image" src="{{ asset('template/assets/img/home/history/photo-4.png') }}"
                            alt="">

                        <img class="statistics-image" src="{{ asset('template/assets/img/home/history/photo-3.png') }}"
                            alt="">
                        <img class="statistics-image" src="{{ asset('template/assets/img/home/history/photo.png') }}"
                            alt="">
                        <img class="statistics-image" src="{{ asset('template/assets/img/home/history/photo-1.png') }}"
                            alt="">
                        <img class="statistics-image" src="{{ asset('template/assets/img/home/history/photo-2.png') }}"
                            alt="">
                    </div>

                </div>
            </div>
            {{-- Family Information --}}
            <div class="col-12 col-md-8 col-lg-4">
                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h3 class="statistics-value">Transaksi terbayarkan</h3>
                        </div>
                    </div>
                    @if (!empty($paidTransactionNames))
                        <p>{{ $paidTransactionNames }}</p>
                    @else
                        <p>Belum ada transaksi yang sudah dibayar.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-lg-6">
                <h2 class="content-title">History</h2>
                <p class="modal-title mb-4">Track the flow</p>

                <div class="document-card">
                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon" src="{{ asset('template/assets/img/home/history/photo.png') }}"
                                alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Amalia Syahrina</h2>

                                <span class="document-desc">Promoted to Sr. Website Designer</span>
                            </div>
                        </div>
                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon" src="{{ asset('template/assets/img/home/history/photo-1.png') }}"
                                alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Ah Park Yo</h2>

                                <span class="document-desc">Promoted to Front-End Developer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <h2 class="content-title">Riwayat Transaksi</h2>
                @if (count($student->transactions) > 0)
                    <div class="document-card">
                        @foreach ($student->transactions as $transaction)
                            <div class="document-item">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="d-flex flex-column justify-content-between align-items-start">
                                        <h2 class="document-title">{{ $transaction->transactionType->name }}</h2>

                                        <span class="document-desc">
                                            {{ number_format($transaction->transactionType->price, 2, ',', '.') }}</span>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-statistics" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ $transaction->id }}">
                                    <i class="bi bi-card-checklist"></i>
                                </button>


                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{ $transaction->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel{{ $transaction->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Pembayaran
                                                    {{ $transaction->transactionType->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Rp
                                                    {{ number_format($transaction->transactionType->price, 2, ',', '.') }}
                                                </h3>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('pay-now') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" id="transaction_id" name="transaction_id"
                                                        value="{{ $transaction->id }}">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    @if (empty($transaction->midtrans_url))
                                                        <button type="submit" class="btn btn-primary">Generate
                                                            Link</button>
                                                    @else
                                                        {{-- <a href="{{ $transaction->midtrans_url }}"
                                                            class="btn btn-primary">Pay Now</a> --}}
                                                        <a href="{{ $transaction->midtrans_url }}"
                                                            class="btn btn-primary {{ $transaction->payment_status === 'paid' ? 'disabled' : '' }} ">{{ $transaction->payment_status === 'paid' ? 'Transaksi Sudah dibayarkan' : 'Pay Now' }}</a>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
