<div class="modal fade" id="waliModal" tabindex="-1" aria-labelledby="waliModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="parentModalLabel">Wali dari
                    {{ $student->fullname }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if (!empty($student))
                <div class="modal-body">
                    <p class="modal-title mb-4">{{ $student->wali->wali_name ?? 'N/A' }}</p>
                    <p class="modal-title mb-4">{{ $student->wali->wali_degree ?? 'N/A' }}
                    </p>

                    <p class="modal-title mb-4">{{ $student->wali->wali_job ?? 'N/A' }}</p>
                    <p class="modal-title mb-4">{{ $student->wali->wali_tel ?? 'N/A' }}</p>
                    <!-- tambahkan penanganan untuk alamat orang tua -->
                    @if ($studentParent->studentParentAddress)
                        <p class="modal-title mb-4">Alamat Wali:
                            {{ $student->wali->wali_address ?? 'N/A' }}
                        </p>
                    @else
                        <p>Alamat Wali tidak tersedia.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            @endif
        </div>
    </div>
</div>
