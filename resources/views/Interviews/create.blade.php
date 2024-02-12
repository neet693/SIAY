@extends('Layout.admin-template')
@section('title', 'Create Interview')
@section('content')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Interview</div>
                    <div class="card-body">
                        <form action="{{ route('interviews.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="interview_date">Tanggal</label>
                                <input type="date" name="interview_date" id="interview_date" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="start_time">Waktu Mulai</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="end_time">Waktu Selesai</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="method">Metode</label>
                                <select name="method" id="method" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control" required>
                            </div>
                            @if (Auth::user()->role_id === 1)
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">-- Pilih User --</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled>
                                </div>

                            @endif
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection
