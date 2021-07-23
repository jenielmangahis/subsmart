$(document).on("click", "#time_activity_modal .modal-header button.settings", function(event) {
    $("#time_activity_settings_modal").show();
});
$(document).on("click", "#time_activity_settings_modal .content .close-button", function(event) {
    $("#time_activity_settings_modal").hide();
});
$(document).on("click", ".time-activity-btn", function(event) {
    $("#time_activity_modal form select[name='customer_id']").val($(this).attr("data-customer-id"));
});

$(document).on("change", "#time_activity_settings_modal .content input[name='show_service']", function(event) {
    if ($(this).is(":checked")) {
        $("#time_activity_modal form .services-section").show();
        $("#time_activity_modal form input[name='show_services']").val(1);
    } else {
        $("#time_activity_modal form .services-section").hide();
        $("#time_activity_modal form input[name='show_services']").val(0);
    }
});
$(document).on("change", "#time_activity_settings_modal .content input[name='make_time_activity_billable']", function(event) {
    if ($(this).is(":checked")) {
        $("#time_activity_modal form .make_time_activity_billable_section").show();
        $("#time_activity_modal form input[name='make_time_activity_billable']").val(1);
    } else {
        $("#time_activity_modal form .make_time_activity_billable_section").hide();
        $("#time_activity_modal form input[name='make_time_activity_billable']").val(0);
    }
});

$(document).on("change", "#time_activity_modal form input[name='enter-start-end-times']", function(event) {
    if ($(this).is(":checked")) {
        $("#time_activity_modal form .start-time-end-part").show();
        $("#time_activity_modal form .time-duration-part").hide();
        $("#time_activity_modal form .form-sec.time-start-end .label-part").removeClass("no-height");
    } else {
        $("#time_activity_modal form .start-time-end-part").hide();
        $("#time_activity_modal form .time-duration-part").show();
        $("#time_activity_modal form .form-sec.time-start-end .label-part").addClass("no-height");
    }
});
$(document).on("change", "#time_activity_modal form input[name='start-time']", function(event) {
    start_end_time_changed();
})
$(document).on("change", "#time_activity_modal form input[name='end-time']", function(event) {
    start_end_time_changed();
});

$(document).on("change", "#time_activity_modal form input[name='break-duration']", function(event) {
    var break_array = $(this).val().split(':');
    if (parseInt(break_array[0]) > 0) {
        if (break_array.length > 1) {
            var hour = parseInt(break_array[0]);
            var minute = parseInt(break_array[1]);
            if (parseInt(break_array[0]) < 10) {
                hour = "0" + parseInt(break_array[0]);
            }
            if (parseInt(break_array[1]) < 10) {
                minute = "0" + parseInt(break_array[1]);
            }
            $(this).val(hour + ":" + minute);
        } else {
            var hour = parseInt(break_array[0]);
            if (parseInt(break_array[0]) < 10) {
                hour = "0" + parseInt(break_array[0]);
            }
            $(this).val(hour + ":00");
        }
    } else {
        $(this).val("00:00");
    }
    start_end_time_changed();
});
$(document).on("change", "#time_activity_modal form input[name='time-duration']", function(event) {
    var break_array = $(this).val().split(':');
    if (parseInt(break_array[0]) > 0) {
        if (break_array.length > 1) {
            var hour = parseInt(break_array[0]);
            var minute = parseInt(break_array[1]);
            if (parseInt(break_array[0]) < 10) {
                hour = "0" + parseInt(break_array[0]);
            }
            if (parseInt(break_array[1]) < 10) {
                minute = "0" + parseInt(break_array[1]);
            }
            $(this).val(hour + ":" + minute);
        } else {
            var hour = parseInt(break_array[0]);
            if (parseInt(break_array[0]) < 10) {
                hour = "0" + parseInt(break_array[0]);
            }
            $(this).val(hour + ":00");
        }
    } else {
        $(this).val("00:00");
    }
    start_end_time_changed();
});
$(document).on("change", "#time_activity_modal form input[name='billable-amount']", function(event) {

    if (parseFloat($(this).val()) >= 0) {
        $(this).val(parseFloat($(this).val()));
    } else {
        $(this).val("0.0");
    }
    start_end_time_changed();
});

