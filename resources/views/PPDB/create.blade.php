@extends('Layout.app2')

@section('content')

    <div class="ppdb-page">

        {{-- =========================================================
        HEADER
        ========================================================= --}}
        <section class="ppdb-header">

            <div class="container">

                <div class="ppdb-header-content">

                    <span class="ppdb-label">
                        PPDB SEKOLAH KRISTEN YAHYA
                    </span>

                    <h1>
                        Mulai Perjalanan
                        <span>Putra-Putri Anda</span>
                    </h1>

                    <p>
                        Lengkapi informasi pendaftaran dengan teliti.
                        Kami akan menggunakan informasi ini untuk
                        membantu proses penerimaan peserta didik baru.
                    </p>

                </div>

            </div>

        </section>


        {{-- =========================================================
        FORM
        ========================================================= --}}
        <section class="ppdb-form-section">

            <div class="container">

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="ppdb-alert ppdb-alert-danger">

                        <div class="ppdb-alert-icon">
                            !
                        </div>

                        <div>
                            <strong>
                                Mohon periksa kembali data Anda.
                            </strong>

                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                @endif


                {{-- =================================================
                PROGRESS
                ================================================= --}}
                <div class="ppdb-progress">

                    <div class="progress-item active" data-step="1">

                        <div class="progress-number">
                            01
                        </div>

                        <div class="progress-text">
                            <small>Langkah 01</small>
                            <strong>Sekolah</strong>
                        </div>

                    </div>


                    <div class="progress-line"></div>


                    <div class="progress-item" data-step="2">

                        <div class="progress-number">
                            02
                        </div>

                        <div class="progress-text">
                            <small>Langkah 02</small>
                            <strong>Siswa</strong>
                        </div>

                    </div>


                    <div class="progress-line"></div>


                    <div class="progress-item" data-step="3">

                        <div class="progress-number">
                            03
                        </div>

                        <div class="progress-text">
                            <small>Langkah 03</small>
                            <strong>Orangtua</strong>
                        </div>

                    </div>


                    <div class="progress-line"></div>


                    <div class="progress-item" data-step="4">

                        <div class="progress-number">
                            04
                        </div>

                        <div class="progress-text">
                            <small>Langkah 04</small>
                            <strong>Wawancara</strong>
                        </div>

                    </div>

                </div>


                {{-- =================================================
                FORM CARD
                ================================================= --}}
                <div class="ppdb-card">

                    <form action="{{ route('ppdb.store') }}" method="post">

                        @csrf

                        <input type="hidden" name="transaction_type_id" value="1">


                        {{-- =================================================
                        STEP 1
                        ================================================= --}}
                        <div class="step" id="step1">

                            <div class="step-header">

                                <span class="step-label">
                                    LANGKAH 01
                                </span>

                                <h2>
                                    Informasi Sekolah
                                </h2>

                                <p>
                                    Tentukan jenjang pendidikan dan
                                    informasi awal pendaftaran.
                                </p>

                            </div>


                            <div class="form-section">

                                <div class="form-section-title">
                                    <span>01</span>
                                    Pilihan Pendidikan
                                </div>


                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="grade">
                                                Jenjang
                                            </label>

                                            <select
                                                class="form-control-modern {{ $errors->has('education_level_id') ? 'is-invalid' : '' }}"
                                                id="grade" name="education_level_id" required>

                                                <option selected disabled>
                                                    Pilih Jenjang
                                                </option>

                                                <option value="1"
                                                    {{ old('education_level_id') == 1 ? 'selected' : '' }}>
                                                    TK
                                                </option>

                                                <option value="2"
                                                    {{ old('education_level_id') == 2 ? 'selected' : '' }}>
                                                    SD
                                                </option>

                                                <option value="3"
                                                    {{ old('education_level_id') == 3 ? 'selected' : '' }}>
                                                    SMP
                                                </option>

                                                <option value="4"
                                                    {{ old('education_level_id') == 4 ? 'selected' : '' }}>
                                                    SMA
                                                </option>

                                            </select>

                                            @error('education_level_id')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="academicYear">
                                                Tahun Ajaran
                                            </label>

                                            <select
                                                class="form-control-modern {{ $errors->has('academic_year_id') ? 'is-invalid' : '' }}"
                                                id="academicYear" name="academic_year_id" required>

                                                <option selected disabled>
                                                    Pilih Tahun Ajaran
                                                </option>

                                                @foreach ($academicYears as $year)
                                                    <option value="{{ $year->id }}"
                                                        {{ old('academic_year_id') == $year->id ? 'selected' : '' }}>

                                                        {{ $year->name }}

                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('academic_year_id')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="form-section">

                                <div class="form-section-title">
                                    <span>02</span>
                                    Informasi Pendaftaran
                                </div>


                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="yahyaNews">
                                                Mengetahui Sekolah Kristen Yahya dari
                                            </label>

                                            <input type="text"
                                                class="form-control-modern {{ $errors->has('news_from') ? 'is-invalid' : '' }}"
                                                id="yahyaNews" name="news_from" placeholder="Contoh: Dari Teman"
                                                value="{{ old('news_from') }}" required>

                                            @error('news_from')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="lastSchool">
                                                Asal Sekolah
                                            </label>

                                            <input type="text"
                                                class="form-control-modern {{ $errors->has('last_school') ? 'is-invalid' : '' }}"
                                                id="lastSchool" name="last_school" placeholder="Contoh: TK Yahya"
                                                value="{{ old('last_school') }}" required>

                                            @error('last_school')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="step-actions">

                                <button type="button" class="ppdb-button ppdb-button-primary" id="nextButtonStep1"
                                    onclick="nextStep(2)">

                                    <span>
                                        Selanjutnya
                                    </span>

                                    <span class="button-arrow">
                                        →
                                    </span>

                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                        STEP 2
                        ================================================= --}}
                        <div class="step" id="step2">

                            <div class="step-header">

                                <span class="step-label">
                                    LANGKAH 02
                                </span>

                                <h2>
                                    Informasi Siswa
                                </h2>

                                <p>
                                    Lengkapi identitas calon peserta didik
                                    secara lengkap dan benar.
                                </p>

                            </div>


                            <div class="ppdb-info">

                                <div class="ppdb-info-icon">
                                    i
                                </div>

                                <div>

                                    <strong>
                                        Informasi penting
                                    </strong>

                                    <p>
                                        Jika Kabupaten, Kota, atau Desa tidak
                                        muncul, pilih Provinsi lain terlebih dahulu
                                        untuk memuat data wilayah.
                                    </p>

                                </div>

                            </div>


                            {{-- IDENTITAS --}}

                            <div class="form-section">

                                <div class="form-section-title">
                                    <span>01</span>
                                    Identitas Siswa
                                </div>


                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="fullName">
                                                Nama Lengkap
                                            </label>

                                            <input type="text"
                                                class="form-control-modern {{ $errors->has('fullname') ? 'is-invalid' : '' }}"
                                                id="fullName" name="fullname" placeholder="Nama lengkap siswa"
                                                value="{{ old('fullname') }}" required>

                                            @error('fullname')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="nickName">
                                                Nama Panggilan
                                            </label>

                                            <input type="text"
                                                class="form-control-modern {{ $errors->has('nickname') ? 'is-invalid' : '' }}"
                                                id="nickName" name="nickname" placeholder="Nama panggilan"
                                                value="{{ old('nickname') }}" required>

                                            @error('nickname')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label>
                                                Kewarganegaraan
                                            </label>

                                            <div class="radio-group">

                                                <label class="radio-card">

                                                    <input type="radio" name="citizenship" value="wni"
                                                        {{ old('citizenship') == 'wni' ? 'checked' : '' }} required>

                                                    <span>
                                                        WNI
                                                    </span>

                                                </label>


                                                <label class="radio-card">

                                                    <input type="radio" name="citizenship" value="wna"
                                                        {{ old('citizenship') == 'wna' ? 'checked' : '' }} required>

                                                    <span>
                                                        WNA
                                                    </span>

                                                </label>

                                            </div>

                                            @error('citizenship')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label>
                                                Jenis Kelamin
                                            </label>

                                            <div class="radio-group">

                                                <label class="radio-card">

                                                    <input type="radio" name="gender" value="male"
                                                        {{ old('gender') == 'male' ? 'checked' : '' }}>

                                                    <span>
                                                        Laki-laki
                                                    </span>

                                                </label>


                                                <label class="radio-card">

                                                    <input type="radio" name="gender" value="female"
                                                        {{ old('gender') == 'female' ? 'checked' : '' }}>

                                                    <span>
                                                        Perempuan
                                                    </span>

                                                </label>

                                            </div>

                                            @error('gender')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- DATA LAHIR --}}

                            <div class="form-section">

                                <div class="form-section-title">
                                    <span>02</span>
                                    Data Kelahiran & Pribadi
                                </div>


                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="birthPlace">
                                                Tempat Lahir
                                            </label>

                                            <input type="text" class="form-control-modern" id="birthPlace"
                                                name="birth_place" placeholder="Contoh: Bandung"
                                                value="{{ old('birth_place') }}" required>

                                            @error('birth_place')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="birthDate">
                                                Tanggal Lahir
                                            </label>

                                            <input type="date"
                                                class="form-control-modern {{ $errors->has('birth_date') ? 'is-invalid' : '' }}"
                                                id="birthDate" name="birth_date" value="{{ old('birth_date') }}"
                                                required>

                                            @error('birth_date')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group-modern">

                                            <label for="userReligion">
                                                Agama
                                            </label>

                                            <select class="form-control-modern" id="userReligion" name="religion_id"
                                                required>

                                                <option selected disabled>
                                                    Pilih Agama
                                                </option>

                                                <option value="1" {{ old('religion_id') == 1 ? 'selected' : '' }}>
                                                    Kristen
                                                </option>

                                                <option value="2" {{ old('religion_id') == 2 ? 'selected' : '' }}>
                                                    Katholik
                                                </option>

                                                <option value="3" {{ old('religion_id') == 3 ? 'selected' : '' }}>
                                                    Islam
                                                </option>

                                                <option value="4" {{ old('religion_id') == 4 ? 'selected' : '' }}>
                                                    Hindu
                                                </option>

                                                <option value="5" {{ old('religion_id') == 5 ? 'selected' : '' }}>
                                                    Buddha
                                                </option>

                                                <option value="6" {{ old('religion_id') == 6 ? 'selected' : '' }}>
                                                    Konghucu
                                                </option>

                                            </select>

                                            @error('religion_id')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group-modern">

                                            <label for="childPosition">
                                                Anak Ke
                                            </label>

                                            <input type="number" class="form-control-modern" id="childPosition"
                                                name="child_position" min="1" max="20"
                                                placeholder="Contoh: 1" value="{{ old('child_position') }}" required>

                                            @error('child_position')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group-modern">

                                            <label for="childNumber">
                                                Jumlah Saudara
                                            </label>

                                            <input type="number" class="form-control-modern" id="childNumber"
                                                name="child_number" min="1" max="20"
                                                placeholder="Contoh: 2" value="{{ old('child_number') }}" required>

                                            @error('child_number')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="chruchDomicile">
                                                Berjemaat di
                                            </label>

                                            <input type="text" class="form-control-modern" id="chruchDomicile"
                                                name="church_domicile" placeholder="Contoh: GKI Taman Cibunut"
                                                value="{{ old('church_domicile') }}" required>

                                            @error('church_domicile')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="userBloodType">
                                                Golongan Darah
                                            </label>

                                            <select class="form-control-modern" id="userBloodType" name="blood_type_id"
                                                required>

                                                <option selected disabled>
                                                    Pilih Golongan Darah
                                                </option>

                                                <option value="1" {{ old('blood_type_id') == 1 ? 'selected' : '' }}>
                                                    A
                                                </option>

                                                <option value="2" {{ old('blood_type_id') == 2 ? 'selected' : '' }}>
                                                    B
                                                </option>

                                                <option value="3" {{ old('blood_type_id') == 3 ? 'selected' : '' }}>
                                                    AB
                                                </option>

                                                <option value="4" {{ old('blood_type_id') == 4 ? 'selected' : '' }}>
                                                    O
                                                </option>

                                            </select>

                                            @error('blood_type_id')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="userStay">
                                                Status Tinggal
                                            </label>

                                            <select class="form-control-modern" id="userStay" name="residence_status_id"
                                                required>

                                                <option selected disabled>
                                                    Pilih Status Tinggal
                                                </option>

                                                <option value="1"
                                                    {{ old('residence_status_id') == 1 ? 'selected' : '' }}>
                                                    Bersama Orang Tua
                                                </option>

                                                <option value="2"
                                                    {{ old('residence_status_id') == 2 ? 'selected' : '' }}>
                                                    Bersama Saudara
                                                </option>

                                                <option value="3"
                                                    {{ old('residence_status_id') == 3 ? 'selected' : '' }}>
                                                    Asrama
                                                </option>

                                                <option value="4"
                                                    {{ old('residence_status_id') == 4 ? 'selected' : '' }}>
                                                    Kost
                                                </option>

                                            </select>

                                            @error('residence_status_id')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="userEmail">
                                                Alamat Email
                                            </label>

                                            <input type="email" class="form-control-modern" id="userEmail"
                                                name="email" placeholder="name@gmail.com"
                                                pattern="[a-zA-Z0-9._%+-]+@gmail\.com" value="{{ old('email') }}"
                                                required>

                                            @error('email')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- ALAMAT SISWA --}}

                            <div class="form-section" id="studentAddressRow" style="display: none;">

                                <div class="form-section-title">
                                    <span>03</span>
                                    Alamat Siswa
                                </div>


                                <div class="row g-4">

                                    <div class="col-md-6">
                                        <div class="form-group-modern">

                                            <label for="province">
                                                Provinsi
                                            </label>

                                            <select class="form-control-modern" id="province" name="student_province">

                                                <option selected disabled>
                                                    Pilih Provinsi
                                                </option>

                                            </select>

                                            <input type="hidden" id="student_province" name="province">
                                            <input type="hidden" id="student_province_name"
                                                name="student_province_name">

                                            @error('student_province')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group-modern">

                                            <label for="regency">
                                                Kabupaten / Kota
                                            </label>

                                            <select class="form-control-modern" id="regency" name="student_regency">

                                                <option selected disabled>
                                                    Pilih Kabupaten / Kota
                                                </option>

                                            </select>

                                            <input type="hidden" id="student_regency" name="regency">
                                            <input type="hidden" id="student_regency_name" name="student_regency_name">

                                            @error('student_regency')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group-modern">

                                            <label for="district">
                                                Kecamatan
                                            </label>

                                            <select class="form-control-modern" id="district" name="student_district">

                                                <option selected disabled>
                                                    Pilih Kecamatan
                                                </option>

                                            </select>

                                            <input type="hidden" id="student_district" name="district">
                                            <input type="hidden" id="student_district_name"
                                                name="student_district_name">

                                            @error('student_district')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group-modern">

                                            <label for="village">
                                                Desa / Kelurahan
                                            </label>

                                            <select class="form-control-modern" id="village" name="student_village">

                                                <option selected disabled>
                                                    Pilih Desa / Kelurahan
                                                </option>

                                            </select>

                                            <input type="hidden" id="student_village" name="village">
                                            <input type="hidden" id="student_village_name" name="student_village_name">

                                            @error('student_village')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>
                                    </div>


                                    <div class="col-12">

                                        <div class="form-group-modern">

                                            <label for="address">
                                                Alamat Lengkap
                                            </label>

                                            <textarea class="form-control-modern" id="address" name="address" rows="3"
                                                placeholder="Contoh: Jl. Riau No. 71A">{{ old('address') }}</textarea>

                                            @error('address')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="step-actions">

                                <button type="button" class="ppdb-button ppdb-button-secondary" onclick="prevStep(1)">

                                    ← Sebelumnya

                                </button>


                                <button type="button" class="ppdb-button ppdb-button-primary" id="nextButtonStep2"
                                    onclick="nextStep(3)">

                                    <span>
                                        Selanjutnya
                                    </span>

                                    <span class="button-arrow">
                                        →
                                    </span>

                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                        STEP 3
                        ================================================= --}}
                        <div class="step" id="step3">

                            <div class="step-header">

                                <span class="step-label">
                                    LANGKAH 03
                                </span>

                                <h2>
                                    Informasi Orangtua
                                </h2>

                                <p>
                                    Informasi orangtua atau wali diperlukan
                                    untuk melengkapi data pendaftaran siswa.
                                </p>

                            </div>


                            <div class="ppdb-info">

                                <div class="ppdb-info-icon">
                                    i
                                </div>

                                <div>

                                    <strong>
                                        Informasi wilayah
                                    </strong>

                                    <p>
                                        Jika data Kabupaten, Kota, atau Desa
                                        belum tersedia, pilih Provinsi lain
                                        terlebih dahulu untuk memuat data.
                                    </p>

                                </div>

                            </div>


                            {{-- ORANGTUA --}}

                            <div class="form-section">

                                <div class="form-section-title">
                                    <span>01</span>
                                    Data Ayah & Ibu
                                </div>


                                <div class="row g-4">

                                    {{-- AYAH --}}

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="dadName">
                                                Nama Ayah
                                            </label>

                                            <input type="text" class="form-control-modern" id="dadName"
                                                name="dad_name" placeholder="Nama lengkap ayah"
                                                value="{{ old('dad_name') }}" required>

                                            @error('dad_name')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    {{-- IBU --}}

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="momName">
                                                Nama Ibu
                                            </label>

                                            <input type="text" class="form-control-modern" id="momName"
                                                name="mom_name" placeholder="Nama lengkap ibu"
                                                value="{{ old('mom_name') }}" required>

                                            @error('mom_name')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="dadDegree">
                                                Pendidikan Terakhir Ayah
                                            </label>

                                            <select class="form-control-modern" id="dadDegree" name="dad_degree"
                                                required>

                                                <option selected disabled>
                                                    Pilih Pendidikan
                                                </option>

                                                @foreach ([
            1 => 'SD',
            2 => 'SMP',
            3 => 'SMA',
            4 => 'D1',
            5 => 'D2',
            6 => 'D3',
            7 => 'S1',
            8 => 'S2',
            9 => 'S3',
        ] as $id => $education)
                                                    <option value="{{ $id }}"
                                                        {{ old('dad_degree') == $id ? 'selected' : '' }}>
                                                        {{ $education }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('dad_degree')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="momDegree">
                                                Pendidikan Terakhir Ibu
                                            </label>

                                            <select class="form-control-modern" id="momDegree" name="mom_degree"
                                                required>

                                                <option selected disabled>
                                                    Pilih Pendidikan
                                                </option>

                                                @foreach ([
            1 => 'SD',
            2 => 'SMP',
            3 => 'SMA',
            4 => 'D1',
            5 => 'D2',
            6 => 'D3',
            7 => 'S1',
            8 => 'S2',
            9 => 'S3',
        ] as $id => $education)
                                                    <option value="{{ $id }}"
                                                        {{ old('mom_degree') == $id ? 'selected' : '' }}>
                                                        {{ $education }}
                                                    </option>
                                                @endforeach

                                            </select>

                                            @error('mom_degree')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="dadJob">
                                                Pekerjaan Ayah
                                            </label>

                                            <input type="text" class="form-control-modern" id="dadJob"
                                                name="dad_job" placeholder="Contoh: Guru" value="{{ old('dad_job') }}"
                                                required>

                                            @error('dad_job')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="momJob">
                                                Pekerjaan Ibu
                                            </label>

                                            <input type="text" class="form-control-modern" id="momJob"
                                                name="mom_job" placeholder="Contoh: Guru" value="{{ old('mom_job') }}"
                                                required>

                                            @error('mom_job')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="dadphoneNumber">
                                                No. Telepon Ayah
                                            </label>

                                            <input type="tel" class="form-control-modern" name="dad_tel"
                                                id="dadphoneNumber" placeholder="0823xxxxxxx" pattern="0\d{9,15}"
                                                value="{{ old('dad_tel') }}" required>

                                            @error('dad_tel')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="momphoneNumber">
                                                No. Telepon Ibu
                                            </label>

                                            <input type="tel" class="form-control-modern" name="mom_tel"
                                                id="momphoneNumber" placeholder="0823xxxxxxx" pattern="0\d{9,15}"
                                                value="{{ old('mom_tel') }}" required>

                                            @error('mom_tel')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- ALAMAT ORANGTUA --}}

                            <div class="form-section">

                                <div class="form-section-title">
                                    <span>02</span>
                                    Alamat Orangtua
                                </div>


                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="provinceParent">
                                                Provinsi
                                            </label>

                                            <select class="form-control-modern" id="provinceParent"
                                                name="parent_province">

                                                <option selected disabled>
                                                    Pilih Provinsi
                                                </option>

                                            </select>

                                            <input type="hidden" id="parent_province" name="provinceParent">

                                            <input type="hidden" id="parent_province_name" name="parent_province">

                                            @error('parent_province')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="regencyParent">
                                                Kabupaten / Kota
                                            </label>

                                            <select class="form-control-modern" id="regencyParent" name="parent_regency">

                                                <option selected disabled>
                                                    Pilih Kabupaten / Kota
                                                </option>

                                            </select>

                                            <input type="hidden" id="parent_regency" name="regencyParent">

                                            <input type="hidden" id="parent_regency_name" name="parent_regency">

                                            @error('parent_regency')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="districtParent">
                                                Kecamatan
                                            </label>

                                            <select class="form-control-modern" id="districtParent"
                                                name="parent_district">

                                                <option selected disabled>
                                                    Pilih Kecamatan
                                                </option>

                                            </select>

                                            <input type="hidden" id="parent_district" name="districtParent">

                                            <input type="hidden" id="parent_district_name" name="parent_district">

                                            @error('parent_district')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="villageParent">
                                                Desa / Kelurahan
                                            </label>

                                            <select class="form-control-modern" id="villageParent" name="parent_village">

                                                <option selected disabled>
                                                    Pilih Desa / Kelurahan
                                                </option>

                                            </select>

                                            <input type="hidden" id="parent_village" name="villageParent">

                                            <input type="hidden" id="parent_village_name" name="parent_village">

                                            @error('parent_village')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-8">

                                        <div class="form-group-modern">

                                            <label for="addressParent">
                                                Alamat
                                            </label>

                                            <textarea class="form-control-modern" id="addressParent" name="address" rows="3"
                                                placeholder="Contoh: Jl. Riau No. 71A">{{ old('address') }}</textarea>

                                            @error('address')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-4">

                                        <div class="form-group-modern">

                                            <label for="parentStay">
                                                Status Tinggal
                                            </label>

                                            <select class="form-control-modern" name="parentStay" id="parentStay"
                                                required>

                                                <option selected disabled>
                                                    Pilih Status
                                                </option>

                                                <option value="1" {{ old('parentStay') == 1 ? 'selected' : '' }}>
                                                    Rumah Pribadi
                                                </option>

                                                <option value="2" {{ old('parentStay') == 2 ? 'selected' : '' }}>
                                                    Apartemen
                                                </option>

                                                <option value="3" {{ old('parentStay') == 3 ? 'selected' : '' }}>
                                                    Kontrak
                                                </option>

                                                <option value="4" {{ old('parentStay') == 4 ? 'selected' : '' }}>
                                                    Kost
                                                </option>

                                            </select>

                                            @error('parentStay')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- WALI --}}

                            <div id="WaliRow" style="display: none;">

                                <div class="form-section">

                                    <div class="form-section-title">
                                        <span>03</span>
                                        Informasi Wali
                                    </div>

                                    <div class="row g-4">

                                        <div class="col-md-6">

                                            <div class="form-group-modern">

                                                <label for="waliName">
                                                    Nama Wali
                                                </label>

                                                <input type="text" class="form-control-modern" id="waliName"
                                                    name="wali_name" value="{{ old('wali_name') }}">

                                                @error('wali_name')
                                                    <p class="form-error">
                                                        {{ $message }}
                                                    </p>
                                                @enderror

                                            </div>

                                        </div>


                                        <div class="col-md-6">

                                            <div class="form-group-modern">

                                                <label for="waliDegree">
                                                    Pendidikan Terakhir Wali
                                                </label>

                                                <select class="form-control-modern" id="waliDegree" name="wali_degree">

                                                    <option selected disabled>
                                                        Pilih Pendidikan
                                                    </option>

                                                    @foreach ([
            1 => 'SD',
            2 => 'SMP',
            3 => 'SMA',
            4 => 'D1',
            5 => 'D2',
            6 => 'D3',
            7 => 'S1',
            8 => 'S2',
            9 => 'S3',
        ] as $id => $education)
                                                        <option value="{{ $id }}"
                                                            {{ old('wali_degree') == $id ? 'selected' : '' }}>
                                                            {{ $education }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                @error('wali_degree')
                                                    <p class="form-error">
                                                        {{ $message }}
                                                    </p>
                                                @enderror

                                            </div>

                                        </div>


                                        <div class="col-md-6">

                                            <div class="form-group-modern">

                                                <label for="waliJob">
                                                    Pekerjaan Wali
                                                </label>

                                                <input type="text" class="form-control-modern" id="waliJob"
                                                    name="wali_job" value="{{ old('wali_job') }}">

                                                @error('wali_job')
                                                    <p class="form-error">
                                                        {{ $message }}
                                                    </p>
                                                @enderror

                                            </div>

                                        </div>


                                        <div class="col-md-6">

                                            <div class="form-group-modern">

                                                <label for="waliPhoneNumber">
                                                    No. Telepon Wali
                                                </label>

                                                <input type="tel" class="form-control-modern" id="waliphoneNumber"
                                                    name="wali_tel" placeholder="0823xxxxxxx" pattern="0\d{9,15}"
                                                    value="{{ old('wali_tel') }}">

                                                @error('wali_tel')
                                                    <p class="form-error">
                                                        {{ $message }}
                                                    </p>
                                                @enderror

                                            </div>

                                        </div>


                                        <div class="col-12">

                                            <div class="form-group-modern">

                                                <label for="waliAddress">
                                                    Alamat Wali
                                                </label>

                                                <textarea class="form-control-modern" id="waliAddress" name="wali_address" rows="3">{{ old('wali_address') }}</textarea>

                                                @error('wali_address')
                                                    <p class="form-error">
                                                        {{ $message }}
                                                    </p>
                                                @enderror

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <div class="step-actions">

                                <button type="button" class="ppdb-button ppdb-button-secondary" onclick="prevStep(2)">

                                    ← Sebelumnya

                                </button>


                                <button type="button" class="ppdb-button ppdb-button-primary" id="nextButtonStep3"
                                    onclick="nextStep(4)">

                                    <span>
                                        Selanjutnya
                                    </span>

                                    <span class="button-arrow">
                                        →
                                    </span>

                                </button>

                            </div>

                        </div>


                        {{-- =================================================
                        STEP 4
                        ================================================= --}}
                        <div class="step" id="step4">

                            <div class="step-header">

                                <span class="step-label">
                                    LANGKAH 04
                                </span>

                                <h2>
                                    Penjadwalan Wawancara
                                </h2>

                                <p>
                                    Tentukan jadwal dan metode wawancara
                                    yang sesuai.
                                </p>

                            </div>


                            <div class="form-section">

                                <div class="form-section-title">
                                    <span>01</span>
                                    Jadwal Wawancara
                                </div>


                                <div class="row g-4">

                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="title">
                                                Judul
                                            </label>

                                            <input type="text" name="title" id="title"
                                                class="form-control-modern" value="{{ old('title') }}" required>

                                            @error('title')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="interview_date">
                                                Tanggal
                                            </label>

                                            <input type="date" name="interview_date" id="interview_date"
                                                class="form-control-modern" value="{{ old('interview_date') }}"
                                                required>

                                            @error('interview_date')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6">

                                        <div class="form-group-modern">

                                            <label for="method">
                                                Metode
                                            </label>

                                            <select name="method" id="method" class="form-control-modern" required>

                                                <option selected disabled>
                                                    Pilih Metode
                                                </option>

                                                <option value="online" {{ old('method') == 'online' ? 'selected' : '' }}>
                                                    Online
                                                </option>

                                                <option value="offline"
                                                    {{ old('method') == 'offline' ? 'selected' : '' }}>
                                                    Offline
                                                </option>

                                            </select>

                                            @error('method')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>


                                    <div class="col-md-6" id="onlineReason"
                                        style="{{ old('method') == 'online' ? '' : 'display:none;' }}">

                                        <div class="form-group-modern">

                                            <label for="reason">
                                                Alasan
                                            </label>

                                            <textarea name="reason" id="online_reason" class="form-control-modern" rows="3"
                                                placeholder="Jelaskan alasan memilih wawancara online">{{ old('reason') }}</textarea>

                                            @error('reason')
                                                <p class="form-error">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- FINAL MESSAGE --}}

                            <div class="ppdb-final-message">

                                <div class="final-icon">
                                    ✓
                                </div>

                                <div>

                                    <strong>
                                        Data sudah lengkap?
                                    </strong>

                                    <p>
                                        Pastikan seluruh informasi yang Anda
                                        masukkan sudah benar sebelum mengirim
                                        formulir pendaftaran.
                                    </p>

                                </div>

                            </div>


                            <div class="step-actions">

                                <button type="button" class="ppdb-button ppdb-button-secondary" onclick="prevStep(3)">

                                    ← Sebelumnya

                                </button>


                                <button type="submit" class="ppdb-button ppdb-button-primary" id="submitButton">

                                    <span>
                                        Kirim Pendaftaran
                                    </span>

                                    <span class="button-arrow">
                                        →
                                    </span>

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </section>

    </div>


    {{-- =========================================================
    STYLE
    ========================================================= --}}
    <style>
        /* =====================================================
                   BASE
                ===================================================== */

        .ppdb-page {
            background: #faf9fc;
            min-height: 100vh;
            color: #202020;
        }


        /* =====================================================
                   HEADER
                ===================================================== */

        .ppdb-header {
            background: #fff;
            padding: 100px 0 80px;
            border-bottom: 1px solid #eeeaf4;
        }


        .ppdb-header-content {
            max-width: 850px;
        }


        .ppdb-label {
            display: inline-block;

            color: #8b5cf6;

            font-size: 12px;

            font-weight: 700;

            letter-spacing: 2px;

            margin-bottom: 15px;
        }


        .ppdb-header h1 {
            font-size: clamp(42px, 6vw, 68px);

            line-height: 1.05;

            letter-spacing: -2.5px;

            font-weight: 700;

            margin: 0 0 20px;
        }


        .ppdb-header h1 span {
            color: #8b5cf6;
        }


        .ppdb-header p {
            max-width: 650px;

            color: #777;

            font-size: 17px;

            line-height: 1.8;

            margin: 0;
        }


        /* =====================================================
                   FORM SECTION
                ===================================================== */

        .ppdb-form-section {
            padding: 70px 0 100px;
        }


        /* =====================================================
                   ERROR
                ===================================================== */

        .ppdb-alert {
            display: flex;

            gap: 15px;

            padding: 20px;

            margin-bottom: 30px;

            border-radius: 16px;
        }


        .ppdb-alert-danger {
            background: #fff5f5;

            border: 1px solid #f3d4d4;

            color: #842029;
        }


        .ppdb-alert-icon {
            width: 32px;
            height: 32px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #842029;

            color: #fff;

            font-weight: 700;
        }


        .ppdb-alert ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }


        /* =====================================================
                   PROGRESS
                ===================================================== */

        .ppdb-progress {
            display: flex;

            align-items: center;

            margin-bottom: 35px;

            overflow-x: auto;

            padding-bottom: 5px;
        }


        .progress-item {
            display: flex;

            align-items: center;

            gap: 12px;

            flex-shrink: 0;

            opacity: .45;

            transition: .3s ease;
        }


        .progress-item.active,
        .progress-item.completed {
            opacity: 1;
        }


        .progress-number {
            width: 42px;
            height: 42px;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            border: 1px solid #ddd8e8;

            background: #fff;

            color: #777;

            font-size: 12px;

            font-weight: 700;
        }


        .progress-item.active .progress-number,
        .progress-item.completed .progress-number {
            background: #8b5cf6;

            border-color: #8b5cf6;

            color: #fff;
        }


        .progress-text {
            display: flex;

            flex-direction: column;
        }


        .progress-text small {
            color: #999;

            font-size: 10px;

            text-transform: uppercase;

            letter-spacing: 1px;
        }


        .progress-text strong {
            font-size: 14px;

            font-weight: 600;
        }


        .progress-line {
            width: 60px;

            height: 1px;

            background: #ddd8e8;

            margin: 0 15px;

            flex-shrink: 0;
        }


        /* =====================================================
                   CARD
                ===================================================== */

        .ppdb-card {
            background: #fff;

            border: 1px solid #ece9f2;

            border-radius: 24px;

            padding: 55px;

            box-shadow: 0 20px 60px rgba(50, 30, 80, .05);
        }


        /* =====================================================
                   STEP
                ===================================================== */

        .step {
            display: none;
        }


        .step.active {
            display: block;

            animation: stepFade .35s ease;
        }


        @keyframes stepFade {

            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }


        /* =====================================================
                   STEP HEADER
                ===================================================== */

        .step-header {
            max-width: 700px;

            margin-bottom: 50px;
        }


        .step-label {
            color: #8b5cf6;

            font-size: 11px;

            font-weight: 700;

            letter-spacing: 2px;
        }


        .step-header h2 {
            font-size: 38px;

            font-weight: 700;

            letter-spacing: -1.5px;

            margin: 10px 0 12px;
        }


        .step-header p {
            color: #777;

            line-height: 1.8;

            margin: 0;
        }


        /* =====================================================
                   FORM SECTION
                ===================================================== */

        .form-section {
            padding: 35px 0;

            border-top: 1px solid #eeeaf4;
        }


        .form-section:first-of-type {
            border-top: 0;

            padding-top: 0;
        }


        .form-section-title {
            display: flex;

            align-items: center;

            gap: 12px;

            margin-bottom: 30px;

            font-size: 17px;

            font-weight: 650;
        }


        .form-section-title span {
            color: #8b5cf6;

            font-size: 11px;

            letter-spacing: 1px;
        }


        /* =====================================================
                   FORM
                ===================================================== */

        .form-group-modern {
            margin-bottom: 5px;
        }


        .form-group-modern label {
            display: block;

            margin-bottom: 9px;

            color: #333;

            font-size: 13px;

            font-weight: 600;
        }


        .form-control-modern {
            width: 100%;

            min-height: 50px;

            padding: 12px 16px;

            border: 1px solid #ddd9e6;

            border-radius: 12px;

            background: #fff;

            color: #25212c;

            font-size: 14px;

            outline: none;

            transition: .25s ease;
        }


        .form-control-modern:focus {
            border-color: #8b5cf6;

            box-shadow: 0 0 0 4px rgba(139, 92, 246, .08);
        }


        .form-control-modern::placeholder {
            color: #aaa6b1;
        }


        textarea.form-control-modern {
            resize: vertical;

            min-height: 110px;
        }


        select.form-control-modern {
            cursor: pointer;
        }


        .form-control-modern.is-invalid {
            border-color: #dc3545;
        }


        .form-error {
            margin: 7px 0 0;

            color: #dc3545;

            font-size: 12px;
        }


        /* =====================================================
                   RADIO
                ===================================================== */

        .radio-group {
            display: flex;

            gap: 10px;

            flex-wrap: wrap;
        }


        .radio-card {
            position: relative;

            cursor: pointer;

            margin: 0;
        }


        .radio-card input {
            position: absolute;

            opacity: 0;
        }


        .radio-card span {
            display: block;

            padding: 12px 20px;

            border: 1px solid #ddd9e6;

            border-radius: 12px;

            color: #555;

            font-size: 13px;

            transition: .25s ease;
        }


        .radio-card input:checked+span {
            background: rgba(139, 92, 246, .07);

            border-color: #8b5cf6;

            color: #8b5cf6;

            font-weight: 600;
        }


        /* =====================================================
                   INFO
                ===================================================== */

        .ppdb-info {
            display: flex;

            gap: 15px;

            padding: 18px;

            margin-bottom: 35px;

            border-radius: 15px;

            background: #f8f6fc;

            border: 1px solid #ebe5f5;
        }


        .ppdb-info-icon {
            width: 30px;
            height: 30px;

            flex-shrink: 0;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #8b5cf6;

            color: #fff;

            font-size: 13px;

            font-weight: 700;
        }


        .ppdb-info strong {
            font-size: 13px;
        }


        .ppdb-info p {
            margin: 5px 0 0;

            color: #777;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =====================================================
                   FINAL MESSAGE
                ===================================================== */

        .ppdb-final-message {
            display: flex;

            gap: 15px;

            align-items: center;

            padding: 22px;

            margin-top: 30px;

            border-radius: 16px;

            background: #f8f6fc;

            border: 1px solid #ebe5f5;
        }


        .final-icon {
            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            background: #8b5cf6;

            color: #fff;

            font-weight: 700;
        }


        .ppdb-final-message strong {
            font-size: 14px;
        }


        .ppdb-final-message p {
            margin: 4px 0 0;

            color: #777;

            font-size: 13px;

            line-height: 1.6;
        }


        /* =====================================================
                   ACTION
                ===================================================== */

        .step-actions {
            display: flex;

            align-items: center;

            justify-content: space-between;

            gap: 15px;

            margin-top: 40px;

            padding-top: 30px;

            border-top: 1px solid #eeeaf4;
        }


        .ppdb-button {
            display: inline-flex;

            align-items: center;

            justify-content: center;

            gap: 12px;

            min-height: 50px;

            padding: 12px 22px;

            border-radius: 50px;

            border: 0;

            text-decoration: none;

            font-size: 14px;

            font-weight: 600;

            cursor: pointer;

            transition: .3s ease;
        }


        .ppdb-button-primary {
            background: #191522;

            color: #fff;
        }


        .ppdb-button-primary:hover {
            background: #8b5cf6;

            color: #fff;

            transform: translateY(-2px);

            box-shadow: 0 12px 30px rgba(139, 92, 246, .20);
        }


        .ppdb-button-secondary {
            background: #f5f3f8;

            color: #55505e;
        }


        .ppdb-button-secondary:hover {
            background: #ebe7f1;

            color: #333;
        }


        .button-arrow {
            font-size: 18px;

            line-height: 1;
        }


        .ppdb-button:disabled {
            opacity: .45;

            cursor: not-allowed;

            transform: none;
        }


        /* =====================================================
                   MOBILE
                ===================================================== */

        @media (max-width: 768px) {

            .ppdb-header {
                padding: 70px 0 55px;
            }


            .ppdb-header h1 {
                font-size: 42px;

                letter-spacing: -1.5px;
            }


            .ppdb-header p {
                font-size: 15px;
            }


            .ppdb-form-section {
                padding: 40px 0 70px;
            }


            .ppdb-card {
                padding: 30px 20px;

                border-radius: 20px;
            }


            .ppdb-progress {
                padding-bottom: 10px;
            }


            .progress-text {
                display: none;
            }


            .progress-number {
                width: 38px;
                height: 38px;
            }


            .progress-line {
                width: 35px;

                margin: 0 8px;
            }


            .step-header {
                margin-bottom: 35px;
            }


            .step-header h2 {
                font-size: 30px;
            }


            .form-section {
                padding: 30px 0;
            }


            .step-actions {
                flex-direction: column-reverse;

                align-items: stretch;
            }


            .ppdb-button {
                width: 100%;
            }


            .radio-group {
                width: 100%;
            }


            .radio-card {
                flex: 1;
            }


            .radio-card span {
                text-align: center;
            }

        }
    </style>


    {{-- =========================================================
    SCRIPT
    ========================================================= --}}
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {

        const form = document.querySelector("form");

        const submitButton =
            form.querySelector("button[type='submit']");


        /*
        |--------------------------------------------------------------------------
        | INITIAL STEP
        |--------------------------------------------------------------------------
        */

        const steps =
            document.querySelectorAll(".step");

        steps.forEach(step => {
            step.classList.remove("active");
        });

        const firstStep =
            document.getElementById("step1");

        if (firstStep) {
            firstStep.classList.add("active");
        }


        /*
        |--------------------------------------------------------------------------
        | FORM VALIDATION & DOUBLE SUBMIT PROTECTION
        |--------------------------------------------------------------------------
        */

        let isSubmitting = false;


        function toggleSubmitButton() {

            if (!submitButton) return;

            /*
            | Jika form sedang dikirim,
            | jangan izinkan tombol kembali aktif.
            */
            if (isSubmitting) {

                submitButton.disabled = true;

                return;

            }

            submitButton.disabled =
                !form.checkValidity();

        }


        toggleSubmitButton();


        form.addEventListener(
            "input",
            toggleSubmitButton
        );


        form.addEventListener(
            "change",
            toggleSubmitButton
        );


        form.addEventListener(
            "submit",
            function(e) {

                /*
                |--------------------------------------------------------------------------
                | CEGAH SUBMIT KEDUA
                |--------------------------------------------------------------------------
                */

                if (isSubmitting) {

                    e.preventDefault();
                    e.stopPropagation();

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | VALIDASI FORM
                |--------------------------------------------------------------------------
                */

                if (!form.checkValidity()) {

                    e.preventDefault();
                    e.stopPropagation();

                    form.classList.add(
                        "was-validated"
                    );

                    alert(
                        "⚠️ Mohon lengkapi semua data yang wajib diisi sebelum submit."
                    );

                    return;

                }


                /*
                |--------------------------------------------------------------------------
                | KUNCI SUBMIT
                |--------------------------------------------------------------------------
                */

                isSubmitting = true;


                /*
                |--------------------------------------------------------------------------
                | DISABLE BUTTON
                |--------------------------------------------------------------------------
                */

                submitButton.disabled = true;


                /*
                |--------------------------------------------------------------------------
                | UBAH TAMPILAN BUTTON
                |--------------------------------------------------------------------------
                */

                submitButton.innerHTML = `
                    <span>
                        Menyimpan Pendaftaran...
                    </span>

                    <span class="button-arrow">
                        ⏳
                    </span>
                `;


                /*
                |--------------------------------------------------------------------------
                | VALIDATED STATE
                |--------------------------------------------------------------------------
                */

                form.classList.add(
                    "was-validated"
                );

            }
        );


        /*
        |--------------------------------------------------------------------------
        | METHOD INTERVIEW
        |--------------------------------------------------------------------------
        */

        const method =
            document.getElementById("method");

        const onlineReason =
            document.getElementById("onlineReason");


        if (method) {

            method.addEventListener(
                "change",
                function() {

                    if (this.value === "online") {

                        onlineReason.style.display =
                            "";

                    } else {

                        onlineReason.style.display =
                            "none";

                    }

                }
            );

        }

    });


    /*
    |--------------------------------------------------------------------------
    | UPDATE PROGRESS
    |--------------------------------------------------------------------------
    */

    function updateProgress(step) {

        document
            .querySelectorAll(".progress-item")
            .forEach(item => {

                const itemStep =
                    parseInt(
                        item.dataset.step
                    );

                item.classList.remove(
                    "active",
                    "completed"
                );


                if (itemStep === step) {

                    item.classList.add(
                        "active"
                    );

                }


                if (itemStep < step) {

                    item.classList.add(
                        "completed"
                    );

                }

            });

    }


    /*
    |--------------------------------------------------------------------------
    | NEXT STEP
    |--------------------------------------------------------------------------
    */

    function nextStep(step) {

        const currentStep =
            document.querySelector(
                ".step.active"
            );


        if (currentStep) {

            const inputs =
                currentStep.querySelectorAll(
                    "input, select, textarea"
                );


            let valid = true;


            inputs.forEach(input => {

                if (
                    input.offsetParent !== null &&
                    !input.checkValidity()
                ) {

                    input.reportValidity();

                    valid = false;

                }

            });


            if (!valid) {
                return;
            }


            currentStep.classList.remove(
                "active"
            );

        }


        const next =
            document.getElementById(
                "step" + step
            );


        if (next) {

            next.classList.add(
                "active"
            );

            updateProgress(step);

            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });

        }

    }


    /*
    |--------------------------------------------------------------------------
    | PREVIOUS STEP
    |--------------------------------------------------------------------------
    */

    function prevStep(step) {

        document
            .querySelectorAll(".step")
            .forEach(item => {

                item.classList.remove(
                    "active"
                );

            });


        const previous =
            document.getElementById(
                "step" + step
            );


        if (previous) {

            previous.classList.add(
                "active"
            );

            updateProgress(step);

            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });

        }

    }
</script>
    @include('components.script')

@endsection
