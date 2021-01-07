const GET_OTHER_MODAL_URL = "/accounting/get-other-modals/";

$(function() {
    $(document).on('click', 'ul#accounting_order li a[data-toggle="modal"], ul#accounting_employees li a', function(e) {
        e.preventDefault();
        var target = e.currentTarget.dataset;
        var view = target.view
        var modal_element = target.target;

        $.get(GET_OTHER_MODAL_URL+view, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
                $(modal_element).modal('show');
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
                $(modal_element).modal('show');
            }
        });
    });
});