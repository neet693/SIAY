@extends('Layout.admin-template')
@section('title', 'Detail Exam')
@section('content')
    <div class="content">
        <div class="row mt-5">
            {{-- Document Card --}}
            <div class="col-12 col-lg-6">
                <h2 class="content-title">Detail Ujian {{ $exam->title }}</h2>
                <h5 class="content-desc mb-4">{{ $exam->description }}</h5>

                <div class="document-card">
                    <div class="document-item">
                        <div class="d-flex justify-content-start align-items-center">
                            <div class="document-icon box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="current"
                                    class="bi bi-clipboard" viewBox="0 0 16 16">
                                    <path
                                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z" />
                                    <path
                                        d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z" />
                                </svg>
                                {{-- <img src="{{ asset('template/assets/img/home/document/archive.svg') }}" alt=""> --}}
                            </div>

                            <div class="d-flex flex-column justify-content-between align-items-start">
                                <h2 class="document-title">{{ $exam->title }}</h2>

                                <span class="document-desc">{{ $exam->duration }} •
                                    {{ $exam->schedule_at->format('d M Y') }}</span>
                            </div>
                        </div>

                        {{-- <button class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button> --}}

                        <a href="#" class="btn-statistics">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mt-10">
                <div class="statistics-card">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column justify-content-between align-items-start">
                            <h5 class="content-desc">Jumlah Soal</h5>

                            <h3 class="statistics-value">{{ $exam->questions->count() }}</h3>
                        </div>

                        {{-- Button Info orangtua --}}
                        <button type="button" class="btn-statistics" data-bs-toggle="modal"
                            data-bs-target="#addQuestionModal">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                        @include('components.modal-add-question')
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5">
                <h2 class="content-title">Daftar Pertanyaan</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Pertanyaan</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exam->questions as $question)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $question->question_text }}</td>
                                    <td>{{ $question->question_type }}</td>
                                    <td>
                                        @foreach ($question->options as $answer)
                                            @if ($answer->is_correct)
                                                <span class="text-success">{{ $question->question_text }}</span>
                                            @endif
                                            <br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
