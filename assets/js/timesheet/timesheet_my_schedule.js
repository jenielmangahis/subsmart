document.addEventListener("DOMContentLoaded", function () {
  load_calendar();
});

var fresh_start = true;
function load_calendar() {
  let text_mont_year = "";
  let initial = "";
  let schedule = "";
  $.ajax({
    url: baseURL + "/timesheet/get_my_schedules",
    type: "POST",
    dataType: "json",
    data: { text_mont_year: text_mont_year },
    success: function (data) {
      initial = data.initial_date;
      schedule = data.schedules_calendar;
      var calendarEl = document.getElementById("calendar");
      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: "prev,next, today",
          center: "title",
          right: "dayGridMonth,dayGridWeek",
        },
        initialDate: initial,
        navLinks: false, // can click day/week names to navigate views
        editable: false,
        dayMaxEvents: true, // allow "more" link when too many events
        events: schedule,
      });
      calendar.render();
    },
  });
}
