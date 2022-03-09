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
        $("#customers_table tbody tr>td>input[type='checkbox']").prop("checked", true);
    } else {
        $("#customers_table tbody tr>td>input[type='checkbox']").prop("checked", false);
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
// $(".section-above-table .search-holder input").focusout(function() {
//     $(".section-above-table .search-holder ul.dropdown-menu").removeClass("show");
// });

get_load_customers_table();
$('#customer_receive_payment_modal').on('hidden.bs.modal', function() {
    get_load_customers_table();
});

get_modal_new_customer();

function get_modal_new_customer() {
    console.log("data");
    console.log("data");
    $.ajax({
        url: baseURL + "/accounting/get-add-customer-details-modal",
        type: "GET",
        data: {},
        success: function(data) {
            $(".new-customer-modal-holdder #modal-container").html(data);
            $(".new-customer-modal-holdder #modal-container #new-customer-modal form").prop("id", "add-new-customer-form");
            $(".new-customer-modal-holdder #modal-container #new-customer-modal button.cancel-add-customer").attr('data-dismiss', 'modal');
        },
    });
}

$(document).on('submit', '#modal-container #new-customer-modal #add-new-customer-form', function(e) {
    e.preventDefault();

    var data = new FormData(this);
    data.set('payee_type', 'customer');

    $.ajax({
        url: baseURL + '/accounting/add-full-payee-details',
        data: data,
        type: 'post',
        processData: false,
        contentType: false,
        success: function(result) {
            var res = JSON.parse(result);
            if (res.updated == true) {
                Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: "Success",
                    html: "Customer details has been updated",
                    icon: "success",
                });
                single_customer_get_customers_details($("#customer-single-modal input[name='customer_id']").val());
                single_customer_page_get_all_customers($("#customer-single-modal input[name='customer_id']").val());
            } else {
                Swal.fire({
                    showConfirmButton: false,
                    timer: 2000,
                    title: "Success",
                    html: "New customer has been added.",
                    icon: "success",
                });
                get_modal_new_customer();
            }
            get_load_customers_table();
            $('#modal-container #new-customer-modal').modal('toggle');
            $(".modal-backdrop.fade.show.modal-stack").hide();
        }
    });

});


$(document).on("click", ".created-sales-receipt", function(event) {
    $('#new-popup #accounting_customers .ajax-modal[data-view="sales_receipt_modal"]').trigger('click');
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

$(document).on('change', '#customers_table input[type=checkbox]', function() {
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


////////////=====>>>>>MAKE CUSTOMER INACTIVE

$(document).on("click", ".section-above-table .make-customer-inactive-by-batch", function(event) {
    var chech_boxes = new Array();
    $("#customers_table tbody tr td:first-child input[type='checkbox']:checked").each(function() {
        chech_boxes.push($(this).attr('data-customer-id'));
    });
    make_custmer_inactive(chech_boxes);
});
$(document).on("click", "#customers_table .make-customer-inactive", function(event) {
    var chech_boxes = new Array();
    chech_boxes.push($(this).attr('data-customer-id'));
    make_custmer_inactive(chech_boxes);
});

function make_custmer_inactive(chech_boxes) {

    if (chech_boxes.length > 0) {
        var customer = "customer"
        if (chech_boxes.length > 1) {
            customer = "customers";
        }
        Swal.fire({
            title: "Make selected " + customer + " Inactive?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/hibernation.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: "Make inactive",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "/accounting/make_customer_inactive",
                    type: "POST",
                    dataType: "json",
                    data: {
                        customer_ids: chech_boxes,
                        action: "by-batch"
                    },
                    success: function(data) {
                        if (data.result == "success") {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Already marked the selected " + customer + " to inactive",
                                icon: "success",
                            });
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Something went wrong.",
                                icon: "error",
                            });
                        }
                    },
                });
            }
        });
    }
}

$(document).on("click", ".section-above-table  .slect-customer-type-by-batch", function(event) {
    $("#select_customer_type_modal").fadeIn();
});
$(document).on("click", "#select_customer_type_modal .select_customer_type_modal-footer  .cancel-btn", function(event) {
    $("#select_customer_type_modal").fadeOut();
});

///