$(document).on("change", "#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-2 select", function(event) {
    $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .by-end-date").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").hide();
    if ($(this).val() == "By") {
        $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .by-end-date").show();
    } else if ($(this).val() == "After") {
        $("#addsalesreceiptModal .recurring-form-part.below .date-part .input-field-3 .after-occurrences").show();
    }
});

$(document).on("change", "#addsalesreceiptModal select[name='recurring-interval']", function(event) {
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .monthly").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .daily").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .weekly").hide();
    $("#addsalesreceiptModal .recurring-form-part.below .interval-part .yearly").hide();
    if ($(this).val() == "Daily") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .daily").show();
    } else if ($(this).val() == "Weekly") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .weekly").show();
    } else if ($(this).val() == "Monthly") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .monthly").show();
    } else if ($(this).val() == "Yearly") {
        $("#addsalesreceiptModal .recurring-form-part.below .interval-part .yearly").show();
    }
});

$(document).on("change", "#addsalesreceiptModal select[name='recurring-type']", function(event) {
    $("#addsalesreceiptModal .recurring-form-part .schedule-type").hide();
    $("#addsalesreceiptModal .recurring-form-part .reminder-type").hide();
    $("#addsalesreceiptModal .recurring-form-part .unschedule-type").hide();
    if ($(this).val() == "Schedule") {
        $("#addsalesreceiptModal .recurring-form-part .schedule-type").show();
        $("#addsalesreceiptModal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Reminder") {
        $("#addsalesreceiptModal .recurring-form-part .reminder-type").show();
        $("#addsalesreceiptModal .recurring-form-part.below ").show();
    } else if ($(this).val() == "Unschedule") {
        $("#addsalesreceiptModal .recurring-form-part .unschedule-type").show();
        $("#addsalesreceiptModal .recurring-form-part.below ").hide();
    }
});

$(document).on("click", "#addsalesreceiptModal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    $("#addsalesreceiptModal .recurring-form-part").show();
    $("#addsalesreceiptModal .modal-footer-check .middle-links").hide();
    $("#addsalesreceiptModal .modal-footer-check #cancel_recurring").show();
    $("#addsalesreceiptModal .modal-footer-check #closeCheckModal").hide();
    $("#addsalesreceiptModal form input[name='recurring_selected']").val(1);
});
$(document).on("click", "#addsalesreceiptModal .modal-footer-check #clearsalereceipt", function(event) {
    event.preventDefault();
    var recurring_selected = $("#addsalesreceiptModal form input[name='recurring_selected']").val();
    $('#addsalesreceiptModal form').trigger("reset");
    $("#addsalesreceiptModal form textarea").html("");
    $("#addsalesreceiptModal form input[name='recurring_selected']").val(recurring_selected);
});

$(document).on("click", "#addsalesreceiptModal .modal-footer-check #cancel_recurring", function(event) {
    event.preventDefault();
    $("#addsalesreceiptModal .modal-footer-check #cancel_recurring").hide();
    $("#addsalesreceiptModal .recurring-form-part").hide();
    $("#addsalesreceiptModal .modal-footer-check .middle-links").show();
    $("#addsalesreceiptModal .modal-footer-check #closeCheckModal").show();
    $("#addsalesreceiptModal form input[name='recurring_selected']").val("");
});