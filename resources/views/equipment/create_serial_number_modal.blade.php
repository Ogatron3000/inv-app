<div class="modal fade in" id="create_serial_number_modal">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('serial_numbers.store', $equipment) }}" id="create_serial_number_form">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Serial Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12">
                            <label for="serial_number_input">Serial Number:</label>
                            <input type="text" class="form-control" name="serial_number" id="create_serial_number_input">
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
