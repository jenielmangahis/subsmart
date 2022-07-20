$('a.add-to-favorites').on('click', function(e) {
    e.preventDefault();
    var el = $(this);
    var id = e.currentTarget.dataset.id;

    $.get('/accounting/reports/add-to-favorites/'+id, function(res) {
        var result = JSON.parse(res);

        if(result.success) {
            location.reload();
        }
    });
});

$('a.remove-from-favorites').on('click', function(e) {
    e.preventDefault();
    var el = $(this);
    var id = e.currentTarget.dataset.id;

    $.get('/accounting/reports/remove-from-favorites/'+id, function(res) {
        var result = JSON.parse(res);

        if(result.success) {
            location.reload();
        }
    });
});

$('a.remove-from-favorites').on('mouseenter', function() {
    $(this).css('color', '#888888');
    $(this).children('i').removeClass('bxs-star').addClass('bx-star');
});

$('a.remove-from-favorites').on('mouseleave', function() {
    $(this).css('color', '#408854');
    $(this).children('i').removeClass('bx-star').addClass('bxs-star');
});

$('a.add-to-favorites').on('mouseenter', function() {
    $(this).css('color', '#408854');
    $(this).children('i').removeClass('bx-star').addClass('bxs-star');
});

$('a.add-to-favorites').on('mouseleave', function() {
    $(this).css('color', '#888888');
    $(this).children('i').removeClass('bxs-star').addClass('bx-star');
});