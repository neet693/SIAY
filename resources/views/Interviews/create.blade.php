@extends('Layout.admin-template')
@section('title', 'Create Interview')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tambah Interview</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('interview.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (Auth::user()->role_id == 2)
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        value="Interview PPDB - {{ Auth::user()->name }}" required>
                                </div>
                            @else
                                <div class="form-group">
                                    <label for="title">Judul</label>
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>
                            @endif

                            <div class="form-group">
                                <label for="interview_date">Tanggal</label>
                                <input type="date" name="interview_date" id="interview_date" class="form-control"
                                    required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="start_time">Waktu Mulai</label>
                                <input type="time" name="start_time" id="start_time" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="end_time">Waktu Selesai</label>
                                <input type="time" name="end_time" id="end_time" class="form-control" required>
                            </div> --}}
                            <div class="form-group">
                                <label for="method">Metode</label>
                                <select name="method" id="method" class="form-control" required>
                                    <option value="">-- Pilih Metode --</option>
                                    <option value="online">Online</option>
                                    <option value="offline">Offline</option>
                                </select>
                            </div>
                            <div class="form-group" id="onlineReason" style="display:none;">
                                <label for="reason">Alasan (jika metode online)</label>
                                <textarea name="reason" id="online_reason" class="form-control" rows="3"></textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" name="status" id="status" class="form-control" required>
                            </div> --}}
                            @if (Auth::user()->role_id === 1)
                                <div class="form-group">
                                    <label for="user_id">User</label>
                                    <select name="user_id" id="user_id" class="form-control"
                                        onchange="updateTitle(this.value)" required>
                                        <option selected disabled>Pilih student</option>
                                        @foreach ($users as $user)
                                            @if ($user->role_id === 3)
                                                <!-- Ganti angka 3 dengan ID role yang sesuai -->
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endif
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const methodSelect = document.querySelector('#method');
            const onlineReason = document.querySelector('#onlineReason');

            methodSelect.addEventListener('change', function() {
                if (this.value === 'online') {
                    onlineReason.style.display = 'block';
                } else {
                    onlineReason.style.display = 'none';
                }
            });

            // Setel visibilitas form alasan sesuai dengan pilihan metode saat load halaman
            if (methodSelect.value === 'online') {
                onlineReason.style.display = 'block';
            } else {
                onlineReason.style.display = 'none';
            }
        });
    </script>
@endsection
