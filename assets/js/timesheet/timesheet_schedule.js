var new_shift_starts = new Array();
var new_shift_start_ids = new Array();
var new_shift_start_dates = new Array();
var new_shift_starts_columns = new Array();
var new_shift_starts_ctr =0;

var new_shift_ends = new Array();
var new_shift_end_ids = new Array();
var new_shift_end_dates = new Array();
var new_shift_ends_columns = new Array();
var new_shift_ends_ctr =0;
var has_error_in_new_schedule = false;

$(document).on('change', '.shift-start-input', function() {
    // console.log($(this).val());
    let selected = this;
    $(selected).addClass("changed");
    $('#schedule_save_btn').removeAttr("disabled");

    let data_column =  $(selected).attr("data-column");
    var data_id=$(selected).attr("data-id");
    console.log(data_column);
    var already_edited = false;
    var found_index = 0;
    for(var i=0; i < new_shift_starts_ctr; i++){
        if(new_shift_start_ids[i] == data_id && new_shift_starts_columns[i] == data_column){
            already_edited = true;
            found_index = i;
            i = new_shift_starts_ctr;
        }
    }
    if(already_edited){
        console.log("Already Edited");
        new_shift_starts[found_index] = $(selected).val();
        new_shift_start_ids[found_index] = $(selected).attr("data-id");
        new_shift_start_dates[found_index] = $(selected).attr("data-date");
    }else{
        new_shift_starts.push($(selected).val());
        new_shift_start_ids.push($(selected).attr("data-id"));
        new_shift_start_dates.push($(selected).attr("data-date"));
        new_shift_starts_columns.push(data_column);
        new_shift_starts_ctr++;
    }
    var validate_start = $(selected).val();
    var validate_end = $(selected).parent('td').children(".shift-end-input").val();
    Shift_end_validation(selected, validate_start, validate_end)
});


$(document).on('change', '.shift-end-input', function() {
    let selected = this;
    $(selected).addClass("changed");
    $('#schedule_save_btn').removeAttr("disabled");
    
    let data_column =  $(selected).attr("data-column");
    var data_id=$(selected).attr("data-id");
    // console.log(data_column);
    var already_edited = false;
    var found_index = 0;
    for(var i=0; i < new_shift_ends_ctr; i++){
        if(new_shift_end_ids[i] == data_id && new_shift_starts_columns[i] == data_column){
            already_edited = true;
            found_index = i;
            i = new_shift_ends_ctr;
        }
    }
    if(already_edited){
        // console.log("Already Edited");
        new_shift_ends[found_index] = $(selected).val();
        new_shift_end_ids[found_index] = $(selected).attr("data-id");
        new_shift_end_dates[found_index] = $(selected).attr("data-date");
    }else{
        new_shift_ends.push($(selected).val());
        new_shift_end_ids.push($(selected).attr("data-id"));
        new_shift_end_dates.push($(selected).attr("data-date"));
        new_shift_ends_columns.push(data_column);
        new_shift_ends_ctr++;
    }
    var validate_start = $(selected).parent('td').children(".shift-start-input").val();
    var validate_end = $(selected).val();
    Shift_end_validation(selected, validate_start, validate_end)
});

function Shift_end_validation(selected, validate_start, validate_end){
    if(validate_start > "12:00" && validate_end < "12:00"){
        var days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
        $(selected).parent('td').children('label').show();
        $(selected).parent('td').children('label').html(days[$(selected).parent('td').next('td').children(".shift-start-input").attr("data-column")-1]);
    }else{
        $(selected).parent('td').children('label').hide();
    }
}

$(document).on('click', '#schedule_save_btn', function() {
    let selected = this;
    console.log("========SHIFT STARTS=========");
    console.log(new_shift_starts);
    console.log(new_shift_start_ids);
    console.log(new_shift_start_dates);
    console.log(new_shift_starts_columns);
    console.log(new_shift_starts_ctr);
    console.log("========SHIFT ENDS=========");
    console.log(new_shift_ends);
    console.log(new_shift_end_ids);
    console.log(new_shift_end_dates);
    console.log(new_shift_ends_columns);
    console.log(new_shift_ends_ctr);

});