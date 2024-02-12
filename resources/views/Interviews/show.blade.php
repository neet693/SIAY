@extends('Layout.admin-template')
@section('title', 'Interview Show')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Detail Interview</div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Judul</th>
                                    <td>{{ $interview->title }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal</th>
                                    <td>{{ $interview->interview_date }}</td>
                                </tr>
                                <tr>
                                    <th>Waktu</th>
                                    <td>{{ $interview->start_time }} - {{ $interview->end_time }}</td>
                                </tr>
                                <tr>
                                    <th>Metode</th>
                                    <td>{{ $interview->method }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $interview->status }}</td>
                                </tr>
                                <tr>
                                    <th>User</th>
                                    <td>{{ $interview->user->name }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
