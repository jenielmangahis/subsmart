$(function() {
    $('.date').datepicker({
        format: 'mm/dd/yyyy',
        orientation: 'bottom',
        autoclose: true
    });
});

$('#edit-employment-details-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit-employment-details-modal')
});

$('#edit-payment-method-modal select').select2({
    minimumResultsForSearch: -1,
    dropdownParent: $('#edit-payment-method-modal')
});