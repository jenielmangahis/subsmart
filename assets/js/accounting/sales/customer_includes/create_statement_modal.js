$("#create_statement_modal form input[name='statement-date']").datepicker({
    uiLibrary: 'bootstrap'
});
$("#create_statement_modal form input[name='start-date']").datepicker({
    uiLibrary: 'bootstrap'
});
$("#create_statement_modal form input[name='end-date']").datepicker({
    uiLibrary: 'bootstrap'
});

$(document).on("click", "#create_statement_modal", function(event) {
    if ($(event.target).closest("#create_statement_modal .apply-btn-part .information-panel .close-panel").length === 0) {
        $("#create_statement_modal .apply-btn-part .information-panel").hide();
    }
});
$(document).on("click", "#create_statement_modal .apply-btn-part .information-panel .close-panel", function(event) {
    $("#create_statement_modal .apply-btn-part .information-panel").hide();
});
$('#create_statement_modal').on('shown.bs.modal', function(e) {
    $("#create_statement_modal .recipient-list-section").hide();
    $("#create_statement_modal .apply-btn-part .information-panel").show();
})

$(document).on("click", "div#create_statement_modal .start-end-date-section .apply-btn-part .apply-btn", function(event) {
    $("#create_statement_modal .recipient-list-section").show();
});