$(document).on("click", function(event) {
    if ($(event.target).closest("#company_overview_modal .modal-footer-check .middle-links .print-preview-option").length === 0) {
        $("#company_overview_modal .pint-pries-option-section").hide();
    }
    if ($(event.target).closest("#company_overview_modal #cover-page-section .page-styles-img .logo-style").length === 0) {
        $("#company_overview_modal #cover-page-section .page-styles-img .logo-style .styles-option-section").hide();
    }
    if ($(event.target).closest("#company_overview_modal #cover-page-section .page-styles-img .cover-style").length === 0) {
        $("#company_overview_modal #cover-page-section .page-styles-img .cover-style .styles-option-section").hide();
    }
});

$(document).on('click', 'table#manage_reports_table ul.report_options li.edit', function() {
    $($(this).attr("data-target")).fadeIn();
});
$(document).on('click', 'div#company_overview_modal .the-modal-body .the-header .icons div.close-modal', function() {
    $("#company_overview_modal").fadeOut();
});
$(document).on("click", "#company_overview_modal .modal-footer-check .middle-links.end a", function(event) {
    event.preventDefault();
    // $("#company_overview_modal .modal-footer-check .middle-links").hide();
});
$('#company_overview_modal').on('hidden.bs.modal', function() {
    $("#company_overview_modal .modal-footer-check .middle-links").show();
});
$(document).on("click", "#company_overview_modal .modal-footer-check .middle-links .print-preview-option", function(event) {
    event.preventDefault();
    $("#company_overview_modal .pint-pries-option-section").show();
});

$(document).on("click", "#company_overview_modal .modal-footer-check button.cancel-button", function(event) {
    event.preventDefault();
    $("#company_overview_modal").fadeOut();
});

$(document).on("click", "#company_overview_modal #cover-page-section .page-styles-img .cover-style .dropdown-icon", function(event) {
    event.preventDefault();
    $("#company_overview_modal #cover-page-section .page-styles-img .cover-style .styles-option-section").show();
});
$(document).on("click", "#company_overview_modal #cover-page-section .page-styles-img .logo-style .dropdown-icon", function(event) {
    event.preventDefault();
    $("#company_overview_modal #cover-page-section .page-styles-img .logo-style .styles-option-section").show();
});

$(document).on("click", "#company_overview_modal .the-content .report-pages ul li", function(event) {
    $("#" + $("#company_overview_modal .the-content .report-pages ul li.active").attr("data-target")).hide();
    $("#company_overview_modal .the-content .report-pages ul li.active").removeClass("active");
    $("#" + $(this).attr("data-target")).fadeIn();
    $(this).addClass("active");
});

$(document).on("click", "#company_overview_modal #reports .report-section", function(event) {
    $("#company_overview_modal #reports .report-section .closed-content-view").show();
    $("#company_overview_modal #reports .report-section .content-collapse").hide();
    $("#company_overview_modal #reports .report-section .content-collapse").addClass("hide");
    if ($("#company_overview_modal #reports .report-section[data-count='" + $(this).attr("data-count") + "'] .content-collapse.hide").length > 0) {
        $("#company_overview_modal #reports .report-section[data-count='" + $(this).attr("data-count") + "'] .closed-content-view").hide();
        $("#company_overview_modal #reports .report-section[data-count='" + $(this).attr("data-count") + "'] .content-collapse").show();
        $("#company_overview_modal #reports .report-section[data-count='" + $(this).attr("data-count") + "'] .content-collapse").removeClass("hide");
        $("#company_overview_modal #reports .report-section .content-collapse").addClass("show");
    }
});

$(document).on("click", "#company_overview_modal #preliminary-page a.add-new-page", function(event) {
    var data_count;
    var new_elements;
    if ($("#company_overview_modal #preliminary-page .pages .page:last-child").length > 0) {
        data_count = parseInt($("#company_overview_modal #preliminary-page .pages .page:last-child").attr("data-count")) + 1;
        new_elements = '<div class="page" data-count="' + data_count + '">' + $("#company_overview_modal #preliminary-page .pages .page:last-child").html() + '</div>';
    } else {
        data_count = parseInt($("#company_overview_modal #preliminary-page .pages .page:first-child").attr("data-count")) + 1;
        new_elements = '<div class="page" data-count="' + data_count + '">' + $("#company_overview_modal #preliminary-page .pages .page:first-child").html() + '</div>';
    }
    //     new_elements = `<div class="page" data-count="` + data_count + `">
    //     <div class="form-check" style="padding: 0 12px;">
    //     <div class="checkbox checkbox-sec margin-right">
    //         <input type="checkbox" name="include_this_page[]" id="include_this_page">
    //         <label for="include_this_page">Include this page</label>
    //     </div>
    //     <i class="fa fa-trash-o delete-page-btn" aria-hidden="true"></i>
    // </div>
    // <div class="form-group">
    //     <div class="label">
    //         Page title
    //     </div>
    //     <input type="text" class="form-control " name="preliminary-page-title[]"
    //         placeholder="">
    // </div>
    // <div class="page-content">
    //     <div class="form-group">
    //         <div class="label">
    //             Page content
    //         </div>
    //     </div>
    //     <div class="page-content-field">
    //         <textarea class="form-control ckeditor" name="update_header_content[]" id=""
    //             cols="40" rows="20"></textarea>
    //     </div>
    // </div>
    //     </div>`;
    $("#company_overview_modal #preliminary-page .pages").append(new_elements);
    $("#company_overview_modal #preliminary-page .pages .page:last-child").load();
});
$(document).on("click", "#company_overview_modal #preliminary-page .delete-page-btn", function(event) {
    if ($("#company_overview_modal #preliminary-page .pages .page").length > 1) {
        $(this).parent("div.form-check").parent(".page").remove();
    }
});