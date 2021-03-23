$(document).ready(function () {
  //Datepicker
  $(".ts_schedule").datepicker();
  $("#timeLogTable").DataTable().destroy();
  show_attendance_logs_table();

  function show_attendance_logs_table() {
    // console.log("pasok");

    $(".table-ts-loader").show();
    $("#timeLogTable").hide();
    $("#timeLogTable").DataTable().destroy();
    $.ajax({
      url: baseURL + "/timesheet/show_attendance_logs_table",
      type: "POST",
      dataType: "json",
      data: {
        date_from: $("#from_date_logs").val(),
        date_to: $("#to_date_logs").val(),
      },
      success: function (data) {
        // alert(data);
        $(".table-ts-loader").hide();
        $("#timeLogTable").show();
        $("#timeLogTable").html(data);

        $("#timeLogTable").DataTable({
          initComplete: function (settings, json) {
            $("body").find(".dataTables_scrollBody").addClass("scrollbar");
          },
          footerCallback: function (row, data, start, end, display) {
            var api = this.api(),
              data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
              return parseFloat("0" + i);
            };

            // Total over all pages
            // total = api
            //   .column(10)
            //   .data()
            //   .reduce(function (a, b) {
            //     return intVal(a) + intVal(b);
            //   }, 0);
            // console.log(total);
            // Total over this page
            pageTotal_expected = api
              .column(9, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);

            pageTotal_expected_break = api
              .column(10, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);
            pageTotal_expected_work_hours = api
              .column(11, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);
            pageTotal_worked_hours = api
              .column(12, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);

            pageTotal_break_duration = api
              .column(13, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);

            pageTotal_late = api
              .column(14, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);

            pageTotal_over_time = api
              .column(15, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);

            pageTotal_over_payable_hours = api
              .column(17, { page: "current" })
              .data()
              .reduce(function (a, b) {
                return intVal(a) + intVal(b);
              }, 0);

            // Update footer
            $(api.column(9).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_expected * 100) / 100 +
                "</label>"
            );
            $(api.column(10).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_expected_break * 100) / 100 +
                "</label>"
            );
            $(api.column(11).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_expected_work_hours * 100) / 100 +
                "</label>"
            );
            $(api.column(12).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_worked_hours * 100) / 100 +
                "</label>"
            );
            $(api.column(13).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_break_duration * 100) / 100 +
                "</label>"
            );
            $(api.column(14).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_late * 100) / 100 +
                "</label>"
            );
            $(api.column(15).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_over_time * 100) / 100 +
                "</label>"
            );

            $(api.column(17).footer()).html(
              "<label class='time-log gray'>" +
                Math.round(pageTotal_over_payable_hours * 100) / 100 +
                "</label>"
            );
          },
          scrollX: true,
          ordering: false,
        });
      },
    });
  }
  $(document).on("change", "#to_date_logs", function () {
    show_attendance_logs_table();
  });

  $(document).on("change", "#from_date_logs", function () {
    // console.log("pasok");
    show_attendance_logs_table();
  });

  $(document).on("click", ".edit_attendancelogs_btn", function () {
    console.log("yes");
    $("#edit_attendancelogs").modal({
      backdrop: "static",
      keyboard: false,
    });
    $(".hiddenSection").show();
    let user_name = $(this).attr("data-user-name");
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
      },
    });
  });

  $(document).on("click", "#save_edited_attendance_logs", function () {
    let form_timesheet_attendance_id = $("#form_timesheet_attendance_id").val();
    let form_user_id = $("#form_user_id").val();
    let form_timesheet_shift_schedule_id = $(
      "#form_timesheet_shift_schedule_id"
    ).val();
    let form_shift_start = $("#form_shift_start").val();
    let form_shift_end = $("#form_shift_end").val();
    let form_clockin_date = $("#form_clockin_date").val();
    let form_clockin_time = $("#form_clockin_time").val();
    let form_clockout_date = $("#form_clockout_date").val();
    let form_clockout_time = $("#form_clockout_time").val();
    let form_breakin_date = $("#form_breakin_date").val();
    let form_breakin_time = $("#form_breakin_time").val();
    let form_breakout_date = $("#form_breakout_date").val();
    let form_breakout_time = $("#form_breakout_time").val();
    let form_expected_hours = $("#form_expected_hours").html();
    let form_worked_hours = $("#form_worked_hours").html();
    let form_break_duration = $("#form_break_duration").html();
    let form_over_time = $("#form_over_time").html();
    let form_attendance_notes = $("#form_attendance_notes").html();
    let form_ot_status = $("#form_ot_status").html();
    let edit_attendance_name = $("#edit_attendance_name").html();

    Swal.fire({
      title: "Save changes?",
      html:
        "Are you sure you want to update this attendance log of <b>" +
        edit_attendance_name +
        "</b>?",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Submit Changes",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/attendance_logs_update",
          type: "POST",
          dataType: "json",
          data: {
            form_timesheet_attendance_id: form_timesheet_attendance_id,
            form_user_id: form_user_id,
            form_timesheet_shift_schedule_id: form_timesheet_shift_schedule_id,
            form_shift_start: form_shift_start,
            form_shift_end: form_shift_end,
            form_clockin_date: form_clockin_date,
            form_clockin_time: form_clockin_time,
            form_clockout_date: form_clockout_date,
            form_clockout_time: form_clockout_time,
            form_breakin_date: form_breakin_date,
            form_breakin_time: form_breakin_time,
            form_breakout_date: form_breakout_date,
            form_breakout_time: form_breakout_time,
            form_expected_hours: form_expected_hours,
            form_worked_hours: form_worked_hours,
            form_break_duration: form_break_duration,
            form_over_time: form_over_time,
            form_attendance_notes: form_attendance_notes,
          },
          success: function (data) {
            show_attendance_logs_table();
            Swal.fire({
              showConfirmButton: false,
              timer: 2000,
              title: "Success",
              html: "Changes has been saved!",
              icon: "success",
            });
          },
        });
      }
    });
    // console.log(form_clockin_time);
  });
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
    console.log(arrayofdurations);
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
