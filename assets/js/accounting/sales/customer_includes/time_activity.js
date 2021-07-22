$(document).on("click", "#time_activity_modal .modal-header button.settings", function(event) {
    $("#time_activity_settings_modal").show();
});
$(document).on("click", "#time_activity_settings_modal .content .close-button", function(event) {
    $("#time_activity_settings_modal").hide();
});

$(document).on("change", "#time_activity_settings_modal .content input[name='show_service']", function(event) {
    if ($(this).is(":checked")) {
        $("#time_activity_modal form .services-section").show();
    } else {
        $("#time_activity_modal form .services-section").hide();
    }
});
$(document).on("change", "#time_activity_settings_modal .content input[name='make_time_activity_billable']", function(event) {
    if ($(this).is(":checked")) {
        $("#time_activity_modal form .make_time_activity_billable_section").show();
    } else {
        $("#time_activity_modal form .make_time_activity_billable_section").hide();
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
            $(this).val(parseInt(break_array[0]) + ":" + parseInt(break_array[1]));
        } else {
            $(this).val(parseInt(break_array[0]) + ":00");
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
    if ($("#time_activity_modal form input[name='start-time']").val() == "" || $("#time_activity_modal form input[name='end-time']").val() == "") {
        $("#time_activity_modal form .form-sec.sumary-sec").hide();
    } else {
        $("#time_activity_modal form .form-sec.sumary-sec").show();
        var time_dif = calculate_time_difference();
        var time_duration_text = "";
        var hours = 0;
        var minutes = 0;
        var break_duration = 0;

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