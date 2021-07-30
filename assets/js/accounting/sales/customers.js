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

$(".section-above-table .search-holder input").on("keyup", function() {
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
// $(".section-above-table .search-field input[name='filter_customers_table']").on("keyup", function() {
//     var value = $(this).val().toLowerCase();
//     $("#customers_table tbody tr").filter(function() {
//         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
//     });
// });
get_load_customers_table();
$('#customer_receive_payment_modal').on('hidden.bs.modal', function() {
    get_load_customers_table();
});



$(document).on("click", "#customers_table ul li a.created-sales-receipt", function(event) {
    $('#addsalesreceiptModal form').trigger("reset");
    $("#addsalesreceiptModal form #sel-customer2").val($(this).attr('data-customer-id'));
    $("#addsalesreceiptModal form #email2").val($(this).attr('data-email-add'));
    event.preventDefault();
    $.ajax({
        url: baseURL + "/accounting/get_customer_info_for_sales_receipt",
        type: "POST",
        dataType: "json",
        data: {
            customer_id: $(this).attr('data-customer-id'),
        },
        success: function(data) {
            $("#addsalesreceiptModal form #billing_address2").html(data.customer_address);
            $("#addsalesreceiptModal form #datepickerinv8").val(data.date_now);
            $("#addsalesreceiptModal form textarea[name='shipping_to']").html(data.customer_address);
            $("#addsalesreceiptModal form input[name='location_scale']").val(data.business_address);
        },
    });
});

$(document).on('change', 'input[type=checkbox]', function() {
    if (!$(this).is(':checked')) {
        $("#checkbox-all-action").prop("checked", false);
    }
    var ctr = 0;
    $("#customers_table tbody tr td:first-child input[type='checkbox']:checked").each(function() {
        ctr++;
    });
    if (ctr == customer_length) {
        $("#checkbox-all-action").prop("checked", true);
    }
    if (ctr == 0) {
        $(".section-above-table .dropdown-holder ul li").addClass("disabled");
    } else {
        $(".section-above-table .dropdown-holder ul li").removeClass("disabled");
    }
});

$(document).on("click", ".section-above-table .email-by-batch", function(event) {
    var mail_to_bcc = "";
    var mail_to = "";
    $("#customers_table tbody tr td:first-child input[type='checkbox']:checked").each(function() {
        mail_to_bcc += $(this).attr("data-email-add") + ", ";
    });
    if (mail_to_bcc == "") {
        event.preventDefault();
    } else {
        $(this).attr("href", "mailto:" + mail_to + "?bcc=" + mail_to_bcc);
    }
});