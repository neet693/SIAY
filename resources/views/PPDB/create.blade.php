@extends('Layout.app2')
@section('content')

    <div class="container">
        {{-- Error --}}
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <div class="row mb-3 pt-70">
            <div class="col-lg-12">
                <form action="{{ route('ppdb.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="transaction_type_id" value="1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="step" id="step1">
                                <h2>Step 1: Informasi Sekolah</h2>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="grade">Jenjang:</label>
                                            <select
                                                class="form-control {{ $errors->has('education_level_id') ? 'is-invalid' : '' }}"
                                                id="grade" name="education_level_id" data-required="true" required>
                                                <option selected disabled>Pilih Jenjang</option>
                                                <option value="1"
                                                    {{ old('education_level_id') == 1 ? 'selected' : '' }}>TK</option>
                                                <option value="2"
                                                    {{ old('education_level_id') == 2 ? 'selected' : '' }}>SD</option>
                                                <option value="3"
                                                    {{ old('education_level_id') == 3 ? 'selected' : '' }}>SMP</option>
                                                <option value="4"
                                                    {{ old('education_level_id') == 4 ? 'selected' : '' }}>SMA</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('education_level_id'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('education_level_id') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="academicYear">Tahun Ajaran:</label>
                                            <select
                                                class="form-control {{ $errors->has('academic_year_id') ? 'is-invalid' : '' }}"
                                                id="academicYear" name="academic_year_id" required>
                                                <option selected disabled>Tahun Ajaran</option>
                                                <option value="1" {{ old('academic_year_id') == 1 ? 'selected' : '' }}>
                                                    2024 - 2025</option>
                                                <option value="2"
                                                    {{ old('academic_year_id') == 2 ? 'selected' : '' }}>
                                                    2025 - 2026</option>
                                                <option value="3"
                                                    {{ old('academic_year_id') == 3 ? 'selected' : '' }}>
                                                    2026 - 2027</option>
                                                <option value="4"
                                                    {{ old('academic_year_id') == 4 ? 'selected' : '' }}>2027 - 2028
                                                </option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('academic_year_id'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('academic_year_id') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="yahyaNews">Mengetahui Sekolah Kristen Yahya dari:</label>
                                            <input type="text"
                                                class="form-control
                                                {{ $errors->has('news_from') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: Dari Teman" id="yahyaNews" name="news_from"
                                                value="{{ old('news_from') }}" required />
                                            @if ($errors->has('news_from'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('news_from') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastSchool">Asal Sekolah:</label>
                                            <input type="text"
                                                class="form-control
                                                {{ $errors->has('last_school') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: TK Yahya" id="lastSchool" name="last_school"
                                                value="{{ old('last_school') }}" required />
                                            @if ($errors->has('last_school'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('last_school') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary" id="nextButtonStep1"
                                    onclick="nextStep(2)">Selanjutnya</button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="step" id="step2">
                                <h2>Step 2: Informasi Siswa</h2>
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>Pengumuman!</strong>Jika Kabupaten, Kota, Desa tidak muncul pilihannya.
                                    Pilih
                                    Provinsi lain
                                    untuk mentrigger.
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fullName">Nama Lengkap:</label>
                                            <input type="text"
                                                class="form-control
                                            {{ $errors->has('fullname') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: John Doe" id="fullName" name="fullname"
                                                value="{{ old('fullname') }}" required />
                                            @if ($errors->has('fullname'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('fullname') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nickName">Nama Panggilan:</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('nickname') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: John" id="nickName" name="nickname"
                                                value="{{ old('nickname') }}" required />
                                            @if ($errors->has('nickname'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('nickname') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="citizenship">Kewarganegaraan:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="citizenship"
                                                    id="wni" value="wni"
                                                    {{ old('citizenship') == 'wni' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="wni">WNI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="citizenship"
                                                    id="wna" value="wna"
                                                    {{ old('citizenship') == 'wna' ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="wna">WNA</label>
                                            </div>
                                            @if ($errors->has('citizenship'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('citizenship') }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Gender:</label>
                                            <div class="row px-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="male" value="male"
                                                        {{ old('gender') == 'male' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="male"> Laki - Laki </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="female" value="female"
                                                        {{ old('gender') == 'female' ? 'checked' : '' }} />
                                                    <label class="form-check-label" for="female"> Perempuan </label>
                                                </div>
                                                @if ($errors->has('gender'))
                                                    <p class="text-danger invalid-feedback" role="alert">
                                                        {{ $errors->first('gender') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="birthPlace">Tempat Lahir:</label>
                                            <input type="text" class="form-control" id="birthPlace"
                                                placeholder="Ex: Bandung" name="birth_place"
                                                value="{{ old('birth_place') }}" required />
                                            @if ($errors->has('birth_place'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="birthDate">Tanggal Lahir:</label>
                                            <input type="date"
                                                class="form-control
                                            {{ $errors->has('birth_date') ? 'is-invalid' : '' }}"
                                                id="birthDate" name="birth_date" value="{{ old('birth_date') }}"
                                                required />
                                            @if ($errors->has('birth_date'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('birth_date') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="userReligion">Agama:</label>
                                            <select
                                                class="form-control {{ $errors->has('religion_id') ? 'is-invalid' : '' }}"
                                                id="userReligion" name="religion_id" required>
                                                <option selected disabled>Agama</option>
                                                <option value="1" {{ old('religion_id') == 1 ? 'selected' : '' }}>
                                                    Kristen</option>
                                                <option value="2" {{ old('religion_id') == 2 ? 'selected' : '' }}>
                                                    Katholik</option>
                                                <option value="3" {{ old('religion_id') == 3 ? 'selected' : '' }}>
                                                    Islam</option>
                                                <option value="4" {{ old('religion_id') == 4 ? 'selected' : '' }}>
                                                    Hindu</option>
                                                <option value="5" {{ old('religion_id') == 5 ? 'selected' : '' }}>
                                                    Buddha</option>
                                                <option value="6" {{ old('religion_id') == 6 ? 'selected' : '' }}>
                                                    Konghucu</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('religion_id'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('religion_id') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="chruchDomicile">Berjemaat di:</label>
                                            <input type="text"
                                                class="form-control
                                            {{ $errors->has('church_domicile') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: GKI Taman Cibunut" id="chruchDomicile"
                                                name="church_domicile" value="{{ old('church_domicile') }}" required />
                                            @if ($errors->has('church_domicile'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('church_domicile') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="childPosition">Anak Ke:</label>
                                            <input type="number"
                                                class="form-control {{ $errors->has('child_position') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: 1" min="1" max="20" id="childPosition"
                                                name="child_position" value="{{ old('child_position') }}" required />
                                            @if ($errors->has('child_position'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('child_position') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="childNumber">Dari Berapa Saudara:</label>
                                            <input type="number"
                                                class="form-control {{ $errors->has('child_number') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: 1" min="1" max="20" id="childNumber"
                                                name="child_number" value="{{ old('child_number') }}" required />
                                            @if ($errors->has('child_number'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('child_number') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userBloodType">Golongan Darah:</label>
                                            <select class="form-control" id="userBloodType" name="blood_type_id"
                                                required>
                                                <option selected disabled>Blood Type</option>
                                                <option value="1" {{ old('blood_type_id') == 1 ? 'selected' : '' }}>A
                                                </option>
                                                <option value="2" {{ old('blood_type_id') == 2 ? 'selected' : '' }}>B
                                                </option>
                                                <option value="3" {{ old('blood_type_id') == 3 ? 'selected' : '' }}>
                                                    AB</option>
                                                <option value="4" {{ old('blood_type_id') == 4 ? 'selected' : '' }}>O
                                                </option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('blood_type_id'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('blood_type_id') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="userStay">Status Tinggal:</label>
                                            <select
                                                class="form-control {{ $errors->has('residence_status_id') ? 'is-invalid' : '' }}"
                                                id="userStay" name="residence_status_id" required>
                                                <option selected disabled>Status Tinggal</option>
                                                <option value="1"
                                                    {{ old('residence_status_id') == 1 ? 'selected' : '' }}>Bersama Orang
                                                    Tua</option>
                                                <option value="2" value="1"
                                                    {{ old('residence_status_id') == 2 ? 'selected' : '' }}>Bersama Saudara
                                                </option>
                                                <option value="3" value="1"
                                                    {{ old('residence_status_id') == 3 ? 'selected' : '' }}>Asrama</option>
                                                <option value="4" value="1"
                                                    {{ old('residence_status_id') == 4 ? 'selected' : '' }}>Kost</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('residence_status_id'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('residence_status_id') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userEmail" class="form-label">Alamat Email:</label>
                                            <input type="email"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                id="userEmail" name="email" placeholder="name@gmail.com"
                                                pattern="[a-zA-Z0-9._%+-]+@gmail\.com" value="{{ old('email') }}"
                                                required />
                                            @if ($errors->has('email'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('email') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div id="studentAddressRow" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="province">Provinsi:</label>
                                                <select class="form-control" id="province" name="student_province">
                                                    <option selected disabled>Pilih Provinsi</option>
                                                    <!-- Options will be added dynamically by JavaScript -->
                                                </select>
                                                @if ($errors->has('student_province'))
                                                    <p class="text-danger">{{ $errors }}</p>
                                                @endif
                                                <input type="hidden" id="student_province" name="province" />
                                                <input type="hidden" id="student_province_name"
                                                    name="student_province_name" readonly />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="regency">Kabupaten / Kota:</label>
                                                <select class="form-control" id="regency" name="student_regency">
                                                    <option selected disabled>Pilih Kabupaten / Kota</option>
                                                    <!-- Options will be added dynamically by JavaScript -->
                                                </select>
                                                <input type="hidden" id="student_regency" name="regency" />
                                                <input type="hidden" id="student_regency_name"
                                                    name="student_regency_name" readonly />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="district">Kecamatan:</label>
                                                <select class="form-control" id="district" name="student_district">
                                                    <option selected disabled>Pilih Kecamatan</option>
                                                    <!-- Options will be added dynamically by JavaScript -->
                                                </select>
                                                <input type="hidden" id="student_district" name="district" />
                                                <input type="hidden" id="student_district_name"
                                                    name="student_district_name" readonly />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="village">Desa / Kelurahan:</label>
                                                <select class="form-control" id="village" name="student_village">
                                                    <option selected disabled>Pilih Desa / Kelurahan</option>
                                                    <!-- Options will be added dynamically by JavaScript -->
                                                </select>

                                                <input type="hidden" id="student_village" name="village" />
                                                <input type="hidden" id="student_village_name"
                                                    name="student_village_name" readonly />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Alamat:</label>
                                                <input type="textarea"
                                                    class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                                                    placeholder="Ex: Jl. Riau No.71A" id="address" name="address" />

                                                @if ($errors->has('address'))
                                                    <p class="text-danger invalid-feedback" role="alert">
                                                        {{ $errors->first('address') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col mt-3">
                                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">
                                        Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary" id="nextButtonStep2"
                                        onclick="nextStep(3)">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="step" id="step3">
                                <h2>Step 3: Informasi Orangtua</h2>
                                <div class="row mb-3">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Pengumuman!</strong>Jika Kabupaten, Kota, Desa tidak muncul pilihannya.
                                        Pilih
                                        Provinsi lain
                                        untuk mentrigger.
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dadName">Nama Ayah:</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('dad_name') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: John Doe" id="dadName" name="dad_name"
                                                value="old{{ 'dad_name' }}" required />
                                            @if ($errors->has('dad_name'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('dad_name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momName">Nama Ibu:</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('mom_name') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: Nina Doe" id="momName" name="mom_name"
                                                value="{{ old('mom_name') }}" required />
                                            @if ($errors->has('mom_name'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('mom_name') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Pendidikan Orangtua -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dadDegree">Pendidikan Terakhir Ayah:</label>
                                            <select
                                                class="form-control {{ $errors->has('dad_degree') ? 'is-invalid' : '' }}"
                                                id="dadDegree" name="dad_degree" required>
                                                <option selected disabled>Gelar</option>
                                                <option value="1" {{ old('dad_degree') == 1 ? 'selected' : '' }}>SD
                                                </option>
                                                <option value="2" {{ old('dad_degree') == 2 ? 'selected' : '' }}>SMP
                                                </option>
                                                <option value="3" {{ old('dad_degree') == 3 ? 'selected' : '' }}>SMA
                                                </option>
                                                <option value="4" {{ old('dad_degree') == 4 ? 'selected' : '' }}>D1
                                                </option>
                                                <option value="5" {{ old('dad_degree') == 5 ? 'selected' : '' }}>D2
                                                </option>
                                                <option value="6" {{ old('dad_degree') == 6 ? 'selected' : '' }}>D3
                                                </option>
                                                <option value="7"{{ old('dad_degree') == 7 ? 'selected' : '' }}>S1
                                                </option>
                                                <option value="8" {{ old('dad_degree') == 8 ? 'selected' : '' }}>S2
                                                </option>
                                                <option value="9" {{ old('dad_degree') == 9 ? 'selected' : '' }}>S3
                                                </option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('dad_degree'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('dad_degree') }}</p>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momDegree">Pendidikan Terakhir Ibu:</label>
                                            <select
                                                class="form-control {{ $errors->has('mom_degree') ? 'is-invalid' : '' }}"
                                                id="momDegree" name="mom_degree" required>
                                                <option selected disabled>Gelar</option>
                                                <option value="1" {{ old('mom_degree') == 1 ? 'selected' : '' }}>SD
                                                </option>
                                                <option value="2" {{ old('mom_degree') == 2 ? 'selected' : '' }}>SMP
                                                </option>
                                                <option value="3" {{ old('mom_degree') == 3 ? 'selected' : '' }}>SMA
                                                </option>
                                                <option value="4" {{ old('mom_degree') == 4 ? 'selected' : '' }}>D1
                                                </option>
                                                <option value="5" {{ old('mom_degree') == 5 ? 'selected' : '' }}>D2
                                                </option>
                                                <option value="6" {{ old('mom_degree') == 6 ? 'selected' : '' }}>D3
                                                </option>
                                                <option value="7"{{ old('mom_degree') == 7 ? 'selected' : '' }}>S1
                                                </option>
                                                <option value="8" {{ old('mom_degree') == 8 ? 'selected' : '' }}>S2
                                                </option>
                                                <option value="9" {{ old('mom_degree') == 9 ? 'selected' : '' }}>S3
                                                </option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('mom_degree'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('mom_degree') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Pendidikan Orangtua -->

                                    <!-- Awal Pekerjaan Orangtua -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dadJob">Pekerjaan Ayah:</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('dad_job') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: Guru" id="dadJob" name="dad_job"
                                                value="{{ old('dad_job') }}" required />
                                            @if ($errors->has('dad_job'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('dad_job') }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momJob">Pekerjaan Ibu:</label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('mom_job') ? 'is-invalid' : '' }}"
                                                placeholder="Ex: Guru" id="momJob" name="mom_job"
                                                vvalue="{{ old('mom_job') }}" required />
                                            @if ($errors->has('mom_job'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('mom_job') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Akhir Pekerjaan Orangtua -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dadphoneNumber">No. Telp Ayah:</label>
                                            <div class="input-group">
                                                <input type="tel"
                                                    class="form-control {{ $errors->has('dad_tel') ? 'is-invalid' : '' }}"
                                                    id="dadphoneNumber" name="dad_tel" placeholder="0823xxxxxxx"
                                                    pattern="0\d{9,15}" value="{{ old('dad_tel') }}" required />
                                                @if ($errors->has('dad_tel'))
                                                    <p class="text-danger invalid-feedback" role="alert">
                                                        {{ $errors->first('dad_tel') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momphoneNumber">No. Telp Ibu:</label>
                                            <div class="input-group">
                                                <input type="tel"
                                                    class="form-control {{ $errors->has('mom_tel') ? 'is-invalid' : '' }}"
                                                    id="momphoneNumber" name="mom_tel" placeholder="0823xxxxxx"
                                                    pattern="0\d{9,15}" value="{{ old('mom_tel') }}" required />
                                                @if ($errors->has('mom_tel'))
                                                    <p class="text-danger invalid-feedback" role="alert">
                                                        {{ $errors->first('mom_tel') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bagian Address -->
                                    <!-- provinceParent -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="provinceParent">Provinsi:</label>
                                            <select class="form-control" id="provinceParent" name="parent_province">
                                                <option selected disabled>Pilih Provinsi</option>
                                                <!-- Options will be added dynamically by JavaScript -->
                                            </select>
                                            @if ($errors->has('parent_province'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif

                                            <input type="hidden" id="provinceParent" name="provinceParent" />
                                            <input type="hidden" id="parent_province_name" name="parent_province_name"
                                                readonly />
                                        </div>
                                    </div>

                                    <!-- regencyParent -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="regencyParent">Kabupaten / Kota:</label>
                                            <select class="form-control" id="regencyParent" name="parent_regency">
                                                <option selected disabled>Pilih Kabupaten / Kota</option>
                                                <!-- Options will be added dynamically by JavaScript -->
                                            </select>
                                            <input type="hidden" id="regencyParent" name="regencyParent" />
                                            <input type="hidden" id="parent_regency_name" name="parent_regency_name"
                                                readonly />
                                        </div>
                                    </div>

                                    <!-- districtParent -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="districtParent">Kecamatan:</label>
                                            <select class="form-control" id="districtParent" name="parent_district">
                                                <option selected disabled>Pilih Kecamatan</option>
                                                <!-- Options will be added dynamically by JavaScript -->
                                            </select>
                                            <input type="hidden" id="districtParent" name="districtParent" />
                                            <input type="hidden" id="parent_district_name" name="parent_district_name"
                                                readonly />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="villageParent">Desa / Kelurahan:</label>
                                            <select class="form-control" id="villageParent" name="parent_village">
                                                <option selected disabled>Pilih Desa / Kelurahan</option>
                                                <!-- Options will be added dynamically by JavaScript -->
                                            </select>
                                            <input type="hidden" id="villageParent" name="villageParent" />
                                            <input type="hidden" id="parent_village_name" name="parent_village_name"
                                                readonly />
                                        </div>
                                    </div>

                                    <!-- addressParent -->
                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="addressParent">Alamat:</label>
                                            <input type="textarea" class="form-control"
                                                placeholder="Ex: Jl. Riau No. 71A" id="addressParent" name="address"
                                                value="{{ old('address') }}" />
                                            @if ($errors->has('address'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="parentStay">Status Tinggal:</label>
                                            <select
                                                class="form-control {{ $errors->has('parentStay') ? 'is-invalid' : '' }}"
                                                name="parentStay" required>
                                                <option selected disabled>Pilih Status Tinggal</option>
                                                <option value="1"{{ old('parentStay') == 1 ? 'selected' : '' }}>
                                                    Rumah
                                                    Pribadi</option>
                                                <option value="2"{{ old('parentStay') == 2 ? 'selected' : '' }}>
                                                    Apartemen</option>
                                                <option value="3" {{ old('parentStay') == 3 ? 'selected' : '' }}>
                                                    Kontrak</option>
                                                <option value="4" {{ old('parentStay') == 4 ? 'selected' : '' }}>
                                                    Kost
                                                </option>
                                            </select>
                                            @if ($errors->has('parentStay'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('parentStay') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Akhir Bagian Address -->
                                </div>

                                <div id="WaliRow" style="display: none;">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliName">Nama Wali:</label>
                                                <input type="text" class="form-control" id="waliName"
                                                    name="wali_name" value="old{{ 'wali_name' }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliDegree">Pendidikan Terakhir Wali:</label>
                                                <select class="form-control" id="waliDegree" name="wali_degree">
                                                    <option selected disabled>Gelar</option>
                                                    <option value="1"
                                                        {{ old('wali_degree') == 1 ? 'selected' : '' }}>SD
                                                    </option>
                                                    <option value="2"
                                                        {{ old('wali_degree') == 2 ? 'selected' : '' }}>SMP
                                                    </option>
                                                    <option value="3"
                                                        {{ old('wali_degree') == 3 ? 'selected' : '' }}>SMA
                                                    </option>
                                                    <option value="4"
                                                        {{ old('wali_degree') == 4 ? 'selected' : '' }}>D1
                                                    </option>
                                                    <option value="5"
                                                        {{ old('wali_degree') == 5 ? 'selected' : '' }}>D2
                                                    </option>
                                                    <option value="6"
                                                        {{ old('wali_degree') == 6 ? 'selected' : '' }}>D3
                                                    </option>
                                                    <option
                                                        value="7"{{ old('wali_degree') == 7 ? 'selected' : '' }}>
                                                        S1
                                                    </option>
                                                    <option value="8"
                                                        {{ old('wali_degree') == 8 ? 'selected' : '' }}>S2
                                                    </option>
                                                    <option value="9"
                                                        {{ old('wali_degree') == 9 ? 'selected' : '' }}>S3
                                                    </option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliJob">Pekerjaan Wali:</label>
                                                <input type="text" class="form-control" id="waliJob"
                                                    name="wali_job" value="{{ old('wali_job') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliPhoneNumber">No. Telp Wali:</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" id="waliTelNumber"
                                                        name="wali_tel" placeholder="0823xxxxxxx" pattern="0\d{9,15}"
                                                        value="{{ old('wali_tel') }}" />
                                                    @if ($errors->has('wali_tel'))
                                                        <p class="text-danger">{{ $errors }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliAddress">Alamat Wali:</label>
                                                <input type="textarea" class="form-control" id="waliAddress"
                                                    name="wali_address" value="{{ old('wali_address') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                                    Sebelumnya
                                </button>
                                <button type="button" class="btn btn-primary" id="nextButtonStep3"
                                    onclick="nextStep(4)">
                                    Selanjutnya
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="step" id="step4">
                                <h2>Step 4: Penjadwalan Wawancara</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">Judul</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control form-control-disabled" value="{{ old('title') }}"
                                                required>
                                            @if ($errors->has('title'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('title') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="interview_date">Tanggal</label>
                                            <input type="date" name="interview_date" id="interview_date"
                                                class="form-control
                                                {{ $errors->has('interview_date') ? 'is-invalid' : '' }}"
                                                value="{{ old('interview_date') }}" required>
                                            @if ($errors->has('interview_date'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('interview_date') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="method">Metode</label>
                                            <select name="method" id="method"
                                                class="form-control
                                            {{ $errors->has('method') ? 'is-invalid' : '' }}"
                                                required>
                                                <option selected disabled>Pilih Metode</option>
                                                <option value="online" {{ old('method') == 'online' ? 'selected' : '' }}>
                                                    Online</option>
                                                <option value="offline"
                                                    {{ old('method') == 'offline' ? 'selected' : '' }}>Offline</option>
                                            </select>
                                            @if ($errors->has('method'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('method') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group" id="onlineReason"
                                            style="{{ old('method') == 'online' ? '' : 'display:none;' }}">
                                            <label for="reason">Alasan (jika metode online)</label>
                                            <textarea name="reason" id="online_reason" class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}"
                                                rows="3">{{ old('reason') }}</textarea>
                                            @if ($errors->has('reason'))
                                                <p class="text-danger invalid-feedback" role="alert">
                                                    {{ $errors->first('reason') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" onclick="prevStep(3)">
                                    Sebelumnya
                                </button>
                                <button type="submit" class="btn btn-master btn-thirdty me-3">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('components.script')
@endsection
