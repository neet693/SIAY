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
                        {{-- Student Modal --}}
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#contactModal">
                            Contact Info
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="contactModalLabel">{{ $student->fullname }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="content-desc mb-4">Nickname: {{ $student->nickname }}</h5>
                                        <h5 class="content-desc mb-4">Citizenship: {{ $student->citizenship }}</h5>
                                        <h5 class="content-desc mb-4">Gender: {{ $student->gender }}</h5>
                                        <h5 class="content-desc mb-4">Tempat, Tanggal Lahir:
                                            {{ $student->birth_place }},
                                            {{ $student->birth_date }}</h5>
                                        <h5 class="content-desc mb-4"> Agama:
                                            {{ $student->religion->religion_name }}
                                            |
                                            Bergereja di
                                            {{ $student->church_domicile }}</h5>
                                        <h5 class="content-desc mb-4">Anak ke - {{ $student->child_position }} Dari
                                            {{ $student->child_number }} Bersaudara</h5>
                                        <h5 class="content-desc mb-4">Golongan Darah:
                                            {{ $student->bloodType->type_name }}</h5>
                                        <h5 class="content-desc mb-4"><i class="bi bi-envelope"></i> :
                                            {{ $student->email }}</h5>
                                        <h5 class="content-desc mb-4">Status Tinggal:
                                            {{ $student->residenceStatus->status_name }}
                                        </h5>
                                        <h5 class="content-desc mb-4">Alamat Siswa:
                                            {{ $student->studentAddress->student_province }},
                                            {{ $student->studentAddress->student_regency }},
                                            {{ $student->studentAddress->student_district }},
                                            {{ $student->studentAddress->student_village }},
                                            {{ $student->studentAddress->address }}
                                        </h5>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Student Parent Modal --}}
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#parentModal">
                            Parent Info
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="parentModal" tabindex="-1" aria-labelledby="parentModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="parentModalLabel">Orang Tua dari
                                            {{ $student->fullname }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    @if (!empty($studentParent))
                                        <div class="modal-body">
                                            <h5 class="content-desc mb-4">{{ $studentParent->dad_name }}</h5>
                                            <h5 class="content-desc mb-4">{{ $studentParent->mom_name }}</h5>
                                            <!-- tambahkan penanganan untuk kemungkinan nilai null -->
                                            <h5 class="content-desc mb-4">{{ $studentParent->dad_degree ?? 'N/A' }}
                                            </h5>
                                            <h5 class="content-desc mb-4">{{ $studentParent->mom_degree ?? 'N/A' }}
                                            </h5>
                                            <h5 class="content-desc mb-4">{{ $studentParent->dad_job ?? 'N/A' }}</h5>
                                            <h5 class="content-desc mb-4">{{ $studentParent->mom_job ?? 'N/A' }}</h5>
                                            <h5 class="content-desc mb-4">{{ $studentParent->dad_tel ?? 'N/A' }}</h5>
                                            <h5 class="content-desc mb-4">{{ $studentParent->mom_tel ?? 'N/A' }}</h5>
                                            <!-- tambahkan penanganan untuk alamat orang tua -->
                                            @if ($studentParent->studentParentAddress)
                                                <h5 class="content-desc mb-4">Alamat Orang Tua:
                                                    {{ $studentParent->studentParentAddress->parent_province ?? 'N/A' }},
                                                    {{ $studentParent->studentParentAddress->parent_regency ?? 'N/A' }},
                                                    {{ $studentParent->studentParentAddress->parent_district ?? 'N/A' }},
                                                    {{ $studentParent->studentParentAddress->parent_village ?? 'N/A' }},
                                                    {{ $studentParent->studentParentAddress->address ?? 'N/A' }}
                                                </h5>
                                            @else
                                                <p>Alamat Orang Tua tidak tersedia.</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Wali Modal --}}
                        <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#waliModal">
                            Info Wali
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="waliModal" tabindex="-1" aria-labelledby="waliModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="parentModalLabel">Wali dari
                                            {{ $student->fullname }}
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    @if (!empty($student))
                                        <div class="modal-body">
                                            <h5 class="content-desc mb-4">{{ $student->wali->wali_name ?? 'N/A' }}</h5>
                                            <h5 class="content-desc mb-4">{{ $student->wali->wali_degree ?? 'N/A' }}
                                            </h5>

                                            <h5 class="content-desc mb-4">{{ $student->wali->wali_job ?? 'N/A' }}</h5>
                                            <h5 class="content-desc mb-4">{{ $student->wali->wali_tel ?? 'N/A' }}</h5>
                                            <!-- tambahkan penanganan untuk alamat orang tua -->
                                            @if ($studentParent->studentParentAddress)
                                                <h5 class="content-desc mb-4">Alamat Wali:
                                                    {{ $student->wali->wali_address ?? 'N/A' }}
                                                </h5>
                                            @else
                                                <p>Alamat Wali tidak tersedia.</p>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
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
                <h5 class="content-desc mb-4">Track the flow</h5>

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

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon" src="{{ asset('template/assets/img/home/history/photo-2.png') }}"
                                alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Sintia Siny</h2>

                                <span class="document-desc">Promoted to Accounting Executive</span>
                            </div>
                        </div>
                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <img class="document-icon" src="{{ asset('template/assets/img/home/history/photo-3.png') }}"
                                alt="">

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Jerami Putu</h2>

                                <span class="document-desc">Promoted to Quality Manager</span>
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
                                <div class="modal fade" id="staticBackdrop{{ $transaction->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
