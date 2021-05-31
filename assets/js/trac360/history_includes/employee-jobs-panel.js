$("#employee-jobs-from").datepicker({
    minDate: new Date(2007, 1 - 1, 1)
});
$("#employee-jobs-to").datepicker({
    maxDate: '0'
});
$(document).on("click", "#employees-view-jobs-panel .close-btn", function() {
    $("#employees-view-jobs-panel").removeClass("panel-show");
    $("#employees-view-jobs-panel").addClass("panel-closed");
});
$(document).on("click", ".people-job-btn", function() {
    $("#employees-view-jobs-panel").removeClass("panel-closed");
    $("#employees-view-jobs-panel").addClass("panel-show");
    $("#employees-view-jobs-panel .panel-content #route-details-setion").hide();
    $("#employees-view-jobs-panel .panel-content .loader").show();
    $("#employee-jobs-from").val(date_monday_this_week);
    $("#employee-jobs-to").val(date_today);
    $("#employee-jobs-filter-form").attr("data-user-id", $(this).attr("data-user-id"));
    $("#employees-view-jobs-panel .employee-name .name").html($(this).attr("data-name"));
    get_employee_prev_jobs(date_monday_this_week, date_today, $(this).attr("data-user-id"));
    $(".sec-2-option.current_view").removeClass("current_view");
    $(this).parent().parent().parent().parent(".sec-2-option").addClass("current_view");
});
$('#employee-jobs-filter-form').on('submit', function(e) {
    e.preventDefault();
    $("#employees-view-jobs-panel .panel-content #jobs-lists-setion").hide();
    $("#employees-view-jobs-panel .panel-content .loader").show();
    get_employee_prev_jobs($("#employee-jobs-from").val(), $("#employee-jobs-to").val(), $("#employee-jobs-filter-form").attr("data-user-id"));
});
$(document).on('mouseenter', '#single-job-view-panel .route-details-setion .route-details-table .last-coords-details', function(event) {
    const index = parseInt($(this).attr("data-i"));
    openwindow_title(history_map_marker[index]);
}).on('mouseleave', '#single-job-view-panel .route-details-setion .route-details-table .last-coords-details', function() {
    if (infoWindow != null) {
        if (infoWindow) {
            infoWindow.close();
        }
    }
});

function get_employee_prev_jobs(the_date_from, the_date_to, the_user_id) {
    $.ajax({
        url: baseURL + "/trac360/get_employee_prev_jobs",
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
                    $("#employees-view-jobs-panel #jobs-lists-setion").addClass('no-result');
                    $("#employees-view-jobs-panel #jobs-lists-setion").html('<center>No jobs to view.</center>');
                } else {
                    $("#employees-view-jobs-panel #jobs-lists-setion").removeClass('no-result');
                    $("#employees-view-jobs-panel #jobs-lists-setion").html(data.html);
                }
                $("#employees-view-jobs-panel .panel-content #jobs-lists-setion").show();
                $("#employees-view-jobs-panel .panel-content .loader").hide();
            }
        },
    });
}