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
  shift_error_finder(selected);
  let end_found_index = end_shift_edited_finder(selected);
  if (end_found_index > -1) {
    new_shift_end_dates[end_found_index] = $(selected).attr("data-date");
    if (Shift_end_validation(selected, validate_start, validate_end)) {
      crossover_setter_from_start_input(selected);
    }
  }
});

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
    }
    new_shift_ends_columns.push(data_column);
    new_shift_ends_ctr++;
  }

  //shift start validation
  shift_error_finder(selected);
});

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

  if (found_erro) {
    has_error_in_new_schedule = true;
    has_error_in_new_schedule_ctr++;
  } else {
    if (has_error_in_new_schedule_ctr > 0) {
      has_error_in_new_schedule_ctr--;
    }
    if (has_error_in_new_schedule_ctr == 0) {
      has_error_in_new_schedule = false;
    }
  }
  $("#schedule_save_btn").attr("disabled", has_error_in_new_schedule);
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
    $(selected).parent("td").children("label").show();
    if (
      $(selected)
        .parent("td")
        .next("td")
        .children(".shift-start-input")
        .attr("data-column") < 7
    ) {
      $(selected)
        .parent("td")
        .children("label")
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
      $(selected).parent("td").children("label").html(days[0]);
    }

    return true;
  } else {
    $(selected).parent("td").children("label").hide();
    return false;
  }
}

$(document).on("click", "#schedule_save_btn", function () {
  if (!has_error_in_new_schedule) {
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
      },
      success: function (data) {},
    });
  } else {
    console.log("========ERROR FOUND=========");
    console.log(has_error_in_new_schedule_ctr);
  }
});
