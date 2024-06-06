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
                                            <select class="form-control" id="grade" name="education_level_id"
                                                data-required="true" required>
                                                <option selected disabled>Pilih Jenjang</option>
                                                <option value="1">TK
                                                </option>
                                                <option value="2">SD</option>
                                                <option value="3">SMP</option>
                                                <option value="4">SMA</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('education_level_id'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="academicYear">Tahun Ajaran:</label>
                                            <select class="form-control" id="academicYear" name="academic_year_id" required>
                                                <option selected disabled>Tahun Ajaran</option>
                                                <option value="1">2024 - 2025</option>
                                                <option value="2">2025 - 2026</option>
                                                <option value="3">2026 - 2027</option>
                                                <option value="4">2027 - 2028</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('academic_year_id'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="yahyaNews">Mengetahui Sekolah Kristen Yahya dari:</label>
                                            <input type="text" class="form-control" placeholder="Ex: Dari Teman"
                                                id="yahyaNews" name="news_from" required />
                                            @if ($errors->has('news_from'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastSchool">Asal Sekolah:</label>
                                            <input type="text" class="form-control" placeholder="Ex: TK Yahya"
                                                id="lastSchool" name="last_school" required />
                                            @if ($errors->has('last_school'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary" id="nextButtonStep1" onclick="nextStep(2)">
                                    Selanjutnya
                                </button>
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
                                            <input type="text" class="form-control" placeholder="Ex: John Doe"
                                                id="fullName" name="fullname" required />
                                            @if ($errors->has('fullname'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="nickName">Nama Panggilan:</label>
                                            <input type="text" class="form-control" placeholder="Ex: John" id="nickName"
                                                name="nickname" required />
                                            @if ($errors->has('nickname'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="citizenship">Kewarganegaraan:</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="citizenship"
                                                    id="wni" value="wni" required>
                                                <label class="form-check-label" for="wni">WNI</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="citizenship"
                                                    id="wna" value="wna" required>
                                                <label class="form-check-label" for="wna">WNA</label>
                                            </div>
                                            @if ($errors->has('citizenship'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label>Gender:</label>
                                            <div class="row px-3">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="male" value="male" />
                                                    <label class="form-check-label" for="male"> Laki - Laki
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="gender"
                                                        id="female" value="female" />
                                                    <label class="form-check-label" for="female"> Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="birthPlace">Tempat Lahir:</label>
                                            <input type="text" class="form-control" id="birthPlace"
                                                placeholder="Ex: Bandung" name="birth_place" required />
                                            @if ($errors->has('birth_place'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="birthDate">Tanggal Lahir:</label>
                                            <input type="date" class="form-control" id="birthDate" name="birth_date"
                                                required />
                                            @if ($errors->has('birth_date'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="userReligion">Agama:</label>
                                            <select class="form-control" id="userReligion" name="religion_id" required>
                                                <option selected disabled>Agama</option>
                                                <option value="1">Kristen</option>
                                                <option value="2">Katholik</option>
                                                <option value="3">Islam</option>
                                                <option value="4">Hindu</option>
                                                <option value="5">Buddha</option>
                                                <option value="6">Konghucu</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('religion_id'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="chruchDomicile">Berjemaat di:</label>
                                            <input type="text" class="form-control"
                                                placeholder="Ex: GKI Taman Cibunut" id="chruchDomicile"
                                                name="church_domicile" required />
                                            @if ($errors->has('church_domicile'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="childPosition">Anak Ke:</label>
                                            <input type="number" class="form-control" placeholder="Ex: 1"
                                                min="1" max="20" id="childPosition" name="child_position"
                                                required />
                                            @if ($errors->has('child_position'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="childNumber">Dari Berapa Saudara:</label>
                                            <input type="number" class="form-control" placeholder="Ex: 1"
                                                min="1" max="20" id="childNumber" name="child_number"
                                                required />
                                            @if ($errors->has('child_number'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userBloodType">Golongan Darah:</label>
                                            <select class="form-control" id="userBloodType" name="blood_type_id"
                                                required>
                                                <option selected disabled>Blood Type</option>
                                                <option value="1">A</option>
                                                <option value="2">B</option>
                                                <option value="3">AB</option>
                                                <option value="4">O</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('blood_type_id'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="userStay">Status Tinggal:</label>
                                            <select class="form-control" id="userStay" name="residence_status_id"
                                                required>
                                                <option selected disabled>Status Tinggal</option>
                                                <option value="1">Bersama Orang Tua</option>
                                                <option value="2">Bersama Saudara</option>
                                                <option value="3">Asrama</option>
                                                <option value="4">Kost</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('residence_status_id'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userEmail" class="form-label">Alamat Email:</label>
                                            <input type="email" class="form-control" id="userEmail" name="email"
                                                placeholder="name@example.com" pattern="[a-zA-Z0-9._%+-]+@gmail\.com"
                                                required />
                                            @if ($errors->has('email'))
                                                <p class="text-danger">{{ $errors }}</p>
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
                                                <input type="textarea" class="form-control"
                                                    placeholder="Ex: Jl. Riau No.71A" id="address" name="address" />

                                                @if ($errors->has('address'))
                                                    <p class="text-danger">{{ $errors }}</p>
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
                                            <input type="text" class="form-control" placeholder="Ex: John Doe"
                                                id="dadName" name="dad_name" required />
                                            @if ($errors->has('dad_name'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momName">Nama Ibu:</label>
                                            <input type="text" class="form-control" placeholder="Ex: Nina Doe"
                                                id="momName" name="mom_name" required />
                                            @if ($errors->has('mom_name'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Pendidikan Orangtua -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dadDegree">Pendidikan Terakhir Ayah:</label>
                                            <select class="form-control" id="dadDegree" name="dad_degree" required>
                                                <option selected disabled>Gelar</option>
                                                <option value="1">SD</option>
                                                <option value="2">SMP</option>
                                                <option value="3">SMA</option>
                                                <option value="4">D1</option>
                                                <option value="5">D2</option>
                                                <option value="6">D3</option>
                                                <option value="7">S1</option>
                                                <option value="8">S2</option>
                                                <option value="9">S3</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('dad_degree'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momDegree">Pendidikan Terakhir Ibu:</label>
                                            <select class="form-control" id="momDegree" name="mom_degree" required>
                                                <option selected disabled>Gelar</option>
                                                <option value="1">SD</option>
                                                <option value="2">SMP</option>
                                                <option value="3">SMA</option>
                                                <option value="4">D1</option>
                                                <option value="5">D2</option>
                                                <option value="6">D3</option>
                                                <option value="7">S1</option>
                                                <option value="8">S2</option>
                                                <option value="9">S3</option>
                                                <!-- Add more options as needed -->
                                            </select>
                                            @if ($errors->has('mom_degree'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Pendidikan Orangtua -->

                                    <!-- Awal Pekerjaan Orangtua -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dadJob">Pekerjaan Ayah:</label>
                                            <input type="text" class="form-control" placeholder="Ex: Guru"
                                                id="dadJob" name="dad_job" required />
                                            @if ($errors->has('dad_job'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momJob">Pekerjaan Ibu:</label>
                                            <input type="text" class="form-control" placeholder="Ex: Guru"
                                                id="momJob" name="mom_job" required />
                                            @if ($errors->has('mom_job'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Akhir Pekerjaan Orangtua -->

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="dadphoneNumber">No. Telp Ayah:</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" id="dadphoneNumber"
                                                    name="dad_tel" placeholder="0823xxxxxxx" pattern="0\d{9,15}"
                                                    required />
                                                @if ($errors->has('dad_tel'))
                                                    <p class="text-danger">{{ $errors }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="momphoneNumber">No. Telp Ibu:</label>
                                            <div class="input-group">
                                                <input type="tel" class="form-control" id="momphoneNumber"
                                                    name="mom_tel" placeholder="0823xxxxxx" pattern="0\d{9,15}"
                                                    required />
                                                @if ($errors->has('mom_tel'))
                                                    <p class="text-danger">{{ $errors }}</p>
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
                                                placeholder="Ex: Jl. Riau No. 71A" id="addressParent" name="address" />
                                            @if ($errors->has('address'))
                                                <p class="text-danger">{{ $errors }}</p>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg">
                                        <div class="form-group">
                                            <label for="parentStay">Status Tinggal:</label>
                                            <select class="form-control" name="parentStay" required>
                                                <option selected disabled>Pilih Status Tinggal</option>
                                                <option value="1">Rumah Pribadi</option>
                                                <option value="2">Apartemen</option>
                                                <option value="3">Kontrak</option>
                                                <option value="4">Kost</option>
                                            </select>
                                            @if ($errors->has('parentStay'))
                                                <p class="text-danger">{{ $errors }}</p>
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
                                                    name="wali_name" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliDegree">Pendidikan Terakhir Wali:</label>
                                                <select class="form-control" id="waliDegree" name="wali_degree">
                                                    <option selected disabled>Gelar</option>
                                                    <option value="1">SD</option>
                                                    <option value="2">SMP</option>
                                                    <option value="3">SMA</option>
                                                    <option value="4">D1</option>
                                                    <option value="5">D2</option>
                                                    <option value="6">D3</option>
                                                    <option value="7">S1</option>
                                                    <option value="8">S2</option>
                                                    <option value="9">S3</option>
                                                    <!-- Add more options as needed -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliJob">Pekerjaan Wali:</label>
                                                <input type="text" class="form-control" id="waliJob"
                                                    name="wali_job" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="waliPhoneNumber">No. Telp Wali:</label>
                                                <div class="input-group">
                                                    <input type="tel" class="form-control" id="waliTelNumber"
                                                        name="wali_tel" placeholder="0823xxxxxxx" pattern="0\d{9,15}" />
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
                                                    name="wali_address" />
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
                                                class="form-control form-control-disabled" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="interview_date">Tanggal</label>
                                            <input type="date" name="interview_date" id="interview_date"
                                                class="form-control" required>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="start_time">Waktu Mulai</label>
                                            <input type="time" name="start_time" id="start_time" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="end_time">Waktu Selesai</label>
                                            <input type="time" name="end_time" id="end_time" class="form-control"
                                                required>
                                        </div> --}}
                                        <div class="form-group">
                                            <label for="method">Metode</label>
                                            <select name="method" id="method" class="form-control" required>
                                                <option selected disabled>Pilih Metode </option>
                                                <option value="online">Online</option>
                                                <option value="offline">Offline</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="onlineReason" style="display:none;">
                                            <label for="reason">Alasan (jika metode online)</label>
                                            <textarea name="reason" id="online_reason" class="form-control" rows="3"></textarea>
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
