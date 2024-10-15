@extends('Layout.admin-template')
@section('title', 'Tambah Ujian')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Ujian Baru</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.exam.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="title">Judul Ujian:</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Deskripsi:</label>
                                <textarea name="description" id="description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="teacher_id">Guru:</label>
                                <select name="teacher_id" id="teacher_id" class="form-control" required>
                                    <option value="">Pilih Guru</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="start_date">Jadwal Mulai:</label>
                                <input type="datetime-local" name="start_date" id="start_date" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="end_date">Jadwal Selesai:</label>
                                <input type="datetime-local" name="end_date" id="end_date" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
