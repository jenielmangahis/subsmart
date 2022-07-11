$('.nsm-table tr[data-toggle="collapse"]').on('click', function(e) {
    var target = e.currentTarget.dataset.target;

    $(target).collapse('toggle');

    if($(this).find('td:nth-child(2)').find('i').hasClass('bx-chevron-down')) {
        $(this).find('td:nth-child(2)').find('i').removeClass('bx-chevron-down').addClass('bx-chevron-up');
    } else {
        $(this).find('td:nth-child(2)').find('i').removeClass('bx-chevron-up').addClass('bx-chevron-down');
    }
});