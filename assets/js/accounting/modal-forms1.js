$(document).ready(function () {
    $(".nsm-sidebar-menu #new-popup ul li a.ajax-modal, #new_estimate_modal .modal-body button.nsm-button").on("click", function(e) {
		e.preventDefault();
        if($(this).hasClass('nsm-button')) {
            var view = $(this).attr('id').replace('-', '_');
            view += '_modal';
            var modal_element = '#'+$(this).attr('id')+'-modal';
            modalName = modal_element;
        } else {
            var target = e.currentTarget.dataset;
            var view = target.view
            var modal_element = target.target;
            modalName = target.target;
        }

        //$.get(GET_OTHER_MODAL_URL + view, function(res) {
        $.get(base_url + 'accounting/get-other-modals/' + view, function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            $(`${modal_element} [data-bs-toggle="popover"]`).popover();

            if ($('div#modal-container .modal-body table.clickable:not(#category-details-table, #item-details-table)').length > 0) {
                rowInputs = $('div#modal-container form .modal table tbody tr:first-child()').html();
                if(modal_element === '#journalEntryModal' || modal_element === '#depositModal') {
                    blankRow = $('div#modal-container form .modal table tbody tr:last-child()').html();

                    $('div#modal-container form .modal table tbody tr:first-child()').remove();
                    $('div#modal-container form .modal table tbody tr:last-child()').remove();
                } else {
                    blankRow = $('div#modal-container form .modal table tbody tr:nth-child(2)').html();
                }

                rowCount = $('div#modal-container form .modal table tbody tr').length;

                $('div#modal-container form .modal table tbody tr:first-child()').html(blankRow);
                $('div#modal-container form .modal table tbody tr:first-child() td:first-child()').html(1);
            }

            if (vendorModals.includes(modal_element)) {
                rowCount = 2;
                catDetailsInputs = $(`${modal_element} .modal-body table#category-details-table tbody tr:first-child()`).html();
                catDetailsBlank = $(`${modal_element} .modal-body table#category-details-table tbody tr:last-child()`).html();

                $(`${modal_element} .modal-body table#category-details-table tbody tr:first-child()`).remove();
                $(`${modal_element} .modal-body table#category-details-table tbody tr:last-child()`).remove();
            }

            if (modal_element === '#printChecksModal') {
                $('#printChecksModal #checks-table').nsmPagination({itemsPerPage: parseInt($('#printChecksModal #checks-table-rows li a.dropdown-item.active').html().trim())})
            }

            $(`${modal_element} select`).each(function() {
                var type = $(this).attr('id');
                if (type === undefined) {
                    type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                } else {
                    type = type.replaceAll('_', '-');

                    if (type.includes('transfer')) {
                        type = 'transfer-account';
                    }
                }

                if (dropdownFields.includes(type)) {
                    $(this).select2({
                        ajax: {
                            url: base_url + 'accounting/get-dropdown-choices',
                            dataType: 'json',
                            data: function(params) {
                                var query = {
                                    search: params.term,
                                    type: 'public',
                                    field: type,
                                    modal: modal_element.replaceAll('#', '')
                                }

                                // Query parameters will be ?search=[term]&type=public&field=[type]
                                return query;
                            }
                        },
                        templateResult: formatResult,
                        templateSelection: optionSelect,
                        dropdownParent: $(modal_element)
                    });
                } else {
                    $(this).select2({
                        minimumResultsForSearch: -1,
                        dropdownParent: $(modal_element)
                    });
                }
            });

            if ($('div#modal-container select#tags').length > 0) {
                $('div#modal-container select#tags').select2({
                    placeholder: 'Start typing to add a tag',
                    dropdownParent: $(modal_element),
                    allowClear: true,
                    ajax: {
                        url: '/accounting/get-job-tags',
                        dataType: 'json'
                    }
                });
            }
            if (view === "weekly_timesheet_modal") {
                tableWeekDate(document.getElementById('weekDates'));
            }

            if ($(`${modal_element} .date`).length > 0) {
                $(`${modal_element} .date`).each(function() {
                    $(this).datepicker({
                        format: 'mm/dd/yyyy',
                        orientation: 'bottom',
                        autoclose: true
                    });
                });
            }

            if ($(`${modal_element} .attachments`).length > 0) {
                var attachmentContId = $(`${modal_element} .attachments .dropzone`).attr('id');
                modalAttachments = new Dropzone(`#${attachmentContId}`, {
                    url: '/accounting/attachments/attach',
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function() {
                        this.on("success", function(file, response) {
                            var ids = JSON.parse(response)['attachment_ids'];
                            var modal = $(`${modal_element}`);

                            for (i in ids) {
                                if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                                    modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                                }

                                modalAttachmentId.push(ids[i]);
                            }
                            modalAttachedFiles.push(file);
                        });
                    },
                    removedfile: function(file) {
                        var ids = modalAttachmentId;
                        var index = modalAttachedFiles.map(function(d, index) {
                            if (d == file) return index;
                        }).filter(isFinite)[0];

                        $(`${modal_element} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                        if($('#modal-container form .modal .attachments-container').length > 0) {
                            $('#modal-container form .modal .attachments-container #attachment-types').trigger('change');
                        }

                        //remove thumbnail
                        var previewElement;
                        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                    }
                });
            }

            if ($(`${modal_element} .dropdown`).length > 0) {
                $(`${modal_element} .dropdown-menu`).on('click', function(e) {
                    e.stopPropagation();
                });
            }

            if (modal_element === '#payBillsModal') {
                $('#payBillsModal #bills-table').nsmPagination({
                    itemsPerPage: parseInt($('#payBillsModal #bills-table-rows li a.dropdown-item.active').html().trim())
                })
            }

            if(modal_element === '#receivePaymentModal') {
                $('#receivePaymentModal #invoices-container').hide();
                $('#receivePaymentModal #credits-container').hide();
                $('#receivePaymentModal #payment-summary').hide();
            }

            CKEDITOR.replace('estimate-terms-and-conditions');
            CKEDITOR.replace('estimate-message-to-customer');
            CKEDITOR.replace('estimate-instructions');

            $(modal_element).modal('show');
            $(document).off('shown', modal_element);
        });
	});

    $(document).on('click', '#printChecksModal #print-checks-setup', function(e) {
        $.get(GET_OTHER_MODAL_URL+'print_checks_setup_modal', function(res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            $('#printSetupModal .printsetup-amountgrid').draggable({
                stop: function(e, ui) {
                    var verticalDistance = ui.position.top - ui.originalPosition.top;
                    var horizontalDistance = ui.position.left - ui.originalPosition.left;
                    var verticalOffset = $('#printSetupModal #vertical-offset').val();
                    var horizontalOffset = $('#printSetupModal #horizontal-offset').val();

                    $('#printSetupModal #vertical-offset').val(verticalDistance + parseInt(verticalOffset));
                    $('#printSetupModal #horizontal-offset').val(horizontalDistance + parseInt(horizontalOffset));
                }
            });

            $('#printSetupModal').modal('show');
        });
    });

    $(document).on("click", "#print_printable_checks_modal #btn_print_printable_checks", function() {
        $("#print_preview_printable_checks_modal #printable_checks_table_print").printThis();
    });

    $(document).on('hidden.bs.modal', '#printSetupModal', function() {
        $('#modal-container').remove();
        $('.modal-backdrop').remove();
    });

    $(document).on('click', '#printSetupModal #continue-setup', function(e) {
        $('#printSetupModal .nsm-progressbar .progressbar ul li.active').removeClass('active').next().addClass('active');
        var index = $('#printSetupModal .nsm-progressbar .progressbar ul li.active').index();

        $(this).parent().prev().html('<button class="nsm-button primary" id="back-setup" type="button">Back</button>');

        $(`#printSetupModal #step-${index}`).hide();
        $(`#printSetupModal #step-${index + 1}`).show();

        if(index === 2) {
            $(this).parent().html('<button class="nsm-button success" id="finish-setup" type="button">Finish setup</button>');
        }
    });

    $(document).on('click', '#printSetupModal #back-setup', function(e) {
        $('#printSetupModal .nsm-progressbar .progressbar ul li.active').removeClass('active').prev().addClass('active');
        var index = $('#printSetupModal .nsm-progressbar .progressbar ul li.active').index();
        $(`#printSetupModal #step-${index + 2}`).hide();
        $(`#printSetupModal #step-${index + 1}`).show();

        $('#printSetupModal #finish-setup').parent().html(`
        Are the fields lined up properly?
        <button class="nsm-button success" id="continue-setup" type="button">
            No, continue setup
        </button>
        <button class="nsm-button success" id="finish-setup" type="button">
            Yes, I'm finished with setup
        </button>
        `);

        if(index === 0) {
            $(this).parent().html(`<button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>`);
        }
    });

    $(document).on('change', '#printSetupModal input[name="check_type"]', function() {
        $('#printSetupModal .check-type-preview.selected').removeClass('selected');
        $(this).parent().find('.check-type-preview').addClass('selected');
    });

    $(document).on('click', '#printSetupModal .check-type-preview', function() {
        if($(this).hasClass('selected') === false) {
            $(this).prev().prev().prop('checked', true).trigger('change');
        }
    });

    $(document).on('change', '#printSetupModal #horizontal-offset, #printSetupModal #vertical-offset', function() {
        var horizontal = $('#printSetupModal #horizontal-offset').val();
        var vertical = $('#printSetupModal #vertical-offset').val();

        var top = 113 + parseInt(vertical);
        var left = 100 - parseInt(horizontal);
        $('#printSetupModal .printsetup-amountgrid').css('inset', `${top}px auto auto ${left}px`);
    });

    $(document).on('click', '#printSetupModal #minus-h-offset, #printSetupModal #plus-h-offset', function(e) {
        var horizontal = $('#printSetupModal #horizontal-offset').val();
        if($(this).attr('id').includes('plus')) {
            var val = parseInt(horizontal) + 1;
        } else {
            var val = parseInt(horizontal) - 1;
        }

        $('#printSetupModal #horizontal-offset').val(val).trigger('change');
    });

    $(document).on('click', '#printSetupModal #minus-v-offset, #printSetupModal #plus-v-offset', function(e) {
        var vertical = $('#printSetupModal #vertical-offset').val();
        if($(this).attr('id').includes('plus')) {
            var val = parseInt(vertical) + 1;
        } else {
            var val = parseInt(vertical) - 1;
        }

        $('#printSetupModal #vertical-offset').val(val).trigger('change');
    });

    $(document).on('click', '#printSetupModal .preview-print-sample', function(e) {
        e.preventDefault();

        var data = new FormData();
        data.set('check_type', $('#printSetupModal input[name="check_type"]:checked').val());
        data.set('horizontal', $('#printSetupModal #horizontal-offset').val());
        data.set('vertical', $('#printSetupModal #vertical-offset').val());

        $.ajax({
            url: '/accounting/preview-and-print-sample',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                $('div#modal-container').append(result);

                $('#viewPrintChecksModal').attr('id', 'viewPrintChecksSampleModal');
                $('#viewPrintChecksSampleModal').modal('show');
            }
        })
    });

    $(document).on('click', '#printSetupModal #finish-setup', function(e) {
        e.preventDefault();

        var data = new FormData();
        data.set('check_type', $('#printSetupModal input[name="check_type"]:checked').val());
        data.set('horizontal', $('#printSetupModal #horizontal-offset').val());
        data.set('vertical', $('#printSetupModal #vertical-offset').val());

        $.ajax({
            url: '/accounting/save-print-checks-settings',
            data: data,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(result) {
                var res = JSON.parse(result);

                if(res.success) {
                    $('#printSetupModal').modal('hide');
                    $('.modal-backdrop').remove();

                    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-target="#printChecksModal"]').trigger('click');
                }
            }
        })
    });

    $(document).on('click', '#viewPrintChecksSampleModal #preview-and-print', function(e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintChecksSampleModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('hidden.bs.modal', '#viewPrintChecksSampleModal', function() {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });
});