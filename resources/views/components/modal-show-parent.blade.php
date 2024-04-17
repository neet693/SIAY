<div class="modal fade" id="parentModal" tabindex="-1" aria-labelledby="parentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="parentModalLabel">Orang Tua dari
                    {{ $student->fullname }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if (!empty($studentParent))
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Bagian 1 -->
                            <h4>Informasi ayah</h4>
                            <p class="modal-title mb-4">Nama Ayah: <br>
                                {{ $studentParent->dad_name }}
                            </p>
                            <p class="modal-title mb-4">Gelar Ayah: <br>
                                {{ $studentParent->dad_degree ?? 'N/A' }}
                            </p>
                            <p class="modal-title mb-4">Pekerjaan
                                Ayah: <br> {{ $studentParent->dad_job ?? 'N/A' }}</p>
                            <p class="modal-title mb-4">No. Telp
                                Ayah: <br> {{ $studentParent->dad_tel ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <!-- Bagian 2 -->
                            <h4>Informasi Ibu</h4>
                            <p class="modal-title mb-4">Nama Ibu: <br>
                                {{ $studentParent->mom_name }}
                            </p>
                            <p class="modal-title mb-4">Gelar Ibu: <br>
                                {{ $studentParent->mom_degree ?? 'N/A' }}
                            </p>
                            <p class="modal-title mb-4">Pekerjaan Ibu: <br>
                                {{ $studentParent->mom_job ?? 'N/A' }}</p>
                            <p class="modal-title mb-4">No. Telp Ibu: <br>
                                {{ $studentParent->mom_tel ?? 'N/A' }}</p>
                        </div>
                        @if ($studentParent->studentParentAddress)
                            <p class="modal-title mb-4">Alamat Orang Tua:
                                {{ $studentParent->studentParentAddress->parent_province ?? 'N/A' }},
                                {{ $studentParent->studentParentAddress->parent_regency ?? 'N/A' }},
                                {{ $studentParent->studentParentAddress->parent_district ?? 'N/A' }},
                                {{ $studentParent->studentParentAddress->parent_village ?? 'N/A' }},
                                {{ $studentParent->studentParentAddress->address ?? 'N/A' }}
                            </p>
                        @else
                            <p>Alamat Orang Tua tidak tersedia.</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#editParentModal">Edit</button>
                </div>
            @endif
        </div>
    </div>
</div>