function start_end_time_changed() {
    if ($("#time_activity_modal form input[name='enter-start-end-times']").is(":checked") && ($("#time_activity_modal form input[name='start-time']").val() == "" || $("#time_activity_modal form input[name='end-time']").val() == "")) {
        $("#time_activity_modal form .form-sec.sumary-sec").hide();
    } else {
        $("#time_activity_modal form .form-sec.sumary-sec").show();
        var time_dif = calculate_time_difference();
        var time_duration_text = "";
        var hours = 0;
        var minutes = 0;
        var break_duration = 0;
        if ($("#time_activity_modal form input[name='enter-start-end-times']").is(":checked")) {
            if ($("#time_activity_modal form input[name='break-duration']").val() != "") {
                var break_array = $("#time_activity_modal form input[name='break-duration']").val().split(':');
                if (parseInt(break_array[0]) > 0) {
                    if (break_array.length > 1) {
                        hours = parseInt(break_array[0]);
                        minutes = parseInt(break_array[1]);
                        break_duration = ((hours * 60) + minutes) / 60;
                    }
                }
            }
        } else {
            if ($("#time_activity_modal form input[name='time-duration']").val() != "") {
                var break_array = $("#time_activity_modal form input[name='time-duration']").val().split(':');
                if (parseInt(break_array[0]) > 0) {
                    if (break_array.length > 1) {
                        hours = parseInt(break_array[0]);
                        minutes = parseInt(break_array[1]);
                        time_dif = ((hours * 60) + minutes) / 60;
                    }
                }
            }
        }

        time_dif = time_dif - break_duration;
        if (time_dif <= 0) {
            $("#time_activity_modal form .form-sec.sumary-sec").hide();
            if ((time_dif + break_duration) < break_duration) {
                $("#time_activity_modal form .form-sec.sumary-sec").show();
                $("#time_activity_modal form .form-sec.sumary-sec .summary").hide();
                $("#time_activity_modal form .form-sec.sumary-sec .summary-error").show();
                $("#time_activity_modal form .form-sec.sumary-sec .summary-error").html("The break time cannot exceed the total time worked. Please correct.")
            }
        } else {
            $("#time_activity_modal form .form-sec.sumary-sec").show();
            $("#time_activity_modal form .form-sec.sumary-sec .summary").show();
            $("#time_activity_modal form .form-sec.sumary-sec .summary-error").hide();
        }

        if (time_dif < 1) {
            if (time_dif > 1) {
                minutes = (time_dif * 60);
                time_duration_text = (minutes.toFixed()) + " minutes";
            } else {
                time_duration_text = (minutes.toFixed()) + " minute";
            }

        } else {
            hours = parseInt(time_dif);
            minutes = (time_dif - hours) * 60;

            if (hours > 1) {
                time_duration_text = hours + " hours ";
            } else {
                time_duration_text = hours + " hours ";
            }
            if (minutes > 0) {
                if (minutes.toFixed() > 1) {
                    time_duration_text += " and " + (minutes.toFixed()) + " minutes ";
                } else {
                    time_duration_text += " and " + (minutes.toFixed()) + " minute ";
                }
            }
        }
        $("#time_activity_modal form .form-sec .form-field-part .summary span.time_duration").html(time_duration_text);
        var bill_per_hour = parseFloat($("#time_activity_modal form input[name='billable-amount']").val());
        if (bill_per_hour >= 0) {
            $("#time_activity_modal form .form-sec .form-field-part .summary span.bill_per_hour").html("$" + (bill_per_hour.toFixed(2)));
            var total = (time_dif * bill_per_hour);
            $("#time_activity_modal form .form-sec .form-field-part .summary span.amount_billable").html("$" + total.toFixed(2));
        } else {
            $("#time_activity_modal form .form-sec.sumary-sec").show();
            $("#time_activity_modal form .form-sec.sumary-sec .summary").hide();
            $("#time_activity_modal form .form-sec.sumary-sec .summary-error").show();
            $("#time_activity_modal form .form-sec.sumary-sec .summary-error").html("Bill amount per hours is not valid.");

        }
    }
    if (!$("#time_activity_modal form input[name='billable']").is(":checked")) {
        $("#time_activity_modal form .form-sec.sumary-sec").hide();
    }
}

