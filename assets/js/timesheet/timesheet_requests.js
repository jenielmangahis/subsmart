//Add row
// $(document).on('click','#btnAddRow',function () {
//     $('#tsSettingsTblTbody tr:last').prev('tr').clone('#tsSettingsRow').insertBefore('#tsSettingsTblTbody tr:last');
//     $('td > .ts-project-name').last().text('Unnamed');
// });

$(document).ready(function () {
  // PTO Leave list DataTable

  //Approve
  $(document).on("click", "#approveRequest", function () {
    let id = $(this).attr("data-id");
    let selected = $(this);
    Swal.fire({
      title: "Approve?",
      html: "Are you sure you want to approve this request?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Approve it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?= base_url() ?>/timesheet/approveRequest",
          type: "POST",
          dataType: "json",
          data: {
            id: id,
          },
          success: function (data) {
            if (data == 1) {
              selected.parent("td").prev("td").text("Approved");
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Success",
                html: "Leave request <strong>Approved</strong>",
                icon: "success",
              });
              // window.location.reload(true);
            }
          },
        });
      }
    });
  });
  //Deny
  $(document).on("click", "#denyRequest", function () {
    let id = $(this).attr("data-id");
    let selected = $(this);
    Swal.fire({
      title: "Deny?",
      html: "Are you sure you want to deny this request?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Deny it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?= base_url() ?>/timesheet/denyRequest",
          type: "POST",
          dataType: "json",
          data: {
            id: id,
          },
          success: function (data) {
            if (data == 1) {
              selected.parent("td").prev("td").text("Denied");
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Success",
                html: "Leave request <strong>Denied</strong>",
                icon: "success",
              });
            }
          },
        });
      }
    });
  });

  // Leave list modal
  $(document).on("click", "#leaveList", function () {
    $("#listLeaveType").modal({
      backdrop: "static",
      keyboard: false,
    });
    let table = $("#leaveTableList");
    table
      .children("tbody")
      .children("tr")
      .children("td")
      .children("input.leave-type-data")
      .addClass("hidden");
    table
      .children("tbody")
      .children("tr")
      .children("td")
      .children("textarea")
      .addClass("hidden");
    table
      .children("tbody")
      .children("tr")
      .children("td")
      .children("span")
      .removeClass("hidden")
      .addClass("display");
  });
  //Leave modal dataTable
  $("#leaveTableList").DataTable({
    paging: false,
    sort: false,
  });
  //Row add/edit
  $(document).on("click", ".leave-type-row", function () {
    $(this)
      .parent("tbody")
      .children("tr")
      .children("td")
      .children("input.leave-type-data")
      .addClass("hidden");
    $(this)
      .parent("tbody")
      .children("tr")
      .children("td")
      .children("textarea")
      .addClass("hidden");
    $(this)
      .parent("tbody")
      .children("tr")
      .children("td")
      .children("span")
      .removeClass("hidden")
      .addClass("display");

    $(this)
      .children("td")
      .children("span")
      .removeClass("display")
      .addClass("hidden");
    $(this)
      .children("td")
      .children("input.leave-type-data")
      .removeClass("hidden")
      .addClass("display");
    $(this)
      .children("td")
      .children("textarea")
      .removeClass("hidden")
      .addClass("display");
  });
  //Add row Leave type
  $(document).on("click", "#addLeaveRow", function () {
    let last = $("#leaveTableList tbody tr:last td:first").text();
    let counter = parseInt(last) + 1;
    let row =
      '     <tr class="leave-type-row">\n' +
      '                        <td class="center" style="border-left: 0;">' +
      counter +
      "</td>\n" +
      '                        <td class="center leave-type-column">\n' +
      '                            <span class="display"></span>\n' +
      '                            <input type="text" name="type[]" class="leave-type-data form-control hidden" value="">\n' +
      '                            <input type="hidden" class="leave-id" name="id[]" value="0">\n' +
      "                        </td>\n" +
      '                        <td class="center">\n' +
      '                            <span class="display"></span>\n' +
      '                            <textarea name="description[]" class="leave-desc-data form-control hidden" id="" cols="30" rows="10"></textarea>\n' +
      "                        </td>\n" +
      '                        <td class="center" style="border-right: 0;">\n' +
      '                            <a href="javascript:void (0)" class="removeLeaveRow" title="Remove" data-toggle="tooltip" style="margin-left: 12px"><i class="fa fa-times fa-lg"></i></a>\n' +
      "                        </td>\n" +
      "                    </tr>";
    $("#leaveTableList tbody tr:last").after(row);
  });
  //Remove leave row
  $(document).on("click", ".removeLeaveRow", function () {
    let type = $(this)
      .parent("td")
      .parent("tr")
      .children("td.leave-type-column")
      .children("span")
      .text();
    let id = $(this).attr("data-id");
    let row = $(this).parent("td").parent("tr");
    if (type == "") {
      row.remove();
    } else {
      Swal.fire({
        title: "Remove leave type?",
        html: "Are you sure you want to remove <strong>" + type + "</strong> ?",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#2ca01c",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Remove it!",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: "<?= base_url() ?>/timesheet/removePTO",
            type: "POST",
            dataType: "json",
            data: {
              id: id,
            },
            success: function (data) {
              if (data == 1) {
                let row_cnt = $("#leaveTableList")
                  .children("tbody")
                  .children("tr").length;
                if (row_cnt == 1) {
                  row
                    .children("td.leave-type-column")
                    .children("span")
                    .text(null);
                  row
                    .children("td.leave-type-column")
                    .children("input.leave-type-data")
                    .val(null)
                    .removeClass("display")
                    .addClass("hidden");
                  row
                    .children("td")
                    .children("textarea.leave-desc-data")
                    .val(null)
                    .removeClass("display")
                    .addClass("hidden");
                  row
                    .children("td.leave-type-column")
                    .children("input.leave-id")
                    .val(null);
                } else if (row_cnt > 1) {
                  row.remove();
                }
                Swal.fire({
                  showConfirmButton: false,
                  timer: 2000,
                  title: "Success",
                  html: "<strong>" + type + "</strong> has been removed.",
                  icon: "success",
                });
              }
            },
          });
        }
      });
    }
  });
  //Save Leave type
  $(document).on("click", "#savedLeaveType", function () {
    let type = getArrayType($(".leave-type-data"));
    let desc = getArrayDesc($(".leave-desc-data"));
    let id = getArrayID($(".leave-id"));

    $.ajax({
      url: "<?= base_url() ?>/timesheet/savedPTO",
      type: "POST",
      dataType: "json",
      data: {
        id: id,
        type: type,
      },
      success: function (data) {
        $("#listLeaveType").modal("hide");
        Swal.fire({
          showConfirmButton: false,
          timer: 2000,
          title: "Success",
          html: "New PTO has been added",
          icon: "success",
        });
      },
    });
  });

  function getArrayDesc(description) {
    let list = [];
    $(description).each(function (index, element) {
      list.push($(element).val());
    });
    return list;
  }

  function getArrayType(type) {
    let list = [];
    $(type).each(function (index, element) {
      list.push($(element).val());
    });
    return list;
  }

  function getArrayID(id) {
    let list = [];
    $(id).each(function (index, element) {
      list.push($(element).val());
    });
    return list;
  }

  // Invite link email field remove icon
  $(document).on("change", ".invite-email", function () {
    if ($(this).val() != "") {
      $(".remove-email-icon").css("visibility", "visible");
      if (isEmail($(this).val()) == false) {
        $(this).css("border-bottom", "2px solid red");
      } else {
        $(this).css("border-bottom", "2px solid #e0e0e0");
      }
    } else {
      $(".remove-email-icon").css("visibility", "hidden");
    }
  });
  $(document).on("keyup", ".invite-email", function () {
    if ($(this).val() != "") {
      $(this).css("border-bottom", "2px solid #e0e0e0");
    }
  });

  function isEmail(email) {
    let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }

  $(document).on("click", "#clearEmailField", function () {
    $(this).prev("input").val(null);
    $(this).children("i").css("visibility", "hidden");
    $(".invite-email").css("border-bottom", "2px solid #e0e0e0");
  });
  //Sending invite link
  $(document).on("click", "#sendInviteLink", function () {
    if (
      $(".invite-email").val() != "" &&
      isEmail($(".invite-email").val()) == true
    ) {
      let values = {};
      $.each($("#formInviteLink").serializeArray(), function (i, field) {
        values[field.name] = field.value;
      });
      let button = $(this);
      button
        .attr("disabled", true)
        .children("i")
        .removeClass("fa-paper-plane")
        .addClass("fa-spinner")
        .addClass("fa-pulse");
      button.children("span").text("SENDING");
      $.ajax({
        url: "<?= base_url() ?>/timesheet/inviteLinkEntry",
        type: "POST",
        dataType: "json",
        data: {
          values: values,
        },
        success: function (data) {
          if (data == 1) {
            button
              .attr("disabled", false)
              .children("i")
              .addClass("fa-paper-plane")
              .removeClass("fa-spinner")
              .removeClass("fa-pulse");
            button.children("span").text("SEND");
            Swal.fire({
              showConfirmButton: false,
              timer: 2000,
              title: "Success",
              html: "Invite link has been sent",
              icon: "success",
            });
          }
        },
      });
    } else {
      $(".invite-email").css("border-bottom", "2px solid red");
    }
  });
  //Select2 role list
  $(".invite-role").select2();

  //Department dataTable
  $("#department-table-list").DataTable({
    paging: true,
    filter: false,
    info: false,
    sort: false,
  });
  // Department modal
  $(document).on("click", "#addDepartmentBtn", function () {
    $("#departmentModal").modal({
      backdrop: "static",
      keyboard: false,
    });
    $(".input-department").children("input").val(null);
  });
  //Adding department
  $(document).on("click", "#savedDepartment", function () {
    let dept = getDepartment($(".deptArray"));
    $.ajax({
      url: "<?= base_url() ?>/timesheet/addDepartment",
      type: "POST",
      dataType: "json",
      data: {
        dept: dept,
      },
      success: function (data) {
        $("#departmentModal").modal("hide");
        if (data == 1) {
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Success",
            html: "New department has been added",
            icon: "success",
          });
        } else {
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Failed",
            html: "Department name already exist",
            icon: "warning",
          });
        }
      },
    });
  });

  function getDepartment(dept) {
    let list = [];
    $(dept).each(function (index, element) {
      list.push($(element).val());
    });
    return list;
  }
  //Department add row
  $(document).on("click", "#addDeptRow", function () {
    let select = $("#departmentForm");
    if ($(".input-department").children("input").val() !== "") {
      select.append($(".department-row").last().clone());
      $(".department-row:last")
        .children(".input-department")
        .children("input")
        .val(null);
    }
  });
  //Deleting department
  $(document).on("click", "#removeDept", function () {
    let id = $(this).attr("data-id");
    let name = $(this).attr("data-name");
    Swal.fire({
      title: "Are you sure to delete this?",
      html: "Department: <strong>" + name + "</strong>",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?= base_url() ?>/timesheet/removeDepartment",
          type: "POST",
          dataType: "json",
          data: {
            id: id,
          },
          success: function (data) {
            if (data == 1) {
              Swal.fire({
                showConfirmButton: false,
                timer: 2000,
                title: "Success",
                html: name + " department has been removed",
                icon: "success",
              });
            }
          },
        });
      }
    });
  });
  //Department update
  $(document).on("click", ".tbl-dept-row td:not(:last-child)", function () {
    let dept_id = $(this).parent("tr").attr("data-id");
    let refresh =
      window.location.protocol +
      "//" +
      window.location.host +
      window.location.pathname +
      "/" +
      dept_id;
    window.history.pushState(
      {
        path: refresh,
      },
      "",
      refresh
    );
    $.ajax({
      url: "<?= base_url() ?>/timesheet/showDeptUpdate",
      type: "GET",
      dataType: "json",
      data: {
        dept_id: dept_id,
      },
      success: function (data) {
        $(".department-table-list").hide();
        $("#empDepartment").append(data);
      },
    });
  });
  //Department back button
  $(document).on("click", "#deptBckBtn", function () {
    let url = window.location.href.replace(window.location.search, "");
    let refresh = url.slice(0, url.lastIndexOf("/"));
    window.history.pushState(
      {
        path: refresh,
      },
      "",
      refresh
    );
    $(".department-edit-view").hide();
    $(".department-table-list").show();
  });
  //Department add members
  $(document).on("click", "#deptAddMembers", function () {
    $("#addMembersModal").modal({
      backdrop: "static",
      keyboard: false,
    });
  });
  $(document).on("click", "#deptEditName", function () {
    let name = $(this).prev("h3").text();
    Swal.fire({
      title: "Edit Department",
      html:
        '<input type="text" id="editField" value="' +
        name +
        '" class="form-control">',
      preConfirm: function () {
        return new Promise(function (resolve) {
          resolve([$("#editField").val()]);
        });
      },
      didOpen: function () {
        $("#editField").focus();
      },
      showCancelButton: true,
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Save changes",
    }).then((result) => {
      if (result.value) {
        console.log(result.value);
      }
    });
  });

  //Workweek and Overtime settings
  $(".workweek-days").select2();

  //Workweek and Overtime save changes
  $(document).on("click", "#savedWorkweekOTsettings", function () {
    let values = {};
    $.each($("#formWorkweekOT").serializeArray(), function (i, field) {
      values[field.name] = field.value;
    });
    $.ajax({
      url: "<?= base_url() ?>/timesheet/workweekOvertimeSettings",
      type: "POST",
      dataType: "json",
      data: {
        values: values,
      },
      success: function (data) {
        if (data == 1) {
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Success",
            html: "Workweek and Overtime has been updated",
            icon: "success",
          });
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
  });
  $(document).on("keyup", 'input[name="hours_week"]', function () {
    $(this).val(function (i, val) {
      let timeParts = val.split(":"),
        totalSeconds =
          parseInt(timeParts[0], 10) * 60 + parseInt(timeParts[1], 10),
        minutes = Math.floor(totalSeconds / 60),
        seconds = totalSeconds - minutes * 60;
      return [
        minutes < 10 ? 0 : "",
        minutes,
        ":",
        seconds < 10 ? 0 : "",
        seconds,
      ].join("");
    });
  });

  //Break Preference
  //Prompt for automatic break rule
  $(document).on("change", "#breakRule", function () {
    let select = $(this).val();
    if (select == "Automatic") {
      $(".break-pref-length").css("display", "block");
    } else {
      $(".break-pref-length").css("display", "none");
    }
  });
  //Break Preference save changes
  $(document).on("click", "#savedBreakPref", function () {
    let values = {};
    $.each($("#formBreakPreference").serializeArray(), function (i, field) {
      values[field.name] = field.value;
    });
    $.ajax({
      url: "<?= base_url() ?>/timesheet/breakPreference",
      method: "POST",
      dataType: "json",
      data: {
        values: values,
      },
      success: function (data) {
        if (data == 1) {
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Success",
            html: "Break Preference has been updated",
            icon: "success",
          });
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
  });
  //Manual Entries
  $(document).on("click", "#manualEntries", function () {
    let checkbox = $(this).is(":checked");
    if (checkbox == false) {
      $("#rolesContainer").addClass("disabled-section");
      $('#rolesContainer input[name="admins"]').attr("disabled", true);
      $('#rolesContainer input[name="managers"]').attr("disabled", true);
      $('#rolesContainer input[name="employees"]').attr("disabled", true);
    } else {
      $("#rolesContainer").removeClass("disabled-section");
      $('#rolesContainer input[name="admins"]').attr("disabled", false);
      $('#rolesContainer input[name="managers"]').attr("disabled", false);
      $('#rolesContainer input[name="employees"]').attr("disabled", false);
    }
  });
  // Notifications
  $(".notify-time-in").timepicker({
    interval: 60,
  });
  // Notifications
  $(document).on("click", ".notify-day-cell", function () {
    $(".notify-day-cell").css("background", "none");
    $(this).css("background", "#5ec355");
    console.log($(this).attr("data"));
  });

  //Select2 employee list
  $(".select2-employee-list").select2({
    placeholder: "Select employee",
    width: "resolve",
    ajax: {
      url: "<?= base_url() ?>/timesheet/getEmployees",
      type: "GET",
      dataType: "json",
      delay: 250,
      data: function (params) {
        let query = {
          search: params.term,
        };
        return query;
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    },
    escapeMarkup: function (markup) {
      return markup;
    },
    templateResult: function (d) {
      let subtext = d.subtext;
      if (subtext == undefined) {
        subtext = "";
      }
      return (
        '<span class="text-details">' +
        d.text +
        '</span><span class="pull-right subtext">' +
        subtext +
        "</span>"
      );
    },
  });

  $(".ts-team-member").select2({
    placeholder: "Select employee",
    width: "resolve",
    ajax: {
      url: "<?= base_url() ?>/timesheet/getEmployees",
      type: "GET",
      dataType: "json",
      delay: 250,
      data: function (params) {
        let query = {
          search: params.term,
        };
        return query;
      },
      processResults: function (response) {
        return {
          results: response,
        };
      },
      cache: true,
    },
    escapeMarkup: function (markup) {
      return markup;
    },
    templateResult: function (d) {
      let subtext = d.subtext;
      if (subtext == undefined) {
        subtext = "";
      }
      return (
        '<span class="text-details">' +
        d.text +
        '</span><span class="pull-right subtext">' +
        subtext +
        "</span>"
      );
    },
  });

  //Load dataTable
  let selected_week = $("#ts-sorting-week").val();
  let user_id = $("#tsUsersList").val();
  $("#timesheet_settings").ready(showWeekList(selected_week, user_id));

  //Country selector
  // $('#tsLocation').countrySelect();
  // Timezone picker
  $("#tsTimezone")
    .select2({
      placeholder: "Select Timezone",
      allowClear: true,
    })
    .timezones()
    .val(null);

  //Datetime picker
  $(".ts-start-date").datepicker();
  $(".ts-settings-datepicker").datepicker();
  $(".start-time").timepicker({
    interval: 60,
    change: differenceTime,
  });
  $(".end-time").timepicker({
    change: differenceTime,
    interval: 60,
  });

  //Show Timesheet settings table
  function showWeekList(week, user_id) {
    $("#timesheet_settings_wrapper").css("display", "none");
    $("#timesheet_settings").css("display", "none");
    $(".table-ts-loader").fadeIn("fast", function () {
      $(".table-ts-loader").css("display", "block");
    });
    if (week != null) {
      $.ajax({
        url: "<?= base_url() ?>/timesheet/showTimesheetSettings",
        type: "GET",
        dataType: "json",
        data: {
          week: week,
          user: user_id,
        },
        success: function (data) {
          $(".table-ts-loader").fadeOut("fast", function () {
            $("#timesheet_settings").html(data).removeAttr("style").DataTable({
              paging: false,
              filter: false,
              info: false,
              sort: false,
            });
            $("#timesheet_settings_wrapper").css("display", "block");
            $(".table-ts-loader").css("display", "none");
            totalPerDay();
            totalWeekDuration();
          });
          // Restriction of input field
          // var options =  {
          //     onKeyPress: function(cep, e, field, options) {
          //         var masks = ['00:00'];
          //         var mask = (cep.length>4) ? masks[1] : masks[0];
          //         $('.ts-duration').mask(mask, options);
          //     }};
          // $('.ts-duration').mask("00:00",options);
        },
      });
    }
  }

  const convertTime12to24 = (time12h) => {
    const [time, modifier] = time12h.split(" ");

    let [hours, minutes] = time.split(":");

    if (hours === "12") {
      hours = "00";
    }

    if (modifier === "PM") {
      hours = parseInt(hours, 10) + 12;
    }

    return `${hours}:${minutes}`;
  };

  function differenceTime() {
    let start_hour = null;
    let end_hour = null;
    if ($(this).attr("id") == "tsStartTime") {
      start_hour = convertTime12to24($(this).val()).split(":")[0];
      end_hour = convertTime12to24(
        $(this).parent("div").next("div").children("input").val()
      ).split(":")[0];
    } else {
      start_hour = convertTime12to24(
        $(this).parent("div").prev("div").children("input").val()
      ).split(":")[0];
      end_hour = convertTime12to24($(this).val()).split(":")[0];
    }
    let duration = "0h";
    if (end_hour > start_hour || duration > 0) {
      duration = end_hour - start_hour + "h";
    } else {
      duration = "Invalid";
    }
    $(".total-duration").text(duration);
  }
  // Adding Project
  $(document).on("click", "#addProject", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    $(".hiddenSection").show();
    $("#tsProjectName").attr("disabled", null).val(null);
    $("#tsTeamMember").attr("disabled", null).select2("val", "All");
    $("#tsTimezone").attr("disabled", false);
    $("#tsNotes").attr("disabled", false);
    let week = $("#ts-sorting-week").val();
    $("#weekType").val(week);
    // Clear fields
    $("#tsStartTime").val(null);
    $("#tsEndTime").val(null);
    $("#tsNotes").val(null);
    $("#tsStartDate").attr("disabled", false).val($("#presentDay").val());
    $(".total-duration").text("0h");
    if ($("#updateTSProject").length == 1) {
      $("#updateTSProject").attr("id", "savedProject").text("Save");
    } else if ($("#updateSchedule").length == 1) {
      $("#updateSchedule").attr("id", "savedProject").text("Save");
    }
  });
  $(document).on("click", "#savedProject", function () {
    let week = $("#ts-sorting-week").val();
    let user_id = $("#tsUsersList").val();
    let values = {};
    $.each($("#formNewProject").serializeArray(), function (i, field) {
      values[field.name] = field.value;
    });
    let duration = $(".total-duration").text();
    let timezone = values["timezone"].replace(/\s*\(.*?\)\s*/g, "");
    $.ajax({
      url: "<?= base_url() ?>/timesheet/addingProjects",
      type: "POST",
      dataType: "json",
      data: {
        values: values,
        timezone: timezone,
        duration: duration,
      },
      cache: false,
      success: function (data) {
        $("#createProject").modal("hide");
        $("#timesheet_settings").DataTable().destroy();
        showWeekList(week, user_id);
        if (data == 1) {
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Success",
            html: "New project has been set",
            icon: "success",
          });
        } else {
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Failed",
            html: "Something is wrong in the process!",
            icon: "warning",
          });
        }
      },
    });
  });
  //Toggle edit pen
  $(document).on("click", "#showEditPen", function () {
    if ($(this).next("a").css("display") === "none") {
      $(this).next("a").css("display", "inline-block");
    } else {
      $(this).next("a").css("display", "none");
    }
  });

  $(document).on("change", "#tsUsersList", function () {
    let user = $(this).val();
    let week = $("#ts-sorting-week").val();
    $("#timesheet_settings").DataTable().destroy();
    showWeekList(week, user);
  });
  $(document).on("change", "#ts-sorting-week", function () {
    var week = $(this).val();
    var user = $("#tsUsersList").val();
    $("#timesheet_settings").DataTable().destroy();
    showWeekList(week, user);
  });
  $.date = function (dateObject, text) {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
      day = "0" + day;
    }
    if (month < 10) {
      month = "0" + month;
    }
    var date;
    if (text == 1) {
      date = month + "/" + day + "/" + year;
    } else {
      const monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ];
      date = monthNames[d.getMonth()] + " " + day + "," + year;
    }

    return date;
  };
  $(document).on("click", "#updateSchedule", function () {
    let week = $("#ts-sorting-week").val();
    let user_id = $("#tsUsersList").val();
    let values = {};
    $.each($("#formNewProject").serializeArray(), function (i, field) {
      values[field.name] = field.value;
    });
    let duration = $(".total-duration").text();
    let date = $("#tsStartDate").val();
    $.ajax({
      url: "<?= base_url() ?>/timesheet/updateSchedule",
      type: "POST",
      dataType: "json",
      data: {
        values: values,
        duration: duration,
        date: date,
      },
      success: function (data) {
        $("#timesheet_settings").DataTable().destroy();
        showWeekList(week, user_id);
        if (data === 1) {
          $("#createProject").modal("hide");
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Success",
            html: "Project has been updated",
            icon: "success",
          });
        }
      },
    });
  });

  function getTimesheetData(
    timesheet_id,
    user_id,
    day_id,
    date,
    day,
    twd_id,
    week
  ) {
    $("#tsProjectName").attr("disabled", "disabled");
    $("#tsTeamMember").attr("disabled", "disabled");
    $("#tsTimezone").attr("disabled", "disabled");
    $("#tsNotes").attr("disabled", "disabled");
    $("#tsStartDate").val($.date(date, 1)).attr("disabled", "disabled");
    $("#tsDate").text($.date(date, 0));
    if ($("#updateTSProject").length === 1) {
      $("#updateProject").attr("id", "updateSchedule").text("Update");
    } else if ($("#savedProject").length === 1) {
      $("#savedProject").text("Update").attr("id", "updateSchedule");
    }
    $("#timesheetId").val(timesheet_id);
    $("#userId").val(user_id);
    $("#selectedDay").val(day);
    $("#totalWeekDuration").val(twd_id);
    $("#tsScheduleId").val(day_id);
    $("#weekType").val(week);
    $(".hiddenSection").show();

    $.ajax({
      url: "<?= base_url() ?>/timesheet/getTimesheetData",
      type: "GET",
      data: {
        timesheet_id: timesheet_id,
        day_id: day_id,
      },
      dataType: "json",
      success: function (data) {
        $("#tsProjectName").val(data.project_name);
        // $('#tsLocation').val(data.location);
        $("#tsNotes").val(data.notes);
        $("#tsTeamMember").next(
          $("#select2-tsTeamMember-container")
            .attr("title", data.team_member)
            .html(data.team_member)
        );
        $("#tsTimezone").next(
          $("#select2-tsTimezone-container")
            .attr("title", data.timezone)
            .html(data.timezone)
        );
        $("#tsStartTime").val(data.start_time);
        $("#tsEndTime").val(data.end_time);
        $(".total-duration").text(data.total_duration + "h");
      },
    });
  }
  //Updating duration
  // Monday
  $(document).on("click", "#tsMonday", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    let day_id = $(this).attr("data-id");
    let timesheet_id = $(this).closest("tr").attr("data-id");
    let date = $(this).attr("data-date");
    let user_id = $(this).attr("data-user");
    let day = $(this).attr("data-day");
    let twd_id = $("#totalWeekDuration-" + user_id).attr("data-id");
    let week = $("#ts-sorting-week").val();
    getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
  });
  // Tuesday
  $(document).on("click", "#tsTuesday", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    var day_id = $(this).attr("data-id");
    var timesheet_id = $(this).closest("tr").attr("data-id");
    var date = $(this).attr("data-date");
    var user_id = $(this).attr("data-user");
    var day = $(this).attr("data-day");
    var twd_id = $("#totalWeekDuration-" + user_id).attr("data-id");
    var week = $("#ts-sorting-week").val();
    getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
  });
  //Wednesday
  $(document).on("click", "#tsWednesday", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    var day_id = $(this).attr("data-id");
    var timesheet_id = $(this).closest("tr").attr("data-id");
    var date = $(this).attr("data-date");
    var user_id = $(this).attr("data-user");
    var day = $(this).attr("data-day");
    var twd_id = $("#totalWeekDuration-" + user_id).attr("data-id");
    var week = $("#ts-sorting-week").val();
    getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
  });
  //Thursday
  $(document).on("click", "#tsThursday", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    var day_id = $(this).attr("data-id");
    var timesheet_id = $(this).closest("tr").attr("data-id");
    var date = $(this).attr("data-date");
    var user_id = $(this).attr("data-user");
    var day = $(this).attr("data-day");
    var twd_id = $("#totalWeekDuration-" + user_id).attr("data-id");
    var week = $("#ts-sorting-week").val();
    getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
  });
  //Friday
  $(document).on("click", "#tsFriday", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    var day_id = $(this).attr("data-id");
    var timesheet_id = $(this).closest("tr").attr("data-id");
    var date = $(this).attr("data-date");
    var user_id = $(this).attr("data-user");
    var day = $(this).attr("data-day");
    var twd_id = $("#totalWeekDuration-" + user_id).attr("data-id");
    var week = $("#ts-sorting-week").val();
    getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
  });
  //Saturday
  $(document).on("click", "#tsSaturday", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    var day_id = $(this).attr("data-id");
    var timesheet_id = $(this).closest("tr").attr("data-id");
    var date = $(this).attr("data-date");
    var user_id = $(this).attr("data-user");
    var day = $(this).attr("data-day");
    var twd_id = $("#totalWeekDuration-" + user_id).attr("data-id");
    var week = $("#ts-sorting-week").val();
    getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
  });
  //Sunday
  $(document).on("click", "#tsSunday", function () {
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    let day_id = $(this).attr("data-id");
    let timesheet_id = $(this).closest("tr").attr("data-id");
    let date = $(this).attr("data-date");
    let user_id = $(this).attr("data-user");
    let day = $(this).attr("data-day");
    let twd_id = $("#totalWeekDuration-" + user_id).attr("data-id");
    let week = $("#ts-sorting-week").val();
    getTimesheetData(timesheet_id, user_id, day_id, date, day, twd_id, week);
  });
  //Calculation total duration
  function totalPerDay() {
    let mon_total = 0,
      tue_total = 0,
      wed_total = 0,
      thu_total = 0,
      fri_total = 0,
      sat_total = 0,
      sun_total = 0;
    //Monday total
    $("input[name$='monday']").each(function () {
      let monday = parseInt($(this).val());
      if (isNaN(monday)) {
        monday = 0;
      }
      mon_total += parseInt($(this).val());
    });
    if (isNaN(mon_total)) {
      mon_total = 0;
    }
    $("#totalMonday").text(mon_total + "h");
    //Tuesday total
    $("input[name$='tuesday']").each(function () {
      let tuesday = parseInt($(this).val());
      if (isNaN(tuesday)) {
        tuesday = 0;
      }
      tue_total += tuesday;
    });
    if (isNaN(tue_total)) {
      tue_total = 0;
    }
    $("#totalTuesday").text(tue_total + "h");
    //Wednesday total
    $("input[name$='wednesday']").each(function () {
      let wednesday = parseInt($(this).val());
      if (isNaN(wednesday)) {
        wednesday = 0;
      }
      wed_total += wednesday;
    });
    if (isNaN(wed_total)) {
      wed_total = 0;
    }
    $("#totalWednesday").text(wed_total + "h");
    //Thursday total
    $("input[name$='thursday']").each(function () {
      let thursday = parseInt($(this).val());
      if (isNaN(thursday)) {
        thursday = 0;
      }
      thu_total += thursday;
    });
    if (isNaN(thu_total)) {
      thu_total = 0;
    }
    $("#totalThursday").text(thu_total + "h");
    //Friday total
    $("input[name$='friday']").each(function () {
      let friday = parseInt($(this).val());
      if (isNaN(friday)) {
        friday = 0;
      }
      fri_total += friday;
    });
    if (isNaN(fri_total)) {
      fri_total = 0;
    }
    $("#totalFriday").text(fri_total + "h");
    //Saturday total
    $("input[name$='saturday']").each(function () {
      let saturday = parseInt($(this).val());
      if (isNaN(saturday)) {
        saturday = 0;
      }
      sat_total += saturday;
    });
    if (isNaN(sat_total)) {
      sat_total = 0;
    }
    $("#totalSaturday").text(sat_total + "h");
    //Sunday total
    $("input[name$='sunday']").each(function () {
      let sunday = parseInt($(this).val());
      if (isNaN(sunday)) {
        sunday = 0;
      }
      sun_total += sunday;
    });
    if (isNaN(sun_total)) {
      sun_total = 0;
    }
    $("#totalSunday").text(sun_total + "h");
  }

  function totalWeekDuration() {
    let total_week = 0;
    $(".totalWeek").each(function () {
      total_week += parseInt($(this).text());
    });
    if (isNaN(total_week)) {
      total_week = 0;
    }
    $("#totalWeekDuration").text(total_week + "h");
  }

  function leftPad(number, targetLength) {
    let output = number + "";
    while (output.length < targetLength) {
      output = "0" + output;
    }
    return output;
  }

  //Updating Project data
  $(document).on("click", "#showProjectData", function () {
    let id = $(this).attr("data-id");
    $("#createProject").modal({
      backdrop: "static",
      keyboard: false,
    });
    $(".hiddenSection").hide();
    $.ajax({
      url: "<?= base_url() ?>/timesheet/getProjectData",
      type: "GET",
      dataType: "json",
      data: {
        id: id,
      },
      success: function (data) {
        $("#tsProjectName").val(data.name).attr("disabled", false);
        $("#tsNotes").val(data.notes).attr("disabled", false);
        $("#tsTimezone")
          .attr("disabled", false)
          .val(data.location)
          .next(".flag-dropdown")
          .children(".selected-flag")
          .attr("title", data.location)
          .children(".flag")
          .removeClass("us")
          .addClass("ph");
        if ($("#savedProject").length == 1) {
          $("#savedProject")
            .attr("id", "updateTSProject")
            .text("Update")
            .attr("data-id", id);
        } else if ($("#updateSchedule").length == 1) {
          $("#updateSchedule")
            .attr("id", "updateTSProject")
            .attr("data-id", id);
        }
      },
    });
  });
  $(document).on("click", "#updateTSProject", function () {
    let week = $("#ts-sorting-week").val();
    let user = $("#tsUsersList").val();
    let id = $(this).attr("data-id");
    let values = {};
    $.each($("#formNewProject").serializeArray(), function (i, field) {
      values[field.name] = field.value;
    });
    let timezone = null;
    if (values["timezone"] != null) {
      timezone = values["timezone"].replace(/\s*\(.*?\)\s*/g, "");
    } else {
      timezone = null;
    }
    $.ajax({
      url: "<?= base_url() ?>/timesheet/updateTSProject",
      type: "POST",
      dataType: "json",
      data: {
        values: values,
        timezone: timezone,
        id: id,
      },
      success: function (data) {
        if (data == 1) {
          $("#timesheet_settings").DataTable().destroy();
          showWeekList(week, user);
          $("#createProject").modal("hide");
          Swal.fire({
            showConfirmButton: false,
            timer: 2000,
            title: "Success",
            html:
              "Project <strong>" +
              values["project"] +
              "</strong> has been updated",
            icon: "success",
          });
        } else {
          console.log("test");
        }
      },
    });
  });

  //Deleting Project
  $(document).on("click", "#removeProject", function () {
    let id = $(this).attr("data-id");
    let project_name = $(this).attr("data-name");
    let week = $("#ts-sorting-week").val();
    let user = $("#tsUsersList").val();
    Swal.fire({
      title: "Are you sure to delete this?",
      html: "Project name: <strong>" + project_name + "</strong>",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "<?= base_url() ?>/timesheet/deleteProjectData",
          method: "POST",
          data: {
            id: id,
          },
          success: function () {
            $("#timesheet_settings").DataTable().destroy();
            showWeekList(week, user);
            Swal.fire({
              showConfirmButton: false,
              timer: 2000,
              title: "Success",
              html:
                "Project <strong>" +
                project_name +
                "</strong> has been deleted!",
              icon: "success",
            });
          },
        });
      }
    });
  });
  show_all_correction_requests();
  $(document).on("change", "#from_date_correction_requests", function () {
    show_all_correction_requests();
  });

  $(document).on("change", "#to_date_correction_requests", function () {
    // console.log("pasok");
    show_all_correction_requests();
  });
  function show_all_correction_requests() {
    $("#attendance_correction_requests_table").hide();
    $(".my-correction-requests-loader").show();
    $("#attendance_correction_requests_table").DataTable().destroy();
    $.ajax({
      url: baseURL + "/timesheet/show_all_correction_requests",
      type: "POST",
      dataType: "json",
      data: {
        date_from: $("#from_date_correction_requests").val(),
        date_to: $("#to_date_correction_requests").val(),
      },
      success: function (data) {
        // console.log(data);
        $("#attendance_correction_requests_table").html(data);
        $("#attendance_correction_requests_table").DataTable({
          ordering: false,
          paging: false,
        });
        $("#attendance_correction_requests_table").show();
        $(".my-correction-requests-loader").hide();
      },
    });
  }
  $(document).on("click", ".deny_correction_reqiest", function () {
    // console.log("pasok");
    let employee_name = $(this).attr("data-employee-name");
    let request_id = $(this).attr("data-timesheet-attendance-correction-id");
    let att_id = $(this).attr("data-attn-id");
    let user_id = $(this).attr("data-user-id");
    Swal.fire({
      title: "Deny this correction request?",
      html:
        "Are you sure you want to want to deny this adjustment request of <strong>" +
        employee_name +
        "</strong>?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/deny.png",
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Deny now",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/deny_correction_request",
          type: "POST",
          dataType: "json",
          data: {
            request_id: request_id,
            att_id: att_id,
            user_id: user_id,
          },
          success: function (data) {
            show_all_correction_requests();
            Swal.fire({
              showConfirmButton: false,
              timer: 2000,
              title: "Success",
              html:
                "Correction request of <strong>" +
                employee_name +
                "</strong> has been denied!",
              icon: "success",
            });
          },
        });
      }
    });
  });
  $(document).on("click", ".approve_correction_reqiest", function () {
    // console.log("pasok");
    let employee_name = $(this).attr("data-employee-name");
    let request_id = $(this).attr("data-timesheet-attendance-correction-id");
    let att_id = $(this).attr("data-attn-id");
    let user_id = $(this).attr("data-user-id");
    Swal.fire({
      title: "Approve this correction request?",
      html:
        "Are you sure you want to want to Approve this adjustment request of <strong>" +
        employee_name +
        "</strong>?",
      showCancelButton: true,
      imageUrl: baseURL + "/assets/img/timesheet/approval.png",
      confirmButtonColor: "#2ca01c",
      cancelButtonColor: "#d33",
      confirmButtonText: "Approve now",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseURL + "/timesheet/approve_correction_reqiest",
          type: "POST",
          dataType: "json",
          data: {
            request_id: request_id,
            att_id: att_id,
            user_id: user_id,
          },
          success: function (data) {
            show_all_correction_requests();
            Swal.fire({
              showConfirmButton: false,
              timer: 2000,
              title: "Success",
              html:
                "Correction request of <strong>" +
                employee_name +
                "</strong> has been approved!",
              icon: "success",
            });
          },
        });
      }
    });
  });
});
