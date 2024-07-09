<script type="text/javascript">
    // $(function() { $('select').select2('destroy'); });

    CKEDITOR.replace('emailBody', {
        toolbarGroups: [{
                name: 'clipboard',
                groups: ['clipboard', 'undo']
            },
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup']
            },
        ],
        height: '165px',
    });

    var BASE_URL = base_url;
    var REPORT_CATEGORY = "balance_sheet";
    var REPORT_ID = 5;
    var TABLE_ID = "balanceSheet_table";

    // Render Report Data Script
    function renderReportList() {
        var theadColumnNames = $(`#${TABLE_ID} thead tr:first td`).map(function() {
            return $(this).text();
        }).get()
        theadTotalColumn = $(`#${TABLE_ID}`).find('tr:first td').length;
        businessLogoURL = 'uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image"; ?>';
        businessName = $('input[name="company_name"]').val();
        reportName = $('input[name="report_name"]').val();
        reportDate = $("#reportDate").text();
        filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
        notes = $("#notesContent").text();
        showHideLogo = $('select[name="showHideLogo"]').val();
        enableDisableBusinessName = $('.enableDisableBusinessName').prop('checked');
        enableDisableReportName = $('.enableDisableReportName').prop('checked');
        header_align = $('select[name="header_align"]').val();
        footer_align = $('select[name="footer_align"]').val();
        sort_by = $('select[name="sort_by"]').val();
        sort_order = $('select[name="sort_order"]').val();
        page_size = $('select[name="page_size"]').val();
        pageOrientation = $('select[name="pageOrientation"]').val();
        pageHeaderRepeat = ($('input[name="pageHeaderRepeat"]').prop('checked') == true) ? 1 : 0;
        date_from = $('input[name="date_from"]').val();
        date_to = $('input[name="date_to"]').val();
        date = $('input[name="date"]').val();
        reportConfig = {
            businessLogoURL: businessLogoURL,
            showHideLogo: showHideLogo,
            header_align: header_align,
            footer_align: footer_align,
            sort_by: sort_by,
            sort_order: sort_order,
            page_size: page_size,
            pageOrientation: pageOrientation,
            pageHeaderRepeat: pageHeaderRepeat,
            date_from: date_from,
            date_to: date_to,
            date: date,
        };
        page_size = $('#page-size').val();

        // =========================
        $.ajax({
            type: "POST",
            url: BASE_URL + "/accounting_controllers/Reports/getReportData/" + REPORT_CATEGORY,
            data: {
                theadColumnNames: theadColumnNames,
                theadTotalColumn: theadTotalColumn,
                businessName: businessName,
                reportName: reportName,
                reportDate: reportDate,
                filename: filename,
                notes: notes,
                reportConfig: reportConfig,
            },
            success: function(data) {
                loadReportPreview();
                $('#pdfPreview').before('<span class="dataLoader"><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...</span>').hide();
                $(`#${TABLE_ID} > tbody`).html(data);
                $(`#${TABLE_ID}`).nsmPagination({
                    itemsPerPage: page_size
                });
                $(".settingsApplyButton").removeAttr('disabled').html('Apply');
            },
            beforeSend: function() {
                $('#table-body').html('<span class="bx bx-loader bx-spin"></span> Fetching Result');
            }
        });
    }

    function updateReportSettings() {
        var theadColumnNames = $(`#${TABLE_ID} thead tr:first td`).map(function() {
            return $(this).text();
        }).get();
        theadTotalColumn = $(`#${TABLE_ID}`).find('tr:first td').length;
        businessLogoURL = 'uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image"; ?>';
        businessName = $('input[name="company_name"]').val();
        reportName = $('input[name="report_name"]').val();
        reportDate = $("#reportDate").text();
        filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
        notes = $("#notesContent").text();
        showHideLogo = $('select[name="showHideLogo"]').val();
        enableDisableBusinessName = $('.enableDisableBusinessName').prop('checked');
        enableDisableReportName = $('.enableDisableReportName').prop('checked');
        header_align = $('select[name="header_align"]').val();
        footer_align = $('select[name="footer_align"]').val();
        sort_by = $('select[name="sort_by"]').val();
        sort_order = $('select[name="sort_order"]').val();
        page_size = $('select[name="page_size"]').val();
        pageOrientation = $('select[name="pageOrientation"]').val();
        pageHeaderRepeat = ($('input[name="pageHeaderRepeat"]').prop('checked') == true) ? 1 : 0;
        date = $('input[name="date"]').val();
        reportDate = 'As of ' + moment($("#report-date").val()).format('LL');

        // Capture compact display setting
        var compact_display = $('#compact_display').prop('checked') ? 1 : 0;

        reportConfig = {
            businessLogoURL: businessLogoURL,
            showHideLogo: showHideLogo,
            header_align: header_align,
            footer_align: footer_align,
            sort_by: sort_by,
            sort_order: sort_order,
            page_size: page_size,
            pageOrientation: pageOrientation,
            pageHeaderRepeat: pageHeaderRepeat,
            date: date,
        };

        $("#reportDate").text(reportDate);
        (enableDisableBusinessName) ? $("#businessName").text(businessName): businessName = $("#businessName").html("&nbsp;").html();
        (enableDisableReportName) ? $("#reportName").text(reportName): reportName = $("#reportName").html("&nbsp;").html();
        if (showHideLogo == "1") {
            $('#businessLogo').attr('src', BASE_URL + '/uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image?"; ?>' + Math.round(Math.random() * 1000000)).show();
            if (header_align == "L") {
                $('.reportTitleInfo').css({
                    textAlign: 'left',
                    marginLeft: '115px'
                });
            }
            if (header_align == "C") {
                $('.reportTitleInfo').css({
                    textAlign: 'center',
                    marginLeft: 'unset'
                });
            }
            if (header_align == "R") {
                $('.reportTitleInfo').css({
                    textAlign: 'right',
                    marginLeft: 'unset'
                });
            }
            if (footer_align == "L") {
                $('.footerInfo').css({
                    textAlign: 'left'
                });
            }
            if (footer_align == "C") {
                $('.footerInfo').css({
                    textAlign: 'center'
                });
            }
            if (footer_align == "R") {
                $('.footerInfo').css({
                    textAlign: 'right'
                });
            }
        } else {
            $('#businessLogo').hide();
            if (header_align == "L") {
                $('.reportTitleInfo').css({
                    textAlign: 'left',
                    marginLeft: 'unset'
                });
            }
            if (header_align == "C") {
                $('.reportTitleInfo').css({
                    textAlign: 'center',
                    marginLeft: 'unset'
                });
            }
            if (header_align == "R") {
                $('.reportTitleInfo').css({
                    textAlign: 'right',
                    marginLeft: 'unset'
                });
            }
            if (footer_align == "L") {
                $('.footerInfo').css({
                    textAlign: 'left'
                });
            }
            if (footer_align == "C") {
                $('.footerInfo').css({
                    textAlign: 'center'
                });
            }
            if (footer_align == "R") {
                $('.footerInfo').css({
                    textAlign: 'right'
                });
            }
        }

        if ($('.enableDisableBusinessName').is(':checked')) {
            show_company_name = 1;
        } else {
            show_company_name = 0;
        }

        if ($('.enableDisableReportName').is(':checked')) {
            show_report_name = 1;
        } else {
            show_report_name = 0;
        }

        if (compact_display) {
            $('#tableID').addClass('compact-table');
        } else {
            $('#tableID').removeClass('compact-table');
        }

        $(`#${TABLE_ID}`).nsmPagination({
            itemsPerPage: page_size
        });
        $(".settingsApplyButton").attr('disabled', '').html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Applying changes...');

        $.ajax({
            type: "POST",
            url: base_url + "accounting/reports/_update_report_settings",
            data: {
                report_type_id: REPORT_ID,
                company_name: businessName,
                title: reportName,
                show_company_name: show_company_name,
                show_title: show_report_name,
                page_size: page_size,
                report_date_text: date,
                report_date_from_text: date,
                report_date_to_text: date,
                show_logo: showHideLogo,
                header_align: header_align,
                footer_align: footer_align,
                sort_by: sort_by,
                sort_asc_desc: sort_order,
                compact_display: compact_display
            },
            dataType: 'json',
            success: function(response) {
                $(".settingsApplyButton").removeAttr('disabled').html('Apply');
                if (response.is_success == 1) {
                    $('#reportSettings').modal('hide');
                    renderReportList();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.msg,
                    });
                }
            }
        });
    }


    document.querySelector('.settingsApplyButton').addEventListener('click', function() {

    });

    document.addEventListener('DOMContentLoaded', function() {
        renderReportList();
    });

    // Load .pdf Report Script
    function loadReportPreview() {
        $('#pdfPreview').hide();
        $('#pdfPreview').attr('src', BASE_URL + "/assets/pdf/accounting/" + filename + ".pdf?" + Math.round(Math.random() * 1000000)).on('load', function() {
            $('.dataLoader').remove();
            $('#pdfPreview').show();
        });
    }

    // Report Config Script
    $('#reportSettingsForm').submit(function(event) {
        event.preventDefault();
        updateReportSettings();
    });

    // Page Orientation Config Script
    $('#pageOrientation').change(function(event) {
        renderReportList();
    });

    // Header Repeat Config Script
    $('#pageHeaderRepeat').change(function(event) {
        renderReportList();
    });

    // Fetch Report Notes On Page Load
    $.ajax({
        type: "POST",
        url: BASE_URL + "/accounting_controllers/reports/getNotes",
        data: {
            reportID: REPORT_ID,
        },
        success: function(data) {
            (data !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
            $('#notesContent').html(data);
            $("#NOTES").val(data);
        }
    });

    // Add and Edit Notes Script
    $('#addNotesForm').submit(function(event) {
        event.preventDefault();
        $(".noteSaveButton").attr('disabled', '').html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Saving notes...');
        $('#notesContent').html($("#NOTES").val());
        ($("#NOTES").val() !== "") ? $('.addNotes').text('Edit Notes'): $('.addNotes').text('Add Notes');
        // =========
        $.ajax({
            type: "POST",
            url: BASE_URL + "/accounting_controllers/reports/saveNotes",
            data: {
                reportID: REPORT_ID,
                reportNotes: $("#NOTES").val(),
            },
            success: function(data) {
                $(".noteSaveButton").removeAttr('disabled').html('Save');
                $("#notesContent").show();
                $("#addNotesForm").hide();
            }
        });
    });

    $(document).ready(function() {
        $('#sendEmailForm').submit(function(event) {
            event.preventDefault();

            // Disable the send button and show a spinner
            $(".sendEmail").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Send');

            // Get form field values
            var emailTo = $("#emailTo").val();
            var emailCC = $("#emailCC").val();
            var emailSubject = $("#emailSubject").val();
            var emailBody = CKEDITOR.instances['emailBody'].getData();
            var customAttachmentNamePDF = ($('.pdfAttachmentCheckbox').is(":checked")) ? $("#pdfReportFilename").val() : "";
            var customAttachmentNameXLSX = ($('.xlsxAttachmentCheckbox').is(":checked")) ? $("#xlsxReportFileName").val() : "";
            var attachmentConfig = {
                reportFilePathPDF: filename + ".pdf",
                reportFilePathXLSX: filename + ".xlsx",
                customAttachmentNamePDF: customAttachmentNamePDF,
                customAttachmentNameXLSX: customAttachmentNameXLSX,
            };

            // Define the company name
            var companyName = "<?php echo $companyInfo ? strtoupper($companyInfo->business_name) : ''; ?>";

            // Prepend company name to the email subject
            if (emailSubject) {
                emailSubject = companyName + ": " + emailSubject;
            } else {
                emailSubject = companyName + ": " + $("#emailSubject").attr('placeholder');
            }

            // Make the AJAX request
            $.ajax({
                type: "POST",
                url: BASE_URL + "/AccountingMailer/emailReport/" + REPORT_CATEGORY,
                data: {
                    emailTo: emailTo,
                    emailCC: emailCC,
                    emailSubject: emailSubject,
                    emailBody: emailBody,
                    attachmentConfig: attachmentConfig,
                },
                success: function(data) {
                    $(".sendEmail").removeAttr('disabled').empty().append('Send');
                    if (data == "true") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Report was emailed successfully!',
                        }).then((result) => {
                            $("#emailCloseModal").click();
                        });
                    } else {
                        $(".sendEmail").removeAttr('disabled').empty().append('Send');
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Failed to send report!',
                        });
                    }
                }
            });
        });
    });

    // Export Report to PDF Script
    $("#exportToPDF, .savePDF").click(function(event) {
        event.preventDefault();
        var filePath = BASE_URL + "/assets/pdf/accounting/" + filename + ".pdf";
        var link = $("<a>", {
            href: filePath,
            download: filename + ".pdf",
        });
        $("body").append(link);
        link[0].click();
        link.remove();
    });

    // Export Report to XLSX Script
    $("#exportToXLSX").click(function(event) {
        event.preventDefault();
        var filePath = BASE_URL + "/assets/pdf/accounting/" + filename + ".xlsx";
        var link = $("<a>", {
            href: filePath,
            download: filename + ".xlsx",
        });
        $("body").append(link);
        link[0].click();
        link.remove();
    });

    // Show/hide script
    $('.addNotes').on('click', function(event) {
        $("#notesContent").hide();
        $("#addNotesForm").show();
        $("#NOTES").focus();
    });
    $('#cancelNotes').on('click', function(event) {
        $(".addNotes").focus();
        $("#notesContent").show();
        $("#addNotesForm").hide();
    });

    // Realtime character counter on report notes.
    $("#NOTES").on('input', function() {
        let textLength = $("#NOTES").val().length;
        $(".noteCharMax").text(textLength + " / 4000 characters max");
    });

    $('input[name="date_from"]').on('input', function() {
        let numericDate = $(this).val();
        let wordDate = new Date(numericDate).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: '2-digit'
        });
        $('#date_from_text').text(wordDate);
    }).trigger('input');

    $('input[name="date_to"]').on('input', function() {
        let numericDate = $(this).val();
        let wordDate = new Date(numericDate).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: '2-digit'
        });
        $('#date_to_text').text(wordDate);
    }).trigger('input');

    // Pagination
    $(document).ready(function() {
        $(".audit_log").nsmPagination({
            itemsPerPage: 10,
        });
    });

    // Date picker
    var currentDate = new Date().toISOString().split('T')[0];

    $(document).ready(function() {
        var isCollapsed = true;

        $("#collapseButton").click(function() {
            if (isCollapsed) {
                $(".collapse").collapse('show');
                $("#collapseButton span").text('Uncollapse');
                updateCarets('show');
            } else {
                $(".collapse").collapse('hide');
                $("#collapseButton span").text('Collapse');
                updateCarets('hide');
            }
            isCollapsed = !isCollapsed;
        });

        $(".collapse-row").click(function() {
            var target = $(this).data("bs-target");
            $(this).find("i").toggleClass("bx-caret-right bx-caret-down");
            $(target).collapse('toggle');
        });

        function updateCarets(action) {
            $(".collapse-row").each(function() {
                var target = $(this).data("bs-target");
                var icon = $(this).find("i");
                if (action === 'show') {
                    icon.removeClass("bx-caret-right").addClass("bx-caret-down");
                } else {
                    icon.removeClass("bx-caret-down").addClass("bx-caret-right");
                }
            });
        }
    });

    $(document).ready(function() {
        function sortTable(order) {
            var rows = $("#reportTable > tr").toArray();

            if (order === 'sort-default') {
                $("#reportTable").html(originalOrder);
            } else {
                rows.sort(function(a, b) {
                    var aValue = parseFloat($(a).find("td").eq(1).text().replace(/[\$,]/g, '')) || 0;
                    var bValue = parseFloat($(b).find("td").eq(1).text().replace(/[\$,]/g, '')) || 0;
                    if (order === 'sort-asc') {
                        return aValue - bValue;
                    } else if (order === 'sort-desc') {
                        return bValue - aValue;
                    }
                });
                $("#reportTable").html(rows);
            }
        }
    });

    // $(document).ready(function() {
    //     $.ajax({
    //         type: "POST",
    //         url: base_url + "/accounting_controllers/Reports/getReportData/balance_sheet",

    //         success: function(data) {
    //             alert(data);
    //         }
    //     });
    // });
</script>
<style>
    .compact-table td,
    .compact-table th {
        padding: 4px 8px;
        font-size: 12px;
    }
</style>