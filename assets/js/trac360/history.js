$("input.date-picker").datepicker();

$(document).on("click", ".collapse-btn", function() {
    if ($(this).hasClass('collapse-active')) {
        $(this).removeClass('collapse-active');
    } else {
        $('.collapse-btn').removeClass('collapse-active');
        $(this).addClass('collapse-active');
        if ($(this).hasClass('people')) {
            $("#previousjobs-collapse-panel").removeClass("show");
        } else {
            $("#people-collapse-panel").removeClass("show");
        }
    }
});



$(document).on("click", "#employees-view-history-panel .close-btn", function() {
    $("#employees-view-history-panel").removeClass("panel-show");
    $("#employees-view-history-panel").addClass("panel-closed");
});

$(document).on("click", ".people-job-btn", function() {
    $("#employees-view-history-panel").removeClass("panel-closed");
    $("#employees-view-history-panel").addClass("panel-show");
    $("#employees-view-history-panel .panel-content #route-details-setion").hide();
    $("#employees-view-history-panel .panel-content .loader").show();
    $("#employe-history-from").val(date_today);
    $("#employe-history-to").val(date_today);
    $("#employee-history-filter-form").attr("data-user-id", $(this).attr("data-user-id"));
    $("#employees-view-history-panel .employee-name .name").html($(this).attr("data-name"));
    get_employee_history(date_today, date_today, $(this).attr("data-user-id"));

});
$('#employee-history-filter-form').on('submit', function(e) {
    e.preventDefault();
    $("#employees-view-history-panel .panel-content #route-details-setion").hide();
    $("#employees-view-history-panel .panel-content .loader").show();
    get_employee_history($("#employe-history-from").val(), $("#employe-history-to").val(), $("#employee-history-filter-form").attr("data-user-id"));
});

function get_employee_history(the_date_from, the_date_to, the_user_id) {
    $.ajax({
        url: baseURL + "/trac360/get_employee_history",
        type: "POST",
        dataType: "json",
        data: {
            the_user_id: the_user_id,
            the_date_from: the_date_from,
            the_date_to: the_date_to
        },
        success: function(data) {
            if (data != null) {
                if (data.html == "") {
                    $("#route-details-setion .route-details-table .tbody").html('<tr><td class="no-data">No history available.</td></tr>');
                } else {
                    $("#route-details-setion .route-details-table .tbody").html(data.html);
                }
                $("#employees-view-history-panel .panel-content #route-details-setion").show();
                $("#employees-view-history-panel .panel-content .loader").hide();
            }
        },
    });
}