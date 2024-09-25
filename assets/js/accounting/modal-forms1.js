$(document).ready(function () {
    let vendorIdTemp
    let modal_element
    $(document).on('change', '#vendor', function () {
        var vendor_id = $(this).val();
        $(`.attachments .dropzone`).attr('data-id', vendor_id);
        modalAttachments.destroy();
        initializeDropzone();
    });

    $(document).on('change', '#expenseModal #payee', function () {
        modalAttachments.destroy();

        var split = $(this).val().split('-');
        vendorIdTemp = split[1]
        modalAttachments.destroy();
        initializeDropzone();

    });


    $(".nsm-sidebar-menu #new-popup ul li a.ajax-modal, a.ajax-modal, #new_estimate_modal .modal-body button.nsm-button").on("click", function (e) {
        e.preventDefault();
        if ($(this).hasClass('nsm-button')) {
            var view = $(this).attr('id').replace('-', '_');
            view += '_modal';
            modal_element = '#' + $(this).attr('id') + '-modal';
            modalName = modal_element;
        } else {
            var target = e.currentTarget.dataset;
            var view = target.view
            modal_element = target.target;
            modalName = target.target;
        }

        //$.get(GET_OTHER_MODAL_URL + view, function(res) {
        $.get(base_url + 'accounting/get-other-modals/' + view, function (res) {
            if ($('div#modal-container').length > 0) {
                $('div#modal-container').html(res);
            } else {
                $('body').append(`
                    <div id="modal-container"> 
                        ${res}
                    </div>
                `);
            }

            if (modal_element != '#invoiceModal' && modal_element != '#salesReceiptModal' && modal_element != '#delayedCreditModal') {
                $(`${modal_element} [data-bs-toggle="popover"]`).popover();
            }

            if ($('div#modal-container .modal-body table.clickable:not(#category-details-table, #item-details-table)').length > 0) {
                rowInputs = $('div#modal-container form .modal table tbody tr:first-child()').html();
                if (modal_element === '#journalEntryModal' || modal_element === '#depositModal') {
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
                $('#printChecksModal #checks-table').nsmPagination({ itemsPerPage: parseInt($('#printChecksModal #checks-table-rows li a.dropdown-item.active').html().trim()) })
            }

            $(`${modal_element} select`).each(function () {
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
                            data: function (params) {
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
                    // $(this).select2({
                    //     minimumResultsForSearch: -1,
                    //     dropdownParent: $(modal_element)
                    // });
                }
            });

            if ($('div#modal-container select#tags').length > 0) {
                $('div#modal-container select#tags').select2({
                    placeholder: 'Start typing to add a tag',
                    dropdownParent: $(modal_element),
                    allowClear: true,
                    ajax: {
                        url: base_url + 'accounting/get-job-tags',
                        dataType: 'json'
                    }
                });
            }
            if (view === "weekly_timesheet_modal") {
                tableWeekDate(document.getElementById('weekDates'));
            }

            if ($(`${modal_element} .date`).length > 0) {
                $(`${modal_element} .date`).each(function () {
                    $(this).datepicker({
                        format: 'mm/dd/yyyy',
                        orientation: 'bottom',
                        autoclose: true
                    });
                });
            }

            $('#customer').on('change', function () {
                var attachmentContId = $(`.attachments .dropzone`).attr('id');
                modalAttachments.destroy();
                var vendorId = $(this).val();
                modalAttachments = new Dropzone(`#${attachmentContId}`, {
                    url: base_url + 'accounting/attachments/attach/' + vendorId,
                    maxFilesize: 20,
                    uploadMultiple: true,
                    // maxFiles: 1,
                    addRemoveLinks: true,
                    init: function () {
                        this.on("success", function (file, response) {
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
                    removedfile: function (file) {
                        var ids = modalAttachmentId;
                        var index = modalAttachedFiles.map(function (d, index) {
                            if (d == file) return index;
                        }).filter(isFinite)[0];

                        $(`${modal_element} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                        if ($('#modal-container form .modal .attachments-container').length > 0) {
                            $('#modal-container form .modal .attachments-container #attachment-types').trigger('change');
                        }

                        //remove thumbnail
                        var previewElement;
                        return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                    }
                });
            });
            initializeDropzone();


            if ($(`${modal_element} .dropdown`).length > 0) {
                $(`${modal_element} .dropdown-menu`).on('click', function (e) {
                    e.stopPropagation();
                });
            }

            if (modal_element === '#payBillsModal') {
                $('#payBillsModal #bills-table').nsmPagination({
                    //itemsPerPage: parseInt($('#payBillsModal #bills-table-rows li a.dropdown-item.active').html().trim())
                    itemsPerPage: 10
                })
            }

            if (modal_element === '#receivePaymentModal') {
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

    function initializeDropzone() {

        if ($(`${modal_element} .attachments`).length > 0) {
            //var attachmentContId = $(`${modal_element} .attachments .dropzone`).attr('id');
            var attachmentContId = $(`${modal_element} .attachments .dropzone`).attr('id');
            var vendorId = $(`${modal_element} .attachments .dropzone`).attr('data-id') ?? vendorIdTemp;
            console.log('vendorId', vendorId);
            console.log('modal element', modal_element);
            modalAttachments = new Dropzone(`#${attachmentContId}`, {
                url: base_url + 'accounting/attachments/attach/' + vendorId,
                maxFilesize: 20,
                uploadMultiple: true,
                // maxFiles: 1,
                addRemoveLinks: true,
                init: function () {
                    this.on("success", function (file, response) {
                        console.log('response', response)
                        if (JSON.parse(response)['is_success']) {
                            var ids = JSON.parse(response)['attachment_ids'];
                            var modal = $(`${modal_element}`);

                            for (i in ids) {
                                if (modal.find(`input[name="attachments[]"][value="${ids[i]}"]`).length === 0) {
                                    modal.find('.attachments').parent().append(`<input type="hidden" name="attachments[]" value="${ids[i]}">`);
                                }

                                modalAttachmentId.push(ids[i]);
                            }
                            modalAttachedFiles.push(file);
                        } else {
                            toast(false, "Please select vendor.");
                        }
                    });
                },
                removedfile: function (file) {
                    var ids = modalAttachmentId;
                    var index = modalAttachedFiles.map(function (d, index) {
                        if (d == file) return index;
                    }).filter(isFinite)[0];

                    $(`${modal_element} .attachments`).parent().find(`input[name="attachments[]"][value="${ids[index]}"]`).remove();

                    if ($('#modal-container form .modal .attachments-container').length > 0) {
                        $('#modal-container form .modal .attachments-container #attachment-types').trigger('change');
                    }

                    //remove thumbnail
                    var previewElement;
                    return (previewElement = file.previewElement) !== null ? (previewElement.parentNode.removeChild(file.previewElement)) : (void 0);
                }
            });
        }
    }

    $(document).on('click', '#printChecksModal #print-checks-setup', function (e) {
        $.get(GET_OTHER_MODAL_URL + 'print_checks_setup_modal', function (res) {
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
                stop: function (e, ui) {
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

    $(document).on("click", "#print_printable_checks_modal #btn_print_printable_checks", function () {
        // $("#print_preview_printable_checks_modal #printable_checks_table_print").printThis({
        //     importStyle: $(this).hasClass('checkListTable')
        // });
    });

    $(document).on('click', '.checkListPrintAction', function () {
        function fileID(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        var filename = "[" + fileID(6) + "] Check list";
        var tab = document.getElementById('checkListTable');
        var style = "<style>";
        style = style + "table {width: 100% !important;}";
        style = style + "* {font-family: SEGOE UI;}";
        style = style + "table, th, td {border: solid 1px gray; border-collapse: collapse; padding: 3px 5px;text-align: left; font-size: 18px;}";
        style = style + "</style>";

        const left = (screen.width - 1280) / 2;
        const top = (screen.height - 720) / 2;
        var win = window.open("", "Check List", "width=" + 1280 + ", height=" + 720 + ", top=" + top + ", left=" + left);

        win.document.write("<h2><strong>NSMARTRAC</strong></h2>");
        win.document.write("<h4 style='margin: -20px 0px 15px 0px; font-weight: normal;'>Check list</h4>");
        win.document.write(tab.outerHTML);
        win.document.write(style);
        win.document.write("<style>th, h2, h4 {text-transform: uppercase;} h4{font-size: 18px !important;}</style>");
        win.document.write("<style>.checkListTable>tbody>tr>td{font-family: SEGOE UI !important;} .checkListTable>thead>tr>th{font-family: SEGOE UI !important;}</style>");
        win.document.title = filename;
        setTimeout(function () {
            win.print();
            win.close();
        }, 500);
    });


    $(document).on('hidden.bs.modal', '#printSetupModal', function () {
        $('#modal-container').remove();
        $('.modal-backdrop').remove();
    });

    $(document).on('click', '#printSetupModal #continue-setup', function (e) {
        $('#printSetupModal .nsm-progressbar .progressbar ul li.active').removeClass('active').next().addClass('active');
        var index = $('#printSetupModal .nsm-progressbar .progressbar ul li.active').index();

        $(this).parent().prev().html('<button class="nsm-button primary" id="back-setup" type="button">Back</button>');

        $(`#printSetupModal #step-${index}`).hide();
        $(`#printSetupModal #step-${index + 1}`).show();

        if (index === 2) {
            $(this).parent().html('<button class="nsm-button success" id="finish-setup" type="button">Finish setup</button>');
        }
    });

    $(document).on('click', '#printSetupModal #back-setup', function (e) {
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

        if (index === 0) {
            $(this).parent().html(`<button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>`);
        }
    });

    $(document).on('change', '#printSetupModal input[name="check_type"]', function () {
        $('#printSetupModal .check-type-preview.selected').removeClass('selected');
        $(this).parent().find('.check-type-preview').addClass('selected');
    });

    $(document).on('click', '#printSetupModal .check-type-preview', function () {
        if ($(this).hasClass('selected') === false) {
            $(this).prev().prev().prop('checked', true).trigger('change');
        }
    });

    $(document).on('change', '#printSetupModal #horizontal-offset, #printSetupModal #vertical-offset', function () {
        var horizontal = $('#printSetupModal #horizontal-offset').val();
        var vertical = $('#printSetupModal #vertical-offset').val();

        var top = 113 + parseInt(vertical);
        var left = 100 - parseInt(horizontal);
        $('#printSetupModal .printsetup-amountgrid').css('inset', `${top}px auto auto ${left}px`);
    });

    $(document).on('click', '#printSetupModal #minus-h-offset, #printSetupModal #plus-h-offset', function (e) {
        var horizontal = $('#printSetupModal #horizontal-offset').val();
        if ($(this).attr('id').includes('plus')) {
            var val = parseInt(horizontal) + 1;
        } else {
            var val = parseInt(horizontal) - 1;
        }

        $('#printSetupModal #horizontal-offset').val(val).trigger('change');
    });

    $(document).on('click', '#printSetupModal #minus-v-offset, #printSetupModal #plus-v-offset', function (e) {
        var vertical = $('#printSetupModal #vertical-offset').val();
        if ($(this).attr('id').includes('plus')) {
            var val = parseInt(vertical) + 1;
        } else {
            var val = parseInt(vertical) - 1;
        }

        $('#printSetupModal #vertical-offset').val(val).trigger('change');
    });

    $(document).on('click', '#printSetupModal .preview-print-sample', function (e) {
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
            success: function (result) {
                $('div#modal-container').append(result);

                $('#viewPrintChecksModal').attr('id', 'viewPrintChecksSampleModal');
                $('#viewPrintChecksSampleModal').modal('show');
            }
        })
    });

    $(document).on('click', '#printSetupModal #finish-setup', function (e) {
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
            success: function (result) {
                var res = JSON.parse(result);

                if (res.success) {
                    $('#printSetupModal').modal('hide');
                    $('.modal-backdrop').remove();

                    $('.nsm-sidebar-menu #new-popup ul li a.ajax-modal[data-target="#printChecksModal"]').trigger('click');
                }
            }
        })
    });

    $(document).on('click', '#viewPrintChecksSampleModal #preview-and-print', function (e) {
        e.preventDefault();

        let pdfWindow = window.open("");
        pdfWindow.document.write(`<iframe width="100%" height="100%" src="${$('#viewPrintChecksSampleModal iframe').attr('src')}"></iframe>`);
        $(pdfWindow.document).find('body').css('padding', '0');
        $(pdfWindow.document).find('body').css('margin', '0');
        $(pdfWindow.document).find('iframe').css('border', '0');
    });

    $(document).on('hidden.bs.modal', '#viewPrintChecksSampleModal', function () {
        $(this).parent().parent().next('.modal-backdrop').remove();
        $(this).parent().remove();
    });
});