function app_notification(token, body, device_type, company_id, title) {
    $.ajax({
        url: baseURL + "timesheet/app_notification",
        type: "POST",
        dataType: "json",
        data: {
            body: body,
            device_type: device_type,
            company_id: company_id,
            token: token,
            title: title,
        },
        success: function(data) {
            console.log("App notification success!");
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            $("#loader-modal").hide();
        },
    });
}

$(document).ready(function() {
    let counter;
    let break_content = $("#break-duration").text();
    let hours = parseInt(break_content.slice(0, 1)),
        minutes = parseInt(break_content.slice(4, 5)),
        seconds = parseInt(break_content.slice(7, 8));
    let pause_time;
    let lunch_h = 0;
    let lunch_m = 0;
    let lunch_s = 0;
    let difference = 0,
        latest_diff = 0;

    if ($("#clock-status").val() == 1) {
        breakTime();
    }
    $(document).on("click", "#notificationDP", function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: baseURL + "timesheet/readNotification",
            type: "POST",
            data: { id: id },
            success: function(data) {},
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    });
    $(document).on("click", "#clockIn", function() {
        var selected = this;
        $.ajax({
            url: baseURL + "timesheet/getShiftSchedule",
            type: "POST",
            dataType: "json",
            // data:{clock_in:clock_in},
            success: function(data) {
                var res_config = false;
                var allow_5min = false;
                if (data.resClock.length > 0 && data.attend_count > 0) {
                    res_config = true;
                    if (data.resClock[0]['allow_5min'] == 1) {
                        allow_5min = true;
                        let day = new Date();
                        let dayShift = new Date(data.attend[0]["shift_start"]);
                        let numberOfMinutes = dayShift.getMinutes() - day.getMinutes();
                        let numberOfHours = dayShift.getHours() - day.getHours();

                        if (numberOfHours <= 0 && numberOfMinutes <= 0) {
                            Swal.fire({
                                title: "Clock in?",
                                html: "Are you sure you want to Clock-in?",
                                imageUrl: baseURL + "assets/img/timesheet/work.png",
                                showCancelButton: true,
                                confirmButtonColor: "#2ca01c",
                                cancelButtonColor: "#d33",
                                confirmButtonText: "Yes, I want to Clock-in!",
                            }).then((result) => {
                                if (result.value) {

                                    $.ajax({
                                        url: baseURL + "timesheet/clockinemployee",
                                        type: "POST",
                                        dataType: "json",
                                        // data:{clock_in:clock_in},
                                        success: function(data) {
                                            if (data != null) {

                                                $("#clockIn").attr("id", "clockOut");
                                                $(selected).attr("id", "clockOut");
                                                $(".clock").addClass("clock-active");
                                                $("#attendanceId").val(data.attendance_id);
                                                $(".in").text(data.clock_in_time);
                                                $(".out").text(data.clock_out_time);
                                                $("#userClockIn").text(data.clock_in_time);
                                                $("#userClockOut").text("-");
                                                $("#userLunchIn").text("-");
                                                $("#userLunchOut").text("-");
                                                $("#shiftDuration").text("-");
                                                $("#userShiftDuration").text("-");
                                                $("#break-duration").text("00:00:00");
                                                $(".employeeLunch").attr("id", "lunchIn").attr("disabled", false);
                                                Swal.fire({
                                                    showConfirmButton: false,
                                                    timer: 2000,
                                                    title: "Success",
                                                    html: "You are now Clock-in",
                                                    icon: "success",
                                                });

                                                notificationRing();

                                                Push.Permission.GRANTED; // 'granted'
                                                Push.create(data.FName + " " + data.LName, {
                                                    body: "You're now clocked in!",
                                                    icon: data.profile_img,
                                                    timeout: 20000,
                                                    onClick: function() {
                                                        window.focus();
                                                        this.close();
                                                    },
                                                });
                                                app_notification(
                                                    data.token,
                                                    data.body,
                                                    data.device_type,
                                                    data.company_id,
                                                    data.title
                                                );
                                                if (data.send_sms) {
                                                    clock_in_clock_out_send_sms("+18506195914", data.FName + " " + data.LName + " " + data.content_notification)
                                                }
                                                // get_user_current_geo_possition(data.timesheet_logs_id, "timesheet_logs");

                                                location.reload();
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            var errorMessage = xhr.status + ': ' + xhr.statusText
                                                // alert('Error - ' + errorMessage);
                                                // window.location.replace(baseURL + "mycrm/membership");
                                            Swal.fire({
                                                showConfirmButton: false,
                                                timer: 3000,
                                                title: "Upgrade your subscription",
                                                html: "Account can't clockin due to membership limitation.",
                                                imageUrl: baseURL + "assets/img/timesheet/subscription.png",
                                            });
                                            setTimeout(function() { window.location.replace(baseURL + "mycrm/membership"); }, 3000);
                                        }
                                    });
                                }
                            });
                        } else {
                            var desc = ""
                            if (numberOfHours == 0) {
                                desc = numberOfMinutes;
                            } else {
                                if (numberOfHours == 1) {
                                    if (numberOfMinutes <= 0) {
                                        desc = numberOfHours + " hour";
                                    } else {
                                        desc = numberOfHours + " hour and " + numberOfMinutes + ' minutes';
                                    }
                                }
                            }
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "NOTICE",
                                html: "You're " + desc + " early <br> Try clocking in 5 minute earlier according to your schedule",
                                icon: "info",
                            });
                        }

                    }
                }

                if (data.attend_count == 0) {
                    Swal.fire({
                        title: "Clock in?",
                        html: "Are you sure you want to Clock-in?",
                        imageUrl: baseURL + "assets/img/timesheet/work.png",
                        showCancelButton: true,
                        confirmButtonColor: "#2ca01c",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, I want to Clock-in!",
                    }).then((result) => {
                        if (result.value) {

                            $.ajax({
                                url: baseURL + "timesheet/clockinemployee",
                                type: "POST",
                                dataType: "json",
                                // data:{clock_in:clock_in},
                                success: function(data) {
                                    if (data != null) {


                                        $("#clockIn").attr("id", "clockOut");
                                        $(selected).attr("id", "clockOut");
                                        $(".clock").addClass("clock-active");
                                        $("#attendanceId").val(data.attendance_id);
                                        $(".in").text(data.clock_in_time);
                                        $(".out").text(data.clock_out_time);
                                        $("#userClockIn").text(data.clock_in_time);
                                        $("#userClockOut").text("-");
                                        $("#userLunchIn").text("-");
                                        $("#userLunchOut").text("-");
                                        $("#shiftDuration").text("-");
                                        $("#userShiftDuration").text("-");
                                        $("#break-duration").text("00:00:00");
                                        $(".employeeLunch").attr("id", "lunchIn").attr("disabled", false);
                                        Swal.fire({
                                            showConfirmButton: false,
                                            timer: 2000,
                                            title: "Success",
                                            html: "You are now Clock-in",
                                            icon: "success",
                                        });

                                        notificationRing();

                                        Push.Permission.GRANTED; // 'granted'
                                        Push.create(data.FName + " " + data.LName, {
                                            body: "You're now clocked in!",
                                            icon: data.profile_img,
                                            timeout: 20000,
                                            onClick: function() {
                                                window.focus();
                                                this.close();
                                            },
                                        });
                                        app_notification(
                                            data.token,
                                            data.body,
                                            data.device_type,
                                            data.company_id,
                                            data.title
                                        );
                                        if (data.send_sms) {
                                            clock_in_clock_out_send_sms("+18506195914", data.FName + " " + data.LName + " " + data.content_notification)
                                        }
                                        // get_user_current_geo_possition(data.timesheet_logs_id, "timesheet_logs");

                                        location.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    var errorMessage = xhr.status + ': ' + xhr.statusText
                                        // alert('Error - ' + errorMessage);
                                        // window.location.replace(baseURL + "mycrm/membership");
                                    Swal.fire({
                                        showConfirmButton: false,
                                        timer: 3000,
                                        title: "Upgrade your subscription",
                                        html: "Account can't clockin due to membership limitation.",
                                        imageUrl: baseURL + "assets/img/timesheet/subscription.png",
                                    });
                                    setTimeout(function() { window.location.replace(baseURL + "mycrm/membership"); }, 3000);
                                }
                            });
                        }
                    });
                }

            }
        })



    });


    function breakTime() {
        let latest_lunch = $("#latestLunchTime").val();
        let start = $("#lunchStartTime").val();
        let now = Date.now();
        let output = parseInt(start) * 1000;
        difference = now - output;

        hours = Math.floor(difference / 60 / 60 / 1000);
        minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((difference % (1000 * 60)) / 1000);
        //Get the present lunch in difference
        if (latest_lunch > 0) {
            latest_diff = now - parseInt(latest_lunch) * 1000;
            lunch_h = Math.floor(latest_diff / 60 / 60 / 1000);
            lunch_m = Math.floor((latest_diff % (1000 * 60 * 60)) / (1000 * 60));
            lunch_s = Math.floor((latest_diff % (1000 * 60)) / 1000);
        }

        $("#break-duration").text(
            remainTwoDigit(hours, 2) +
            ":" +
            remainTwoDigit(minutes, 2) +
            ":" +
            remainTwoDigit(seconds, 2)
        );

        if (latest_lunch > 0) {
            pause_time =
                remainTwoDigit(lunch_h, 2) +
                ":" +
                remainTwoDigit(lunch_m, 2) +
                ":" +
                remainTwoDigit(lunch_s, 2);
        } else {
            pause_time =
                remainTwoDigit(hours, 2) +
                ":" +
                remainTwoDigit(minutes, 2) +
                ":" +
                remainTwoDigit(seconds, 2);
        }

        counter = setTimeout(breakTime, 1000);
    }

    function stopCountdown() {
        clearTimeout(counter);
    }

    function clock_in_clock_out_send_sms(phone_number, message) {
        $.ajax({
            url: baseURL + "send-sms/clockin-clockout",
            type: "POST",
            dataType: "json",
            data: { phone_number: phone_number, message: message },
            success: function(data) {
                console.log("sms_status")
                console.log(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    }

    function remainTwoDigit(number, targetLength) {
        let output = number + "";
        while (output.length < targetLength) {
            output = "0" + output;
        }
        return output;
    }


    let confirmLunchin = (function() {
        let executed = false;
        return function() {
            let selected = this;
            let attn_id = $("#attendanceId").val();
            Swal.fire({
                title: "Lunch-in",
                html: "Are you sure you want to take your lunch?",
                imageUrl: baseURL + "assets/img/timesheet/lunch-icon-23.png",
                showDenyButton: true,
                confirmButtonColor: "#2ca01c",
                denyButtonColor: "#d33",
                confirmButtonText: "Yes, I want to Lunch-in!",
                denyButtonText: "I'm done for today.",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: baseURL + "timesheet/lunchInEmployee",
                        type: "POST",
                        dataType: "json",
                        data: { attn_id: attn_id },
                        success: function(data) {
                            if (data != null) {
                                // $(selected).attr('id','lunchOut');
                                $(".clock").removeClass("clock-active").addClass("clock-break");
                                $("#userLunchIn").text(data.lunch_in);
                                $("#userLunchOut").text(null);
                                $("#lunchStartTime").val(data.timestamp);
                                $("#latestLunchTime").val(data.latest_in);
                                $(selected)
                                    .children(".btn-lunch")
                                    .attr(
                                        "src",
                                        "/assets/css/timesheet/images/coffee-active.svg"
                                    );
                                $("#clock-status").val(1);
                                $("#autoClockOut").val(0);
                                // break_end_time = data.end_break;
                                // $('#clock-end-time').val(break_end_time);
                                breakTime();
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: "Success",
                                    html: "You are now on Lunch break",
                                    icon: "success",
                                });
                                app_notification(
                                    data.token,
                                    data.body,
                                    data.device_type,
                                    data.company_id,
                                    data.title
                                );
                                // get_user_current_geo_possition(data.timesheet_logs_id, "timesheet_logs");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                            $("#loader-modal").hide();
                        },
                    });
                } else if (result.isDenied) {
                    confirmClockOut();
                }
            });
        };
    })();

    $(document).on("click", "#clockOut", function() {
        let attn_id = $("#attendanceId").val();
        // alert(attn_id);
        $.ajax({
            url: baseURL + "timesheet/clockOut_validation",
            type: "POST",
            dataType: "json",
            data: { attn_id: attn_id },
            success: function(data) {
                // alert(data);
                if (data.noLunch) {
                    confirmLunchin();
                } else if (data.onLunch) {
                    confirmLunchOut();
                } else {
                    confirmClockOut();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    });
    let confirmLunchOut = (function() {
        let executed = false;
        return function() {
            let selected = this;
            let attn_id = $("#attendanceId").val();
            Swal.fire({
                title: "Lunch-out",
                html: "Done taking your Lunch?",
                imageUrl: baseURL + "assets/img/timesheet/work.png",
                showCancelButton: true,
                confirmButtonColor: "#2ca01c",
                cancelButtonColor: "#d33",
                confirmButtonText: "Back to work!",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: baseURL + "timesheet/lunchOutEmployee",
                        type: "POST",
                        dataType: "json",
                        data: { attn_id: attn_id, pause_time: pause_time },
                        success: function(data) {
                            if (data != null) {
                                // $(selected).attr('id','lunchIn');
                                $(".clock").removeClass("clock-break").addClass("clock-active");
                                $("#userLunchOut").text(data.lunch_time);
                                $(selected)
                                    .children(".btn-lunch")
                                    .attr(
                                        "src",
                                        baseURL + "assets/css/timesheet/images/coffee-static.svg"
                                    );
                                clearTimeout(counter);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: "Success",
                                    html: "You are now Lunch-out",
                                    icon: "success",
                                });
                                app_notification(
                                    data.token,
                                    data.body,
                                    data.device_type,
                                    data.company_id,
                                    data.title
                                );
                                // get_user_current_geo_possition(data.timesheet_logs_id, "timesheet_logs");
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                            $("#loader-modal").hide();
                        },
                    });
                }
            });
        };
    })();

    let confirmClockOut = (function() {
        let executed = false;
        return function() {
            let selected = this;
            let attn_id = $("#attendanceId").val();
            Swal.fire({
                title: "Clock out?",
                html: "Are you sure you want to Clock-out?",
                imageUrl: baseURL + "assets/img/timesheet/clock-out.png",
                showCancelButton: true,
                confirmButtonColor: "#2ca01c",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I want to Clock-out!",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: baseURL + "timesheet/clockOutEmployee",
                        type: "POST",
                        dataType: "json",
                        data: { attn_id: attn_id },
                        success: function(data) {
                            if (data != null) {
                                $("#clockOut").attr("id", null);
                                $("#clockOut").attr("id", "");
                                $(".clock").removeClass("clock-active");
                                $(".out").text(data.clock_out_time);
                                $("#userClockOut").text(data.clock_out_time);
                                $("#shiftDuration").text(data.shift_duration);
                                $("#userShiftDuration").text(data.shift_duration);
                                $(".employeeLunch").attr("id", null).attr("disabled", true);
                                $("#unScheduledShift").val(0);
                                $("#autoClockOut").val(2);
                                $("#attendance_status").val(0);
                                Swal.fire({
                                    showConfirmButton: false,
                                    timer: 2000,
                                    title: "Success",
                                    html: "You are now Clock-out",
                                    icon: "success",
                                });
                                notificationRing();
                                Push.Permission.GRANTED; // 'granted'
                                Push.create(data.FName + " " + data.LName, {
                                    body: "You are now clocked out!",
                                    icon: data.profile_img,
                                    timeout: 20000,
                                    onClick: function() {
                                        window.focus();
                                        this.close();
                                    },
                                });
                            }
                            app_notification(
                                data.token,
                                data.body,
                                data.device_type,
                                data.company_id,
                                data.title
                            );

                            if (data.send_sms) {
                                clock_in_clock_out_send_sms("+18506195914", data.FName + " " + data.LName + " " + data.content_notification)
                            } // get_user_current_geo_possition(data.timesheet_logs_id, "timesheet_logs");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                            $("#loader-modal").hide();
                        },
                    });
                }
            });
        };
    })();
    //Auto clock out
    let autoClockOut = (function() {
        let executed = false;
        return function() {
            if (!executed) {
                executed = true;
                let attn_id = $("#attendanceId").val();
                let expected_end_shift = $("#employeeOvertime").val();
                if (expected_end_shift < 1 || expected_end_shift == "") {
                    expected_end_shift = $("#unScheduledShift").val();
                }
                let time_diff = $("#timeDifference").val();
                let end_shift = new Date(expected_end_shift * 1000);
                let time = end_shift.setHours(end_shift.getHours() - time_diff);
                $.ajax({
                    url: baseURL + "timesheet/clockOutEmployee",
                    type: "POST",
                    dataType: "json",
                    data: { attn_id: attn_id, time: time, auto: "Auto" },
                    success: function(data) {
                        if (data != null) {
                            $("#unScheduledShift").val(null);
                            $(".clock").removeClass("clock-active");
                            $(".out").text(data.clock_out_time);
                            $("#userClockOut").text(data.clock_out_time);
                            $("#shiftDuration").text(data.shift_duration);
                            $("#userShiftDuration").text(data.shift_duration);
                            $(".employeeLunch").attr("id", null).attr("disabled", true);
                            $("#employeeOvertime").val(null);
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "You are now Clock-out",
                                icon: "success",
                            });
                            Push.Permission.GRANTED; // 'granted'
                            Push.create("Auto Clocked out", {
                                body: "User : " + data.FName + " " + data.LName,
                                icon: baseURL + "uploads/users/user-profile/" + data.profile_img,
                                timeout: 20000,
                                onClick: function() {
                                    window.focus();
                                    this.close();
                                },
                            });
                            app_notification(
                                data.token,
                                data.body,
                                data.device_type,
                                data.company_id,
                                data.title
                            );

                            if (data.send_sms) {
                                clock_in_clock_out_send_sms("+18506195914", data.FName + " " + data.LName + " " + data.content_notification)
                            } // get_user_current_geo_possition(data.timesheet_logs_id, "timesheet_logs");
                            // location.reload();
                        } else {
                            console.log("Autoc lockout: Something is wrong!");
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        $("#loader-modal").hide();
                    },
                });
            }
        };
    })();
    // end of auto clock out


    //Live Clock JS
    const deg = 6;
    const hr = document.querySelector("#hr");
    const min = document.querySelector("#min");
    const sec = document.querySelector("#sec");
    if (hr != null) {
        setInterval(() => {
            let day = new Date();
            let hh = day.getHours() * 30;
            let mm = day.getMinutes() * deg;
            let ss = day.getSeconds() * deg;
            hr.style.transform = "rotateZ(" + (hh + mm / 12) + "deg)";
            min.style.transform = "rotateZ(" + mm + "deg)";
            sec.style.transform = "rotateZ(" + ss + "deg)";
        });
    }
    // end of Live clock
    show_my_attendance_logs();

    try {
        $(".ts_schedule").datepicker();
    } catch (err) {
        console.log(err);
    }

    $(document).on("change", "#to_date_logs", function() {
        show_my_attendance_logs();
    });

    $(document).on("change", "#from_date_logs", function() {
        // console.log("pasok");
        show_my_attendance_logs();
    });

    function show_my_attendance_logs() {
        $("#my-attendance-logs").hide();
        $(".table-ts-loader").show();

        try {
            $("#my-attendance-logs").DataTable().destroy();
        } catch (err) {
            console.log(err);
        }

        $.ajax({
            url: baseURL + "timesheet/show_my_attendance_logs",
            type: "POST",
            dataType: "json",
            data: {
                date_from: $("#from_date_logs").val(),
                date_to: $("#to_date_logs").val(),
            },
            success: function(data) {
                // console.log(data);
                try {
                    $(".table-ts-loader").hide();
                    $("#my-attendance-logs").show();
                    $("#my-attendance-logs").html(data);
                    $("#my-attendance-logs").DataTable({
                        ordering: false,
                        paging: false,
                    });
                } catch (err) {
                    console.log(err);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    }
    $(document).on("click", ".request-my-ot", function() {
        let selected = this;

        var user_id = $(selected).attr("data-user-id");
        var attendance_id = $(selected).attr("data-attn-id");
        var shift_date = $(selected).attr("data-shift-date");
        Swal.fire({
            title: "Request Overtime?",
            html: "Are you sure you want to submit Overtime request for the shift date <strong>" +
                shift_date +
                "</strong>?",
            showCancelButton: true,
            imageUrl: baseURL + "assets/img/timesheet/overtime.png",
            confirmButtonColor: "#1D9E74",
            cancelButtonColor: "#d33",
            confirmButtonText: "Request now!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "timesheet/request_my_ot",
                    type: "POST",
                    dataType: "json",
                    data: {
                        attendance_id: attendance_id,
                        user_id: user_id,
                    },
                    success: function(data) {
                        if (data == 0) {
                            show_my_attendance_logs();
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Overtime Requested",
                                html: "Overtime request for <strong>" +
                                    shift_date +
                                    "</strong> has been sent.",
                                icon: "success",
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    });
    $(document).on("click", ".adjust-my-attendance-request", function() {
        $("#request_attendance_correct_from").modal({
            backdrop: "static",
            keyboard: false,
        });
        $(".hiddenSection").show();

        let user_name = $(this).attr("data-name");
        $.ajax({
            url: baseURL + "timesheet/get_spicific_attendance_log",
            type: "POST",
            dataType: "json",
            data: {
                user_id: $(this).attr("data-user-id"),
                att_id: $(this).attr("data-att-id"),
                shift_date: $(this).attr("data-shift-date"),
            },
            success: function(data) {
                $("#form_timesheet_attendance_id").val(data.att_id);
                $("#form_user_id").val(data.user_id);
                $("#form_timesheet_shift_schedule_id").val(data.shift_schedule_id);
                $("#form_shift_start").val(data.shift_start);
                $("#form_shift_end").val(data.shift_end);
                $("#form_clockin_date").val(data.checkin_date);
                $("#form_clockin_time").val(data.checkin_time);
                $("#form_clockout_date").val(data.checkout_date);
                $("#form_clockout_time").val(data.checkout_time);
                $("#form_breakin_date").val(data.breakin_date);
                $("#form_breakin_time").val(data.breakin_time);
                $("#form_breakout_date").val(data.breakout_date);
                $("#form_breakout_time").val(data.breakout_time);
                $("#form_expected_hours").html(data.expected_hours);
                $("#form_worked_hours").html(data.shift_durations);
                $("#form_break_duration").html(data.break_duration);
                $("#form_over_time").html(data.overtime);
                $("#form_attendance_notes").html(data.attendance_note);
                $("#form_minutes_late").html(data.minutes_late);
                $("#form_payable_hours").html(data.payable_hours);
                $("#form_ot_status").html(data.ot_status);
                $("#edit_attendance_name").html(user_name);
                $("#form_expected_break_duration").html(data.expected_break);
                $("#form_expected_work_hours").html(data.expected_work_hours);
                $("#editors_footprint").html(data.footprint_text);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    });
    $(document).on("click", "#submit_attendance_correction_request", function() {
        let selected = this;
        var shift_date = $("#form_clockin_date").val();
        var user_id = $("#form_user_id").val();
        var attendance_id = $("#form_timesheet_attendance_id").val();
        var employee_name = $(selected).attr("data-name");
        Swal.fire({
            title: "Send adjustment request?",
            html: "Are you sure you want to submit attendance correction for shift date <strong>" +
                shift_date +
                "</strong>?",
            showCancelButton: true,
            imageUrl: baseURL + "assets/img/timesheet/attendance_correction.png",
            confirmButtonColor: "#2ca01c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Submit Adjustment now!",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "timesheet/submit_attendance_correction_request",
                    type: "POST",
                    dataType: "json",
                    data: {
                        att_id: attendance_id,
                        user_id: user_id,
                        form_clockin_date: $("#form_clockin_date").val(),
                        form_clockin_time: $("#form_clockin_time").val(),
                        form_clockout_date: $("#form_clockout_date").val(),
                        form_clockout_time: $("#form_clockout_time").val(),
                        form_breakin_date: $("#form_breakin_date").val(),
                        form_breakin_time: $("#form_breakin_time").val(),
                        form_breakout_date: $("#form_breakout_date").val(),
                        form_breakout_time: $("#form_breakout_time").val(),
                    },
                    success: function(data) {
                        if (data == 0) {
                            Swal.fire({
                                showConfirmButton: false,
                                timer: 2000,
                                title: "Success",
                                html: "Attendance correction request for shift date <strong>" +
                                    shift_date +
                                    "</strong> has been sent!",
                                icon: "success",
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    });


    $(document).on("change", "#from_date_correction_requests", function() {
        show_my_correction_requests();
    });

    $(document).on("change", "#to_date_correction_requests", function() {
        show_my_correction_requests();
    });

    function show_my_correction_requests() {
        $("#my_correction_requests").hide();
        $(".my-correction-requests-loader").show();
        $("#my_correction_requests").DataTable().destroy();
        $.ajax({
            url: baseURL + "timesheet/show_my_correction_requests",
            type: "POST",
            dataType: "json",
            data: {
                date_from: $("#from_date_correction_requests").val(),
                date_to: $("#to_date_correction_requests").val(),
            },
            success: function(data) {
                $(".my-correction-requests-loader").hide();
                $("#my_correction_requests").show();
                $("#my_correction_requests").html(data);
                $("#my_correction_requests").DataTable({
                    ordering: false,
                    paging: false,
                });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    }
    $(document).on("click", ".cancel_my_correction_reqiest", function() {
        let shift_date = $(this).attr("data-shift-date");
        let request_id = $(this).attr("data-timesheet-attendance-correction-id");
        let att_id = $(this).attr("data-attn-id");
        let user_id = $(this).attr("data-user-id");
        Swal.fire({
            title: "Cancel this request?",
            html: "Are you sure you want to want to cancel your adjustment request for shift date <strong>" +
                shift_date +
                "</strong>?",
            showCancelButton: true,
            imageUrl: baseURL + "assets/img/timesheet/cancel.png",
            confirmButtonColor: "#2ca01c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Cancel now",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "timesheet/cancel_my_correction_request",
                    type: "POST",
                    dataType: "json",
                    data: {
                        request_id: request_id,
                        att_id: att_id,
                        user_id: user_id,
                    },
                    success: function(data) {
                        show_my_correction_requests();
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: "Correction request has been canceled for shift date <strong>" +
                                shift_date +
                                "</strong> has been sent!",
                            icon: "success",
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    });
    show_my_leave_requests();
    $(document).on("change", "#from_date_leave_requests", function() {
        show_my_leave_requests();
    });

    $(document).on("change", "#to_date_leave_requests", function() {
        show_my_leave_requests();
    });

    function show_my_leave_requests() {
        $("#my_leave_requests").hide();
        $(".my-leave-requests-loader").show();
        $.ajax({
            url: baseURL + "timesheet/show_my_leave_requests",
            type: "POST",
            dataType: "json",
            data: {
                date_from: $("#from_date_leave_requests").val(),
                date_to: $("#to_date_leave_requests").val(),
            },
            success: function(data) {
                $(".my-leave-requests-loader").hide();
                $("#my_leave_requests").show();
                $("#my_leave_requests_body").html(data.display);
                if (!data.hide_action) {
                    $(".leave_request_action_td").hide();
                } else {
                    $(".leave_request_action_td").show();
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    }

    $(document).on("click", ".cancel_my_leave_request", function() {
        let date_filed = $(this).attr("data-date-filed");
        let leave_id = $(this).attr("data-leave-id");
        let user_id = $(this).attr("data-user-id");
        let leave_type = $(this).attr("data-leave-type");
        Swal.fire({
            title: "Cancel this leave request?",
            html: "Are you sure you want to want to cancel this leave request that you filed last <strong>" +
                date_filed +
                "</strong>?",
            showCancelButton: true,
            imageUrl: baseURL + "assets/img/timesheet/cancel.png",
            confirmButtonColor: "#2ca01c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Cancel now",
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: baseURL + "timesheet/cancel_my_leave_request",
                    type: "POST",
                    dataType: "json",
                    data: {
                        date_filed: date_filed,
                        leave_id: leave_id,
                        user_id: user_id,
                    },
                    success: function(data) {
                        show_my_leave_requests();
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 2000,
                            title: "Success",
                            html: "Your  " +
                                leave_type +
                                " request that was filed last <strong>" +
                                date_filed +
                                "</strong> has been canceled!",
                            icon: "success",
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                        $("#loader-modal").hide();
                    },
                });
            }
        });
    });
    show_my_attendance_remarks();
    $(document).on("change", "#week_attendance_remarks", function() {
        show_my_attendance_remarks();
    });

    function show_my_attendance_remarks() {
        $("#show_my_attendance_remarks").hide();
        $(".my-attendance-remarks-loader").show();
        $.ajax({
            url: baseURL + "timesheet/show_my_attendance_remarks",
            type: "POST",
            dataType: "json",
            data: {
                week: $("#week_attendance_remarks").val(),
            },
            success: function(data) {
                $(".my-attendance-remarks-loader").hide();
                $("#show_my_attendance_remarks").show();

                // $("#show_my_attendance_remarks").DataTable().destroy();
                $("#show_my_attendance_remarks").html(data.display);
                // $("#show_my_attendance_remarks").DataTable({
                //   ordering: false,
                //   paging: false,
                // });
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    }
    //Auto clockout popup
    autoClockOut_checker();
    var autoclockout_checker_loop = setInterval(autoClockOut_checker, 5000);
    var auto_popup_executed = false;

    function autoClockOut_checker() {

        let attn_id = $("#attendanceId").val();
        $.ajax({
            url: baseURL + "timesheet/get_shift_duration",
            type: "POST",
            dataType: "json",
            data: { attn_id: attn_id },
            success: function(data) {
                $("#overtime_status_acknowledgement").val(data.overtime_status);
                let startdate = $("#clockedin_date_time").val();
                let anntendance_status = $("#attendance_status").val();
                let overtime_status = $("#overtime_status_acknowledgement").val();
                if (anntendance_status == 1 && data.overtime_status == 0) {
                    // alert("pasok");
                    $.ajax({
                        url: baseURL + "timesheet/get_shift_duration",
                        type: "POST",
                        dataType: "json",
                        data: { attn_id: attn_id },
                        success: function(data) {
                            let was_closed = data.autoclockout_timer_closed;
                            if (data.over_lunch) {
                                clearInterval(autoclockout_checker_loop);
                                $.ajax({
                                    url: baseURL + "timesheet/lunchOutEmployee",
                                    type: "POST",
                                    dataType: "json",
                                    data: { attn_id: attn_id, pause_time: pause_time },
                                    success: function(data) {
                                        clearTimeout(counter);
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        console.log(xhr.status);
                                        console.log(thrownError);
                                        $("#loader-modal").hide();
                                    },
                                });
                                autoClockOut();
                            }
                            if (data.difference > 8) {
                                was_closed = false;
                            }
                            if (was_closed != true) {

                                if (data.difference >= 8 && !auto_popup_executed) {

                                    auto_popup_executed = true;
                                    notificationRing();
                                    if (data.difference < 8.08333333) {
                                        $difference = (8.08333333 - data.difference) * 60 * 60;
                                    } else {
                                        $difference = 10;
                                    }
                                    Swal.fire({
                                        title: "Do you need more time?",
                                        // icon:'question',
                                        html: 'Please select "Continue" to keep working, or select "End Session" to end session now <br> Will close in <strong></strong>',
                                        imageUrl: baseURL + "assets/img/timesheet/clock-out.png",
                                        showDenyButton: true,
                                        confirmButtonText: `Continue`,
                                        denyButtonText: `End Session`,
                                        allowOutsideClick: false,
                                        timer: $difference * 1000,
                                        timerProgressBar: true,
                                        willOpen: () => {
                                            var content;
                                            try {
                                                content = Swal.getContent();
                                            } catch (err) {}

                                            try {
                                                content = Swal.getHtmlContainer();
                                            } catch (err) {}
                                            const $ = content.querySelector.bind(content);
                                            timerInterval = setInterval(() => {
                                                if ((Swal.getTimerLeft() / 1000).toFixed(0) >= 0) {
                                                    var coundown = Swal.getTimerLeft() / 1000 / 60;
                                                    var intV = parseInt(coundown);

                                                    var text_countdown = "";
                                                    if (intV != 0) {
                                                        text_countdown =
                                                            intV + ":" + parseInt((coundown - intV) * 60);
                                                    } else {
                                                        text_countdown = parseInt((coundown - intV) * 60);
                                                    }

                                                    try {
                                                        Swal.getContent().querySelector(
                                                            "strong"
                                                        ).textContent = text_countdown;
                                                    } catch (err) {}

                                                    try {
                                                        Swal.getHtmlContainer().querySelector(
                                                            "strong"
                                                        ).textContent = text_countdown;
                                                    } catch (err) {}
                                                } else {
                                                    clearInterval(timerInterval);
                                                }
                                            }, 100);
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval);
                                        },
                                    }).then((result) => {
                                        let status = 0;
                                        if (result.isConfirmed) {
                                            $("#overtime_status_acknowledgement").val(1);
                                            status = 1;
                                            $.ajax({
                                                url: baseURL + "timesheet/overtimeApproval",
                                                type: "POST",
                                                dataType: "json",
                                                data: { attn_id: attn_id, status: status },
                                                success: function(data) {
                                                    if (data == 1) {
                                                        $("#autoClockOut").val(1);
                                                        Swal.fire({
                                                            showConfirmButton: false,
                                                            timer: 2000,
                                                            title: "Success",
                                                            html: "You can now work more without auto Clock-out.",
                                                            icon: "success",
                                                        });
                                                    }
                                                },
                                                error: function(xhr, ajaxOptions, thrownError) {
                                                    console.log(xhr.status);
                                                    console.log(thrownError);
                                                    $("#loader-modal").hide();
                                                },
                                            });
                                        } else if (result.isDenied) {
                                            clearInterval(autoclockout_checker_loop);
                                            autoClockOut();
                                        }
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            clearInterval(autoclockout_checker_loop);
                                            autoClockOut();
                                        }
                                        var di = result.dismiss;
                                        if (di == "close") {
                                            $.ajax({
                                                url: baseURL + "timesheet/get_shift_duration",
                                                type: "POST",
                                                dataType: "json",
                                                data: { attn_id: attn_id },
                                                success: function(data) {
                                                    if (data.difference > 8.08333333) {
                                                        clearInterval(autoclockout_checker_loop);
                                                        autoClockOut();
                                                    } else {
                                                        $.ajax({
                                                            url: baseURL + "/timesheet/autoclockout_timer_closed",
                                                            type: "POST",
                                                            dataType: "json",
                                                            data: { attn_id: attn_id },
                                                            success: function(data) {},
                                                            error: function(xhr, ajaxOptions, thrownError) {
                                                                console.log(xhr.status);
                                                                console.log(thrownError);
                                                                $("#loader-modal").hide();
                                                            },
                                                        });
                                                    }
                                                },
                                                error: function(xhr, ajaxOptions, thrownError) {
                                                    console.log(xhr.status);
                                                    console.log(thrownError);
                                                    $("#loader-modal").hide();
                                                },
                                            });
                                        }
                                    });
                                }
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                            $("#loader-modal").hide();
                        },
                    });
                } else {
                    clearInterval(autoclockout_checker_loop);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
                $("#loader-modal").hide();
            },
        });
    }
});

function edit_attendance_log_form_changed() {
    let form_clockin_date = $("#form_clockin_date").val();
    let form_clockin_time = $("#form_clockin_time").val();
    let form_clockout_date = $("#form_clockout_date").val();
    let form_clockout_time = $("#form_clockout_time").val();
    let form_breakin_date = $("#form_breakin_date").val();
    let form_breakin_time = $("#form_breakin_time").val();
    let form_breakout_date = $("#form_breakout_date").val();
    let form_breakout_time = $("#form_breakout_time").val();
    let form_expected_hours = $("#form_expected_hours").html();
    let form_expected_work_hours = $("#form_expected_work_hours").html();
    let form_ot_status = $("#form_ot_status").html();

    let arrayofdates = [
        [
            form_clockin_date + " " + form_clockin_time,
            form_clockout_date + " " + form_clockout_time,
        ],
        [
            form_breakin_date + " " + form_breakin_time,
            form_breakout_date + " " + form_breakout_time,
        ],
        [$("#form_shift_start").val(), form_clockin_date + " " + form_clockin_time],
    ];
    let arrayofdurations = new Array();
    for (let i = 0; i < arrayofdates.length; i++) {
        var date1 = new Date(arrayofdates[i][0]);
        var date2 = new Date(arrayofdates[i][1]);
        let diff = (date2.getTime() - date1.getTime()) / 1000 / 60 / 60;
        $rounded_amount = Math.round(diff * 100) / 100;
        if ($rounded_amount > 0) {} else {
            $rounded_amount = 0;
        }
        arrayofdurations.push($rounded_amount);
    }
    var work_hours =
        Math.round((arrayofdurations[0] - arrayofdurations[1]) * 100) / 100;
    $("#form_worked_hours").html(work_hours);
    $("#form_break_duration").html(arrayofdurations[1]);

    let payable_hours = 0;
    if (form_expected_hours == "") {
        if (work_hours > 8) {
            $("#form_over_time").html(Math.round((work_hours - 8) * 100) / 100);
        } else {
            $("#form_over_time").html(0);
        }
    } else {
        if (form_expected_work_hours < work_hours) {
            $("#form_over_time").html(
                Math.round((work_hours - form_expected_work_hours) * 100) / 100
            );
        } else {
            $("#form_over_time").html(0);
        }

        if (form_ot_status == "Approved") {
            $("#form_payable_hours").html(work_hours);
        } else {
            payable_hours = work_hours;
            if (payable_hours > form_expected_work_hours) {
                payable_hours = form_expected_work_hours;
            }

            $("#form_payable_hours").html(payable_hours);
        }
    }

    $("#form_minutes_late").html(Math.round(arrayofdurations[2] * 60));

}


var table_id;
var table_name;

function get_user_current_geo_possition(id, table) {
    table_id = id;
    table_name = table;
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(show_user_current_geo_possition);
    } else {
        console.log("Geolocation is not supported by this browser.");
    }
}

function show_user_current_geo_possition(position) {
    current_user_latitude = position.coords.latitude;
    current_user_longitude = position.coords.longitude;

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
            latLng: new google.maps.LatLng(
                current_user_latitude,
                current_user_longitude
            ),
        },
        function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                    var formattedAddress = "";
                    if (results[0].formatted_address != null) {
                        formattedAddress = results[0].formatted_address;
                    }
                    $.ajax({
                        url: baseURL + "timesheet/timesheet_save_current_geo_location",
                        type: "POST",
                        dataType: "json",
                        data: {
                            table_id: table_id,
                            table_name: table_name,
                            lat: current_user_latitude,
                            lng: current_user_longitude,
                            formatted_address: formattedAddress,
                        },
                        success: function(data) {
                            console.log("current location saved.");
                            console.log(table_id);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                            $("#loader-modal").hide();
                        },
                    });
                }
            }
        }
    );
}