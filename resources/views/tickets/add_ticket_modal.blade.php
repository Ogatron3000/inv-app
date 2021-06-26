<div class="modal fade in" id="add_ticket_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form method="GET" action="{{ route('tickets.create') }}" id="add_ticket_modal">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <label for="ticket_type_select">Ticket type:</label>
                            <select name="ticket_type"
                                    id="ticket_type_select"
                                    class="form-control @error('ticket_type') is-invalid @endif">
                                <option value="">- select a ticket type -</option>
                                @foreach($ticketTypes as $ticketType)
                                    <option value="{{ $ticketType }}">{{ $ticketType }}</option>
                                @endforeach
                            </select>
                            @error('ticket_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
