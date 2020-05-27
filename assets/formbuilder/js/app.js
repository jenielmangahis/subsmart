// Drag and drop
$( "#sortable" ).sortable({
	revert: true,
	handel: '.cb_move_btn',
	cancel: '.no-drag',
});
// $( "#sortable" ).disableSelection();

// Elements
var __col_btn = $('.col_btn');
var __mr_btn = $('.main_row_btn');
var __mr_box = $('.main_row_append_box');
var __mr_btn_mini = $('.main_row_minimize');
var __generate_btn = $('.generate_btn');
var __generate_box = $('.form_generated_box');
var __html_btn = $('.html_btn');
var __code_box = $('.code_box');
var __doc = $(document);


// Events
function make_column(e){
	e.preventDefault();
	var d = $(this).data('col-btn');
	console.log(d);
}

function add_main_row(e){
	e.preventDefault();
	__mr_box.append(main_row);

	$(".form_bal_textfield").draggable({
        helper: function () {
            return getTextFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_textarea").draggable({
        helper: function () {
            return getTextAreaFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_number").draggable({
        helper: function () {
            return getNumberFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_email").draggable({
        helper: function () {
            return getEmailFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_password").draggable({
        helper: function () {
            return getPasswordFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_date").draggable({
        helper: function () {
            return getDateFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_button").draggable({
        helper: function () {
            return getButtonFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_select").draggable({
        helper: function () {
            return getSelectFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_radio").draggable({
        helper: function () {
            return getRadioFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_checkbox").draggable({
        helper: function () {
            return getCheckboxFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });

    $(".form_builder_area").sortable({
        cursor: 'move',
        placeholder: 'placeholder',
        start: function (e, ui) {
            ui.placeholder.height(ui.helper.outerHeight());
        },
        stop: function (ev, ui) {
            getPreview();
        }
    });
    $(".form_builder_area").disableSelection();
	// $(".dropper").droppable({
 //        drop: function (event, ui) {
            
 //        	$(event.target).find('.custom-div').append($('#form-autocomplete-field-clone').html());
 //        	//$(event.target).find('.custom-div').css('background','red');

 //            // $(this)
 //            //     .addClass("ui-state-highlight")
 //            //     .find("custom-div")
 //            //     .html("Dropped!");

 //            // var element = $('.ui-draggable-dragging');
 //            // var currentDrop=$(this);
 //            //return element.clone().appendTo(currentDrop);
 //        }
 //    });
	// console.log(main_row)
}

function add_inner_row(e){
	e.preventDefault();

	var par = $(this).parents('.cb_display_box:first');
	var box = par.find('.inner_row_append_box:first');
	box.append(inner_row);
}

function add_column(){
	var par = $(this).parents('.inner_col__box:first');
	var n = $(this).val();
	var col_d = '';
	var col = '';
	
	if(parseInt(n) == 1) {col = 'col-sm-12'; }
	if(parseInt(n) == 2) {col = 'col-sm-6';}
	if(parseInt(n) == 3) {col = 'col-sm-4';}
	if(parseInt(n) == 4) {col = 'col-sm-3';}

	for(var i = 0; i < n; i++){
		col_d += '<div class="'+col+'">'+form_select_bar+'</div>';
	}

	var box = par.find('.form_row_box');
	box.html(col_d);
}

// Make Field
function on_select_field(){
	var txt = $(this).val();
	var par = $(this).parent('.field_box');
	var box = par.find('.form_field_box');

	$(this).hide();
	box.text('Here')

	switch(txt){
		case 'input':
			make_input_field(box);
			break;

		case 'textarea':
			make_textarea_field(box);
			break;

		case 'select':
			make_select_field(box);
			break;

		case 'checkbox':
			make_checkbox_field(box);
			break;

		case 'radio':
			make_radio_field(box);
			break;

		default:
			console.log('Not added');
	}
	// console.log(txt);
}

// Create Input
function make_input_field(el){
	var id = make_id(6);
	var input = '<div class="cnt_input_box form-group">';
		input += '<label for="'+id+'" data-field-type="input" class="in_field">';
		input += '<span class="field_title" contenteditable>Input Field [edit]</span>';
		input += in_field_edit;
		input += '</label>';
		input += '<input type="text" name="'+id+'" class="form-control" placeholder="">';
		input += '</div>';
	el.html(input);
}

// Create Textarea
function make_textarea_field(el){
	var id = make_id(6);
	var input = '<div class="cnt_input_box form-group">';
		input += '<label for="'+id+'" data-field-type="text" class="in_field">';
		input += '<span class="field_title" contenteditable>Note Field [edit]</span>';
		input += in_field_edit;
		input += '</label>';
		input += '<textarea type="text" name="'+id+'" class="form-control" placeholder=""></textarea>';
		input += '</div>';
	el.html(input);
}

// Create Select
function make_select_field(el){
	var id = make_id(6);
	var input = '<div class="cnt_input_box form-group">';
		input += '<label for="'+id+'" data-field-type="select" class="in_field">';
		input += '<span class="field_title" contenteditable>Select Field [edit]</span>';
		input += in_field_edit;
		input += '</label>';
		input += add_option_temp('select');
		input += '<select name="'+id+'" class="form-control hide_box">';
		input += '<option disabled="" selected="">-- Select Option --</option>';
		input += '</select>';
		input += '</div>';
	el.html(input);
}

// Create Checkbox
function make_checkbox_field(el){
	var id = make_id(6);
	var input = '<div class="cnt_input_box form-group">';
		input += '<label for="'+id+'" data-field-type="checkbox" class="in_field">';
		input += '<span class="field_title" contenteditable>Checkbox Field [edit]</span>';
		input += in_field_edit;
		input += '</label>';
		input +=  add_option_temp('checkbox');
		input += '</div>';
	el.html(input);
}

// Create Radio
function make_radio_field(el){
	var id = make_id(6);
	var input = '<div class="cnt_input_box form-group">';
		input += '<label for="'+id+'" data-field-type="radio" class="in_field">';
		input += '<span class="field_title" contenteditable>Radio Field [edit]</span>';
		input += in_field_edit;
		input += '</label>';
		input +=  add_option_temp('radio');
		input += '</div>';
	el.html(input);
}

// Select option
function add_options(){
	var par = $(this).parents('.cnt_input_box');
	var type = $(this).attr('data-option-text');
	var s_ul = par.find('.select_list');
	var s_box = par.find('.select_add_list');
	var inp = s_box.find('input:first');
	var sel = par.find('select:first');
	var icon = '<i class="fa fa-close"></i>';

	if(type === 'select'){
		if(inp.val() !== ''){
			var el = '<span class="delete" data-rem-text="select">'+icon+'</span></li>';
			s_ul.append('<li data-select-val="'+inp.val()+'">'+ inp.val() +el);
			sel.append('<option>'+inp.val()+'</option>');
			inp.val('');
		}
	}

	if(type === 'checkbox'){
		var label = par.find('label:first');
		var type = label.data('field-type');
		var txt = label.text();

		var el = '<div class="checkbox">';
			el += '<label>';
			el += '<input type="checkbox" name="'+slugify(txt.trim())+'" value="'+inp.val()+'">'+inp.val();
			el += '<span class="delete" data-rem-text="checkbox">'+icon+'</span></li>';
			el += '</label>';
			el += '</div>';

		s_ul.append(el);
		inp.val('');
	}

	if(type === 'radio'){
		var label = par.find('label:first');
		var type = label.data('field-type');
		var txt = label.text();

		var el = '<div class="radio">';
			el += '<label>';
			el += '<input type="radio" name="'+slugify(txt.trim())+'" value="'+inp.val()+'">'+inp.val();
			el += '<span class="delete" data-rem-text="radio">'+icon+'</span></li>';
			el += '</label>';
			el += '</div>';

		s_ul.append(el);
		inp.val('');
	}
}

// Edit field field 
function add_field_title(){
	var par = $(this).parents('.cnt_input_box');
	var label = par.find('label:first');
	var type = label.data('field-type');
	var txt = label.text();

	if(type === 'input'){
		par.find('input:first').attr('name', slugify(txt));
		par.find('input:first').attr('placeholder', txt.trim());
	}

	// 
	if(type === 'text'){
		par.find('textarea:first').attr('name', slugify(txt));
		par.find('textarea:first').attr('placeholder', txt.trim());
	}

	if(type === 'select'){
		var sel = par.find('select:first');
		sel.attr('name', slugify(txt));
		sel.attr('placeholder', txt.trim());
		sel.find('option:first').text('-- '+txt.trim()+' --');
	}

	if(type === 'checkbox'){
		var cbox = par.find('.checkbox');
		var inp = cbox.find('input');
		inp.attr('name', slugify(txt.trim() ));
	}

	if(type === 'radio'){
		console.log('Radio here');
		var cbox = par.find('.radio');
		var inp = cbox.find('input');
		inp.attr('name', slugify(txt.trim() ));
	}
}

function update_field_obj(){
	//
}

// Generate form data
function generate_form_data(){
	var c = __mr_box.clone(true, true);
	var mainbox = c.find('.cb_display_box');
	var removables = c.find('.removable');
	
	var btn = __html_btn;
	var btn_txt = btn.attr('data-code-btn');

	// Remove handlers
	c.find('.removable, .delete, .remove_btn').remove();
	c.removeClass('cb_display_box, no-drag');

	__generate_box.html('');
	mainbox.each(function(i, v){		
		var heading = $(this).find('h2:first');
		var desc = $(this).find('.add_desc_box:first');
		var desc = desc.text().trim();

		var box = '<div class="main-group-box">';
		box += '<h2 class="group_title">'+heading.text()+'</h2>';

		if(desc !== '-- Description text here' && desc !== ''){
			box += '<p>'+desc+'</p>';
		}

		var fbox = $(this).find('.form_row_box');
		var el = '';

		fbox.each(function (i, v) {
			
			

			el += '<div class="row">';

			var cols = $(this).children();
			for(var j = 0; j < cols.length; j++){
				var field = $(this).find('.cnt_input_box');
				var c = cols[j].getAttribute('class');
				el += '<div class="'+c+'">';
				el += field[j].outerHTML;
				el += '</div>';
			}
			el += '</div>';
		});

		box += el;
		box += '</div>';

		__generate_box.append(box);
	});

	__mr_box.hide();
	__generate_box.show();

	// __generate_box.html(c);
	__mr_btn.hide();
	btn.attr('data-code-btn', 'editor');
	btn.html('<i class="fa fa-angle-double-left"></i> Back');
}

// Make HTML View
function switch_view(){
	var c = __mr_box.clone(true, true);
	var mainbox = c.find('.cb_display_box');

	var btn = $(this);
	var btn_txt = btn.attr('data-code-btn');

	// Remove handlers
	if(btn_txt === 'code'){
		mainbox.find('.removable').remove();

		__code_box.val('');
		mainbox.each(function (i, v) {

			var heading = $(this).find('h2:first');
			var desc = $(this).find('.add_desc_box:first');
			var desc = desc.text().trim();

			var box = '<div class="main-group-box">';
			box += '<h2 class="group_title">'+heading.text()+'</h2>';

			if(desc !== '-- Description text here' && desc !== ''){
				box += '<p>'+desc+'</p>';
			}

			var fbox = $(this).find('.form_row_box');
			var el = '';
			fbox.each(function(i, v){
				el += '<div class="row">';

				var cols = $(this).children();
				for(var j = 0; j < cols.length; j++){
					var field = $(this).find('.cnt_input_box');
					var c = cols[j].getAttribute('class');
					el += '<div class="'+c+'">';
					el += field[j].outerHTML;
					el += '</div>';
				}
				el += '</div>';
			});

			box += el;
			box += '</div>';

			var txt = __code_box.val();
			__code_box.val(txt + box);
		});

		__mr_box.hide();
		__generate_box.hide();
		__code_box.show();

		btn.attr('data-code-btn', 'editor');
		btn.html('<i class="fa fa-angle-double-left"></i> Back');
	}

	if(btn_txt === 'editor'){
		__code_box.hide();
		__generate_box.hide();
		__mr_box.show();
		__mr_btn.show();

		btn.attr('data-code-btn', 'code');
		btn.html('View HTML <i class="fa fa-code"></i>')
	}
}

function heading_text(){
	var par = $(this).parent('.desc_box');
	var box = par.find('.add_desc_box');
	$(this).hide();
	box.show();
}

function remove_action(){
	var btn = $(this);
	var txt = btn.attr('data-remove-txt');

	// alert 

	if(txt === 'main'){
		var box = $(this).parents('.cb_layer_box:first');
		box.remove();
	}

	if(txt === 'inner_row'){
		var box = $(this).parents('.inner_col__box:first');
		box.remove();
	}

	if(txt === 'field'){
		var par = btn.parents('.field_box:first');
		var sel = par.find('.form_field_select:first');
		var div = par.find('div:first');

		// Alert first

		div.html('');
		var op = sel.find('option')[0];
		sel.val(op.innerText);
		sel.show();
	}

	if(txt === 'heading'){
		var par = btn.parents('.desc_box');
		var btn = par.find('.add_desc_btn');
		var box = par.find('.add_desc_box');

		box.find('span:first').text('-- Description text here');

		box.hide();
		btn.show();
	}
}

function minimize_action(){
	var btn = $(this);
	var txt = btn.attr('data-minimize-txt');

	if(txt === 'main'){
		var par = btn.parents('.cb_layer_box:first');
		var min_tb = par.find('.on_minimize:first');
		var min_txt = par.find('.group_title:first');
		var side_bar = par.find('.side_move_bar:first');

		var box = par.find('.minimize_box:first');
		if(box.is(':visible')){
			par.addClass('minimize_cover');
			box.hide();
			btn.html('<i class="fa fa-plus"></i>');
			min_tb.html('<h2 class="group_title">'+min_txt.text()+'</h2>');

			side_bar.removeClass('cb_move_btn');
		}else{
			min_tb.html('');
			par.removeClass('minimize_cover');
			box.show();
			btn.html('<i class="fa fa-minus"></i>');
			side_bar.addClass('cb_move_btn');
		}
	}

	if(txt === 'inner_row'){
		var par = btn.parents('.inner_col__box:first');
		var box = par.find('.form_row_box:first');
		if(box.is(':visible')){
			box.hide();
			btn.html('<i class="fa fa-plus"></i>');
		}else{
			box.show();
			btn.html('<i class="fa fa-minus"></i>');
		}
	}
}

function copy_action(){
	var btn = $(this);
	var txt = btn.attr('data-copy-txt');

	if(txt === 'main'){
		var row = btn.parents('.main_row_append_box:first');
		var box = btn.parents('.cb_layer_box:first');

		var c = box.clone(true, true);
		box.after(c);
	}

	if(txt === 'inner_row'){
		var row = btn.parents('.inner_row_append_box:first');
		var box = btn.parents('.inner_col__box:first');

		var c = box.clone(true, true);
		box.after(c);
	}
}

// Delete Option 
function remove_option(){
	var txt = $(this).attr('data-rem-text');
	var box;

	// alert

	if(txt === 'checkbox' || txt === 'radio'){
		box = $(this).parents('.'+txt+':first');
		box.remove();
	}

	if(txt === 'select'){
		var par = $(this).parents('.cnt_input_box:first');
		var li = $(this).parent('li');
		var op_txt = li.attr('data-select-val');
		var sel = par.find('select');

		var ops = sel.find('option');

		ops.each(function(i, v){
			if(op_txt === v.innerText){
				li.remove();
				v.remove();
				console.log('Removed '+op_txt);
			}
		});
		// console.log(op, sel);
	}
}

/**
 * Helpers
 * @param  {[type]} len [description]
 * @return {[type]}     [description]
 */
function make_id(len) {
	var text = "";
	var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (var i = 0; i < len; i++)
	text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}

function slugify(text){
	return text.toString().toLowerCase()
		.replace(/\s+/g, '_')           // Replace spaces with -
		.replace(/[^\w\-]+/g, '')       // Remove all non-word chars
		.replace(/\-\-+/g, '_')         // Replace multiple - with single -
		.replace(/^-+/, '')             // Trim - from start of text
		.replace(/-+$/, '');            // Trim - from end of text
}


// Actions
__generate_btn.on('click', generate_form_data);
__html_btn.on('click', switch_view);

__col_btn.on('click', make_column);
__mr_btn.on('click', add_main_row);

__doc.on('click', '.inner_row_btn', add_inner_row);
__doc.on('change', '.col_btn', add_column);

__doc.on('change', '.form_field_select', on_select_field);
__doc.on('keyup', '.in_field', add_field_title);
__doc.on('click', '.add_select_option', add_options);
__doc.on('click', '.delete', remove_option);
__doc.on('click', '.add_desc_btn', heading_text);

__doc.on('click', '.remove_btn', remove_action);
__doc.on('click', '.minimize_btn', minimize_action);
__doc.on('click', '.copy_btn', copy_action);






    function getButtonFieldHTML(btn_class = '', btn_value = '', name = '') {
        var field = generateField();

        var btn_class = (btn_class == '') ? '' : btn_class;
        var btn_value = (btn_value == '') ? '' : btn_value;
        var name = (name == '') ? '' : name;

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="button" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="class_' + field + '" class="form-control form_input_button_class" placeholder="Class" value="'+btn_class+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="value_' + field + '" data-field="' + field + '" class="form-control form_input_button_value" value="'+btn_value+'" placeholder="Value"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name" value="'+name+'"/></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getTextFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="text" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="'+label+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" class="form-control form_input_placeholder" placeholder="Placeholder" value="'+placeholder+'"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"  value="'+name+'"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getNumberFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="number" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="'+label+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" value="'+placeholder+'" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name" value="'+name+'"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getEmailFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="email" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="'+label+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" value="'+placeholder+'" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name" '+name+'/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" '+((required)?'checked':'')+' class="form-check-input form_input_req"><span class="checkbox-text-span">Required</span></label></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getPasswordFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="password" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="'+label+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" class="form-control form_input_placeholder" placeholder="Placeholder" value="'+placeholder+'"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name" value="'+name+'"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox"  class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getDateFieldHTML(label = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="date" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="'+label+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" value="'+name+'" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getTextAreaFieldHTML(label = '', placeholder = '', name = '', required = false) {
        var field = generateField();

        var label = (label == '') ? '' : label;
        var placeholder = (placeholder == '') ? '' : placeholder;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div></div><hr/><div class="row li_row form_output" data-type="textarea" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="'+label+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="placeholder_' + field + '" data-field="' + field + '" value="'+placeholder+'" class="form-control form_input_placeholder" placeholder="Placeholder"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name" value="'+name+'"/></div></div><div class="col-md-12"><div class="form-check"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getSelectFieldHTML(label = '', name = '', options = [],required = false) {
        var field = generateField();
        var opt1 = generateField();

        var label = (label == '') ? '' : label;
        var name = (name == '') ? '' : name;
        var required = (required == true) ? true : false;
        var sopt_html = '<option data-opt="' + opt1 + '" value="Value" >Option</option>';
        var editable_html = '<div data-field="' + field + '" class="row select_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="s_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="s_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_select" data-field="' + field + '"></i></div></div>';


        if(options.length > 0)
        {
        	sopt_html = ""; editable_html = "";
        	$.each( options, function( keyFields, valueFields ) {

        		var opt1 = generateField();
        		sopt_html = sopt_html + '<option data-opt="' + opt1 + '" value="'+valueFields.value+'" >'+valueFields.option+'</option>';

        		if(keyFields == 0)
        		{
        			editable_html = editable_html + '<div data-field="' + field + '" class="row select_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="s_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="s_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_select" data-field="' + field + '"></i></div></div>';

        		} else {
        			editable_html = editable_html + '<div data-field="' + field + '" class="row select_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="s_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="s_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_select" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_select" data-field="' + field + '"></i></div></div>';
        		}
        	});
        }

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div><hr/><div class="row li_row form_output" data-type="select" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="'+label+'" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name" value="'+name+'"/></div></div><div class="col-md-12"><div class="form-group"><select name="select_' + field + '" class="form-control">'+sopt_html+'</select></div></div></div><div class="row li_row"><div class="col-md-12"><div class="field_extra_info_' + field + '">'+editable_html+'</div></div><div class="col-md-12 "><div class="form-check pl-0"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getRadioFieldHTML(label = '', name = '', options = [],required = false) {
        var field = generateField();
        var opt1 = generateField();
        var required = (required == true) ? true : false;

        var sopt_html = '<div class="mt-radio-list radio_list_' + field + '"><label class="mt-radio mt-radio-outline"><input data-opt="' + opt1 + '" type="radio" name="radio_' + field + '" value="Value"><p class="r_opt_name_' + opt1 + '">Option</p><span></span></label></div>';
        var editable_html = '<div data-field="' + field + '" class="row radio_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="r_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="r_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_radio" data-field="' + field + '"></i></div></div>';

        if(options.length > 0)
        {
        	sopt_html = ""; editable_html = "";
        	$.each( options, function( keyFields, valueFields ) {

        		var opt1 = generateField();
        		sopt_html = sopt_html + '<div class="mt-radio-list radio_list_' + field + '"><label class="mt-radio mt-radio-outline"><input data-opt="' + opt1 + '" type="radio" name="radio_' + field + '" value="'+valueFields.value+'"><p class="r_opt_name_' + opt1 + '">'+valueFields.option+'</p><span></span></label></div>';

        		if(keyFields == 0)
        		{
        			editable_html = editable_html + '<div data-field="' + field + '" class="row radio_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.value+'" class="r_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.option+'" class="r_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_radio" data-field="' + field + '"></i></div></div>';

        		} else {

        			editable_html = editable_html + '<div data-field="' + field + '" class="row radio_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.value+'" class="r_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.option+'" class="r_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_radio" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_radio" data-field="' + field + '"></i></div></div>';
        		}
        	});
        }

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div><hr/><div class="row li_row form_output" data-type="radio" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-group">'+sopt_html+'</div></div></div><div class="row li_row"><div class="col-md-12"><div class="field_extra_info_' + field + '">'+editable_html+'</div><div class="col-md-12 pl-0"><div class="form-check pl-0"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }
    function getCheckboxFieldHTML(label = '', name = '', options = [],required = false) {
        var field = generateField();
        var opt1 = generateField();
        var required = (required == true) ? true : false;
        required = false;
        var sopt_html = '<label class="mt-checkbox mt-checkbox-outline"><input data-opt="' + opt1 + '" type="checkbox" name="checkbox_' + field + '" value="Value"> <p class="c_opt_name_' + opt1 + '">Option</p><span></span></label>';

        var editable_html = '<div data-field="' + field + '" class="row checkbox_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="c_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="c_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_checkbox" data-field="' + field + '"></i></div></div>';

        if(options.length > 0)
        {
        	sopt_html = ""; editable_html = "";
        	$.each( options, function( keyFields, valueFields ) {

        		var opt1 = generateField();
        		sopt_html = sopt_html + '<label class="mt-checkbox mt-checkbox-outline"><input data-opt="' + opt1 + '" type="checkbox" name="checkbox_' + field + '" value="'+valueFields.value+'"> <p class="c_opt_name_' + opt1 + '">'+valueFields.option+'</p><span></span></label>';

        		if(keyFields == 0)
        		{
        			editable_html = editable_html + '<div data-field="' + field + '" class="row checkbox_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.option+'" class="c_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.value+'" class="c_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_checkbox" data-field="' + field + '"></i></div></div>';

        		} else {

        			editable_html = editable_html + '<div data-field="' + field + '" class="row checkbox_row_' + field + '" data-opt="' + opt1 + '"><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.option+'" class="c_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="'+valueFields.value+'" class="c_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_checkbox" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_checkbox" data-field="85054"></i></div></div>';
        		}
        	});
        }

        var html = '<div class="all_div"><div class="row li_row"><div class="col-md-12"><button type="button" class="btn btn-primary btn-sm remove_bal_field pull-right" data-field="' + field + '"><i class="fa fa-times"></i></button></div></div><hr/><div class="row li_row form_output" data-type="checkbox" data-field="' + field + '"><div class="col-md-12"><div class="form-group"><input type="text" name="label_' + field + '" class="form-control form_input_label" value="Label" data-field="' + field + '"/></div></div><div class="col-md-12"><div class="form-group"><input type="text" name="text_' + field + '" class="form-control form_input_name" placeholder="Name"/></div></div><div class="col-md-12"><div class="form-group"><div class="mt-checkbox-list checkbox_list_' + field + '">'+sopt_html+'</div></div></div></div><div class="row li_row"><div class="col-md-12"><div class="field_extra_info_' + field + '">'+editable_html+'</div><div class="col-md-12 pl-0"><div class="form-check pl-0"><label class="form-check-label"><input data-field="' + field + '" type="checkbox" class="form-check-input form_input_req" '+((required)?'checked':'')+'><span class="checkbox-text-span">Required</span></label></div></div></div></div></div>';
        return $('<div>').addClass('li_' + field + ' form_builder_field').html(html);
    }



$(document).ready(function () {
    // $(".form_bal_textfield").draggable({
    //     helper: function () {
    //         return getTextFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_textarea").draggable({
    //     helper: function () {
    //         return getTextAreaFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_number").draggable({
    //     helper: function () {
    //         return getNumberFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_email").draggable({
    //     helper: function () {
    //         return getEmailFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_password").draggable({
    //     helper: function () {
    //         return getPasswordFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_date").draggable({
    //     helper: function () {
    //         return getDateFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_button").draggable({
    //     helper: function () {
    //         return getButtonFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_select").draggable({
    //     helper: function () {
    //         return getSelectFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_radio").draggable({
    //     helper: function () {
    //         return getRadioFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });
    // $(".form_bal_checkbox").draggable({
    //     helper: function () {
    //         return getCheckboxFieldHTML();
    //     },
    //     connectToSortable: ".form_builder_area"
    // });

    // $(".form_builder_area").sortable({
    //     cursor: 'move',
    //     placeholder: 'placeholder',
    //     start: function (e, ui) {
    //         ui.placeholder.height(ui.helper.outerHeight());
    //     },
    //     stop: function (ev, ui) {
    //         getPreview();
    //     }
    // });
    // $(".form_builder_area").disableSelection();


    
});


$(document).on('click', '.add_more_select', function () {
        $(this).closest('.form_builder_field').css('height', 'auto');
        var field = $(this).attr('data-field');
        var option = generateField();
        $('.field_extra_info_' + field).append('<div data-field="' + field + '" class="row select_row_' + field + '" data-opt="' + option + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="s_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="s_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_select" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_select" data-field="' + field + '"></i></div></div>');
        var options = '';
        $('.select_row_' + field).each(function () {
            var opt = $(this).find('.s_opt').val();
            var val = $(this).find('.s_val').val();
            var s_opt = $(this).attr('data-opt');
            options += '<option data-opt="' + s_opt + '" value="' + val + '">' + opt + '</option>';
        });
        $('select[name=select_' + field + ']').html(options);
        getPreview();
    });
    $(document).on('click', '.add_more_radio', function () {
        $(this).closest('.form_builder_field').css('height', 'auto');
        var field = $(this).attr('data-field');
        var option = generateField();
        $('.field_extra_info_' + field).append('<div data-opt="' + option + '" data-field="' + field + '" class="row radio_row_' + field + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="r_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="r_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_radio" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_radio" data-field="' + field + '"></i></div></div>');
        var options = '';
        $('.radio_row_' + field).each(function () {
            var opt = $(this).find('.r_opt').val();
            var val = $(this).find('.r_val').val();
            var s_opt = $(this).attr('data-opt');
            options += '<label class="mt-radio mt-radio-outline"><input data-opt="' + s_opt + '" type="radio" name="radio_' + field + '" value="' + val + '"> <p class="r_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
        });
        $('.radio_list_' + field).html(options);
        getPreview();
    });
    $(document).on('click', '.add_more_checkbox', function () {
        $(this).closest('.form_builder_field').css('height', 'auto');
        var field = $(this).attr('data-field');
        var option = generateField();
        $('.field_extra_info_' + field).append('<div data-opt="' + option + '" data-field="' + field + '" class="row checkbox_row_' + field + '"><div class="col-md-4"><div class="form-group"><input type="text" value="Option" class="c_opt form-control"/></div></div><div class="col-md-4"><div class="form-group"><input type="text" value="Value" class="c_val form-control"/></div></div><div class="col-md-4"><i class="margin-top-5 fa fa-plus-circle fa-2x default_blue add_more_checkbox" data-field="' + field + '"></i><i class="margin-top-5 margin-left-5 fa fa-times-circle default_red fa-2x remove_more_checkbox" data-field="' + field + '"></i></div></div>');
        var options = '';
        $('.checkbox_row_' + field).each(function () {
            var opt = $(this).find('.c_opt').val();
            var val = $(this).find('.c_val').val();
            var s_opt = $(this).attr('data-opt');
            options += '<label class="mt-checkbox mt-checkbox-outline"><input data-opt="' + s_opt + '" name="checkbox_' + field + '" type="checkbox" value="' + val + '"> <p class="c_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
        });
        $('.checkbox_list_' + field).html(options);
        getPreview();
    });
    $(document).on('keyup', '.s_opt', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('select[name=select_' + field + ']').find('option[data-opt=' + option + ']').html(op_val);
        getPreview();
    });
    $(document).on('keyup', '.s_val', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('select[name=select_' + field + ']').find('option[data-opt=' + option + ']').val(op_val);
        getPreview();
    });
    $(document).on('keyup', '.r_opt', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.radio_list_' + field).find('.r_opt_name_' + option).html(op_val);
        getPreview();
    });
    $(document).on('keyup', '.r_val', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.radio_list_' + field).find('input[data-opt=' + option + ']').val(op_val);
        getPreview();
    });
    $(document).on('keyup', '.c_opt', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.checkbox_list_' + field).find('.c_opt_name_' + option).html(op_val);
        getPreview();
    });
    $(document).on('keyup', '.c_val', function () {
        var op_val = $(this).val();
        var field = $(this).closest('.row').attr('data-field');
        var option = $(this).closest('.row').attr('data-opt');
        $('.checkbox_list_' + field).find('input[data-opt=' + option + ']').val(op_val);
        getPreview();
    });
    $(document).on('click', '.edit_bal_textfield', function () {
        var field = $(this).attr('data-field');
        var el = $('.field_extra_info_' + field);
        el.html('<div class="form-group"><input type="text" name="label_' + field + '" class="form-control" placeholder="Enter Text Field Label"/></div><div class="mt-checkbox-list"><label class="mt-checkbox mt-checkbox-outline"><input name="req_' + field + '" type="checkbox" value="1"> Required<span></span></label></div>');
        getPreview();
    });
    $(document).on('click', '.remove_bal_field', function (e) {
        e.preventDefault();
        var field = $(this).attr('data-field');
        $(this).closest('.li_' + field).hide('400', function () {
            $(this).remove();
            getPreview();
        });
    });
    $(document).on('click', '.remove_more_select', function () {
        var field = $(this).attr('data-field');
        $(this).closest('.select_row_' + field).hide('400', function () {
            $(this).remove();
            var options = '';
            $('.select_row_' + field).each(function () {
                var opt = $(this).find('.s_opt').val();
                var val = $(this).find('.s_val').val();
                var s_opt = $(this).attr('data-opt');
                options += '<option data-opt="' + s_opt + '" value="' + val + '">' + opt + '</option>';
            });
            $('select[name=select_' + field + ']').html(options);
            getPreview();
        });
    });
    $(document).on('click', '.remove_more_radio', function () {
        var field = $(this).attr('data-field');
        $(this).closest('.radio_row_' + field).hide('400', function () {
            $(this).remove();
            var options = '';
            $('.radio_row_' + field).each(function () {
                var opt = $(this).find('.r_opt').val();
                var val = $(this).find('.r_val').val();
                var s_opt = $(this).attr('data-opt');
                options += '<label class="mt-radio mt-radio-outline"><input data-opt="' + s_opt + '" type="radio" name="radio_' + field + '" value="' + val + '"> <p class="r_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
            });
            $('.radio_list_' + field).html(options);
            getPreview();
        });
    });
    $(document).on('click', '.remove_more_checkbox', function () {
        var field = $(this).attr('data-field');
        $(this).closest('.checkbox_row_' + field).hide('400', function () {
            $(this).remove();
            var options = '';
            $('.checkbox_row_' + field).each(function () {
                var opt = $(this).find('.c_opt').val();
                var val = $(this).find('.c_val').val();
                var s_opt = $(this).attr('data-opt');
                options += '<label class="mt-checkbox mt-checkbox-outline"><input data-opt="' + s_opt + '" name="checkbox_' + field + '" type="checkbox" value="' + val + '"> <p class="r_opt_name_' + s_opt + '">' + opt + '</p><span></span></label>';
            });
            $('.checkbox_list_' + field).html(options);
            getPreview();
        });
    });
    $(document).on('keyup', '.form_input_button_class', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_button_value', function () {
        getPreview();
    });
    $(document).on('change', '.form_input_req', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_placeholder', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_label', function () {
        getPreview();
    });
    $(document).on('keyup', '.form_input_name', function () {
        getPreview();
    });
    function generateField() {
        return Math.floor(Math.random() * (100000 - 1 + 1) + 57);
    }
    function getPreview(plain_html = '') {
        var el = $('.form_builder_area .form_output');
        var html = '';
        el.each(function () {
            var data_type = $(this).attr('data-type');
            //var field = $(this).attr('data-field');
            var label = $(this).find('.form_input_label').val();
            var name = $(this).find('.form_input_name').val();
            if (data_type === 'text') {
                var placeholder = $(this).find('.form_input_placeholder').val();
                var checkbox = $(this).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                }
                html += '<div class="form-group"><label class="control-label">' + label + '</label><input type="text" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + '/></div>';
            }
            if (data_type === 'number') {
                var placeholder = $(this).find('.form_input_placeholder').val();
                var checkbox = $(this).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                }
                html += '<div class="form-group"><label class="control-label">' + label + '</label><input type="number" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + '/></div>';
            }
            if (data_type === 'email') {
                var placeholder = $(this).find('.form_input_placeholder').val();
                var checkbox = $(this).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                }
                html += '<div class="form-group"><label class="control-label">' + label + '</label><input type="email" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + '/></div>';
            }
            if (data_type === 'password') {
                var placeholder = $(this).find('.form_input_placeholder').val();
                var checkbox = $(this).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                }
                html += '<div class="form-group"><label class="control-label">' + label + '</label><input type="password" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + '/></div>';
            }
            if (data_type === 'textarea') {
                var placeholder = $(this).find('.form_input_placeholder').val();
                var checkbox = $(this).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                }
                html += '<div class="form-group"><label class="control-label">' + label + '</label><textarea rows="5" name="' + name + '" placeholder="' + placeholder + '" class="form-control" ' + required + '/></div>';
            }
            if (data_type === 'date') {
                var checkbox = $(this).find('.form-check-input');
                var required = '';
                if (checkbox.is(':checked')) {
                    required = 'required';
                }
                html += '<div class="form-group"><label class="control-label">' + label + '</label><input type="date" name="' + name + '" class="form-control" ' + required + '/></div>';
            }
            if (data_type === 'button') {
                var btn_class = $(this).find('.form_input_button_class').val();
                var btn_value = $(this).find('.form_input_button_value').val();
                html += '<button name="' + name + '" type="submit" class="' + btn_class + '">' + btn_value + '</button>';
            }
            if (data_type === 'select') {
                var option_html = '';
                $(this).find('select option').each(function () {
                    var option = $(this).html();
                    var value = $(this).val();
                    option_html += '<option value="' + value + '">' + option + '</option>';
                });
                html += '<div class="form-group"><label class="control-label">' + label + '</label><select class="form-control" name="' + name + '">' + option_html + '</select></div>';
            }
            if (data_type === 'radio') {
                var option_html = '';
                $(this).find('.mt-radio').each(function () {
                    var option = $(this).find('p').html();
                    var value = $(this).find('input[type=radio]').val();
                    option_html += '<div class="form-check"><label class="form-check-label"><input type="radio" class="form-check-input" name="' + name + '" value="' + value + '">' + option + '</label></div>';
                });
                html += '<div class="form-group"><label class="control-label">' + label + '</label>' + option_html + '</div>';
            }
            if (data_type === 'checkbox') {
                var option_html = '';
                $(this).find('.mt-checkbox').each(function () {
                    var option = $(this).find('p').html();
                    var value = $(this).find('input[type=checkbox]').val();
                    option_html += '<div class="form-check"><label class="form-check-label"><input type="checkbox" class="form-check-input" name="' + name + '[]" value="' + value + '">' + option + '</label></div>';
                });
                html += '<div class="form-group"><label class="control-label">' + label + '</label>' + option_html + '</div>';
            }
        });
        if (html.length) {
            $('.export_html').show();
        } else {
            $('.export_html').hide();
        }
        if (plain_html === 'html') {
            $('.preview').hide();
            $('.plain_html').show().find('textarea').val(html);
        } else {
            $('.plain_html').hide();
            $('.preview').html(html).show();
    }
    }
    $(document).on('click', '.export_html', function () {
        getPreview('html');
    });




function make_custom_column(e){
	e.preventDefault();
	var d = $(this).data('col-btn');
	console.log(d);
}



function add_main_custom_row(e){
	e.preventDefault();
	__mr_box.append(main_row);


	$(".form_bal_textfield").draggable({
        helper: function () {
            return getTextFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_textarea").draggable({
        helper: function () {
            return getTextAreaFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_number").draggable({
        helper: function () {
            return getNumberFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_email").draggable({
        helper: function () {
            return getEmailFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_password").draggable({
        helper: function () {
            return getPasswordFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_date").draggable({
        helper: function () {
            return getDateFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_button").draggable({
        helper: function () {
            return getButtonFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_select").draggable({
        helper: function () {
            return getSelectFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_radio").draggable({
        helper: function () {
            return getRadioFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });
    $(".form_bal_checkbox").draggable({
        helper: function () {
            return getCheckboxFieldHTML();
        },
        connectToSortable: ".form_builder_area"
    });

    $(".form_builder_area").sortable({
        cursor: 'move',
        placeholder: 'placeholder',
        start: function (e, ui) {
            ui.placeholder.height(ui.helper.outerHeight());
        },
        stop: function (ev, ui) {
            getPreview();
        }
    });
    $(".form_builder_area").disableSelection();
	// $(".dropper").droppable({
 //        drop: function (event, ui) {
            
 //        	$(event.target).find('.custom-div').append($('#form-autocomplete-field-clone').html());
 //        	//$(event.target).find('.custom-div').css('background','red');

 //            // $(this)
 //            //     .addClass("ui-state-highlight")
 //            //     .find("custom-div")
 //            //     .html("Dropped!");

 //            // var element = $('.ui-draggable-dragging');
 //            // var currentDrop=$(this);
 //            //return element.clone().appendTo(currentDrop);
 //        }
 //    });
	// console.log(main_row)
}