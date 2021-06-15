$('#all_sales_table').DataTable({
    "lengthChange": true,
    "searching": true,
    "pageLength": 50,
    "order": [
        [1, "asc"]
    ],
});
$(document).on('change', '#checkbox-all-action', function() {
    if ($("#checkbox-all-action").is(':checked')) {
        for (var i = 0; i < customer_length; i++) {
            $("input[name='checkbox" + i + "']").prop("checked", true);
        }
    } else {
        for (var i = 0; i < customer_length; i++) {
            $("input[name='checkbox" + i + "']").prop("checked", false);
        }
    }
});
$(document).on('change', 'input[type=checkbox]', function() {
    if (!$(this).is(':checked')) {
        $("#checkbox-all-action").prop("checked", false);

    }
});