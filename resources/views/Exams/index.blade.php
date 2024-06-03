@extends('Layout.admin-template')
@section('title', 'Exam Dashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row mt-5">
                    <div class="container">
                        <a href="{{ route('admin.exam.create') }}" class="btn btn-primary mb-3">Tambah Ujian</a>
                        <table id="examsTable" class="table table-striped" style="width:100%; justify-content: center">
                            <thead>
                                <tr>
                                    <th>Nama Ujian</th>
                                    <th>Deskripsi</th>
                                    <th>Guru</th>
                                    <th>Durasi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exams as $exam)
                                    <tr>
                                        <td><a href="{{ route('admin.exam.show', $exam->id) }}"
                                                style="none">{{ $exam->title }}</a></td>
                                        <td>{{ $exam->description }}</td>
                                        <td>{{ $exam->teacher->name }}</td>
                                        <td>{{ $exam->duration }}</td>
                                        <td>{{ $exam->schedule_at->format('d M Y') }}</td>
                                        <td>

                                            <form action="{{ route('admin.exam.destroy', $exam->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus ujian ini?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nama Ujian</th>
                                    <th>Deskripsi</th>
                                    <th>Guru</th>
                                    <th>Durasi</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#examsTable').DataTable(); // #example adalah ID tabel yang ingin Anda terapkan DataTables
        });
    </script>
@endsection
