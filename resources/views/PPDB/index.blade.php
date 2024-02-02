@extends('Layout.app2')

@section('content')
    <h1>Formulir Pendaftaran</h1>
    <p>Silakan isi formulir pendaftaran berikut:</p>
    @if (isset($success))
        <div class="alert alert-success">{{ $success }}</div>
    @endif

    <a href="{{ route('ppdb.create') }}" class="btn btn-primary">
        Mulai Pendaftaran
    </a>
@endsection
