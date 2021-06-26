<div class="modal fade in" id="export_custom_modal">
    <div class="modal-dialog">
        <form id="export_custom_form" action="{{ route('export.user_equipment') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="d-flex flex-column">
                            <label for="userIds[]">Search:</label>
                            <select id="userIds[]" class="livesearch form-control" multiple name="userIds[]"></select>
                        </div>

                        @error('userIds[]')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Export</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
