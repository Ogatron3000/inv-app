<div class="modal fade in" id="edit_faq_modal">
    <div class="modal-dialog">
        <form id="edit_faq_form" method="POST" action="{{ route('faq.store', $equipmentCategory->id) }}">
            @method('PUT')
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="question">Question:</label>
                        <input type="text" name="question" id="question" class="form-control @error('question') is-invalid @endif" />
                        @error('question')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="answer">Answer:</label>
                        <textarea name="answer" id="answer" class="form-control @error('answer') is-invalid @endif"></textarea>
                        @error('answer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
