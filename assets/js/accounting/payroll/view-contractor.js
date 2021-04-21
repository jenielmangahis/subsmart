$('.banking-tab-container a').on('click', function() {
    var activeTab = $(this).parent().find('.banking-tab-active');
    activeTab.removeClass('text-decoration-none');
    activeTab.removeClass('banking-tab-active');
    activeTab.removeClass('active');
    activeTab.addClass('banking-tab');
    $(this).removeClass('banking-tab');
    $(this).addClass('banking-tab-active');
    $(this).addClass('text-decoration-none');
});

$('#myTabContent #details .card').on('click', function() {
    $('#personal-details-modal').modal('show');
});

$('#personal-details-modal [name="contractor_type"]').on('change', function() {
    if($(this).val() !== "") {
        if($(this).val() === '1') {
            $('#personal-details-modal .individual-type-field').removeClass('hide');
            $('#personal-details-modal .business-type-field').addClass('hide');

            $('#personal-details-modal .individual-type-field #first_name').prop('required', true);
            $('#personal-details-modal .individual-type-field #last_name').prop('required', true);
            $('#personal-details-modal .individual-type-field #social_sec_num').prop('required', true);

            $('#personal-details-modal .business-type-field #social_sec_num').prop('required', false);
            $('#personal-details-modal .business-type-field #emp_id_num').prop('required', false);
        } else {
            $('#personal-details-modal .business-type-field').removeClass('hide');
            $('#personal-details-modal .individual-type-field').addClass('hide');

            $('#personal-details-modal .individual-type-field #first_name').prop('required', false);
            $('#personal-details-modal .individual-type-field #last_name').prop('required', false);
            $('#personal-details-modal .individual-type-field #social_sec_num').prop('required', false);

            $('#personal-details-modal .business-type-field #social_sec_num').prop('required', true);
            $('#personal-details-modal .business-type-field #emp_id_num').prop('required', true);
        }
        
        $('#personal-details-modal .default-field').removeClass('hide');
    } else {
        $('#personal-details-modal .individual-type-field').addClass('hide');
        $('#personal-details-modal .business-type-field').addClass('hide');
        $('#personal-details-modal .default-field').addClass('hide');

        $('#personal-details-modal .individual-type-field #first_name').prop('required', false);
        $('#personal-details-modal .individual-type-field #last_name').prop('required', false);
        $('#personal-details-modal .individual-type-field #social_sec_num').prop('required', false);

        $('#personal-details-modal .business-type-field #social_sec_num').prop('required', false);
        $('#personal-details-modal .business-type-field #emp_id_num').prop('required', false);
    }
});

function formatSocialSecurity(val){
	val = val.replace(/\D/g, '');
	val = val.replace(/^(\d{3})/, '$1-');
	val = val.replace(/-(\d{2})/, '-$1-');
	val = val.replace(/(\d)-(\d{4}).*/, '$1-$2');
	return val;
}

$('#social_sec_num').on('keyup', function() {
    $(this).val(formatSocialSecurity($(this).val()));
});

$('#personal-details-modal select').select2();

$('#payments.tab-pane select').select2({
    minimumResultsForSearch: -1
});

$('#contractor-payments-table').DataTable({
    autoWidth: false,
    searching: false,
    processing: true,
    // serverSide: true,
    lengthChange: false,
    info: false,
    pageLength: 50,
    order: [[0, 'asc']],
});