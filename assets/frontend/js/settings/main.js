var options = {
    urlEmployeeList: base_url + 'workorder/employee_list_json'
};

$(document).ready(function() {

    $('#calender_day_starts_on, #calender_day_ends_on').datetimepicker({
        format: 'LT'
    });
});
