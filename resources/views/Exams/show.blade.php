@extends('Layout.admin-template')
@section('title', 'Detail Exam')
@section('content')
    <div class="container">
        <h1>{{ $exam->title }}</h1>
        <h1>{{ $exam->description }}</h1>
        <h1>{{ $exam->duration }}</h1>
        <h1>{{ $exam->teacher->name }}</h1>
    </div>
@endsection
