@extends('Layout.admin-template')
@section('title', 'Interview Dashboard')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Total Interview</h5>

                            <h3 class="statistics-value">{{ $interviews->count() }}</h3>
                        </div>

                        {{-- <a href="{{ route('admin.interviews.create') }}" class="btn-statistics"> --}}
                        <a href="{{ route('interview.create') }}" class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Interview Selesai</h5>

                            <h3 class="statistics-value">{{ $acceptedInterview }}</h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6 col-lg-4">

                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Interview Dibatalkan</h5>

                            <h3 class="statistics-value"></h3>
                        </div>
                    </div>
                </div>

            </div>
            <div class="container">
                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($interviews as $interview)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('interview.show', $interview->id) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $interview->user->name }}
                                    </a>
                                </td>
                                <td>{{ $interview->method }}</td>
                                <td>
                                    <span
                                        class="badge rounded-pill {{ $interview->status == 'Ditolak' ? 'text-bg-danger' : ($interview->status == 'Selesai' ? 'text-bg-success' : 'text-bg-info') }}">{{ $interview->status }}</span>

                                </td>
                                <td>
                                    @if ($interview->status == 'Dijadwalkan')
                                        <form method="POST"
                                            action="{{ route('end-interview', ['id' => $interview->id]) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-link link-success">
                                                <i class="bi bi-check-circle"></i>
                                            </button>
                                        </form>
                                        <button href="#addZoomModal" data-bs-toggle="modal"
                                            class="btn btn-link link-success d-inline-block"
                                            title="Set Link Zoom {{ $interview->user->name }}">
                                            <i class="bi bi-camera-video"></i>
                                        </button>
                                        @include('components.modal-add-zoom')
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Method</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#example').DataTable(); // #example adalah ID tabel yang ingin Anda terapkan DataTables
        });
    </script>

@endsection
