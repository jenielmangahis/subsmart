$('a.add-to-favorites').on('mouseover', function() {
    $(this).children('i').removeClass('fa-star-o').addClass('fa-star');
});

$('a.add-to-favorites').on('mouseout', function() {
    $(this).children('i').removeClass('fa-star').addClass('fa-star-o');
});

$('a.remove-to-favorites').on('mouseover', function() {
    $(this).children('i').removeClass('fa-star').addClass('fa-star-o');
    $(this).addClass('text-secondary');
});

$('a.remove-to-favorites').on('mouseout', function() {
    $(this).children('i').removeClass('fa-star-o').addClass('fa-star');
    $(this).removeClass('text-secondary');
});