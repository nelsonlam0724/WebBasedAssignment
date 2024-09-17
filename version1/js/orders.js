$(() => {
    // GET request
    $('[data-get]').on('click', e => {
        e.preventDefault();
        const url = e.target.dataset.get;
        location = url || location;
    });


    // Confirmation message
    $('[data-order]').on('click', e => {
        const text = e.target.dataset.confirm || 'Are you sure want to cancel this order?';
        if (!confirm(text)) {
            e.preventDefault();
            e.stopImmediatePropagation();
        }
    });

    // POST request
    $('[data-post]').on('click', e => {
        e.preventDefault();
        const url = e.target.dataset.post;
        const f = $('<form>').appendTo(document.body)[0];
        f.method = 'POST';
        f.action = url || location;
        f.submit();
    });

    // Confirmation message
    $('[data-updatestatus]').on('click', e => {
        const text = e.target.dataset.confirm || 'Are you sure want to update this order status?';
        if (!confirm(text)) {
            e.preventDefault();
            e.stopImmediatePropagation();
        }
    });

    
});