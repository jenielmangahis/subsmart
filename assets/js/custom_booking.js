$(document).ready(function() {
    var click  = 0;
    $("#add-timeslots-row").click(function() {
        /*var markup = "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";*/
        var markup = '';
        click++
        markup += '<tr id="tr_'+click+'">';

            markup += '<td width="">';
                markup += '<div class="time-cnt">';
                    markup += '<input type="text" name="time_start['+click+']" value="8:00am" class="form-control time-input time_start ui-timepicker-input" autocomplete="off">';
                    markup += '&nbsp;&nbsp; - &nbsp;&nbsp;';
                    markup += '<input type="text" name="time_end['+click+']" value="10:00am" class="form-control time-input time_end ui-timepicker-input" autocomplete="off">';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="mon['+click+']" value="Mon" class="checkbox-select" id="mon_'+click+'">';
                    markup += '<label for="mon_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="tue['+click+']" value="Tue" class="checkbox-select" id="tue_'+click+'">';
                    markup += '<label for="tue_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="wed['+click+']" value="Wed" class="checkbox-select" id="wed_'+click+'">';
                    markup += '<label for="wed_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="thu['+click+']" value="Thu" class="checkbox-select" id="thu_'+click+'">';
                    markup += '<label for="thu_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="fri['+click+']" value="Fri" class="checkbox-select" id="fri_'+click+'">';
                    markup += '<label for="fri_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="sat['+click+']" value="Sat" class="checkbox-select" id="sat_'+click+'">';
                    markup += '<label for="sat_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="sun['+click+']" value="Sun" class="checkbox-select" id="sun_'+click+'">';
                    markup += '<label for="sun_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="time-cnt">';
                    markup += '<a class="service-item-delete" data-category-delete-modal="open" data-id="'+click+'" onclick="deleteTimeSlotRow('+click+');" href="javascript:void(0);">';
                    markup += '<span class="fa fa-trash"></span>';
                    markup += '</a>';
                markup += '</div>';
            markup += '</td>';

        markup += '<tr>';
        $("table tbody").append(markup);
    });

    $("#add-form-field-row").click(function() {
        $("#field-name-container").show();
        $("#add-form-field-row").hide();
    });

    $("#hide-add-form-field-row").click(function() {
        $("#field-name-container").hide();
        $("#add-form-field-row").show();
    }); 

});   

function deleteTimeSlotRow(row_id) {
    $('table#table-timeslots tr#tr_' + row_id).remove();
}
