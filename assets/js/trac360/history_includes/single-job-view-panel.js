$(document).on("click", "#single-job-view-panel .close-btn", function() {
    $("#single-job-view-panel").removeClass("panel-show");
    $("single-job-view-panel").addClass("panel-closed");
});
$(document).on("click", ".jobs-list-item.clickable", function() {
    var employee_name = $(this).attr("data-employee-name");
    var job_item_selected_view = "";
    if ($(this).attr("data-section") == "prev-panel") {
        job_item_selected_view = $(this).children(".jobs-list-item").html();
    } else {
        job_item_selected_view = $(this).html();
    }
    var job_id = $(this).attr("data-job-id");
    var employee_id = $(this).attr("data-user-id");
    jobs_list_item_clicked(job_id, employee_id, employee_name, job_item_selected_view);
});


function get_jobs_travel_history(the_job_id, the_user_id) {
    $.ajax({
        url: baseURL + "/trac360/get_jobs_travel_history",
        type: "POST",
        dataType: "json",
        data: {
            job_id: the_job_id,
            user_id: the_user_id
        },
        success: function(data) {
            if (data != null) {
                if (data.html == "") {
                    $("#single-job-view-panel .route-details-setion .route-details-table .tbody").html('<tr><td class="no-data">No travel history available.</td></tr>');
                } else {
                    $("#single-job-view-panel .route-details-setion .route-details-table .tbody").html(data.html);
                    emeployee_history_calculateAndDisplayRoute(data.route_latlng);
                }
                $("#single-job-view-panel .panel-content .loader").hide();
                $("#single-job-view-panel .panel-content .route-details-setion").show();
            }
        },
    });
}


function jobs_list_item_clicked(job_id, employee_id, employee_name, job_item_selected_view) {
    $("#single-job-view-panel").removeClass("panel-closed");
    $("#single-job-view-panel").addClass("panel-show");
    $("#single-job-view-panel .panel-content .route-details-setion").hide();
    $("#single-job-view-panel .panel-content .loader").show();
    $("#single-job-view-panel .employee-name .name").html(employee_name);
    $("#single-job-view-panel #job-item-selected-view").html(job_item_selected_view);
    get_jobs_travel_history(job_id, employee_id);
}