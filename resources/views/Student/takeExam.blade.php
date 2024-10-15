@extends('Layout.admin-template')
@section('title', 'Layout Ujian')
@section('content')
    <div class="content">
        <div class="row">
            <div>
                <h3>Exam: {{ $exam->title }}</h3>
                <p>{{ $exam->description }}</p>
            </div>
            <p>Ujian berakhir pada: {{ $exam->end_date }}</p>

            <!-- Countdown Timer -->
            <p>Waktu tersisa: <span id="countdown"></span></p>
            <!-- Countdown Display -->
            {{-- <h2>{{ $exam->title }}</h2> --}}

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
                <button type="submit" class="btn btn-primary mb-3">Submit</button>
            </form>
        </div>

    </div>
    <script>
        // Ambil tanggal berakhirnya ujian dari server (dari PHP)
        var endDate = new Date("{{ $exam->end_date }}").getTime();

        // Update timer setiap 1 detik
        var countdownTimer = setInterval(function() {
            // Waktu saat ini
            var now = new Date().getTime();

            // Selisih waktu antara waktu saat ini dan endDate
            var timeRemaining = endDate - now;

            // Hitung hari, jam, menit, dan detik dari timeRemaining
            var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
            var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            // Tampilkan hasilnya di elemen dengan id="countdown"
            document.getElementById("countdown").innerHTML = days + "d " + hours + "h " +
                minutes + "m " + seconds + "s ";

            // Jika hitungan sudah selesai, tampilkan pesan "Waktu habis"
            if (timeRemaining < 0) {
                clearInterval(countdownTimer);
                document.getElementById("countdown").innerHTML = "Waktu habis";
            }
        }, 1000);
    </script>

@endsection
