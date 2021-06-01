$('#live-jobs-filter-form').on('submit', function(e) {
    e.preventDefault();
    $("#livejobs-collapse-panel .loader").show();
    $("#livejobs-collapse-panel .livejobs-section").hide();
    get_live_jobs($("#livejobs-collapse-panel #live-jobs-filter-form #livejob-long-id").val());
});

function get_live_jobs(the_job_long_id = "") {
    $.ajax({
        url: baseURL + "/trac360/get_seach_live_jobs",
        type: "POST",
        dataType: "json",
        data: {
            the_job_long_id: the_job_long_id
        },
        success: function(data) {
            if (data != null) {
                if (data.html == "") {
                    $("#livejobs-collapse-panel .livejobs-section").html('<div class="cue-event-name no-data">No live jobs.</div>');
                } else {
                    $("#livejobs-collapse-panel .livejobs-section").html(data.html);
                }
                $("#livejobs-collapse-panel .loader").hide();
                $("#livejobs-collapse-panel .livejobs-section").show();
            }
        },
    });
}