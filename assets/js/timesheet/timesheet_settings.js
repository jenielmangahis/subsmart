$(document).ready(function() {

    var pay = "";




    $("#timezone_settings_form").submit(function(event) {
        var report_series = 0;
        if ($("#report_series_1").is(":checked")) {
            report_series = 1;
        } else if ($("#report_series_2").is(":checked")) {
            report_series = 2;
        } else {
            report_series = 3;
        }
        var sched_day = '';
        $('input[name="sched_day"]:checked').each(function() {
            if (sched_day != '') {
                sched_day += ',' + this.value;
            } else {
                sched_day = this.value;
            }
        });
        var formData = {
            tz_display_name: $("#tz_display_name").val(),
            tz_id_of_tz: $("#tz_id_of_tz").val(),
            subscribe: $("#subcribe_weekly_report").is(":checked"),
            est_wage_privacy: $("#est_wage_privacy").is(":checked"),
            report_series: report_series,
            sched_day: sched_day,
            sched_time: $("#sched_time").val(),
            email_report: $("#email_report").val()
        };
        // alert($("#tz_id_of_tz").val());
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

    $("#est_wage_privacy2").change(function() {


        if ($("#est_wage_privacy2").is(":checked")) {
            $("#est_wage_privacy2").val(1);
            var status = 'Disable';
            $('.allow_clock_in #status').html(status);
        } else {
            $("#est_wage_privacy2").val(0);
            var status = 'Enable';
            $('.allow_clock_in #status').html(status);
        }

    })



    $("#est_wage_privacy2").on("change", function() {
        $.ajax({
            type: "POST",
            url: baseURL + "/timesheet/insertResClockInPayDate_allow",
            data: {
                allow: $("#est_wage_privacy2").val(),
            },
            dataType: "json",
            success: function(data) {
                if (data != null) {

                    var html = data.user[0]['FName'] + " " + data.user[0]['LName'] + ", " + data.last_update;
                    $("#update").html(html);
                }
            },
        });
    })

    $("#GPS_Allow").on("change", function() {

        if ($("#GPS_Allow").is(":checked")) {
            $("#GPS_Allow").val(1);
            $("#gps_toggle").show();
        } else {
            $("#GPS_Allow").val(0);
            $("#gps_toggle").hide();
        }


        $.ajax({
            type: "POST",
            url: baseURL + "/timesheet/insertResClockInPayDate_gps",
            data: {
                gps: $("#GPS_Allow").val(),
            },
            dataType: "json",
            success: function(data) {
                if (data != null) {

                    var html = data.user[0]['FName'] + " " + data.user[0]['LName'] + ", " + data.last_update;
                    $("#gps_update").html(html);
                }
            },
        });
    })


    $("#submit_location_CIn_COut").on("click", function(event) {
        event.preventDefault();
        var clock_In = $("#cIn_Location").val();
        var clock_Out = $("#cOut_Location").val();

        Swal.fire({
            html: "Are you sure you want to save changes for the selection of the start day of the week?",
            imageUrl: baseURL + "/assets/img/question.jpg",
            showDenyButton: true,
            confirmButtonColor: "#2ca01c",
            denyButtonColor: "#d33",
            confirmButtonText: "Yes",
            denyButtonText: "Cancel",
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: baseURL + "/timesheet/insert_cOut_cIn_Location",
                    data: { cIn: clock_In, cOut: clock_Out },
                    dataType: "json",
                    success: function(data) {
                        if (data != null) {

                            var html = data.name[0]['FName'] + " " + data.name[0]['LName'] + ", " + data.last_update;
                            $("#update_locatonCoutCin").html(html);
                        }
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

    })



    $("#submit").on("click", function() {
        $("input[name='payday']:checked").each(function() {
            pay = this.value;
        });

        Swal.fire({
            html: "Are you sure you want to save changes for the selection of the start day of the week?",
            imageUrl: baseURL + "/assets/img/Ask.jpg",
            showDenyButton: true,
            confirmButtonColor: "#2ca01c",
            denyButtonColor: "#d33",
            confirmButtonText: "Yes",
            denyButtonText: "Cancel",
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: "POST",
                    url: baseURL + "/timesheet/insertResClockInPayDate",
                    data: { paydate: pay },
                    dataType: "json",
                    success: function(data) {
                        if (data != null) {

                            var html = data.user[0]['FName'] + " " + data.user[0]['LName'] + ", " + data.last_update;
                            $("#update2").html(html);
                        }
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



    })

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
    $.ajax({
        url: baseURL + "/timesheet/getData",
        type: "POST",
        dataType: "json",
        data: {},
        success: function(data) {

            var html = data.user_payday[0]['FName'] + " " + data.user_payday[0]['LName'] + ", " + data.last_update2;

            var html2 = data.user_allow[0]['FName'] + " " + data.user_allow[0]['LName'] + ", " + data.last_update;

            if (data.result.length > 0) {
                if (data.result[0]['allow_5min'] == 1) {
                    $(".custom-control-input.allow_clock_in").attr('checked', true);
                    var status = 'Disable';
                    $('.allow_clock_in #status').html(status);
                } else {
                    $(".custom-control-input.allow_clock_in").attr('checked', false);
                    var status = 'Enable';
                    $('#status').html(status);
                }

            }


            $("#update2").html(html);
            $(".est_wage_privacy_editor #update").html(html2);

            $("input[name='payday']").each(function() {
                if ($(this).val() == data.result[0]['pay_date']) {
                    $(this).attr('checked', true);
                }
            })
        }
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
                    $("#sched_time").val(data.sched_time);
                    $("#email_report").val(data.email_report);
                    if (data.subscribed == 1) {
                        $("#subcribe_weekly_report").attr("checked");
                        $(".subscribed-fields").show();
                    } else {
                        $("#subcribe_weekly_report").removeAttr("checked");
                        $(".subscribed-fields").hide();
                    }

                    var sched_day = data.sched_day;
                    $("#sched_sun").prop("checked", false);
                    $("#sched_m").prop("checked", false);
                    $("#sched_t").prop("checked", false);
                    $("#sched_w").prop("checked", false);
                    $("#sched_th").prop("checked", false);
                    $("#sched_f").prop("checked", false);
                    $("#sched_sat").prop("checked", false);
                    for (var i = 0; i < sched_day.length; i++) {
                        if (sched_day[i] == "Sun") {
                            $("#sched_sun").prop("checked", true);
                            $('#sched_sun').removeAttr('disabled');
                        }
                        if (sched_day[i] == "Mon") {
                            $("#sched_m").prop("checked", true);
                            $('#sched_m').removeAttr('disabled');
                        }
                        if (sched_day[i] == "Tue") {
                            $("#sched_t").prop("checked", true);
                            $('#sched_t').removeAttr('disabled');
                        }
                        if (sched_day[i] == "Wed") {
                            $("#sched_w").prop("checked", true);
                            $('#sched_w').removeAttr('disabled');
                        }
                        if (sched_day[i] == "Thu") {
                            $("#sched_th").prop("checked", true);
                            $('#sched_th').removeAttr('disabled');
                        }
                        if (sched_day[i] == "Fri") {
                            $("#sched_f").prop("checked", true);
                            $('#sched_f').removeAttr('disabled');
                        }
                        if (sched_day[i] == "Sat") {
                            $("#sched_sat").prop("checked", true);
                            $('#sched_sat').removeAttr('disabled');
                        }
                    }
                    if (data.report_series == 1) {
                        $('#report_series_1').prop("checked", true);
                        report_series_1_changed();
                    } else if (data.report_series == 2) {
                        $('#report_series_2').prop("checked", true);
                    } else {
                        $('#report_series_3').prop("checked", true);
                    }
                } else {
                    $("#tz_display_name").val(36);
                    $("#tz_id_of_tz").val("Etc/GMT");
                    $("#email_report").val(data.email);
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

    $('#report_series_1').change(function() {
        report_series_1_changed();
    });
    report_series_1_changed();

    function report_series_1_changed() {
        if ($('#report_series_1').is(':checked')) {

            $('#sched_sun').prop('checked', true);
            $('#sched_m').prop('checked', true);
            $('#sched_t').prop('checked', true);
            $('#sched_w').prop('checked', true);
            $('#sched_th').prop('checked', true);
            $('#sched_f').prop('checked', true);
            $('#sched_sat').prop('checked', true);


            $('#sched_sun').attr('disabled', true);
            $('#sched_m').attr('disabled', true);
            $('#sched_t').attr('disabled', true);
            $('#sched_w').attr('disabled', true);
            $('#sched_th').attr('disabled', true);
            $('#sched_f').attr('disabled', true);
            $('#sched_sat').attr('disabled', true);
        }
    }
    $('#report_series_2').change(function() {
        report_series_2_changed();
    });

    function report_series_2_changed() {
        if ($('#report_series_2').is(':checked')) {
            $('#sched_sun').prop('checked', true);
            $('#sched_m').prop('checked', false);
            $('#sched_t').prop('checked', false);
            $('#sched_w').prop('checked', true);
            $('#sched_th').prop('checked', false);
            $('#sched_f').prop('checked', false);
            $('#sched_sat').prop('checked', false);

            $('#sched_sun').removeAttr('disabled');
            $('#sched_m').removeAttr('disabled');
            $('#sched_t').removeAttr('disabled');
            $('#sched_w').removeAttr('disabled');
            $('#sched_th').removeAttr('disabled');
            $('#sched_f').removeAttr('disabled');
            $('#sched_sat').removeAttr('disabled');
            sched_day_changed();
        }
    }
    $('#report_series_3').change(function() {
        report_series_3_changed();
    });
    report_series_3_changed();

    function report_series_3_changed() {
        if ($('#report_series_3').is(':checked')) {
            $('#sched_sun').prop('checked', true);
            $('#sched_m').prop('checked', false);
            $('#sched_t').prop('checked', false);
            $('#sched_w').prop('checked', false);
            $('#sched_th').prop('checked', false);
            $('#sched_f').prop('checked', false);
            $('#sched_sat').prop('checked', false);

            $('#sched_sun').removeAttr('disabled');
            $('#sched_m').removeAttr('disabled');
            $('#sched_t').removeAttr('disabled');
            $('#sched_w').removeAttr('disabled');
            $('#sched_th').removeAttr('disabled');
            $('#sched_f').removeAttr('disabled');
            $('#sched_sat').removeAttr('disabled');
            sched_day_changed();
        }
    }

});

function sched_day_changed() {
    if ($('#report_series_2').is(':checked')) {
        var counter = 0;
        $('input[name="sched_day"]:checked').each(function() {
            counter++;
        });
        if (counter >= 2) {
            if (!$('#sched_sun').is(':checked')) {
                $('#sched_sun').attr('disabled', true);
            }
            if (!$('#sched_m').is(':checked')) {
                $('#sched_m').attr('disabled', true);
            }
            if (!$('#sched_t').is(':checked')) {
                $('#sched_t').attr('disabled', true);
            }
            if (!$('#sched_w').is(':checked')) {
                $('#sched_w').attr('disabled', true);
            }
            if (!$('#sched_th').is(':checked')) {
                $('#sched_th').attr('disabled', true);
            }
            if (!$('#sched_f').is(':checked')) {
                $('#sched_f').attr('disabled', true);
            }
            if (!$('#sched_sat').is(':checked')) {
                $('#sched_sat').attr('disabled', true);
            }
        } else {
            $('#sched_sun').removeAttr('disabled');
            $('#sched_m').removeAttr('disabled');
            $('#sched_t').removeAttr('disabled');
            $('#sched_w').removeAttr('disabled');
            $('#sched_th').removeAttr('disabled');
            $('#sched_f').removeAttr('disabled');
            $('#sched_sat').removeAttr('disabled');
        }
    }

    if ($('#report_series_3').is(':checked')) {
        var counter = 0;
        $('input[name="sched_day"]:checked').each(function() {
            counter++;
        });
        if (counter >= 1) {
            if (!$('#sched_sun').is(':checked')) {
                $('#sched_sun').attr('disabled', true);
            }
            if (!$('#sched_m').is(':checked')) {
                $('#sched_m').attr('disabled', true);
            }
            if (!$('#sched_t').is(':checked')) {
                $('#sched_t').attr('disabled', true);
            }
            if (!$('#sched_w').is(':checked')) {
                $('#sched_w').attr('disabled', true);
            }
            if (!$('#sched_th').is(':checked')) {
                $('#sched_th').attr('disabled', true);
            }
            if (!$('#sched_f').is(':checked')) {
                $('#sched_f').attr('disabled', true);
            }
            if (!$('#sched_sat').is(':checked')) {
                $('#sched_sat').attr('disabled', true);
            }
        } else {
            $('#sched_sun').removeAttr('disabled');
            $('#sched_m').removeAttr('disabled');
            $('#sched_t').removeAttr('disabled');
            $('#sched_w').removeAttr('disabled');
            $('#sched_th').removeAttr('disabled');
            $('#sched_f').removeAttr('disabled');
            $('#sched_sat').removeAttr('disabled');
        }
    }

}