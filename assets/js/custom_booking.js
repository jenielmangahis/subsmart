$(document).ready(function() {
    $("#add-timeslots-row").click(function() {
        /*var markup = "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";*/
        var markup = '';

        markup += '<tr>';

            markup += '<td width="">';
                markup += '<div class="time-cnt">';
                    markup += '<input type="text" name="time_start[0]" value="8:00am" class="form-control time-input time_start ui-timepicker-input" autocomplete="off">';
                    markup += '&nbsp;&nbsp; - &nbsp;&nbsp;';
                    markup += '<input type="text" name="time_end[0]" value="10:00am" class="form-control time-input time_end ui-timepicker-input" autocomplete="off">';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">';
                    markup += '<label for="weekday_Mon_0"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">';
                    markup += '<label for="weekday_Mon_0"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">';
                    markup += '<label for="weekday_Mon_0"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">';
                    markup += '<label for="weekday_Mon_0"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">';
                    markup += '<label for="weekday_Mon_0"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">';
                    markup += '<label for="weekday_Mon_0"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="weekday[0][]" value="Mon" class="checkbox-select" id="weekday_Mon_0">';
                    markup += '<label for="weekday_Mon_0"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="time-cnt">';
                    markup += '<a class="service-item-delete" data-category-delete-modal="open" data-id="13526" href="#">';
                    markup += '<span class="fa fa-trash"></span>';
                    markup += '</a>';
                markup += '</div>';
            markup += '</td>';

        markup += '<tr>';
        $("table tbody").append(markup);
    });

});   

