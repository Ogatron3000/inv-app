<div class="modal fade in" id="export_group_modal">
    <div class="modal-dialog">
        <form id="export_group_form" action="{{ route('export.user_equipment') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="d-flex flex-column">
                            <label for="groupExport">Select Group:</label>
                            <select name="groupExport" id="groupExport" class="form-control">
                                <option value="all">All</option>
                                <optgroup label="department">
                                    @foreach($departments as $department)
                                        <option value="{{ 'department ' . $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="position">
                                    @foreach($positions as $position)
                                        <option value="{{ 'position ' . $position->id }}">{{ $position->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>

                        @error('groupExport')
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
