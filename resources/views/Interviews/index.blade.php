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
                                <td>{{ $interview->status }}</td>
                                <td>
                                    <a href="{{ route('interview.edit', $interview->id) }}"
                                        class="text-decoration-none link-warning">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('interview.destroy', $interview->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="link-danger text-decoration-none btn">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
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
