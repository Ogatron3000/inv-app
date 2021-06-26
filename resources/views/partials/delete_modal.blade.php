<div class="modal fade in" id="delete_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <b class="text-danger">Are you sure?</b>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
                <button id="confirm_deletion_button" class="btn btn-primary">Yes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


{{--<div class="modal fade in" id="delete_modal">--}}
{{--    <div class="modal-dialog">--}}
{{--        <form method="POST" action="" id="delete_form">--}}
{{--            @csrf--}}
{{--            @method('DELETE')--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title">{{ $modalTitle }}</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">×</span></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <b class="text-danger">Are you sure?</b>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <a type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</a>--}}
{{--                    <button type="submit" class="btn btn-primary">Yes</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--        <!-- /.modal-content -->--}}
{{--    </div>--}}
{{--    <!-- /.modal-dialog -->--}}
{{--</div>--}}
