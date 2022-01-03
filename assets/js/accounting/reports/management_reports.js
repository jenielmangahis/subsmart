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
$(document).on("click", function(event) {
    if ($(event.target).closest("#company_overview_modal .modal-footer-check .middle-links .print-preview-option").length === 0) {
        $("#company_overview_modal .pint-pries-option-section").hide();
    }
});
$(document).on("click", "#company_overview_modal .modal-footer-check .middle-links .print-preview-option", function(event) {
    event.preventDefault();
    $("#company_overview_modal .pint-pries-option-section").show();
});

$(document).on("click", "#company_overview_modal .modal-footer-check button.cancel-button", function(event) {
    event.preventDefault();
    $("#company_overview_modal").fadeOut();
});