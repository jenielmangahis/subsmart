$(document).ready(function () {
  //START DOCUMENT READY

  $(document).on("click", ".delete-new-notif", function () {
    var notif_id = $(this).attr("data-notif-id");
    var user_id = $(this).attr("data-user-id");

    $("#notif" + notif_id).removeClass("show");
    $.ajax({
      url: baseURL + "/timesheet/delete_notification",
      type: "POST",
      dataType: "json",
      data: { notif_id: notif_id, user_id: user_id },
      success: function (data) {
        $("#notif" + notif_id).hide();
        new_notif_ctr = new_notif_ctr - 1;
        if (new_notif_ctr == 0) {
          $("#nothing_new_for_you").show();
          $("#read-all-notif").hide();
        }
      },
    });
  });

  $(document).on("click", ".delete-prev-notif", function () {
    var notif_id = $(this).attr("data-notif-id");
    var user_id = $(this).attr("data-user-id");

    $("#notif" + notif_id).removeClass("show");
    $.ajax({
      url: baseURL + "/timesheet/delete_notification",
      type: "POST",
      dataType: "json",
      data: { notif_id: notif_id, user_id: user_id },
      success: function (data) {
        $("#notif" + notif_id).hide();
        count_of_prev_notiv = count_of_prev_notiv - 1;
        if (count_of_prev_notiv == 0) {
          $("#nothing_prev_for_you").show();
        }
      },
    });
  });

  $(document).on("click", "#read-all-notif", function () {
    console.log("pasok");
    $.ajax({
      url: baseURL + "/timesheet/delete_read_all_notif",
      type: "POST",
      dataType: "json",
      data: { action: "read-all" },
      success: function (data) {
        location.reload();
      },
    });
  });

  $(document).on("click", "#delete-all-notif", function () {
    console.log("pasok delete");
    $.ajax({
      url: baseURL + "/timesheet/delete_read_all_notif",
      type: "POST",
      dataType: "json",
      data: { action: "delete-all" },
      success: function (data) {
        location.reload();
      },
    });
  });
  //END DOCUMENT READY
});
