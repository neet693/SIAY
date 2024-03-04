@extends('Layout.admin-template')
@section('title', 'Student Dashboard')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2 class="content-title">Statistics</h2>
                <h5 class="content-desc mb-4">Your learning growth</h5>
            </div>

            {{-- Student Statistics --}}
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Student</h5>

                            <h3 class="statistics-value">{{ $students->count() }}</h3>
                        </div>

                        <a class="btn-statistics" href="{{ route('ppdb.create') }}"><img
                                src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
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

            {{-- Parent Statistics --}}
            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Parent</h5>

                            <h3 class="statistics-value">{{ $parents->count() }}</h3>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
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

            <div class="col-12 col-md-6 col-lg-4">
                <div class="statistics-card">

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Projects</h5>

                            <h3 class="statistics-value">150,000,000</h3>
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

        <div class="row mt-5">
            <div class="container">
                <table id="transactionTable" class="table table-striped" style="width:100%; justify-content: center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Jenjang</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->fullname }}</td>
                                <td>{{ $student->schoolInformation->educationLevel->level_name }}</td>
                                <td>{{ $student->status_penerimaan }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Dropdown button
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form method="POST"
                                                    action="{{ route('admin.set.accept', ['unique_code' => $student->unique_code]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Diterima</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form method="POST"
                                                    action="{{ route('admin.set.reject', ['unique_code' => $student->unique_code]) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Ditolak</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
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
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            {{-- Document Card --}}
            <div class="col-12 col-lg-6">
                <h2 class="content-title">Documents</h2>
                <h5 class="content-desc mb-4">Standard procedure</h5>

                <div class="document-card">
                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon box">
                                <img src="{{ asset('template/assets/img/home/document/archive.svg') }}" alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Customer Guide</h2>

                                <span class="document-desc">180 MB • PDF</span>
                            </div>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/download.svg') }}" alt="">
                        </button>

                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon globe">
                                <img src="{{ asset('template/assets/img/home/document/twitch.svg') }}" alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Twitch Record</h2>

                                <span class="document-desc">700 GB • MP4</span>
                            </div>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/download.svg') }}" alt="">
                        </button>

                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon database">
                                <img src="{{ asset('template/assets/img/home/document/database.svg') }}" alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Personas Datasets</h2>

                                <span class="document-desc">11 MB • CSV</span>
                            </div>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/download.svg') }}" alt="">
                        </button>

                    </div>

                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon target">
                                <img src="{{ asset('template/assets/img/home/document/book-open.svg') }}" alt="">
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">Marketing Book</h2>

                                <span class="document-desc">891 MB • PDF</span>
                            </div>
                        </div>

                        <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/download.svg') }}" alt="">
                        </button>

                    </div>


                </div>
            </div>

            {{-- History Card --}}
            <div class="col-12 col-lg-6">
                <h2 class="content-title">Student</h2>
                <h5 class="content-desc mb-4">PPDB Student Tracker</h5>

                <div class="document-card">
                    @foreach ($students as $item)
                        <div class="document-item">
                            {{-- <a href="{{ route('admin.students.show', ['student' => $item->id]) }}" --}}
                            <a href="{{ route('admin.student.show', ['unique_code' => $item->unique_code]) }}"
                                style="text-decoration: none; color: black;">
                                <div class="d-flex justify-content-start align-items-center">
                                    <img class="document-icon"
                                        src="{{ asset('template/assets/img/home/history/photo.png') }}" alt="">

                                    <div class="d-flex flex-column justify-content-between align-items-start">
                                        <h2 class="document-title">{{ $item->fullname }}</h2>

                                        {{ $item->schoolInformation->academicYear->name ?? 'Not available' }}
                                        •
                                        {{ $item->schoolInformation->educationLevel->level_name ?? 'Not available' }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#transactionTable').DataTable(); // #example adalah ID tabel yang ingin Anda terapkan DataTables
        });
    </script>
@endsection
