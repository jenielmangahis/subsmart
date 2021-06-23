$('#customers_table1').DataTable({
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
$(document).on('.section-above-table .search-holder input.search-field', 'input', function() {
    $(".section-above-table .search-holder ul").addClass("show");
    var value = $(this).val();
    if (!(value == "")) {
        $.ajax({
            url: baseURL + "/accounting/get_customer_search_result",
            type: "POST",
            dataType: "json",
            data: { value: value },
            success: function(data) {
                if (data.html != "") {
                    $(".section-above-table .search-holder ul").html(data.html);
                } else {
                    $(".section-above-table .search-holder ul").html('<label style="font-size:12px;padding: 10px;">Please make a valid entry.</label>');
                }
            }
        });
    } else {
        $(".section-above-table .search-holder ul").html('<label style="font-size:12px;padding: 10px;">Please make a valid entry.</label>');
    }

});
$(".section-above-table .search-holder input").focusout(function() {
    $(".section-above-table .search-holder ul.dropdown-menu").removeClass("show");
});
$(".section-above-table .search-field input[name='filter_customers_table']").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#customers_table tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});