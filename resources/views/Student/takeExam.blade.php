@extends('Layout.admin-template')
@section('title', 'Layout Ujian')
@section('content')
    <div class="content">
        <div class="row">
            <h2>{{ $exam->title }}</h2>
            <p>{{ $exam->description }}</p>

            <form action="{{ route('student.submit-exam', $exam->id) }}" method="post">
                @csrf
                @foreach ($exam->questions as $question)
                    <div>
                        <p>{{ $question->question_text }}</p>
                        <!-- Tambahkan input untuk menjawab pertanyaan sesuai dengan tipe pertanyaan -->
                        @if ($question->question_type === 'multiple_choice')
                            <!-- Tampilkan opsi pilihan -->
                            @foreach ($question->options as $option)
                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->id }}">
                                <label>{{ $option->option_text }}</label>
                            @endforeach
                        @elseif($question->question_type === 'true_false')
                            <!-- Tampilkan opsi benar atau salah -->
                            <input type="radio" name="answers[{{ $question->id }}]" value="true">
                            <label>True</label>
                            <input type="radio" name="answers[{{ $question->id }}]" value="false">
                            <label>False</label>
                        @elseif($question->question_type === 'short_answer' || $question->question_type === 'essay')
                            <!-- Tampilkan input teks untuk menjawab -->
                            <input type="text" name="answers[{{ $question->id }}]">
                        @endif
                    </div>
                @endforeach
                <button type="submit">Submit</button>
            </form>
        </div>

    </div>
    </div>
@endsection
