<div class="modal fade" id="addZoomModal{{ $interview->id }}" tabindex="-1"
    aria-labelledby="addZoomModalLabel{{ $interview->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addZoomModalLabel{{ $interview->id }}">Set Link Zoom
                    {{ $interview->user->name }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('set-zoom', ['id' => $interview->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <h4>Link Zoom</h4>
                            <div class="mb-3">
                                <label for="link{{ $interview->id }}" class="form-label">Link Zoom</label>
                                <input type="text" class="form-control" id="link{{ $interview->id }}" name="link"
                                    value="{{ old('link', $interview->link) }}">
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
</div>
