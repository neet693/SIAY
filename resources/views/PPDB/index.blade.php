@extends('Layout.app')

@section('content')
    <h1>Formulir Pendaftaran</h1>
    <p>Silakan isi formulir pendaftaran berikut:</p>

    <a href="{{ route('ppdb.show', ['ppdb' => 'ppdb', 'step' => 1]) }}" class="btn btn-primary">
        Mulai Pendaftaran
    </a>
@endsection
