$('.clickable-row').click((e) => {
    if (e.target.id !== 'delete_modal_button' && e.target.id !== 'delete_modal_icon') {
        window.location.href = $(e.currentTarget).data('href');
    }
});
