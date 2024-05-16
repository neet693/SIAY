<!-- Modal -->
<div class="modal fade" id="assignStudentsModal" tabindex="-1" aria-labelledby="assignStudentsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignStudentsModalLabel">Assign Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="assignStudentsForm" method="POST" action="{{ route('admin.exams.assign', $exam->id) }}">
                    @csrf
                    <!-- Form content for assigning students -->
                    <div class="mb-3">
                        <label for="studentsList" class="form-label">Select Students</label>
                        <select multiple class="form-control" id="studentsList" name="students[]">
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <button type="button" class="btn btn-secondary" id="assignAllButton">Assign All</button> --}}
                    <button type="submit" class="btn btn-primary">Assign Selected</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const assignAllButton = document.getElementById('assignAllButton');
        const studentsList = document.getElementById('studentsList');
        const assignStudentsForm = document.getElementById('assignStudentsForm');

        assignAllButton.addEventListener('click', function() {
            for (let option of studentsList.options) {
                option.selected = true;
            }
        });

        assignStudentsForm.addEventListener('submit', function() {
            // Clear the selected options before submitting the form
            for (let option of studentsList.options) {
                option.selected = false;
            }
        });
    });
</script>
