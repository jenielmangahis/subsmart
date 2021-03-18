var new_shift_starts = new Array();
var new_shift_start_ids = new Array();
var new_shift_start_dates = new Array();
var new_shift_starts_columns = new Array();
var new_shift_starts_ctr = 0;

var new_shift_ends = new Array();
var new_shift_end_ids = new Array();
var new_shift_end_dates = new Array();
var new_shift_ends_columns = new Array();
var new_shift_ends_ctr = 0;
var has_error_in_new_schedule = false;
var has_error_in_new_schedule_ctr = 0;

$(document).on("change", ".shift-start-input", function () {
  let selected = this;
  shift_start_input_changed(selected);
});

function shift_start_input_changed(selected) {
  $(selected).addClass("changed");
  $("#schedule_save_btn").removeAttr("disabled");

  let data_column = $(selected).attr("data-column");
  var data_id = $(selected).attr("data-id");
  var already_edited = false;
  var found_index = 0;
  for (var i = 0; i < new_shift_starts_ctr; i++) {
    if (
      new_shift_start_ids[i] == data_id &&
      new_shift_starts_columns[i] == data_column
    ) {
      already_edited = true;
      found_index = i;
      i = new_shift_starts_ctr;
    }
  }
  if (already_edited) {
    new_shift_starts[found_index] = $(selected).val();
    new_shift_start_ids[found_index] = $(selected).attr("data-id");
    new_shift_start_dates[found_index] = $(selected).attr("data-date");
  } else {
    new_shift_starts.push($(selected).val());
    new_shift_start_ids.push($(selected).attr("data-id"));
    new_shift_start_dates.push($(selected).attr("data-date"));
    new_shift_starts_columns.push(data_column);
    new_shift_starts_ctr++;
  }
  var validate_start = $(selected).val();
  var validate_end = $(selected)
    .parent("td")
    .children(".shift-end-input")
    .val();
  Shift_end_validation(selected, validate_start, validate_end);

  remove_error_if_both_blank(selected);
  shift_error_finder(selected);
  let end_found_index = end_shift_edited_finder(selected);
  if (end_found_index > -1) {
    new_shift_end_dates[end_found_index] = $(selected).attr("data-date");
    if (Shift_end_validation(selected, validate_start, validate_end)) {
      crossover_setter_from_start_input(selected);
    } else {
      if (
        $(selected).parent("td").children(".shift-end-input").val() <
        $(selected).val()
      ) {
        $(selected)
          .parent("td")
          .children(".shift-end-input")
          .removeClass("changed")
          .addClass("pink");
      }
    }
  }
}

function end_shift_edited_finder(selected) {
  let data_column = $(selected).attr("data-column");
  var data_id = $(selected).attr("data-id");
  var already_edited = false;
  var found_index = 0;
  for (var i = 0; i < new_shift_ends_ctr; i++) {
    if (
      new_shift_end_ids[i] == data_id &&
      new_shift_ends_columns[i] == data_column
    ) {
      already_edited = true;
      found_index = i;
      break;
    }
  }
  if (already_edited) {
    return found_index;
  } else {
    return -1;
  }
}

function crossover_setter_from_start_input(selected) {
  let found_index = end_shift_edited_finder(selected);
  if (found_index > -1) {
    var crossover_date = new Date($(selected).attr("data-date"));
    var date = new Date(crossover_date.setDate(crossover_date.getDate() + 1));

    var corr_d =
      date.getFullYear() +
      "-" +
      (date.getMonth() > 8
        ? date.getMonth() + 1
        : "0" + (date.getMonth() + 1)) +
      "-" +
      (date.getDate() > 9 ? date.getDate() : "0" + date.getDate());
    new_shift_end_dates[found_index] = corr_d;
  }
}

$(document).on("change", ".shift-end-input", function () {
  let selected = this;
  shift_end_input_changed(selected);
});

