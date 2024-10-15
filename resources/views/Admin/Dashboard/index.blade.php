@extends('Layout.admin-template')
@section('title', 'Dashboard')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2 class="content-title">Dashboard</h2>
                <h2 class="content-title">Statistics</h2>
                <h5 class="content-desc mb-4">Your business growth</h5>
            </div>


            {{-- PPDB Statistics --}}
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Pendaftar PPDB</h5>

                            <h3 class="statistics-value">{{ $students->count() }}</h3>
                        </div>

                        <a href="{{ route('ppdb.create') }}" class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </a>
                    </div>

                    <div class="statistics-list">
                        @foreach ($students->sortByDesc('created_at')->take(10) as $student)
                            <img class="statistics-image" src="https://ui-avatars.com/api/?name={{ $student->fullname }}"
                                alt="studentImage{{ $student->fullname }}" title="{{ $student->fullname }}">
                        @endforeach
                    </div>

                </div>

            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Pendapatan</h5>

                            <h3 class="statistics-value">Rp {{ number_format($PaidTransaction, 2, ',', '.') }}</h3>
                            </h3>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                    </div>

                    <div class="statistics-list">
                        <div class="statistics-icon one">
                            <span>SK</span>
                        </div>
                        <div class="statistics-icon two">
                            <span>DW</span>
                        </div>
                        <div class="statistics-icon three">
                            <span>FJ</span>
                        </div>
                        <div class="statistics-icon four">
                            <span>AP</span>
                        </div>
                        <div class="statistics-icon five">
                            <span>ML</span>
                        </div>
                        <!-- <img src="./assets/img/home/icon-1.png" alt=""><img src="./assets/img/home/icon-2.png" alt=""><img src="./assets/img/home/icon-3.png" alt=""><img src="./assets/img/home/icon-4.png" alt=""><img src="./assets/img/home/icon-5.png" alt=""> -->
                    </div>

                </div>

            </div>


            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Unpaid PPDB</h5>

                            <h3 class="statistics-value">Rp {{ number_format($PPDBUnpaid, 2, ',', '.') }}</h3>
                            </h3>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                    </div>

                    <div class="statistics-list">
                        <div class="statistics-icon one">
                            <span>SK</span>
                        </div>
                        <div class="statistics-icon two">
                            <span>DW</span>
                        </div>
                        <div class="statistics-icon three">
                            <span>FJ</span>
                        </div>
                        <div class="statistics-icon four">
                            <span>AP</span>
                        </div>
                        <div class="statistics-icon five">
                            <span>ML</span>
                        </div>
                        <!-- <img src="./assets/img/home/icon-1.png" alt=""><img src="./assets/img/home/icon-2.png" alt=""><img src="./assets/img/home/icon-3.png" alt=""><img src="./assets/img/home/icon-4.png" alt=""><img src="./assets/img/home/icon-5.png" alt=""> -->
                    </div>

                </div>

            </div>
        </div>

        <!--Table Pembayaran -->
        <div class="row mt-5">
            <div class="container">
                <table id="transactionTable" class="table table-striped" style="width:100%; justify-content: center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.student.show', ['unique_code' => $transaction->student->unique_code]) }}"
                                        style="text-decoration: none;">
                                        {{ $transaction->student->fullname }}
                                    </a>
                                </td>
                                <td>{{ $transaction->transactionType->name }}</td>
                                <td>{{ $transaction->payment_status }}</td>
                                <td>
                                    <form method="POST"
                                        action="{{ route('admin.set.paid', ['booking_code' => $transaction->midtrans_booking_code]) }}"
                                        style="{{ $transaction->payment_status == 'paid' ? 'display: none' : '' }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Set to Paid</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <!--Table Student -->
        <div class="row mt-5">
            <div class="container">
                <table id="studentTable" class="table table-striped" style="width:100%; justify-content: center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenjang</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.student.show', ['unique_code' => $student->unique_code]) }}"
                                        style="text-decoration: none; color: black;">
                                        {{ $student->fullname }}
                                    </a>
                                </td>
                                <td>{{ $student->schoolInformation->educationLevel->level_name }}</td>
                                <td>{{ $student->schoolInformation->academicYear->name }}</td>
                                <td>{{ $student->status_penerimaan }}</td>
                                <td>
                                    @if ($student->status_penerimaan != 'Diterima')
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                Pilih Aksi
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('admin.set.accept', ['unique_code' => $student->unique_code]) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="link-success text-decoration-none btn">Diterima</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form method="POST" class="d-inline"
                                                        action="{{ route('admin.set.reject', ['unique_code' => $student->unique_code]) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="link-danger text-decoration-none btn">Ditolak</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif
                                    <a class="btn btn-link link-success d-inline-block"
                                        title="Print Formulir{{ $student->fullname }}"
                                        href="{{ route('print-formmulir-ppdb', ['unique_code' => $student->unique_code]) }}">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenjang</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12 col-lg-6">
                <h2 class="content-title">Quick Links</h2>
                <h5 class="content-desc mb-4">Tautan Cepat
                </h5>

                <div class="document-card">
                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon box">
                                <img src="{{ asset('template/assets/img/home/document/cash.svg') }}" alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Pembayaran Siswa</h2>

                                <span class="document-desc">Tambah pembayaran Siswa</span>
                            </div>
                        </div>

                        <a href="{{ route('admin.assignment.payment') }}">
                            <button class="btn-statistics">
                                <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                            </button>
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <h2 class="content-title">Student</h2>
                <h5 class="content-desc mb-4">PPDB Student Tracker</h5>

                <div class="document-card">
                    @php
                        // Sesuaikan dengan timezone lokal Anda
                        $timezone = 'Asia/Jakarta'; // Ganti dengan timezone yang sesuai
                        $oneMonthAgo = now()->setTimezone($timezone)->subMonth();
                        $hasStudents = false; // Flag untuk mengecek ada siswa
                    @endphp

                    @foreach ($students as $item)
                        @if ($item->created_at > $oneMonthAgo)
                            <div class="document-item">
                                <a href="{{ route('admin.student.show', ['unique_code' => $item->unique_code]) }}"
                                    style="text-decoration: none; color: black;">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <img class="document-icon"
                                            src="{{ asset('template/assets/img/home/history/photo.png') }}"
                                            alt="">

                                        <div class="d-flex flex-column justify-content-between align-items-start">
                                            <h2 class="document-title">{{ $item->fullname }}</h2>
                                            {{ $item->schoolInformation->academicYear->name ?? 'Not available' }}
                                            •
                                            {{ $item->schoolInformation->educationLevel->level_name ?? 'Not available' }}</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @php
                                $hasStudents = true; // Set flag ke true jika ada siswa
                            @endphp
                        @endif
                    @endforeach

                    @if (!$hasStudents)
                        <p>Tidak ada siswa yang terdaftar dalam sebulan terakhir.</p>
                    @endif
                </div>
            </div>


        </div>
    </div>
@endsection
