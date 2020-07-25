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

    $(".onoffswitch-checkbox-productStatus").click(function(){
        var service_item_id = $(this).attr("data-product-id");
        var url = base_url + '/booking/ajax_save_service_item_visible_status';

        if($('#product-status-' + service_item_id).is(':checked')) {
            //save to is_visible to 1 (checked)
            var is_visible = 1;
            $.ajax({
               type: "POST",
               url: url,
               data: {service_item_id:service_item_id,is_visible:is_visible},
               success: function(o)
               {
                    var obj = jQuery.parseJSON( o );
                    if(obj.is_success == true) {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times</button>Update Visible Status Successfull</div></div></div>');
                    } else {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-dangel"><button type="button" class="close" data-dismiss="alert">&times</button>Error Updating Visible Status</div></div></div>');
                    }                  
               }
            });            
        } else {
            //save to is_visible to 0 (unchecked)
            var is_visible = 0;
            $.ajax({
               type: "POST",
               url: url,
               data: {service_item_id:service_item_id,is_visible:is_visible},
               success: function(o)
               {
                    var obj = jQuery.parseJSON( o );
                    if(obj.is_success == true) {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times</button>Update Visible Status Successfull</div></div></div>');
                    } else {
                        $(".ajax-alert-container").html('<div class="row dashboard-container-1"><div class="col-md-12"><div class="alert alert-dangel"><button type="button" class="close" data-dismiss="alert">&times</button>Error Updating Visible Status</div></div></div>');
                    }                  
               }
            });            
        }

    });    

    $(".select-form-field-visible").click(function(){
        var field_name = $(this).attr("data-field-name");
        if($('#is_visible_' + field_name).is(':checked')) {
           $(".form-group-" + field_name).show();          
        } else {
           $(".form-group-" + field_name).hide();    
        }
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

$(".add-custom-field").click(function(){
    var totalRows = $(".tbl-custom-fields tr").length;
    var fieldName = $("#field_name").val();
    var newRowNum = totalRows + 1;

    //Left Pane
    var col1 = '<td width="60%">'+fieldName+' <input type="hidden" id="is_field['+fieldName+'][]" name="is_field['+fieldName+'][]" value="'+fieldName+'" /> </td>';
    var col2 = '<td width="20%"><div class="checkbox checkbox-sm"><input type="checkbox" name="is_visible['+fieldName+'][]" value="1" class="checkbox-select select-form-field-visible" data-field-name="'+fieldName+'" id="is_visible_'+fieldName+'"><label for="is_visible_'+fieldName+'"></label></td>';
    var col3 = '<td width="20%"><div class="checkbox checkbox-sm"><input type="checkbox" name="is_required['+fieldName+'][]" value="1" class="checkbox-select select-form-field-visible" data-field-name="'+fieldName+'" id="is_required_'+fieldName+'"><label for="is_required_'+fieldName+'"></label></td>';
    var col4 = '<td width="20%"><a href="javascript:void(0);" class="delete-custom-field" data-row="'+newRowNum+'"><i class="fa fa-trash"></i></a></td>';
    var newRow = '<tr class="custom-row-'+newRowNum+'">' + col1 + col2 + col3 + col4 + '</tr>';
    $(".tbl-custom-fields").append(newRow);

    //Right Pane    
    var newField  = '<div class="form-group form-group-address custom-field-'+newRowNum+'"><label>'+fieldName+'</label><input type="text" id="'+newField+'" name="'+fieldName+'" placeholder="" class="form-control pac-target-input" autocomplete="off"></div>';

    $(".form-fileds-container").append(newField);

    $("#field_name").val("");

    $(".delete-custom-field").click(function(){
        var row = $(this).attr('data-row');
        $(".custom-row-" + row).remove();
        $(".custom-field-" + row).remove();
    });

    $("#modalAddFormField").modal('hide');
});