function shift_end_input_changed(selected) {
  $(selected).addClass("changed");
  $("#schedule_save_btn").removeAttr("disabled");

  let data_column = $(selected).attr("data-column");
  var data_id = $(selected).attr("data-id");
  var already_edited = false;
  var found_index = 0;
  for (var i = 0; i < new_shift_ends_ctr; i++) {
    if (
      new_shift_end_ids[i] == data_id &&
      new_shift_ends_columns[i] == data_column
    ) {
      already_edited = true;
      found_index = i;
      break;
    }
  }

  var validate_start = $(selected)
    .parent("td")
    .children(".shift-start-input")
    .val();
  var validate_end = $(selected).val();
  var crossover = Shift_end_validation(selected, validate_start, validate_end);

  remove_error_if_both_blank(selected);
  shift_error_finder(selected);

  if (already_edited) {
    new_shift_ends[found_index] = $(selected).val();
    new_shift_end_ids[found_index] = $(selected).attr("data-id");
    new_shift_end_dates[found_index] = $(selected).attr("data-date");
    if (crossover) {
      var crossover_date = new Date($(selected).attr("data-date"));
      var date = new Date(crossover_date.setDate(crossover_date.getDate() + 1));

      var corr_d =
        date.getFullYear() +
        "-" +
        (date.getMonth() > 8
          ? date.getMonth() + 1
          : "0" + (date.getMonth() + 1)) +
        "-" +
        (date.getDate() > 9 ? date.getDate() : "0" + date.getDate());
      new_shift_end_dates[found_index] = corr_d;
    } else {
      if (
        $(selected).parent("td").children(".shift-start-input").val() >
        $(selected).val()
      ) {
        $(selected)
          .parent("td")
          .children(".shift-end-input")
          .removeClass("changed")
          .addClass("pink");
      }
    }
  } else {
    new_shift_ends.push($(selected).val());
    new_shift_end_ids.push($(selected).attr("data-id"));
    if (crossover) {
      var crossover_date = new Date($(selected).attr("data-date"));
      var date = new Date(crossover_date.setDate(crossover_date.getDate() + 1));

      var corr_d =
        date.getFullYear() +
        "-" +
        (date.getMonth() > 8
          ? date.getMonth() + 1
          : "0" + (date.getMonth() + 1)) +
        "-" +
        (date.getDate() > 9 ? date.getDate() : "0" + date.getDate());
      new_shift_end_dates.push(corr_d);
    } else {
      new_shift_end_dates.push($(selected).attr("data-date"));
      if (
        $(selected).parent("td").children(".shift-start-input").val() >
        $(selected).val()
      ) {
        $(selected)
          .parent("td")
          .children(".shift-end-input")
          .removeClass("changed")
          .addClass("pink");
      }
    }
    new_shift_ends_columns.push(data_column);
    new_shift_ends_ctr++;
  }
  shift_start_setter_if_not_changed(
    selected,
    $(selected).attr("data-id"),
    data_column
  );
}

function timeStringToFloat(time) {
  var hoursMinutes = time.split(/[.:]/);
  var hours = parseInt(hoursMinutes[0], 10);
  var minutes = hoursMinutes[1] ? parseInt(hoursMinutes[1], 10) : 0;
  return hours + minutes / 60;
}

function shift_start_setter_if_not_changed(selected, user_id, data_column) {
  if ($(selected).parent("td").children(".shift-start-input").val() != "") {
    let found = false;
    let found_ctr = 0;
    for (var i = 0; i < new_shift_ends_ctr; i++) {
      if (
        new_shift_start_ids[i] == user_id &&
        new_shift_starts_columns[i] == data_column
      ) {
        found = true;
        fount_ctr = i;
        break;
      }
    }
    if (found) {
      new_shift_starts[found_ctr] = $(selected)
        .parent("td")
        .children(".shift-start-input")
        .val();
      new_shift_start_dates[found_ctr] = $(selected)
        .parent("td")
        .children(".shift-start-input")
        .attr("data-date");
      new_shift_start_ids[found_ctr] = user_id;
      new_shift_starts_columns[found_ctr] = data_column;
    } else {
      new_shift_starts.push(
        $(selected).parent("td").children(".shift-start-input").val()
      );
      new_shift_start_dates.push(
        $(selected)
          .parent("td")
          .children(".shift-start-input")
          .attr("data-date")
      );
      new_shift_start_ids.push(user_id);
      new_shift_starts_columns.push(data_column);
      new_shift_starts_ctr++;
    }
  }
}

