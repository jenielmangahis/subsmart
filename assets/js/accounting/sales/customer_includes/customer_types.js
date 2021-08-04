$('#customer_type_modal').on('shown.bs.modal', function(e) {
    get_load_customer_type_table();
})
$(document).on("click", "#customer_type_modal button.new-customer-type-btn", function(event) {
    $("#customer_type_modal #new-customer-type-popup").fadeIn();
    $("#customer_type_modal #new-customer-type-popup button[type='submit']").removeAttr("data-action");
    $("#customer_type_modal #new-customer-type-popup .modal-title h2").html("New customer type");
});
$(document).on("click", "#customer_type_modal #new-customer-type-popup .cancel-btn", function(event) {
    $("#customer_type_modal #new-customer-type-popup").fadeOut();
});

function get_load_customer_type_table() {
    $("#customer_type_modal .table-section table").hide();
    $("#customer_type_modal .modal-loader").show();
    $.ajax({
        url: baseURL + "/accounting/get_load_customer_type_table",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data) {
            $("#customer_type_modal .table-section table tbody").html(data.tbody_html);
            $("#customer_type_modal .modal-loader").hide();
            $("#customer_type_modal .table-section table").show();
        },
    });
}

$("#customer_type_modal #new-customer-type-popup form").submit(function(event) {
    event.preventDefault();
    var swal_title = "Add new customer type?";
    var swal_html = "Add <b>" + $("#customer_type_modal #new-customer-type-popup input[name='customer_type']").val() + "</b> as new customer type?";
    var ajax_url = baseURL + "/accounting/add_new_customer_type";
    var swal_success_message = "New customer type has been added.";
    if ($("#customer_type_modal #new-customer-type-popup form button[type='submit']").attr("data-action") == "edit") {
        swal_title = "Save updated customer type?";
        swal_html = "";
        ajax_url = baseURL + "/accounting/update_customer_type";
        swal_success_message = "Customer type has been updated.";
    }
    Swal.fire({
        title: swal_title,
        html: swal_html,
        showCancelButton: true,
        imageUrl: baseURL + "/assets/img/accounting/customers/customer-behavior.png",
        cancelButtonColor: "#d33",
        confirmButtonColor: "#2ca01c",
        confirmButtonText: "Save",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: ajax_url,
                type: "POST",
                dataType: "json",
                data: $("#customer_type_modal #new-customer-type-popup form").serialize(),
                success: function(data) {
                    if (data.result == "success") {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: swal_success_message,
                            icon: "success",
                        });
                        $("#customer_type_modal #new-customer-type-popup input[name='customer_type']").val("");
                        $("#customer_type_modal #new-customer-type-popup").fadeOut();
                        get_load_customer_type_table();
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
});


$(document).on("click", "#customer_type_modal .delete-customer-type-btn", function(event) {
    Swal.fire({
        title: "Delete?",
        html: "Are you sure you want to delete this customer type <b>" + $(this).attr("data-title") + "</b>?,",
        showCancelButton: true,
        imageUrl: baseURL + "/assets/img/accounting/customers/delete.png",
        cancelButtonColor: "#d33",
        confirmButtonColor: "#2ca01c",
        confirmButtonText: "Delete now",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: baseURL + "/accounting/delete_customer_type",
                type: "POST",
                dataType: "json",
                data: { id: $(this).attr("data-id") },
                success: function(data) {
                    if (data.result == "success") {
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: "Customer type has been deleted.",
                            icon: "success",
                        });
                        get_load_customer_type_table();
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
});
$(document).on("click", "#customer_type_modal .edit-customer-type-btn", function(event) {
    $("#customer_type_modal #new-customer-type-popup").fadeIn();
    $("#customer_type_modal #new-customer-type-popup form button[type='submit']").attr("data-action", "edit");
    $("#customer_type_modal #new-customer-type-popup form input[name='customer-type-id']").val($(this).attr('data-id'));
    $("#customer_type_modal #new-customer-type-popup form input[name='customer_type']").val($(this).attr('data-title'));
    $("#customer_type_modal #new-customer-type-popup .modal-title h2").html("Edit customer type");
});