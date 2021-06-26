<div class="modal fade in" id="new_position_modal">
    <div class="modal-dialog">
        <form id="new_position_form" method="POST" action="{{ route('positions.store') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div>
                        <label for="department_select">Department:</label>
                        <select name="department_id" id="department_select" class="form-control @error('department_id') is-invalid @endif">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group mt-4">
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @endif" />
                        @error('name')
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