function shift_error_finder(selected) {
  var found_erro = false;
  if ($(selected).parent("td").children(".shift-start-input").val() == "") {
    $(selected)
      .parent("td")
      .children(".shift-start-input")
      .removeClass("changed")
      .addClass("pink");
    found_erro = true;
  } else {
    $(selected)
      .parent("td")
      .children(".shift-start-input")
      .removeClass("pink")
      .addClass("changed");
  }
  if ($(selected).parent("td").children(".shift-end-input").val() == "") {
    $(selected)
      .parent("td")
      .children(".shift-end-input")
      .removeClass("changed")
      .addClass("pink");
    found_erro = true;
  } else {
    $(selected)
      .parent("td")
      .children(".shift-end-input")
      .removeClass("pink")
      .addClass("changed");
  }

  remove_error_if_both_blank(selected);
  if ($(".pink").length > 0) {
    $("#schedule_save_btn").attr("disabled", true);
  }
}
function remove_error_if_both_blank(selected) {
  if (
    $(selected).parent("td").children(".shift-start-input").val() == "" &&
    $(selected).parent("td").children(".shift-end-input").val() == ""
  ) {
    $(selected)
      .parent("td")
      .children(".shift-end-input")
      .removeClass("pink")
      .addClass("blank");

    $(selected)
      .parent("td")
      .children(".shift-start-input")
      .removeClass("pink")
      .addClass("blank");
  }
}
function Shift_end_validation(selected, validate_start, validate_end) {
  if (validate_start > "12:00" && validate_end < "12:00") {
    var days = [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday",
    ];
    $(selected).parent("td").children(".shift-end-day-indecator").show();
    if (
      $(selected)
        .parent("td")
        .next("td")
        .children(".shift-start-input")
        .attr("data-column") <= 7
    ) {
      $(selected)
        .parent("td")
        .children(".shift-end-day-indecator")
        .html(
          days[
            $(selected)
              .parent("td")
              .next("td")
              .children(".shift-start-input")
              .attr("data-column") - 1
          ]
        );
    } else {
      $(selected)
        .parent("td")
        .children(".shift-end-day-indecator")
        .html(days[0]);
    }
    $(selected).parent("td").children("div").removeAttr("style");
    return true;
  } else {
    $(selected).parent("td").children("div").attr("style", "padding-top:10px;");
    $(selected).parent("td").children(".shift-end-day-indecator").hide();
    return false;
  }
}

$(document).on("click", "#schedule_save_btn", function () {
  if ($(".pink").length == 0) {
    console.log("========SHIFT START=========");
    console.log(new_shift_starts);
    console.log(new_shift_start_ids);
    console.log(new_shift_start_dates);
    console.log(new_shift_starts_columns);
    console.log(new_shift_starts_ctr);
    console.log("========SHIFT END=========");
    console.log(new_shift_ends);
    console.log(new_shift_end_ids);
    console.log(new_shift_end_dates);
    console.log(new_shift_ends_columns);
    console.log(new_shift_ends_ctr);
    $.ajax({
      url: baseURL + "/timesheet/set_schedule",
      type: "POST",
      dataType: "json",
      data: {
        new_shift_starts: new_shift_starts,
        new_shift_start_ids: new_shift_start_ids,
        new_shift_start_dates: new_shift_start_dates,
        new_shift_starts_columns: new_shift_starts_columns,
        new_shift_starts_ctr: new_shift_starts_ctr,

        new_shift_ends: new_shift_ends,
        new_shift_end_ids: new_shift_end_ids,
        new_shift_end_dates: new_shift_end_dates,
        new_shift_ends_columns: new_shift_ends_columns,
        new_shift_ends_ctr: new_shift_ends_ctr,
        week_schedule: $("#scheduleWeek").val(),
      },
      success: function (data) {
        Swal.fire({
          showConfirmButton: false,
          timer: 2000,
          title: "Success",
          html: "Changes has been saved",
          icon: "success",
        }).then((result) => {
          window.location.reload(true);
        });
      },
    });
  } else {
    Swal.fire({
      showConfirmButton: false,
      timer: 2000,
      title: $(".pink").length + " Incorrect schedule",
      icon: "error",
    });
  }
});

