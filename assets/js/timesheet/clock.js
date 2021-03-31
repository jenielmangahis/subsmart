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
    success: function (data) {
      console.log("App notification success!");
    },
  });
}

$(document).ready(function () {
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
  $(document).on("click", "#notificationDP", function () {
    var id = $(this).attr("data-id");
    $.ajax({
      url: baseURL + "/timesheet/readNotification",
      type: "POST",
      data: { id: id },
      success: function (data) {},
    });
  });
  $(document).on("click", "#clockIn", function () {
    let selected = this;
    Swal.fire({
      title: "Clock in?",
      html: "Are you sure you want to Clock-in?",
      imageUrl: baseURL + "/assets/img/timesheet/work.png",
      showCancelButton: true,
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, I want to Clock-in!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/clockinemployee",
          type: "POST",
          dataType: "json",
          // data:{clock_in:clock_in},
          success: function (data) {
            if (data != null) {
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
                onClick: function () {
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
            }
          },
        });
      }
    });
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

  function remainTwoDigit(number, targetLength) {
    let output = number + "";
    while (output.length < targetLength) {
      output = "0" + output;
    }
    return output;
  }
  let start_sched = (function () {
    let executed = false;
    return function () {
      if (!executed) {
        executed = true;
        $.ajax({
          url: baseURL + "/timesheet/notifyStartSchedule",
          dataType: "json",
          data: "POST",
          success: function (data) {
            var notify_count = $("#notifyBadge").text();
            if (notify_count == "") {
              notify_count = 0;
            }
            var count = parseInt(notify_count) + 1;
            $("#notificationList").prepend(data);
            $("#notifyBadge").css("visibility", "visible").text(count);
            $(".layer-1").css("animation", "animation-layer-1 5000ms infinite");
            $(".layer-2").css("animation", "animation-layer-2 5000ms infinite");
            $(".layer-3").css("animation", "animation-layer-3 5000ms infinite");
            $("#employeePingStart").val(0);
            notificationRing();
          },
        });
      }
    };
  })();
  let overtime = (function () {
    let executed = false;
    return function () {
      if (!executed) {
        executed = true;
        $.ajax({
          url: baseURL + "/timesheet/notifyEndSchedule",
          dataType: "json",
          data: "POST",
          success: function (data) {
            var notify_count = $("#notifyBadge").text();
            if (notify_count == "") {
              notify_count = 0;
            }
            var count = parseInt(notify_count) + 1;
            $("#notificationList").prepend(data);
            $("#notifyBadge").css("visibility", "visible").text(count);
            $(".layer-1").css("animation", "animation-layer-1 5000ms infinite");
            $(".layer-2").css("animation", "animation-layer-2 5000ms infinite");
            $(".layer-3").css("animation", "animation-layer-3 5000ms infinite");
            $("#employeePingEnd").val(0);
            notificationRing();
          },
        });
      }
    };
  })();

  let overtimeTimer = (function () {
    let executed = false;
    return function () {
      // alert(executed);
      if (!executed) {
        executed = true;
        let attn_id = $("#attendanceId").val();
        let timerInterval;
        let current_time = new Date();
        let shift_end = $("#unScheduledShift").val();
        let set_time = new Date(shift_end * 1000);
        set_time.setMinutes(set_time.getMinutes() - 10);
        // set_time.setHours(set_time.getHours() + 1);
        let timer = set_time.setSeconds(set_time.getSeconds());
        let difference = timer - current_time.getTime();
        if (difference <= 0) {
          difference = 1000;
        }
      }
    };
  })();

  $(document).on("click", "#clockOut", function () {
    let attn_id = $("#attendanceId").val();
    // alert(attn_id);
    $.ajax({
      url: baseURL + "/timesheet/clockOut_validation",
      type: "POST",
      dataType: "json",
      data: { attn_id: attn_id },
      success: function (data) {
        // alert(data);
        if (data.noLunch) {
          confirmLunchin();
        } else if (data.onLunch) {
          confirmLunchOut();
        } else {
          confirmClockOut();
        }
      },
    });
  });

  let confirmLunchin = (function () {
    let executed = false;
    return function () {
      let selected = this;
      let attn_id = $("#attendanceId").val();
      Swal.fire({
        title: "Lunch-in",
        html: "Are you sure you want to take your lunch?",
        imageUrl: baseURL + "/assets/img/timesheet/lunch-icon-23.png",
        showDenyButton: true,
        confirmButtonColor: "#2ca01c",
        denyButtonColor: "#d33",
        confirmButtonText: "Yes, I want to Lunch-in!",
        denyButtonText: "I'm done for today.",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseURL + "/timesheet/lunchInEmployee",
            type: "POST",
            dataType: "json",
            data: { attn_id: attn_id },
            success: function (data) {
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
              }
            },
          });
        } else if (result.isDenied) {
          confirmClockOut();
        }
      });
    };
  })();

  let confirmLunchOut = (function () {
    let executed = false;
    return function () {
      let selected = this;
      let attn_id = $("#attendanceId").val();
      Swal.fire({
        title: "Lunch-out",
        html: "Done taking your Lunch?",
        imageUrl: baseURL + "/assets/img/timesheet/work.png",
        showCancelButton: true,
        confirmButtonColor: "#2ca01c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Back to work!",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseURL + "/timesheet/lunchOutEmployee",
            type: "POST",
            dataType: "json",
            data: { attn_id: attn_id, pause_time: pause_time },
            success: function (data) {
              if (data != null) {
                // $(selected).attr('id','lunchIn');
                $(".clock").removeClass("clock-break").addClass("clock-active");
                $("#userLunchOut").text(data.lunch_time);
                $(selected)
                  .children(".btn-lunch")
                  .attr(
                    "src",
                    baseURL + "/assets/css/timesheet/images/coffee-static.svg"
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
              }
            },
          });
        }
      });
    };
  })();

  let confirmClockOut = (function () {
    let executed = false;
    return function () {
      let selected = this;
      let attn_id = $("#attendanceId").val();
      Swal.fire({
        title: "Clock out?",
        html: "Are you sure you want to Clock-out?",
        imageUrl: baseURL + "/assets/img/timesheet/clock-out.png",
        showCancelButton: true,
        confirmButtonColor: "#2ca01c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, I want to Clock-out!",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseURL + "/timesheet/clockOutEmployee",
            type: "POST",
            dataType: "json",
            data: { attn_id: attn_id },
            success: function (data) {
              if (data != null) {
                $("#clockOut").attr("id", null);
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
                  onClick: function () {
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
            },
          });
        }
      });
    };
  })();
  //Auto clock out
  let autoClockOut = (function () {
    let executed = false;
    return function () {
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
          url: baseURL + "/timesheet/clockOutEmployee",
          type: "POST",
          dataType: "json",
          data: { attn_id: attn_id, time: time },
          success: function (data) {
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
                icon:
                  baseURL + "uploads/users/user-profile/" + data.profile_img,
                timeout: 20000,
                onClick: function () {
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
              // location.reload();
            } else {
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Failed",
                html: "Something is wrong in the process",
                icon: "warning",
              });
            }
          },
        });
      }
    };
  })();
  // end of auto clock out

  //Auto clockout popup
  var autoclockout_checker_loop = setInterval(autoClockOut_checker, 5000);
  var auto_popup_executed = false;

  function autoClockOut_checker() {
    let startdate = $("#clockedin_date_time").val();
    let anntendance_status = $("#attendance_status").val();
    let attn_id = $("#attendanceId").val();
    let overtime_status = $("#overtime_status_acknowledgement").val();
    if (anntendance_status == 1 && overtime_status == 0) {
      $.ajax({
        url: baseURL + "/timesheet/get_shift_duration",
        type: "POST",
        dataType: "json",
        data: { attn_id: attn_id },
        success: function (data) {
          let was_closed = data.autoclockout_timer_closed;
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
                html:
                  'Please select "Continue" to keep working, or select "End Session" to end session now <br> Will close in <strong></strong>',
                imageUrl: baseURL + "/assets/img/timesheet/clock-out.png",
                showDenyButton: true,
                confirmButtonText: `Continue`,
                denyButtonText: `End Session`,
                allowOutsideClick: false,
                timer: $difference * 1000,
                timerProgressBar: true,
                willOpen: () => {
                  const content = Swal.getContent();
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

                      Swal.getContent().querySelector(
                        "strong"
                      ).textContent = text_countdown;
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
                  status = 1;
                  $.ajax({
                    url: baseURL + "/timesheet/overtimeApproval",
                    type: "POST",
                    dataType: "json",
                    data: { attn_id: attn_id, status: status },
                    success: function (data) {
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
                    url: baseURL + "/timesheet/get_shift_duration",
                    type: "POST",
                    dataType: "json",
                    data: { attn_id: attn_id },
                    success: function (data) {
                      if (data.difference > 8.08333333) {
                        clearInterval(autoclockout_checker_loop);
                        autoClockOut();
                      } else {
                        $.ajax({
                          url: baseURL + "/timesheet/autoclockout_timer_closed",
                          type: "POST",
                          dataType: "json",
                          data: { attn_id: attn_id },
                          success: function (data) {},
                        });
                      }
                    },
                  });
                }
              });
            }
          }
        },
      });
    } else {
      clearInterval(autoclockout_checker_loop);
    }
  }
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
  $(".ts_schedule").datepicker();
  $(document).on("change", "#to_date_logs", function () {
    show_my_attendance_logs();
  });

  $(document).on("change", "#from_date_logs", function () {
    // console.log("pasok");
    show_my_attendance_logs();
  });
  function show_my_attendance_logs() {
    $("#my-attendance-logs").hide();
    $(".table-ts-loader").show();
    $("#my-attendance-logs").DataTable().destroy();
    $.ajax({
      url: baseURL + "/timesheet/show_my_attendance_logs",
      type: "POST",
      dataType: "json",
      data: {
        date_from: $("#from_date_logs").val(),
        date_to: $("#to_date_logs").val(),
      },
      success: function (data) {
        // console.log(data);
        $(".table-ts-loader").hide();
        $("#my-attendance-logs").show();
        $("#my-attendance-logs").html(data);
        $("#my-attendance-logs").DataTable({
          ordering: false,
          paging: false,
        });
      },
    });
  }
  $(document).on("click", ".request-my-ot", function () {
    let selected = this;

    var user_id = $(selected).attr("data-user-id");
    var attendance_id = $(selected).attr("data-attn-id");
    var shift_date = $(selected).attr("data-shift-date");
    Swal.fire({
      title: "Request Overtime?",
      html:
        "Are you sure you want to submit Overtime request for the shift date <strong>" +
        shift_date +
        "</strong>?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/overtime.png",
      confirmButtonColor: "#1D9E74",
      cancelButtonColor: "#d33",
      confirmButtonText: "Request now!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/request_my_ot",
          type: "POST",
          dataType: "json",
          data: {
            attendance_id: attendance_id,
            user_id: user_id,
          },
          success: function (data) {
            if (data == 0) {
              show_my_attendance_logs();
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Overtime Requested",
                html:
                  "Overtime request for <strong>" +
                  shift_date +
                  "</strong> has been sent.",
                icon: "success",
              });
            }
          },
        });
      }
    });
  });
  $(document).on("click", ".adjust-my-attendance-request", function () {
    // console.log("yes");
    $("#request_attendance_correct_from").modal({
      backdrop: "static",
      keyboard: false,
    });
    $(".hiddenSection").show();

    // console.log($(this).attr("data-att-id"));
    let user_name = $(this).attr("data-name");
    $.ajax({
      url: baseURL + "/timesheet/get_spicific_attendance_log",
      type: "POST",
      dataType: "json",
      data: {
        user_id: $(this).attr("data-user-id"),
        att_id: $(this).attr("data-att-id"),
        shift_date: $(this).attr("data-shift-date"),
      },
      success: function (data) {
        // console.log(data);
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
    });
  });
  $(document).on("click", "#submit_attendance_correction_request", function () {
    let selected = this;
    var shift_date = $("#form_clockin_date").val();
    var user_id = $("#form_user_id").val();
    var attendance_id = $("#form_timesheet_attendance_id").val();
    var employee_name = $(selected).attr("data-name");
    Swal.fire({
      title: "Send adjustment request?",
      html:
        "Are you sure you want to submit attendance correction for shift date <strong>" +
        shift_date +
        "</strong>?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/attendance_correction.png",
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Submit Adjustment now!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/submit_attendance_correction_request",
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
          success: function (data) {
            if (data == 0) {
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Success",
                html:
                  "Attendance correction request for shift date <strong>" +
                  shift_date +
                  "</strong> has been sent!",
                icon: "success",
              });
            }
          },
        });
      }
    });
  });

  show_my_correction_requests();
  $(document).on("change", "#from_date_correction_requests", function () {
    show_my_correction_requests();
  });

  $(document).on("change", "#to_date_correction_requests", function () {
    // console.log("pasok");
    show_my_correction_requests();
  });
  function show_my_correction_requests() {
    $("#my_correction_requests").hide();
    $(".my-correction-requests-loader").show();
    $("#my_correction_requests").DataTable().destroy();
    $.ajax({
      url: baseURL + "/timesheet/show_my_correction_requests",
      type: "POST",
      dataType: "json",
      data: {
        date_from: $("#from_date_correction_requests").val(),
        date_to: $("#to_date_correction_requests").val(),
      },
      success: function (data) {
        // console.log(data);
        $(".my-correction-requests-loader").hide();
        $("#my_correction_requests").show();
        $("#my_correction_requests").html(data);
        $("#my_correction_requests").DataTable({
          ordering: false,
          paging: false,
        });
      },
    });
  }
  $(document).on("click", ".cancel_my_correction_reqiest", function () {
    // console.log("pasok");
    let shift_date = $(this).attr("data-shift-date");
    let request_id = $(this).attr("data-timesheet-attendance-correction-id");
    let att_id = $(this).attr("data-attn-id");
    let user_id = $(this).attr("data-user-id");
    Swal.fire({
      title: "Cancel this request?",
      html:
        "Are you sure you want to want to cancel your adjustment request for shift date <strong>" +
        shift_date +
        "</strong>?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/cancel.png",
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Cancel now",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/cancel_my_correction_request",
          type: "POST",
          dataType: "json",
          data: {
            request_id: request_id,
            att_id: att_id,
            user_id: user_id,
          },
          success: function (data) {
            show_my_correction_requests();
            Swal.fire({
              showConfirmButton: false,
              timer: 2000,
              title: "Success",
              html:
                "Correction request has been canceled for shift date <strong>" +
                shift_date +
                "</strong> has been sent!",
              icon: "success",
            });
          },
        });
      }
    });
  });
  show_my_leave_requests();
  $(document).on("change", "#from_date_leave_requests", function () {
    show_my_leave_requests();
  });

  $(document).on("change", "#to_date_leave_requests", function () {
    // console.log("pasok");
    show_my_leave_requests();
  });
  function show_my_leave_requests() {
    $("#my_leave_requests").hide();
    $(".my-leave-requests-loader").show();
    $.ajax({
      url: baseURL + "/timesheet/show_my_leave_requests",
      type: "POST",
      dataType: "json",
      data: {
        date_from: $("#from_date_leave_requests").val(),
        date_to: $("#to_date_leave_requests").val(),
      },
      success: function (data) {
        // console.log(data);
        $(".my-leave-requests-loader").hide();
        $("#my_leave_requests").show();
        $("#my_leave_requests_body").html(data.display);
        if (!data.hide_action) {
          $(".leave_request_action_td").hide();
        } else {
          $(".leave_request_action_td").show();
        }
      },
    });
  }

  $(document).on("click", ".cancel_my_leave_request", function () {
    // console.log("pasok");
    let date_filed = $(this).attr("data-date-filed");
    let leave_id = $(this).attr("data-leave-id");
    let user_id = $(this).attr("data-user-id");
    let leave_type = $(this).attr("data-leave-type");
    Swal.fire({
      title: "Cancel this leave request?",
      html:
        "Are you sure you want to want to cancel this leave request that you filed last <strong>" +
        date_filed +
        "</strong>?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/cancel.png",
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Cancel now",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/cancel_my_leave_request",
          type: "POST",
          dataType: "json",
          data: {
            date_filed: date_filed,
            leave_id: leave_id,
            user_id: user_id,
          },
          success: function (data) {
            show_my_leave_requests();
            Swal.fire({
              showConfirmButton: false,
              timer: 2000,
              title: "Success",
              html:
                "Your  " +
                leave_type +
                " request that was filed last <strong>" +
                date_filed +
                "</strong> has been canceled!",
              icon: "success",
            });
          },
        });
      }
    });
  });
  show_my_attendance_remarks();
  $(document).on("change", "#week_attendance_remarks", function () {
    show_my_attendance_remarks();
  });
  function show_my_attendance_remarks() {
    $("#show_my_attendance_remarks").hide();
    $(".my-attendance-remarks-loader").show();
    $.ajax({
      url: baseURL + "/timesheet/show_my_attendance_remarks",
      type: "POST",
      dataType: "json",
      data: {
        week: $("#week_attendance_remarks").val(),
      },
      success: function (data) {
        $(".my-attendance-remarks-loader").hide();
        $("#show_my_attendance_remarks").show();

        // $("#show_my_attendance_remarks").DataTable().destroy();
        $("#show_my_attendance_remarks").html(data.display);
        // $("#show_my_attendance_remarks").DataTable({
        //   ordering: false,
        //   paging: false,
        // });
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
    if ($rounded_amount > 0) {
    } else {
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
    // console.log(arrayofdurations);
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
