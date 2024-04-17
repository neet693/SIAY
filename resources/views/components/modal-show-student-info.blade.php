<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="contactModalLabel">{{ $student->fullname }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Bagian 1 -->
                        <p class="modal-title mb-4">Nama Panggilan: <br> {{ $student->nickname }}
                        </p>
                        <p class="modal-title mb-4">Warga Negara: <br> {{ $student->citizenship }}
                        </p>
                        <p class="modal-title mb-4">Tempat, Tanggal Lahir: <br>
                            {{ $student->birth_place }},
                            {{ $student->birth_date->format('d F Y') }}
                        </p>
                        <p class="modal-title mb-4">Anak ke - {{ $student->child_position }} Dari
                            {{ $student->child_number }} Bersaudara
                        </p>
                        <p class="modal-title mb-4">Email Siswa: <br>
                            {{ $student->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <!-- Bagian 2 -->
                        <p class="modal-title mb-4">Jenis Kelamin: <br>
                            {{ $student->gender = $student->gender == 'female' ? 'Perempuan' : 'Laki - Laki' }}
                        </p>
                        <p class="modal-title mb-4">Golongan Darah: <br>
                            {{ $student->bloodType->type_name }}</p>
                        <p class="modal-title mb-4"> Agama: <br>
                            {{ $student->religion->religion_name }}
                        </p>
                        <p class="modal-title mb-4"> Bergereja di
                            {{ $student->church_domicile }}
                        </p>
                        <p class="modal-title mb-4">Status Tinggal: <br>
                            {{ $student->residenceStatus->status_name }}
                        </p>
                    </div>
                </div>
                <p class="modal-title mb-4">Alamat Siswa:
                    {{ $student->studentAddress->student_province }},
                    {{ $student->studentAddress->student_regency }},
                    {{ $student->studentAddress->student_district }},
                    {{ $student->studentAddress->student_village }},
                    {{ $student->studentAddress->address }}
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