var copied_single_shift_start = "";
var copied_single_shift_end = "";
var single_copy = false;
var group_copy = false;
var copied_group_start = new Array();
var copied_group_end = new Array();
$(document).on("click", ".copy-btn", function () {
  let selected = this;
  $(".copy-alert").hide();
  $(
    "#copy_id_" +
      $(selected).attr("data-id") +
      "_" +
      $(selected).attr("data-column")
  ).show();

  copied_single_shift_start = $(selected)
    .parent("div")
    .parent("td")
    .children(".shift-start-input ")
    .val();
  copied_single_shift_end = $(selected)
    .parent("div")
    .parent("td")
    .children(".shift-end-input ")
    .val();
  single_copy = true;
  group_copy = false;
});

$(document).on("click", ".paste-btn", function () {
  let selected = this;
  if (single_copy) {
    $(selected)
      .parent("div")
      .parent("td")
      .children(".shift-start-input ")
      .val(copied_single_shift_start);
    $(selected)
      .parent("div")
      .parent("td")
      .children(".shift-end-input ")
      .val(copied_single_shift_end);
    shift_end_input_changed(
      $(selected).parent("div").parent("td").children(".shift-end-input")
    );
  }
});

$(document).on("click", ".group-copy-btn", function () {
  let selected = this;
  $(".copy-alert").hide();
  $("#copy_all_" + $(selected).attr("data-id")).show();
  copied_group_start = new Array();
  copied_group_end = new Array();
  ///copy starts
  copied_group_start.push(
    $(selected).parent("td").next("td").children(".shift-start-input").val()
  );
  copied_group_start.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .children(".shift-start-input")
      .val()
  );
  copied_group_start.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-start-input")
      .val()
  );
  copied_group_start.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-start-input")
      .val()
  );
  copied_group_start.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-start-input")
      .val()
  );
  copied_group_start.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-start-input")
      .val()
  );
  copied_group_start.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-start-input")
      .val()
  );
  //copy ends
  copied_group_end.push(
    $(selected).parent("td").next("td").children(".shift-end-input").val()
  );
  copied_group_end.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .children(".shift-end-input")
      .val()
  );
  copied_group_end.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-end-input")
      .val()
  );
  copied_group_end.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-end-input")
      .val()
  );
  copied_group_end.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-end-input")
      .val()
  );
  copied_group_end.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-end-input")
      .val()
  );
  copied_group_end.push(
    $(selected)
      .parent("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .next("td")
      .children(".shift-end-input")
      .val()
  );
  single_copy = false;
  group_copy = true;
  console.log(copied_group_start);
  console.log(copied_group_end);
});

