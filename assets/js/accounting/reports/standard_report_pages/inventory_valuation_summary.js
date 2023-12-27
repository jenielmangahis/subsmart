// $(function() {
//     $('.datepicker').datepicker({
//         format: 'mm/dd/yyyy',
//         orientation: 'bottom',
//         autoclose: true
//     });
// });

// $('.dropdown-menu:not(.export-dropdown)').on('click', function(e) {
//     e.stopPropagation();
// });

// $('#previous-period, #previous-year').on('change', function() {
//     if($(this).prop('checked')) {
//         $(this).parent().next().find('input').prop('disabled', false);
//     } else {
//         $(this).parent().next().find('input').prop('checked', false);
//         $(this).parent().next().find('input').prop('disabled', true);
//     }
// });

// $('input[name="show_rows"]').on('change', function() {
//     var selectedRow = $('input[name="show_rows"]:checked').attr('id').replace('-rows', '');

//     switch(selectedRow) {
//         case 'active' :
//             var row = 'Active rows';
//         break;
//         case 'all' :
//             var row = 'All rows';
//         break;
//         case 'non-zero' :
//             var row = 'Non-zero rows';
//         break;
//     }

//     $(this).parent().parent().prev().find('span').html(row);
// });

// DISABLE UNUSED SCRIPT