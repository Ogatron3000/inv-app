<div class="modal fade in" id="new_item_modal">
    <div class="modal-dialog">
        <form id="new_item_form" method="POST" action="/user-equipment/{{ $user->id }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="equipment_select">Equipment:</label>
                        <select name="equipment_id" id="equipment_select" class="form-control @error('equipment_id') is-invalid @endif" onchange="fillSerialNumbers()" required>
                            <option value="">- select equipment -</option>
                            @foreach($equipment as $e)
                                <option value="{{ $e->id }}">{{ $e->full_name }}</option>
                            @endforeach
                        </select>

                        @error('equipment_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="serial_number_select">Serial number:</label>
                        <select name="serial_number_id" id="serial_number_select" class="form-control @error('serial_number_id') is-invalid @endif" required>
                            {{-- populated by AJAX function --}}
                        </select>
                        @error('serial_number_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="date_input">Date:</label>
                        <input type="date" name="date" id="date_input" class="form-control @error('date') is-invalid @endif" required/>
                        @error('date')
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
