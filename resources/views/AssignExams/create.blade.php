@extends('Layout.admin-template')
@section('title', 'Assign Exam')
@section('content')
    <div class="container mt-5">
        <h1>Assign Exam: {{ $exam->title }}</h1>

        <form action="{{ route('admin.exam.assign.submit', $exam) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="students">Select Students:</label>
                <select name="students[]" id="students" class="form-control" multiple required>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Assign Exam</button>
        </form>
    </div>
@endsection