function calculate_time_difference() {
    var valuestart = $("#time_activity_modal form input[name='start-time']").val();
    var valuestop = $("#time_activity_modal form input[name='end-time']").val();
    var timeStart_hours = new Date("01/01/2021 " + valuestart).getHours();
    var timeEnd_hours = new Date("01/01/2021 " + valuestop).getHours();
    var timeStart_minutes = new Date("01/01/2021 " + valuestart).getMinutes();
    var timeEnd_minutes = new Date("01/01/2021 " + valuestop).getMinutes();

    var time_difference = (((timeEnd_hours * 60) + timeEnd_minutes) - ((timeStart_hours * 60) + timeStart_minutes)) / 60;
    if (time_difference < 0) {
        time_difference = 24 + time_difference;
    }
    return time_difference;
}

$("#time_activity_modal form").submit(function(event) {
    event.preventDefault();
});
$(document).on("click", "#time_activity_modal form button[data-action='save']", function(event) {
    var submit_type = $(this).attr('data-submit-type');
    $("#time_activity_modal form input[name='submit_option']").val(submit_type);
    var customer_id = $("#time_activity_modal form select[name='customer_id']").val();
    var empty_flds = 0;
    $("#time_activity_modal form  .required").each(function() {
        if (!$.trim($(this).val())) {
            empty_flds++;
        }
    });
    if (empty_flds == 0) {
        event.preventDefault();
        Swal.fire({
            title: "Save this Time Activity?",
            html: "Are you sure you want to save this?",
            showCancelButton: true,
            imageUrl: baseURL + "/assets/img/accounting/customers/folder.png",
            cancelButtonColor: "#d33",
            confirmButtonColor: "#2ca01c",
            confirmButtonText: $(this).html(),
        }).then((result) => {
            if (result.value) {
                $("#loader-modal").show();
                $.ajax({
                    url: baseURL + "/accounting/save_time_activity",
                    type: "POST",
                    dataType: "json",
                    data: $("#time_activity_modal form").serialize(),
                    success: function(data) {
                        if (data.count_save > 0) {
                            $("#time_activity_modal form input[name='time_activity_id']").val(data.time_activity_id);
                            get_load_customers_table();
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Time activity has been saved.",
                                icon: "success",
                            });

                            if (submit_type == "save-new") {
                                $('#time_activity_modal form').trigger("reset");
                                $("#time_activity_modal form select[name='customer_id']").val(customer_id);
                                reset_time_activity_modal_form();
                            } else if (submit_type == "save-close") {
                                $("#time_activity_modal").modal('hide');
                                reset_time_activity_modal_form();
                            }
                        } else {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Error",
                                html: "Please double check your inputs.",
                                icon: "error",
                            });
                            $("#loader-modal").hide();
                        }
                    },
                });
            }
        });

    }
});

function reset_time_activity_modal_form() {
    var customer_id = $("#time_activity_modal form select[name='customer_id']").val();
    $('#time_activity_modal form').trigger("reset");
    $("#time_activity_modal form select[name='customer_id']").val(customer_id);
    $("#time_activity_modal form input[name='time_activity_id']").val("");
    $("#time_activity_modal form .start-time-end-part").hide();
    $("#time_activity_modal form .time-duration-part").show();
    $("#time_activity_modal form .form-sec.time-start-end .label-part").addClass("no-height");
    $("#time_activity_modal form input[name='enter-start-end-times']").prop("checked", fales);
    $("#time_activity_modal form input[name='billable']").prop("checked", true);
    $("#time_activity_modal form input[name='taxable']").prop("checked", true);
    $("#time_activity_settings_modal .content input[name='show_service']").prop("checked", true);
    $("#time_activity_settings_modal .content input[name='make_time_activity_billable']").prop("checked", true);
    $("#time_activity_modal form .make_time_activity_billable_section").show();
    $("#time_activity_modal form input[name='make_time_activity_billable']").val(1);
    $("#time_activity_modal form .services-section").show();
    $("#time_activity_modal form input[name='show_services']").val(1);
}
$('#time_activity_modal').on('hidden.bs.modal', function() { reset_time_activity_modal_form(); });