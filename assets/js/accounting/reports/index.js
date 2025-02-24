$(document).on('click', 'a.add-to-favorites', function(e) {
    e.preventDefault();
    Swal.fire({
        html: '<h1><span class="bx bx-loader bx-spin"></span></h1><b>Adding to favorites</b>',
        showCancelButton: false,
        showConfirmButton: false
    });
    var el = $(this);
    var id = e.currentTarget.dataset.id;

    $.get('/accounting/reports/add-to-favorites/' + id, function(res) {
        // $('.favorites-item-container').html(res);
        // Swal.close();  
        // toastr.success("Successfully added to favorites");
        window.location.reload(true);
    });
});


$(document).on('click','a.remove-from-favorites', function(e) {
    e.preventDefault();

    Swal.fire({
        html: '<h1><span class="bx bx-loader bx-spin"></span></h1><b>Removing to favorites</b>',
        showCancelButton: false,
        showConfirmButton: false
    });
    var el = $(this);
    var id = e.currentTarget.dataset.id;

    $.get('/accounting/reports/remove-from-favorites/'+id, function(res) {
        // $('.favorites-item-container').html(res);
        // Swal.close();  
        // toastr.success("Successfully removed to favorites");
        window.location.reload(true);
    });
});

$('a.remove-from-favorites').on('mouseenter', function() {
    $(this).css('color', '#888888');
    $(this).children('i').removeClass('bxs-check-square').addClass('bx-checkbox');
});

$('a.remove-from-favorites').on('mouseleave', function() {
    $(this).css('color', '#408854');
    $(this).children('i').removeClass('bx-checkbox').addClass('bxs-check-square');
});

$('a.add-to-favorites').on('mouseenter', function() {
    $(this).css('color', '#408854');
    $(this).children('i').removeClass('bx-checkbox').addClass('bxs-check-square');
});

$('a.add-to-favorites').on('mouseleave', function() {
    $(this).css('color', '#888888');
    $(this).children('i').removeClass('bxs-check-square').addClass('bx-checkbox');
});