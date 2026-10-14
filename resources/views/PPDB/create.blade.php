<x-app-layout>
<script src="https://cdn.tailwindcss.com"></script>
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

                                            <select class="form-control-modern" id="provinceParent">

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

                                            <select class="form-control-modern" id="regencyParent">

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

                                            <select class="form-control-modern" id="districtParent">

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

                                            <select class="form-control-modern" id="villageParent">

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
                                                class="form-control-modern" value="{{ old('title', 'Wawancara PPDB') }}"
                                                readonly required aria-describedby="titleHelp">
                                            <small id="titleHelp" class="form-hint">Judul dibuat otomatis berdasarkan nama lengkap siswa.</small>

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
        .ppdb-page { background:#faf9fc; min-height:100vh; color:#202020; }
        .ppdb-page .container { width:min(100% - 2rem, 1120px); margin-inline:auto; }
        .ppdb-page .row { display:grid; grid-template-columns:repeat(12,minmax(0,1fr)); gap:1.5rem; }
        .ppdb-page [class*="col-"] { min-width:0; grid-column:span 12 / span 12; }
        .ppdb-page .col-md-4 { grid-column:span 4 / span 4; }
        .ppdb-page .col-md-6 { grid-column:span 6 / span 6; }
        .ppdb-page .col-md-8 { grid-column:span 8 / span 8; }
        .ppdb-page .col-12 { grid-column:span 12 / span 12; }
        .ppdb-page .g-4 { gap:1.5rem; }
        .ppdb-page .step { display:none; }
        .ppdb-page .step.active { display:block; animation:stepFade .25s ease; }
        .ppdb-page .form-control-modern { box-sizing:border-box; }
        .ppdb-page .step-actions { display:flex; align-items:center; justify-content:space-between; gap:1rem; margin-top:2rem; }
        .ppdb-page .ppdb-progress { display:flex; align-items:center; overflow-x:auto; }
        .ppdb-page .progress-item { flex-shrink:0; }
        .ppdb-page .progress-line { flex-shrink:0; }
        .ppdb-page button { font:inherit; }
        .ppdb-page .ppdb-button { display:inline-flex; align-items:center; justify-content:center; gap:.75rem; padding:.9rem 1.25rem; border:0; border-radius:12px; font-weight:600; cursor:pointer; transition:.2s ease; }
        .ppdb-page .ppdb-button-primary { background:#191522; color:white; }
        .ppdb-page .ppdb-button-primary:hover { background:#8b5cf6; color:white; }
        .ppdb-page .ppdb-button-secondary { background:#f5f3f8; color:#55505e; }
        .ppdb-page .ppdb-button:disabled { opacity:.55; cursor:not-allowed; }
        .ppdb-page .form-error { color:#dc2626; font-size:.8rem; margin-top:.4rem; }
        .ppdb-page .form-control-modern.is-invalid { border-color:#dc2626; }
        .ppdb-page .ppdb-alert-danger { background:#fff5f5; border:1px solid #f3d4d4; color:#842029; border-radius:14px; padding:1rem 1.25rem; margin-bottom:1.5rem; }
        @keyframes stepFade { from {opacity:0;transform:translateY(6px)} to {opacity:1;transform:translateY(0)} }
        @media(max-width:768px) {
            .ppdb-page .col-md-4,.ppdb-page .col-md-6,.ppdb-page .col-md-8 { grid-column:span 12 / span 12; }
            .ppdb-page .ppdb-card { padding:1.5rem 1rem; }
            .ppdb-page .progress-text { display:none; }
            .ppdb-page .step-actions { flex-direction:column-reverse; align-items:stretch; }
            .ppdb-page .ppdb-button { width:100%; }
            .ppdb-page .step-header h2 { font-size:1.9rem; }
        }
    </style>

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
    
    


    <style>
        .ppdb-page {
            background: #F7F9FC;
            color: #172033;
            min-height: 100vh;
        }

        .ppdb-page .ppdb-header {
            background: linear-gradient(135deg, #2B6EFF 0%, #1D4ED8 100%);
        }

        .ppdb-page .ppdb-header .ppdb-label {
            color: #DBEAFE;
        }

        .ppdb-page .ppdb-header h1 {
            color: #FFFFFF;
        }

        .ppdb-page .ppdb-header h1 span {
            color: #DBEAFE;
        }

        .ppdb-page .ppdb-header p {
            color: #EFF6FF;
        }

        .ppdb-page .ppdb-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            box-shadow: 0 16px 45px rgba(23, 32, 51, .08);
        }

        .ppdb-page .step-header h2,
        .ppdb-page .form-section-title {
            color: #172033;
        }

        .ppdb-page .step-header p,
        .ppdb-page .ppdb-info p,
        .ppdb-page .ppdb-final-message p {
            color: #475569;
        }

        .ppdb-page .form-group-modern label {
            color: #172033;
        }

        .ppdb-page .form-control-modern {
            background: #FFFFFF;
            color: #172033;
            border: 1px solid #CBD5E1;
            border-radius: 10px;
        }

        .ppdb-page .form-control-modern::placeholder {
            color: #64748B;
            opacity: 1;
        }

        .ppdb-page .form-control-modern:focus {
            border-color: #2B6EFF;
            box-shadow: 0 0 0 3px rgba(43, 110, 255, .16);
            outline: none;
        }

        .ppdb-page .form-control-modern:disabled {
            background: #F1F5F9;
            color: #64748B;
            cursor: not-allowed;
        }

        .ppdb-page .progress-number {
            color: #475569;
            border-color: #CBD5E1;
        }

        .ppdb-page .progress-item.active .progress-number,
        .ppdb-page .progress-item.completed .progress-number {
            background: #1D4ED8;
            border-color: #1D4ED8;
            color: #FFFFFF;
        }

        .ppdb-page .progress-text strong {
            color: #172033;
        }

        .ppdb-page .progress-text small {
            color: #64748B;
        }

        .ppdb-page .progress-line {
            background: #CBD5E1;
        }

        .ppdb-page .ppdb-button-primary {
            background: #1D4ED8;
            color: #FFFFFF;
        }

        .ppdb-page .ppdb-button-primary:hover {
            background: #1E40AF;
            color: #FFFFFF;
        }

        .ppdb-page .ppdb-button-secondary {
            background: #EAF1FF;
            color: #1E40AF;
        }

        .ppdb-page .ppdb-button-secondary:hover {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .ppdb-page .ppdb-info,
        .ppdb-page .ppdb-final-message {
            background: #EAF1FF;
            border-color: #BFDBFE;
            color: #172033;
        }

        .ppdb-page .form-error {
            color: #B42318;
        }

        .ppdb-page .form-hint {
            display: block;
            margin-top: 7px;
            color: #64748B;
            font-size: 12px;
            line-height: 1.5;
        }

        .ppdb-page .form-control-modern.is-invalid {
            border-color: #DC2626 !important;
            background-color: #FEF2F2;
        }

        .ppdb-page .form-group-modern:has(.is-invalid) > label {
            color: #B91C1C;
        }

        .ppdb-page .field-error-summary {
            margin: 0 0 1.5rem;
            padding: 1rem 1.25rem;
            border: 1px solid #FECACA;
            border-radius: 14px;
            background: #FEF2F2;
            color: #991B1B;
        }

        .ppdb-page .field-error-summary a {
            color: #1D4ED8;
            text-decoration: underline;
            font-weight: 600;
        }

        .ppdb-page .radio-card span {
            color: #334155;
            border-color: #CBD5E1;
        }

        .ppdb-page .radio-card input:checked + span {
            background: #EAF1FF;
            border-color: #2B6EFF;
            color: #1D4ED8;
        }

        .ppdb-page .ppdb-button:focus-visible,
        .ppdb-page .form-control-modern:focus-visible {
            outline: 3px solid #93C5FD;
            outline-offset: 2px;
        }

        .ppdb-page .step { display: none; }
        .ppdb-page .step.active { display: block; }
        .ppdb-page [id$="AddressRow"].is-visible { display: block !important; }

        @media (max-width: 768px) {
            .ppdb-page .ppdb-card { padding: 1.5rem 1rem; }
        }
    </style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const API = 'https://www.emsifa.com/api-wilayah-indonesia/v2';
    const $ = id => document.getElementById(id);
    const form = document.querySelector('.ppdb-page form');
    const panels = [...document.querySelectorAll('.ppdb-page .step')];
    const progress = [...document.querySelectorAll('.ppdb-page .progress-item')];
    const DRAFT_KEY = 'yahya_ppdb_form_draft_v2';

    async function getRegions(path) {
        const response = await fetch(`${API}/${path}.json`);
        if (!response.ok) throw new Error(`HTTP ${response.status}`);
        const json = await response.json();
        if (!Array.isArray(json.data)) throw new Error('Format data wilayah tidak valid');
        return json.data;
    }

    function resetSelect(select, label, disabled = true) {
        if (!select) return;
        select.replaceChildren(new Option(label, ''));
        select.disabled = disabled;
    }

    function fillSelect(select, items, label) {
        if (!select) return;
        select.replaceChildren(new Option(label, ''));
        items.forEach(item => select.add(new Option(item.name, String(item.id))));
        select.disabled = items.length === 0;
    }

    function hiddenValue(id, value) {
        const input = $(id);
        if (input) input.value = value || '';
    }

    function setupAddress(ids) {
        const province = $(ids.province);
        const regency = $(ids.regency);
        const district = $(ids.district);
        const village = $(ids.village);
        if (!province || !regency || !district || !village) return;
        let provinceRequest = 0, regencyRequest = 0, districtRequest = 0;

        function update(select, idField, nameField) {
            const option = select.options[select.selectedIndex];
            hiddenValue(idField, select.value);
            hiddenValue(nameField, select.value ? option.text : '');
        }

        function clearFrom(level) {
            if (level <= 1) {
                resetSelect(regency, 'Pilih kabupaten/kota');
                update(regency, ids.regencyId, ids.regencyName);
            }
            if (level <= 2) {
                resetSelect(district, 'Pilih kecamatan');
                update(district, ids.districtId, ids.districtName);
            }
            if (level <= 3) {
                resetSelect(village, 'Pilih desa/kelurahan');
                update(village, ids.villageId, ids.villageName);
            }
        }

        province.addEventListener('change', async () => {
            const request = ++provinceRequest;
            clearFrom(1);
            update(province, ids.provinceId, ids.provinceName);
            if (!province.value) { saveDraft(); return; }
            resetSelect(regency, 'Memuat kabupaten/kota...');
            try {
                const data = await getRegions(`regencies/${province.value}`);
                if (request === provinceRequest) fillSelect(regency, data, 'Pilih kabupaten/kota');
            } catch (error) {
                if (request === provinceRequest) resetSelect(regency, 'Gagal memuat. Coba pilih provinsi lagi.');
                console.error(error);
                showNotice('Kabupaten/kota gagal dimuat. Periksa koneksi internet lalu coba lagi.');
            }
            saveDraft();
        });

        regency.addEventListener('change', async () => {
            const request = ++regencyRequest;
            clearFrom(2);
            update(regency, ids.regencyId, ids.regencyName);
            if (!regency.value) { saveDraft(); return; }
            resetSelect(district, 'Memuat kecamatan...');
            try {
                const data = await getRegions(`districts/${regency.value}`);
                if (request === regencyRequest) fillSelect(district, data, 'Pilih kecamatan');
            } catch (error) {
                if (request === regencyRequest) resetSelect(district, 'Gagal memuat kecamatan');
                console.error(error);
                showNotice('Kecamatan gagal dimuat. Silakan coba lagi.');
            }
            saveDraft();
        });

        district.addEventListener('change', async () => {
            const request = ++districtRequest;
            clearFrom(3);
            update(district, ids.districtId, ids.districtName);
            if (!district.value) { saveDraft(); return; }
            resetSelect(village, 'Memuat desa/kelurahan...');
            try {
                const data = await getRegions(`villages/${district.value}`);
                if (request === districtRequest) fillSelect(village, data, 'Pilih desa/kelurahan');
            } catch (error) {
                if (request === districtRequest) resetSelect(village, 'Gagal memuat desa/kelurahan');
                console.error(error);
                showNotice('Desa/kelurahan gagal dimuat. Silakan coba lagi.');
            }
            saveDraft();
        });

        village.addEventListener('change', () => {
            update(village, ids.villageId, ids.villageName);
            saveDraft();
        });
    }

    function showNotice(message) {
        let notice = $('ppdbRuntimeNotice');
        if (!notice) {
            notice = document.createElement('div');
            notice.id = 'ppdbRuntimeNotice';
            notice.className = 'ppdb-alert ppdb-alert-danger';
            notice.setAttribute('role', 'alert');
            const section = document.querySelector('.ppdb-form-section .container');
            section?.prepend(notice);
        }
        notice.textContent = message;
    }

    function showStep(number, scroll = true) {
        const target = Math.min(4, Math.max(1, Number(number) || 1));
        panels.forEach(panel => panel.classList.toggle('active', panel.id === `step${target}`));
        progress.forEach(item => {
            const n = Number(item.dataset.step);
            item.classList.toggle('active', n === target);
            item.classList.toggle('completed', n < target);
            if (n === target) item.setAttribute('aria-current', 'step');
            else item.removeAttribute('aria-current');
        });
        if (scroll) {
            const heading = $(`step${target}`)?.querySelector('.step-header h2');
            heading?.setAttribute('tabindex', '-1');
            heading?.focus({ preventScroll: true });
            window.scrollTo({ top: Math.max(0, document.querySelector('.ppdb-page')?.offsetTop || 0), behavior: 'smooth' });
        }
    }

    function firstInvalid(panel) {
        return [...panel.querySelectorAll('input, select, textarea')].find(input => {
            if (!input.willValidate || input.disabled) return false;
            if (input.type === 'radio') {
                const group = [...panel.querySelectorAll(`input[type="radio"][name="${CSS.escape(input.name)}"]`)];
                if (group.some(radio => radio.checked)) return false;
                return input === group[0] && input.required;
            }
            return input.offsetParent !== null && !input.checkValidity();
        });
    }

    function validatePanel(panel) {
        const invalid = firstInvalid(panel);
        if (invalid) {
            invalid.classList.add('is-invalid');
            invalid.reportValidity();
            invalid.focus({ preventScroll: true });
            invalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }
        return true;
    }

    window.nextStep = number => {
        const current = document.querySelector('.ppdb-page .step.active');
        if (!current || !validatePanel(current)) return;
        showStep(number);
        saveDraft();
    };
    window.prevStep = number => showStep(number);

    progress.forEach(item => {
        item.style.cursor = 'pointer';
        item.setAttribute('role', 'button');
        item.setAttribute('tabindex', '0');
        const go = () => {
            const target = Number(item.dataset.step);
            const current = document.querySelector('.ppdb-page .step.active');
            const currentNumber = current ? Number(current.id.replace('step', '')) : 1;
            if (target > currentNumber) {
                for (let n = currentNumber; n < target; n++) {
                    const panel = $(`step${n}`);
                    if (panel && !validatePanel(panel)) { showStep(n, false); return; }
                }
            }
            showStep(target);
        };
        item.addEventListener('click', go);
        item.addEventListener('keydown', event => {
            if (event.key === 'Enter' || event.key === ' ') { event.preventDefault(); go(); }
        });
    });

    setupAddress({
        province: 'province', regency: 'regency', district: 'district', village: 'village',
        provinceId: 'student_province', provinceName: 'student_province_name',
        regencyId: 'student_regency', regencyName: 'student_regency_name',
        districtId: 'student_district', districtName: 'student_district_name',
        villageId: 'student_village', villageName: 'student_village_name'
    });
    setupAddress({
        province: 'provinceParent', regency: 'regencyParent', district: 'districtParent', village: 'villageParent',
        provinceId: 'parent_province', provinceName: 'parent_province_name',
        regencyId: 'parent_regency', regencyName: 'parent_regency_name',
        districtId: 'parent_district', districtName: 'parent_district_name',
        villageId: 'parent_village', villageName: 'parent_village_name'
    });

    // Simpan draft hanya pada tab browser ini agar input tidak hilang saat refresh.
    // Data draft dihapus saat submit dimulai; bila validasi server gagal, old() akan mengisi ulang form.
    let restoringDraft = false;
    function getFormControls() {
        return [...(form?.querySelectorAll('input, select, textarea') || [])].filter(el =>
            el.id && !['_token', '_method'].includes(el.name) && el.type !== 'submit' && el.type !== 'button' && el.type !== 'password'
        );
    }
    function saveDraft() {
        if (restoringDraft || !form) return;
        try {
            const draft = {};
            getFormControls().forEach(el => {
                if (!el.id) return;
                if (el.type === 'radio' || el.type === 'checkbox') {
                    if (el.checked) draft[el.id] = el.value;
                } else if (!el.matches('select:disabled')) {
                    draft[el.id] = el.value;
                }
            });
            draft.__step = Number(document.querySelector('.ppdb-page .step.active')?.id.replace('step', '') || 1);
            sessionStorage.setItem(DRAFT_KEY, JSON.stringify(draft));
        } catch (error) {
            console.warn('Draft PPDB tidak dapat disimpan pada sesi browser ini.', error);
        }
    }

    function restoreDraft() {
        let draft;
        try { draft = JSON.parse(sessionStorage.getItem(DRAFT_KEY) || 'null'); }
        catch { draft = null; }
        if (!draft) return 1;
        restoringDraft = true;
        Object.entries(draft).forEach(([id, value]) => {
            if (id.startsWith('__')) return;
            const el = $(id);
            if (!el || el.matches('select')) return; // Wilayah dipulihkan setelah API selesai memuat.
            if (el.type === 'radio' || el.type === 'checkbox') el.checked = el.value === value;
            else el.value = value ?? '';
        });
        // Restore ordinary selects first; address selects are restored by the region loader.
        Object.entries(draft).forEach(([id, value]) => {
            const el = $(id);
            if (el?.tagName === 'SELECT' && !['province','regency','district','village','provinceParent','regencyParent','districtParent','villageParent'].includes(id)) el.value = value;
        });
        restoringDraft = false;
        return Number(draft.__step) || 1;
    }

    const oldStudentProvince = @json(old('student_province'));
    const oldParentProvince = @json(old('provinceParent'));
    const oldStudentRegency = @json(old('student_regency'));
    const oldStudentDistrict = @json(old('student_district'));
    const oldStudentVillage = @json(old('student_village'));
    const oldParentRegency = @json(old('regencyParent'));
    const oldParentDistrict = @json(old('districtParent'));
    const oldParentVillage = @json(old('villageParent'));

    async function restoreRegionChain(prefix, ids, values) {
        const province = $(ids.province), regency = $(ids.regency), district = $(ids.district), village = $(ids.village);
        if (!province || !values.province) return;
        province.value = String(values.province);
        province.dispatchEvent(new Event('change'));
        try {
            const regencies = await getRegions(`regencies/${values.province}`);
            fillSelect(regency, regencies, 'Pilih kabupaten/kota');
            if (!values.regency) return;
            regency.value = String(values.regency);
            regency.dispatchEvent(new Event('change'));
            const districts = await getRegions(`districts/${values.regency}`);
            fillSelect(district, districts, 'Pilih kecamatan');
            if (!values.district) return;
            district.value = String(values.district);
            district.dispatchEvent(new Event('change'));
            const villages = await getRegions(`villages/${values.district}`);
            fillSelect(village, villages, 'Pilih desa/kelurahan');
            if (values.village) village.value = String(values.village);
            const mapping = prefix === 'student' ? {
                provinceId:'student_province', provinceName:'student_province_name', regencyId:'student_regency', regencyName:'student_regency_name', districtId:'student_district', districtName:'student_district_name', villageId:'student_village', villageName:'student_village_name'
            } : {
                provinceId:'parent_province', provinceName:'parent_province_name', regencyId:'parent_regency', regencyName:'parent_regency_name', districtId:'parent_district', districtName:'parent_district_name', villageId:'parent_village', villageName:'parent_village_name'
            };
            [[province,mapping.provinceId,mapping.provinceName],[regency,mapping.regencyId,mapping.regencyName],[district,mapping.districtId,mapping.districtName],[village,mapping.villageId,mapping.villageName]].forEach(([select,id,name]) => {
                const option = select.options[select.selectedIndex];
                hiddenValue(id, select.value);
                hiddenValue(name, select.value ? option?.text : '');
            });
        } catch (error) {
            console.error('Gagal memulihkan data wilayah:', error);
        }
    }

    async function loadProvinces(draft) {
        const selects = [$('province'), $('provinceParent')].filter(Boolean);
        selects.forEach(select => resetSelect(select, 'Memuat provinsi...'));
        try {
            const data = await getRegions('provinces');
            selects.forEach(select => fillSelect(select, data, 'Pilih provinsi'));
            const studentProvince = oldStudentProvince || draft?.province || '';
            const parentProvince = oldParentProvince || draft?.provinceParent || '';
            await restoreRegionChain('student', {province:'province',regency:'regency',district:'district',village:'village'}, {
                province:studentProvince, regency:oldStudentRegency || draft?.regency || '', district:oldStudentDistrict || draft?.district || '', village:oldStudentVillage || draft?.village || ''
            });
            await restoreRegionChain('parent', {province:'provinceParent',regency:'regencyParent',district:'districtParent',village:'villageParent'}, {
                province:parentProvince, regency:oldParentRegency || draft?.regencyParent || '', district:oldParentDistrict || draft?.districtParent || '', village:oldParentVillage || draft?.villageParent || ''
            });
        } catch (error) {
            console.error(error);
            selects.forEach(select => resetSelect(select, 'Gagal memuat provinsi'));
            showNotice('Data provinsi gagal dimuat. Periksa koneksi internet lalu coba muat ulang halaman. Data lain yang sudah diisi tetap tersimpan di sesi tab ini.');
        }
    }

    const residence = $('userStay');
    const studentAddressRow = $('studentAddressRow');
    const waliRow = $('WaliRow') || $('waliRow');
    function updateResidenceFields() {
        const needsStudentAddress = residence && residence.value && residence.value !== '1';
        if (studentAddressRow) studentAddressRow.style.display = needsStudentAddress ? '' : 'none';
        if (waliRow) waliRow.style.display = needsStudentAddress ? '' : 'none';
    }
    residence?.addEventListener('change', () => { updateResidenceFields(); saveDraft(); });
    updateResidenceFields();

    const method = $('method');
    const onlineReason = $('onlineReason');
    function updateReason() {
        if (!method || !onlineReason) return;
        const isOnline = method.value === 'online';
        onlineReason.style.display = isOnline ? '' : 'none';
        const reason = $('online_reason');
        if (reason) reason.required = isOnline;
    }
    method?.addEventListener('change', () => { updateReason(); saveDraft(); });
    updateReason();

    // Judul wawancara mengikuti nama lengkap siswa dan tidak perlu diketik manual.
    const titleInput = $('title');
    const studentNameInput = $('fullName');
    function updateInterviewTitle() {
        if (!titleInput) return;
        const name = studentNameInput?.value.trim();
        titleInput.value = name ? `Wawancara PPDB - ${name}` : 'Wawancara PPDB';
    }
    studentNameInput?.addEventListener('input', () => { updateInterviewTitle(); saveDraft(); });
    updateInterviewTitle();

    // Hilangkan status invalid ketika pengguna mulai memperbaiki field.
    form?.querySelectorAll('input,select,textarea').forEach(input => {
        input.addEventListener('input', () => input.classList.remove('is-invalid'));
        input.addEventListener('change', () => input.classList.remove('is-invalid'));
        if (!['submit','button','radio','checkbox','hidden'].includes(input.type)) input.addEventListener('input', saveDraft);
        input.addEventListener('change', saveDraft);
    });

    const draft = restoreDraft();
    loadProvinces(draft).finally(() => {
        updateResidenceFields();
        updateReason();
        updateInterviewTitle();
        const errorStep = panels.find(panel => panel.querySelector('.form-error, .is-invalid'));
        if (errorStep) {
            showStep(Number(errorStep.id.replace('step','')), false);
            const firstError = errorStep.querySelector('.is-invalid, .form-error')?.closest('.form-group-modern')?.querySelector('input,select,textarea');
            if (firstError && firstError.offsetParent !== null) firstError.focus({ preventScroll: true });
        } else {
            const hasOldInput = @json($errors->any());
            showStep(hasOldInput ? (errorStep ? Number(errorStep.id.replace('step','')) : 1) : draft, false);
        }
        saveDraft();
    });

    if (form) {
        let submitting = false;
        form.addEventListener('submit', event => {
            if (submitting) { event.preventDefault(); return; }
            // Periksa setiap langkah satu per satu dan buka langkah pertama yang bermasalah.
            for (const panel of panels) {
                const invalid = firstInvalid(panel);
                if (invalid) {
                    event.preventDefault();
                    showStep(Number(panel.id.replace('step','')));
                    invalid.classList.add('is-invalid');
                    invalid.reportValidity();
                    invalid.focus({ preventScroll: true });
                    invalid.scrollIntoView({ behavior:'smooth', block:'center' });
                    return;
                }
            }
            submitting = true;
            try { sessionStorage.removeItem(DRAFT_KEY); } catch {}
            const button = $('submitButton');
            if (button) {
                button.disabled = true;
                button.innerHTML = '<span>Mengirim pendaftaran...</span><span aria-hidden="true">⏳</span>';
            }
        });
    }
});
</script>

</x-app-layout>