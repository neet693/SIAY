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
        <!-- Table Student -->
        <div class="mt-5 row">
            <div class="container">
                <div class="table-responsive">
                    <table id="studentTable" class="table align-middle table-bordered table-hover">
                        <thead class="text-center table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Jenjang</th>
                                <th>Tahun Ajaran</th>
                                <th>Status Penerimaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.student.show', ['unique_code' => $student->unique_code]) }}"
                                            class="text-decoration-none text-dark fw-semibold">
                                            {{ $student->fullname }}
                                        </a>
                                        <br>
                                        <small class="text-muted">Kode: {{ $student->unique_code }}</small>
                                        <br>
                                        <small class="text-muted">Tanggal Daftar:
                                            {{ $student->created_at->translatedFormat('d F Y, H:i') }}</small>
                                    </td>
                                    <td class="text-center">{{ $student->schoolInformation->educationLevel->level_name }}
                                    </td>
                                    <td class="text-center">{{ $student->schoolInformation->academicYear->name }}</td>
                                    <td class="text-center">
                                        @php
                                            $status = $student->status_penerimaan;
                                            $badgeClass = match ($status) {
                                                'Diterima' => 'success',
                                                'Batal' => 'danger',
                                                default => 'secondary',
                                            };
                                        @endphp
                                        <span class="badge bg-{{ $badgeClass }}">{{ $status }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if ($student->status_penerimaan != 'Diterima')
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-outline-primary dropdown-toggle"
                                                    type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pilih Aksi
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item text-warning"
                                                            title="Print Formulir {{ $student->fullname }}"
                                                            href="{{ route('print-formmulir-ppdb', ['unique_code' => $student->unique_code]) }}">
                                                            🖨️ Print Formulir
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('admin.set.accept', ['unique_code' => $student->unique_code]) }}">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-success">✅
                                                                Diterima</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form method="POST"
                                                            action="{{ route('admin.set.reject', ['unique_code' => $student->unique_code]) }}">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item text-danger">❌
                                                                Batal</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <span class="text-success">✔ Sudah Diterima</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="text-center table-light">
                            <tr>
                                <th>No.</th>
                                <th>Nama Lengkap</th>
                                <th>Jenjang</th>
                                <th>Tahun Ajaran</th>
                                <th>Status Penerimaan</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
