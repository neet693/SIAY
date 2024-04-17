<!-- Modal -->
<div class="modal fade" id="editParentModal" tabindex="-1" aria-labelledby="editParentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editParentModalLabel">Edit Orang Tua dari {{ $student->fullname }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('student.update-parent', $student->unique_code) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Informasi Ayah</h4>
                            <div class="mb-3">
                                <label for="dad_name" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" id="dad_name" name="dad_name"
                                    value="{{ $studentParent->dad_name ?? '' }}">
                            </div>
                            <div class="mb-3">
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
                            <div class="mb-3">
                                <label for="dad_job" class="form-label">Pekerjaan Ayah</label>
                                <input type="text" class="form-control" id="dad_job" name="dad_job"
                                    value="{{ $studentParent->dad_job ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="dad_tel" class="form-label">No. Telp Ayah</label>
                                <input type="text" class="form-control" id="dad_tel" name="dad_tel"
                                    value="{{ $studentParent->dad_tel ?? '' }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Informasi Ibu</h4>
                            <div class="mb-3">
                                <label for="mom_name" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" id="mom_name" name="mom_name"
                                    value="{{ $studentParent->mom_name ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="mom_degree" class="form-label">Gelar Ibu</label>
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
                            <div class="mb-3">
                                <label for="mom_job" class="form-label">Pekerjaan Ibu</label>
                                <input type="text" class="form-control" id="mom_job" name="mom_job"
                                    value="{{ $studentParent->mom_job ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="mom_tel" class="form-label">No. Telp Ibu</label>
                                <input type="text" class="form-control" id="mom_tel" name="mom_tel"
                                    value="{{ $studentParent->mom_tel ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Alamat Orang Tua</h4>
                            <div class="mb-3">
                                <label for="parent_province" class="form-label">Provinsi</label>
                                <input type="text" class="form-control" id="parent_province"
                                    name="parent_province"
                                    value="{{ $studentParent->studentParentAddress->parent_province ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="parent_regency" class="form-label">Kabupaten/Kota</label>
                                <input type="text" class="form-control" id="parent_regency" name="parent_regency"
                                    value="{{ $studentParent->studentParentAddress->parent_regency ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="parent_district" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control" id="parent_district"
                                    name="parent_district"
                                    value="{{ $studentParent->studentParentAddress->parent_district ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="parent_village" class="form-label">Kelurahan</label>
                                <input type="text" class="form-control" id="parent_village" name="parent_village"
                                    value="{{ $studentParent->studentParentAddress->parent_village ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    value="{{ $studentParent->studentParentAddress->address ?? '' }}">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>
