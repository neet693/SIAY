@extends('Layout.admin-template')
@section('title', 'Info Murid Baru')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                <h2 class="content-title">Info Murid Baru</h2>
                <h2 class="content-title">Statistics</h2>
                <h5 class="mb-4 content-desc">Update Info Murid Baru</h5>
            </div>


            {{-- Student Statistics --}}
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Pendaftar PPDB</h5>

                            <h3 class="statistics-value">{{ $students->count() }}</h3>
                        </div>

                        {{-- <a href="{{ route('ppdb.create') }}" class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </a> --}}
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
                            <h5 class="content-desc">Menunggu Persetujuan</h5>

                            <h3 class="statistics-value">{{ $menunggu }}</h3>
                        </div>

                    </div>

                    <div class="statistics-list">
                        @foreach ($students->where('status_penerimaan', 'Menunggu Persetujuan')->sortByDesc('created_at')->take(10) as $student)
                            <img class="statistics-image"
                                src="https://ui-avatars.com/api/?name={{ urlencode($student->fullname) }}"
                                alt="studentImage{{ $student->fullname }}" title="{{ $student->fullname }}">
                        @endforeach
                    </div>

                </div>

            </div>

            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Diterima</h5>

                            <h3 class="statistics-value">{{ $diterima }}</h3>
                        </div>

                    </div>

                    <div class="statistics-list">
                        @foreach ($students->where('status_penerimaan', 'Diterima')->sortByDesc('created_at')->take(10) as $student)
                            <img class="statistics-image"
                                src="https://ui-avatars.com/api/?name={{ urlencode($student->fullname) }}"
                                alt="studentImage{{ $student->fullname }}" title="{{ $student->fullname }}">
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
        <!--Table Student -->
        <div class="mt-5 row">
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
                                                    <a class="btn btn-link link-warning d-inline-block text-decoration-none"
                                                        title="Print Formulir{{ $student->fullname }}"
                                                        href="{{ route('print-formmulir-ppdb', ['unique_code' => $student->unique_code]) }}">
                                                        Print Formulir
                                                    </a>
                                                </li>
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

    </div>
@endsection
