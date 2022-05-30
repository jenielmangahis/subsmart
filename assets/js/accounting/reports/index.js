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