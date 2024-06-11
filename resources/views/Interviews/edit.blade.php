@extends('Layout.admin-template')
@section('title', 'Edit Interview')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Interview</div>
                    <div class="card-body">
                        <form action="{{ route('interview.update', $interview->slug) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ old('title', $interview->title) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="interview_date">Tanggal</label>
                                <input type="date" name="interview_date" id="interview_date" class="form-control"
                                    value="{{ old('interview_date', $interview->interview_date->format('Y-m-d')) }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="method">Metode</label>
                                <select name="method" id="method" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="online"
                                        {{ old('method', $interview->method) == 'online' ? 'selected' : '' }}>Online
                                    </option>
                                    <option value="offline"
                                        {{ old('method', $interview->method) == 'offline' ? 'selected' : '' }}>Offline
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control"
                                    value="{{ old('status', $interview->status) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">-- Pilih User --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id', $interview->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
