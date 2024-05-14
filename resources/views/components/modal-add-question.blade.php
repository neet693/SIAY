<!-- Modal -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-labelledby="addQuestionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addQuestionModalLabel">Tambah Soal Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-question-form" method="POST" action="{{ route('admin.question.store') }}">
                    @csrf
                    <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                    <div class="form-group">
                        <label for="question_text">Teks Soal:</label>
                        <textarea name="question_text" id="question_text" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="question_type">Question Type</label>
                        <select class="form-control" id="question_type" name="question_type" required>
                            <option value="">Select question type</option>
                            <option value="multiple_choice">Multiple Choice</option>
                            <option value="true_false">True/False</option>
                            <option value="short_answer">Short Answer</option>
                            <option value="essay">Essay</option>
                        </select>
                    </div>

                    <div id="options-container" style="display: none;">
                        <h4>Options</h4>
                        <button type="button" class="btn btn-secondary mb-2" id="add-option">Add Option</button>
                        <div class="form-group option-item">
                            <input type="text" class="form-control mb-2" name="options[0][option_text]"
                                placeholder="Option Text">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="options[0][is_correct]"
                                    value="1">
                                <label class="form-check-label">Is Correct</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#question_type').change(function() {
            if ($(this).val() === 'multiple_choice') {
                $('#options-container').show();
            } else {
                $('#options-container').hide();
            }
        });

        let optionCount = 1;
        $('#add-option').click(function() {
            const optionItem = `<div class="form-group option-item">
                <input type="text" class="form-control mb-2" name="options[${optionCount}][option_text]" placeholder="Option Text" >
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="options[${optionCount}][is_correct]" value="1">
                    <label class="form-check-label">Is Correct</label>
                </div>
            </div>`;
            $('#options-container').append(optionItem);
            optionCount++;
        });
    });
</script>
