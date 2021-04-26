$(document).ready(function() {
    $("#timezone_settings_form").submit(function(event) {
        var report_series = 0;
        if ($("#report_series_1").is(":checked")) {
            report_series = 1;
        } else if ($("#report_series_2").is(":checked")) {
            report_series = 2;
        } else {
            report_series = 3;
        }
        var formData = {
            tz_display_name: $("#tz_display_name").val(),
            tz_id_of_tz: $("#tz_id_of_tz").val(),
            subscribe: $("#subcribe_weekly_report").is(":checked"),
            est_wage_privacy: $("#est_wage_privacy").is(":checked"),
            report_series: report_series
        };

        Swal.fire({
            html: "Are you sure you want receive Timesheet Report in <strong>" +
                $("#tz_id_of_tz").val() +
                "</strong> timezone?",
            imageUrl: baseURL + "/assets/img/timesheet/timezone.png",
            showDenyButton: true,
            confirmButtonColor: "#2ca01c",
            denyButtonColor: "#d33",
            confirmButtonText: "Yes",
            denyButtonText: "Cancel",
        }).then((result) => {
            if (result.value) {
                $(".tz-form-img-loader").show();
                $("#tz_form_submit").attr("disabled", true);
                $.ajax({
                    type: "POST",
                    url: baseURL + "/timesheet/save_timezone_changes",
                    data: formData,
                    dataType: "json",
                    success: function(data) {
                        $(".tz-form-img-loader").hide();
                        $("#tz_form_submit").attr("disabled", null);
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 1000,
                            title: "Saved",
                            icon: "success",
                        });
                    },
                });
            }
        });

        event.preventDefault();
    });

    $("#tz_display_name").change(function() {
        $("#tz_id_of_tz").val($("#tz_id_" + $("#tz_display_name").val()).val());
        $.ajax({
            type: "POST",
            url: baseURL + "/timesheet/get_next_report",
            data: {
                timezone: $("#tz_id_of_tz").val(),
            },
            dataType: "json",
            success: function(data) {
                $("#next-timesheet-report").html(data);
            },
        });
    });

    set_current_timezone();

    function set_current_timezone() {
        var current_tz = Intl.DateTimeFormat().resolvedOptions().timeZone;
        // alert(current_tz);
        $.ajax({
            url: baseURL + "/timesheet/get_saved_timezone",
            type: "POST",
            dataType: "json",
            data: { usertimezone: current_tz },
            success: function(data) {
                if (data.hasSet) {
                    $("#tz_display_name").val(data.timezone_id);
                    $("#tz_id_of_tz").val(data.timezone_id_of_tz);
                    if (data.subscribed == 1) {
                        $("#subcribe_weekly_report").attr("checked");
                        $(".subscribed-fields").show();
                    } else {
                        $("#subcribe_weekly_report").removeAttr("checked");
                        $(".subscribed-fields").hide();
                    }
                } else {
                    $("#tz_display_name").val(36);
                    $("#tz_id_of_tz").val("Etc/GMT");

                }
                subcribe_weekly_report_changed();
                $.ajax({
                    type: "POST",
                    url: baseURL + "/timesheet/get_next_report",
                    data: {
                        timezone: $("#tz_id_of_tz").val(),
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#next-timesheet-report").html(data);
                    },
                });
            },
        });
    }
    $("#subcribe_weekly_report").change(function() {
        if ($("#subcribe_weekly_report").is(":checked")) {
            $(".subscribed-fields").show();
        } else {
            $(".subscribed-fields").hide();
        }
    });

    $("#subcribe_weekly_report").change(function() {
        subcribe_weekly_report_changed();
    });

    function subcribe_weekly_report_changed() {
        if ($("#subcribe_weekly_report").is(":checked")) {
            $(".report_series_div").show();
        } else {
            $(".report_series_div").hide();
        }
    }
});