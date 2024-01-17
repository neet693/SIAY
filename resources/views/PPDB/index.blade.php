@extends('Layout.app')

@section('content')
    <h1>Formulir Pendaftaran</h1>
    <p>Silakan isi formulir pendaftaran berikut:</p>

    <a href="{{ route('ppdb.create') }}" class="btn btn-primary">
        Mulai Pendaftaran
    </a>
@endsection
