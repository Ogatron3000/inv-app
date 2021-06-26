<div class="modal fade in" id="estimate_finish_date_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('tickets.manage', $ticket->id) }}" method="POST" id="estimate_finish_date_modal_form">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="estimated_finish_date">Estimated Finish Date:</label>
                            <input type="date" id="estimated_finish_date" name="estimated_finish_date" class="form-control @error('estimated_finish_date') is-invalid @endif" required/>
                            @error('estimated_finish_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Manage</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