$(document).on("click", ".group-paste-btn", function () {
  let selected = this;
  let montd = $(selected).parent("td").next("td");
  let tuetd = $(selected).parent("td").next("td").next("td");
  let wedtd = $(selected).parent("td").next("td").next("td").next("td");
  let thurtd = $(selected)
    .parent("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td");
  let fritd = $(selected)
    .parent("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td");
  let sattd = $(selected)
    .parent("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td");
  let suntd = $(selected)
    .parent("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td")
    .next("td");
  if (single_copy) {
    ///paste start

    $(montd).children(".shift-start-input").val(copied_single_shift_start);
    $(tuetd).children(".shift-start-input").val(copied_single_shift_start);
    $(wedtd).children(".shift-start-input").val(copied_single_shift_start);
    $(thurtd).children(".shift-start-input").val(copied_single_shift_start);
    $(fritd).children(".shift-start-input").val(copied_single_shift_start);
    $(sattd).children(".shift-start-input").val(copied_single_shift_start);
    $(suntd).children(".shift-start-input").val(copied_single_shift_start);

    $(montd).children(".shift-end-input").val(copied_single_shift_end);
    $(tuetd).children(".shift-end-input").val(copied_single_shift_end);
    $(wedtd).children(".shift-end-input").val(copied_single_shift_end);
    $(thurtd).children(".shift-end-input").val(copied_single_shift_end);
    $(fritd).children(".shift-end-input").val(copied_single_shift_end);
    $(sattd).children(".shift-end-input").val(copied_single_shift_end);
    $(suntd).children(".shift-end-input").val(copied_single_shift_end);
  } else if (group_copy) {
    $(montd).children(".shift-start-input").val(copied_group_start[0]);
    $(tuetd).children(".shift-start-input").val(copied_group_start[1]);
    $(wedtd).children(".shift-start-input").val(copied_group_start[2]);
    $(thurtd).children(".shift-start-input").val(copied_group_start[3]);
    $(fritd).children(".shift-start-input").val(copied_group_start[4]);
    $(sattd).children(".shift-start-input").val(copied_group_start[5]);
    $(suntd).children(".shift-start-input").val(copied_group_start[6]);

    $(montd).children(".shift-end-input").val(copied_group_end[0]);
    $(tuetd).children(".shift-end-input").val(copied_group_end[1]);
    $(wedtd).children(".shift-end-input").val(copied_group_end[2]);
    $(thurtd).children(".shift-end-input").val(copied_group_end[3]);
    $(fritd).children(".shift-end-input").val(copied_group_end[4]);
    $(sattd).children(".shift-end-input").val(copied_group_end[5]);
    $(suntd).children(".shift-end-input").val(copied_group_end[6]);
  }
  if (group_copy || single_copy) {
    if (
      $(montd).children(".shift-start-input").val() != "" &&
      $(montd).children(".shift-end-input").val() != ""
    ) {
      // shift_start_input_changed($(montd).children(".shift-start-input"));
      shift_end_input_changed($(montd).children(".shift-end-input"));
    }

    if (
      $(tuetd).children(".shift-start-input").val() != "" &&
      $(tuetd).children(".shift-end-input").val() != ""
    ) {
      // shift_start_input_changed($(tuetd).children(".shift-start-input"));
      shift_end_input_changed($(tuetd).children(".shift-end-input"));
    }

    if (
      $(wedtd).children(".shift-start-input").val() != "" &&
      $(wedtd).children(".shift-end-input").val() != ""
    ) {
      // shift_start_input_changed($(wedtd).children(".shift-start-input"));
      shift_end_input_changed($(wedtd).children(".shift-end-input"));
    }

    if (
      $(thurtd).children(".shift-start-input").val() != "" &&
      $(thurtd).children(".shift-end-input").val() != ""
    ) {
      // shift_start_input_changed($(thurtd).children(".shift-start-input"));
      shift_end_input_changed($(thurtd).children(".shift-end-input"));
    }

    if (
      $(fritd).children(".shift-start-input").val() != "" &&
      $(fritd).children(".shift-end-input").val() != ""
    ) {
      // shift_start_input_changed($(fritd).children(".shift-start-input"));
      shift_end_input_changed($(fritd).children(".shift-end-input"));
    }

    if (
      $(sattd).children(".shift-start-input").val() != "" &&
      $(sattd).children(".shift-end-input").val() != ""
    ) {
      // shift_start_input_changed($(sattd).children(".shift-start-input"));
      shift_end_input_changed($(sattd).children(".shift-end-input"));
    }

    if (
      $(suntd).children(".shift-start-input").val() != "" &&
      $(suntd).children(".shift-end-input").val() != ""
    ) {
      // shift_start_input_changed($(suntd).children(".shift-start-input"));
      shift_end_input_changed($(suntd).children(".shift-end-input"));
    }
  }
});
