"use strict";




var main_row = 

"<div class=\"col-sm-12 dropper\"  style=\"margin: 15px 0;\">"+
   "<span class=\"side_move_bar cb_move_btn removable\"><i class=\"fa fa-bars\"></i></span>"+
   "<div class=\"cb_display_box no-drag\">"+
      "<div class=\"no-drag cb_inner_layer_box\">"+
         "<div class=\"content-edit\">"+
            "<div class=\"row cb_layer_box\">"+
               "<div  class=\"col-sm-12 group-description\">"+
               		"<h4 class=\"col-sm-2\">Group Label</h4>"+
               		"<input name=\"group-label\" class=\"col-sm-10\" type=\"text\">"+
               "</div>"+
               "<div class=\"col-sm-12 group-field-description mt-3 \">"+
                     "<h4 class=\"col-sm-2\">Field Description</h4>"+
                     "<input name=\"group-field-description\" class=\"col-sm-10\" type=\"text\">"+
               "</div>"+
            "</div>"+
            "<div class=\"inner_row_append_box\"></div>"+
         "</div>"+
         "<!-- row btn -->"+
         "<div class=\"removable\"></div>"+
         "<div class=\"custom-div\"></div>"+
         "<div class=\"form_builder_area\" style=\"padding:15px;\"></div>"+
         "<!-- end row btn -->"+
      "</div>"+
   "</div>"+
"</div>";
/* 



*/
// Main row template
// var main_row = "<div class=\"col-sm-12 minimize_box\">\n\t\t<!-- Drag bar -->\n\t\t<span class=\"side_move_bar cb_move_btn removable\">\n\t\t\t<i class=\"fa fa-bars\"></i>\n\t\t</span>\n\t\t\n\t\t<div class=\"cb_display_box no-drag\">\n\n\t\t\t<div class=\"no-drag cb_inner_layer_box\">\n\t\t\t\t<div class=\"content-edit\">\n\t\t\t\t\t<div class=\"row cb_layer_box\">\n\t<div class=\"col-sm-12 removable\">\n\t\t<span class=\"on_minimize\"></span>\n\t\t<span class=\"pull-right win_control\">\n\t\t\t<span class=\"cb_move_btn move_bar\" style=\"color: #222\" title=\"Move\">\n\t\t\t\t<i class=\"fa fa-arrows\"></i>\n\t\t\t</span>\n\t\t\t<span class=\"copy_btn\" data-copy-txt=\"main\" title=\"Copy\">\n\t\t\t\t<i class=\"fa fa-copy\"></i>\n\t\t\t</span>\n\t\t\t<span class=\"minimize_btn\" data-minimize-txt=\"main\" title=\"Minimize\">\n\t\t\t\t<i class=\"fa fa-minus\"></i>\n\t\t\t</span>\n\t\t\t<span class=\"remove_btn\" data-remove-txt=\"main\" title=\"Remove\">\n\t\t\t\t<i class=\"fa fa-close\"></i>\n\t\t\t</span>\n\t\t</span>\n\t</div>\n\n\t<h2 class=\"group_title\" contenteditable=\"\">Group title [edit]</h2>\n\t\t\t\t\t<div class=\"desc_box\">\n\t\t\t\t\t\t<span class=\"add_desc_btn removable\">\n\t\t\t\t\t\t\t<i class=\"fa fa-pencil\"></i> Add Description\n\t\t\t\t\t\t</span>\n\t\t\t\t\t\t<span class=\"add_desc_box\">\n\t\t\t\t\t\t\t<span contenteditable=\"\">-- Description text here [edit]</span>\n\t\t\t\t\t\t\t<span class=\"remove_btn\" data-remove-txt=\"heading\">\n\t\t\t\t\t\t\t\t<i class=\"fa fa-close\"></i>\n\t\t\t\t\t\t\t</span>\n\t\t\t\t\t\t</span>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\n\t\t\t\t<div class=\"inner_row_append_box\"></div>\n\t\t\t</div>\n\n\t\t\t<!-- row btn -->\n\t\t\t<div class=\"removable\">\n\t\t\t\t<a href=\"#\" class=\"btn btn-info btn_round inner_row_btn\">\n\t\t\t\t\t<i class=\"fa fa-plus\"></i> Add Row\n\t\t\t\t</a>\n\t\t\t</div><!-- end row btn -->\n\t\t</div>\n\t</div>\n</div>";


// Inner row template
var inner_row = "<div class=\"no-drag inner_col__box\">\t\t\t\t\t\t\t\t\t\n\t<!-- Control btn -->\n\t<div class=\"handle_bar removable\">\n\t\t<span class=\"cb_layer_control\">\n\n\t\t\t<select class=\"col_btn\">\n\t\t\t\t<option selected=\"\" disabled=\"\">-- Select Column --</option>\n\t\t\t\t<option value=\"1\">Full Column</option>\n\t\t\t\t<option value=\"2\">2 Column</option>\n\t\t\t\t<option value=\"3\">3 Column</option>\n\t\t\t\t<option value=\"4\">4 Column</option>\n\t\t\t</select>\n\t\t</span>\n\n\t\t<span class=\"pull-right win_control\">\n\t\t\t<span href=\"#\" class=\"copy_btn\" data-copy-txt=\"inner_row\" title=\"Copy\">\n\t\t\t\t<i class=\"fa fa-copy\"></i>\n\t\t\t</span> \n\t\t\t<span class=\"minimize_btn\" data-minimize-txt=\"inner_row\" title=\"Minimize\">\n\t\t\t\t<i class=\"fa fa-minus\"></i>\n\t\t\t</span> \n\t\t\t<span class=\"remove_btn\" data-remove-txt=\"inner_row\" title=\"Remove\">\n\t\t\t\t<i class=\"fa fa-times\"></i>\n\t\t\t</span>\n\t\t</span>\n\t</div><!-- end Control btn -->\n\t\n\t<!-- Form input box -->\n\t<div class=\"row form_row_box\">\n\t</div><!-- Form input box -->\n</div>";


// Select field
var form_select_bar = "<div  class=\"field_box\"> \n\t<select class=\"form-control form_field_select removable\">\n\t\t<option selected=\"\" disabled=\"\">-- Select Field --</option>\n\t\t<option value=\"input\">Input</option>\n\t\t<option value=\"textarea\">Textarea</option>\n\t\t<option value=\"select\">Select</option>\n\t\t<option value=\"checkbox\">Checkbox</option>\n\t\t<option value=\"radio\">Radio button</option>\n\t</select>\n\n\t<div class=\"form_field_box\"></div>\n</div>";

// In fields editables
var in_field_edit = "<span  class=\"pull-right removable\"> \n\t<span class=\"in_field_edit\" style=\"color: #aaa\">\n\t\t<i class=\"fa fa-pencil\"></i>\n\t</span>\n\t<span class=\"remove_btn\" data-remove-txt=\"field\">\n\t\t<i class=\"fa fa-close\"></i>\n\t</span>\n</span>";


// Select Temp
function add_option_temp(a){var b='';return'select'===a&&(b+='<ul class="select_list removable"></ul>'),('checkbox'===a||'radio'===a)&&(b+='<div class="select_list"></div>'),b+='\n\t\t\t<div class="input-group select_add_list removable">\n\t\t\t   <input type="text" class="form-control"  placeholder="Add Option">\n\t\t\t   <span class="input-group-addon add_select_option" title="Add" data-option-text="'+a+'">\n\t\t\t   \t<i class="fa fa-plus"></i>\n\t\t\t   </span>\n\t\t\t</div>\n\t\t',b}


