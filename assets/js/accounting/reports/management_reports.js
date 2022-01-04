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