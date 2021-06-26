<div class="modal fade in" id="reject_ticket_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form action="{{ route('tickets.reject', $ticket->id) }}" method="POST" id="reject_ticket_modal_form">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="rejection_comment">Comment:</label>
                            <input type="text" id="rejection_comment" name="rejection_comment" class="form-control @error('rejection_comment') is-invalid @endif" placeholder="Enter a comment" />
                            @error('rejection_comment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Reject</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
