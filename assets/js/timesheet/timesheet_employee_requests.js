$(document).ready(function () {
  $("#pto-table-list").DataTable({
    paging: false,
  });
  // PTO placeholder
  $("#pto-table-list_filter")
    .children("label")
    .children("input")
    .attr("placeholder", "Search...");
  // PTO table approve and deny prompt
  show_OT_Requests();
  function show_OT_Requests() {
    $(".loading").show();
    $("#otrequest-table-list").hide();
    $.ajax({
      url: baseURL + "/timesheet/show_OT_Requests",
      type: "POST",
      dataType: "json",
      data: { id: 1 },
      success: function (data) {
        $(".loading").hide();
        $("#otrequest-table-list").show();
        $("#otrequest-table-list").DataTable().destroy();
        $("#otrequest-table-list").html(data);
        $("#otrequest-table-list").DataTable({
          ordering: false,
        });
        // PTO placeholder
        $("#pto-table-list_filter_filter")
          .children("label")
          .children("input")
          .attr("placeholder", "Search...");
      },
    });
  }
  $(document).on("click", ".ot_request_tab", function () {
    $("#page_title").html("Employee Overtime Requests");
  });

  $(document).on("click", ".attendance_correction_tab ", function () {
    $("#page_title").html("Attendance Correction Requests");
  });
  $(document).on("click", ".leave_request_tab", function () {
    $("#page_title").html("Employee Leave Requests");
  });
  $(document).on("click", ".approve-ot-request", function () {
    let selected = this;

    var user_id = $(selected).attr("data-user-id");
    var attendance_id = $(selected).attr("data-attn-id");
    var employee_name = $(selected).attr("data-name");
    Swal.fire({
      title: "Approve?",
      html:
        "Are you sure you want to Approve <strong>" +
        employee_name +
        "</strong>'s Overtime Request?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/overtime.png",
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Approve",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/approve_deny_ot_request",
          type: "POST",
          dataType: "json",
          data: {
            attendance_id: attendance_id,
            user_id: user_id,
            action: "approved",
          },
          success: function (data) {
            if (data == 0) {
              show_OT_Requests();
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Success",
                html:
                  "<strong>" +
                  employee_name +
                  "</strong>'s Overtime has been approved!",
                icon: "success",
              });
            }
          },
        });
      }
    });
  });
  $(document).on("click", ".deny-ot-request", function () {
    let selected = this;

    var user_id = $(selected).attr("data-user-id");
    var attendance_id = $(selected).attr("data-attn-id");
    var employee_name = $(selected).attr("data-name");
    Swal.fire({
      title: "Deny?",
      html:
        "Are you sure you want to Deny <strong>" +
        employee_name +
        "</strong>'s Overtime Request?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/deny.png",
      confirmButtonColor: "#303030",
      cancelButtonColor: "#d33",
      confirmButtonText: "Deny Now!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/approve_deny_ot_request",
          type: "POST",
          dataType: "json",
          data: {
            attendance_id: attendance_id,
            user_id: user_id,
            action: "denied",
          },
          success: function (data) {
            if (data == 0) {
              show_OT_Requests();
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Success",
                html:
                  "<strong>" +
                  employee_name +
                  "</strong>'s Overtime has been Denied",
                icon: "success",
              });
            }
          },
        });
      }
    });
  });
});
