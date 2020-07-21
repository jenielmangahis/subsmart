$(document).ready(function() {
    var click  = 0;
    $("#add-timeslots-row").click(function() {
        /*var markup = "<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>";*/
        var markup = '';
        click++
        markup += '<tr id="tr_'+click+'">';

            markup += '<td width="">';
                markup += '<div class="time-cnt">';
                    markup += '<input type="text" name="time['+click+'][time_start]" value="8:00am" class="form-control time-input time_start ui-timepicker-input" autocomplete="off">';
                    markup += '&nbsp;&nbsp; - &nbsp;&nbsp;';
                    markup += '<input type="text" name="time['+click+'][time_end]" value="10:00am" class="form-control time-input time_end ui-timepicker-input" autocomplete="off">';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="time['+click+'][days][mon]" value="Mon" class="checkbox-select" id="mon_'+click+'">';
                    markup += '<label for="mon_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="time['+click+'][days][tue]" value="Tue" class="checkbox-select" id="tue_'+click+'">';
                    markup += '<label for="tue_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="time['+click+'][days][wed]" value="Wed" class="checkbox-select" id="wed_'+click+'">';
                    markup += '<label for="wed_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="time['+click+'][days][thu]" value="Thu" class="checkbox-select" id="thu_'+click+'">';
                    markup += '<label for="thu_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="time['+click+'][days][fri]" value="Fri" class="checkbox-select" id="fri_'+click+'">';
                    markup += '<label for="fri_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="time['+click+'][days][sat]" value="Sat" class="checkbox-select" id="sat_'+click+'">';
                    markup += '<label for="sat_'+click+'"></label>';
                markup += '</div>';
            markup += '</td>';

            markup += '<td width="">';
                markup += '<div class="checkbox checkbox-sm">';
                    markup += '<input type="checkbox" name="time['+click+'][days][sun]" value="Sun" class="checkbox-select" id="sun_'+click+'">';
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
        $('.time-input').timepicker({ 'timeFormat': 'h:i A' });
    });

    $("#add-form-field-row").click(function() {
        $("#field-name-container").show();
        $("#add-form-field-row").hide();
    });

    $("#hide-add-form-field-row").click(function() {
        $("#field-name-container").hide();
        $("#add-form-field-row").show();
    }); 

    $(".category-edit").click(function(){
        $("#modalEditCategory").modal('show');
        var cat_id = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        var url = base_url + '/booking/ajax_edit_category';

        $(".modal-edit-category-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {cat_id:cat_id},
               success: function(o)
               {
                  $(".modal-edit-category-container").html(o);
               }
            });
        }, 1000);

    });
        
    $(".service-item-edit").click(function(){
        $("#modalEditServiceItem").modal('show');
        var siid = $(this).attr("data-id");
        
        var msg = '<div class="alert alert-info" role="alert"><img src="'+base_url+'/assets/img/spinner.gif" /> Loading...</div>';
        var url = base_url + '/booking/ajax_edit_service_item';

        $(".modal-edit-service-item-container").html(msg);
        setTimeout(function () {
            $.ajax({
               type: "POST",
               url: url,
               data: {siid:siid},
               success: function(o)
               {
                  $(".modal-edit-service-item-container").html(o);
               }
            });
        }, 1000);

    });

    $(".service-item-delete").click(function(){
        var siid = $(this).attr("data-id");
        $("#siid").val(siid);
        $("#modalDeleteServiceItem").modal('show');
    });

    $(".category-delete").click(function(){
        var cat_id = $(this).attr("data-id");
        $("#cat_id").val(cat_id);
        $("#modalDeleteCategory").modal('show');
    });
});   

function deleteTimeSlotRow(row_id) {
    $('table#table-timeslots tr#tr_' + row_id).remove();
}

var loadPreviewImg=function(event){
    $('#preview-img-container').attr('src', URL.createObjectURL(event.target.files[0]));
};

var loadEditPreviewImg=function(event){
    $('#edit-preview-img-container').attr('src', URL.createObjectURL(event.target.files[0]));
};