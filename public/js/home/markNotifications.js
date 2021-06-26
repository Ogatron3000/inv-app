function sendMarkRequest(id = null) {
    return $.ajax("/mark-as-read", {
        method: 'POST',
        data: { id },
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });
}

$(function () {
    $('.mark-as-read').click(function () {
        let request = sendMarkRequest($(this).data('id'));
        request.done(() => {
            $(this).parents('div.alert').remove();
        });
    });
    $('#mark-all').click(function () {
        let request = sendMarkRequest();
        request.done(() => {
            $('div.alert').remove();
        })
    });
});
