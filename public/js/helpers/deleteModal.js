$('#delete_modal').on('show.bs.modal', function(e) {
    let button = $(e.relatedTarget),
        dataId = button.data('id');

    $('#confirm_deletion_button').on('click', function (e) {
        $(`#delete_form_${dataId}`).submit();
    });
});
