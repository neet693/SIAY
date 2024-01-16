@extends('Layout.app')
@section('content')
    <form action="{{ route('ppdb.store') }}" id="enrollmentForm" method="post">
        @csrf
        <div class="step" id="step1">
            <h2>Step 1: School Information</h2>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="grade">Jenjang:</label>
                        <select class="form-control" id="grade" name="education_level_id" required>
                            <option selected>Pilih Jenjang</option>
                            <option value="1">TK</option>
                            <option value="2">SD</option>
                            <option value="3">SMP</option>
                            <option value="4">SMA</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="academicYear">Academic Year:</label>
                        <select class="form-control" id="academicYear" name="academic_year_id" required>
                            <option selected>Academic Year</option>
                            <option value="1">2024 - 2025</option>
                            <option value="2">2025 - 2026</option>
                            <option value="3">2026 - 2027</option>
                            <option value="4">2027 - 2028</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="yahyaNews">Mengetahui Sekolah Kristen Yahya dari:</label>
                        <input type="text" class="form-control" id="yahyaNews" name="news_from" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lastSchool">Asal Sekolah:</label>
                        <input type="text" class="form-control" id="lastSchool" name="last_school" required />
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                Next
            </button>
        </div>

        <!-- Step 2 : Student Information -->
        <div class="step" id="step2">
            <h2>Step 2: Student Information</h2>
            <div class="row mb-3">
                <!-- Bagian Siswa -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fullName">Fullname:</label>
                        <input type="text" class="form-control" id="fullName" name="fullname" required />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="nickName">Nickname:</label>
                        <input type="text" class="form-control" id="nickName" name="nickname" required />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="citizenship">Citizenship:</label>
                        <input type="text" class="form-control" id="citizenship" name="citizenship" required />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" />
                        <label class="form-check-label" for="male"> Male </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" checked />
                        <label class="form-check-label" for="female"> Female </label>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="birthPlace">Place of Birth:</label>
                        <input type="text" class="form-control" id="birthPlace" name="birth_place" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="birthDate">Date of Birth:</label>
                        <input type="date" class="form-control" id="birthDate" name="birth_date" required />
                    </div>
                </div>
                <!-- Akhir Bagian Siswa -->

                <!-- Bagian Agama dan Gereja -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="userReligion">Religion:</label>
                        <select class="form-control" id="userReligion" name="religion_id" required>
                            <option selected>Religion</option>
                            <option value="1">Kristen</option>
                            <option value="2">Katholik</option>
                            <option value="3">Islam</option>
                            <option value="4">Hindu</option>
                            <option value="5">Buddha</option>
                            <option value="6">Konghucu</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="chruchDomicile">Chruch Domicile:</label>
                        <input type="text" class="form-control" id="chruchDomicile" name="church_domicile"
                            required />
                    </div>
                </div>
                <!-- Akhir Bagian Agama dan Gereja -->

                <!-- Bagian Address -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="province">Province:</label>
                        <select class="form-control" id="province" name="student_province" required>
                            <option selected>Select Province</option>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>
                        <input type="hidden" id="student_province" name="province" />
                        <input type="hidden" id="student_province_name" name="student_province_name" readonly />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="regency">Regency:</label>
                        <select class="form-control" id="regency" name="student_regency" required>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>
                        <input type="hidden" id="student_regency" name="regency" />
                        <input type="hidden" id="student_regency_name" name="student_regency_name" readonly />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="district">District:</label>
                        <select class="form-control" id="district" name="student_district" required>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>
                        <input type="hidden" id="student_district" name="district" />
                        <input type="hidden" id="student_district_name" name="student_district_name" readonly />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="village">Village:</label>
                        <select class="form-control" id="village" name="student_village" required>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>

                        <input type="hidden" id="student_village" name="village" />
                        <input type="hidden" id="student_village_name" name="student_village_name" readonly />
                    </div>
                </div>

                <div class="col-lg">
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="textarea" class="form-control" id="address" name="address" required />
                    </div>
                </div>
                <!-- Akhir Bagian Address -->

                <!-- Bagian Family Tree -->
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="childPosition">Anak Ke:</label>
                        <input type="number" class="form-control" min="1" max="20" id="childPosition"
                            name="child_position" required />
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="childNumber">Dari Berapa Saudara:</label>
                        <input type="number" class="form-control" min="1" max="20" id="childNumber"
                            name="child_number" required />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="userBloodType">Blood Type:</label>
                        <select class="form-control" id="userBloodType" name="blood_type_id" required>
                            <option selected>Blood Type</option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">AB</option>
                            <option value="4">O</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="userEmail" class="form-label">Email address:</label>
                        <input type="email" class="form-control" id="userEmail" name="email"
                            placeholder="name@example.com" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="userStay">Status Tinggal:</label>
                        <select class="form-control" id="userStay" name="residence_status_id" required>
                            <option selected>Status Tinggal</option>
                            <option value="1">Bersama Orang Tua</option>
                            <option value="2">Bersama Saudara</option>
                            <option value="3">Asrama</option>
                            <option value="4">Kost</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dadphoneNumber">Dad Phone Number:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                                <!-- Country code or any other prefix -->
                            </div>
                            <input type="tel" class="form-control" id="dadphoneNumber" name="dad_tel"
                                placeholder="Enter phone number" required />
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="momphoneNumber">Mom Phone Number:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+62</span>
                                <!-- Country code or any other prefix -->
                            </div>
                            <input type="tel" class="form-control" id="momphoneNumber" name="mom_tel"
                                placeholder="Enter phone number" required />
                        </div>
                    </div>
                </div>
                <!-- Akhir Bagian Family Tree -->
            </div>

            <button type="button" class="btn btn-secondary" onclick="prevStep(1)">
                Previous
            </button>
            <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                Next
            </button>
        </div>

        <!-- Step 3: Parents Information -->
        <div class="step" id="step3">
            <h2>Step 3: Parents Information</h2>
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dadName">Nama Ayah:</label>
                        <input type="text" class="form-control" id="dadName" name="dad_name" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="momName">Nama Ibu:</label>
                        <input type="text" class="form-control" id="momName" name="mom_name" required />
                    </div>
                </div>

                <!-- Pendidikan Orangtua -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dadDegree">Pendidikan Terakhir Ayah:</label>
                        <select class="form-control" id="dadDegree" name="dad_degree" required>
                            <option selected>Gelar</option>
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
                        <label for="momDegree">Pendidikan Terakhir Ibu:</label>
                        <select class="form-control" id="momDegree" name="mom_degree" required>
                            <option selected>Gelar</option>
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
                <!-- Pendidikan Orangtua -->

                <!-- Awal Pekerjaan Orangtua -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="dadJob">Pekerjaan Ayah:</label>
                        <input type="text" class="form-control" id="dadJob" name="dad_job" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="momJob">Pekerjaan Ibu:</label>
                        <input type="text" class="form-control" id="momJob" name="mom_job" required />
                    </div>
                </div>
                <!-- Akhir Pekerjaan Orangtua -->

                <!-- Bagian Address -->
                <!-- provinceParent -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="provinceParent">Province:</label>
                        <select class="form-control" id="provinceParent" name="parent_province" required>
                            <option selected>Select Province</option>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>

                        <input type="hidden" id="provinceParent" name="provinceParent" />
                        <input type="hidden" id="parent_province_name" name="parent_province_name" readonly />
                    </div>
                </div>

                <!-- regencyParent -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="regencyParent">Regency:</label>
                        <select class="form-control" id="regencyParent" name="parent_regency" required>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>
                        <input type="hidden" id="regencyParent" name="regencyParent" />
                        <input type="hidden" id="parent_regency_name" name="parent_regency_name" readonly />
                    </div>
                </div>

                <!-- districtParent -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="districtParent">District:</label>
                        <select class="form-control" id="districtParent" name="parent_district" required>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>
                        <input type="hidden" id="districtParent" name="districtParent" />
                        <input type="hidden" id="parent_district_name" name="parent_district_name" readonly />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="villageParent">Village:</label>
                        <select class="form-control" id="villageParent" name="parent_village" required>
                            <!-- Options will be added dynamically by JavaScript -->
                        </select>
                        <input type="hidden" id="villageParent" name="villageParent" />
                        <input type="hidden" id="parent_village_name" name="parent_village_name" readonly />
                    </div>
                </div>

                <!-- addressParent -->
                <div class="col-lg">
                    <div class="form-group">
                        <label for="addressParent">Address:</label>
                        <input type="textarea" class="form-control" id="addressParent" name="address" required />
                    </div>
                </div>
                <!-- Akhir Bagian Address -->

                <!-- Payment Method -->
                {{-- <div class="col-lg">
                    <div class="form-group">
                        <label for="paymentMethod">Metode Pembayaran:</label>
                        <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                            <option selected>Pilih Metode</option>
                            <option value="1">Tunai</option>
                            <option value="2">Transfer</option>
                        </select>
                    </div>
                </div> --}}
            </div>

            <button type="button" class="btn btn-secondary" onclick="prevStep(2)">
                Previous
            </button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
@endsection
