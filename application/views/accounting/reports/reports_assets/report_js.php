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

    var BASE_URL = window.location.origin;
    var REPORT_CATEGORY = "<?php echo $reportCategory; ?>";
    var REPORT_ID = "<?php echo $reportTypeId; ?>";
    // =========================
    var theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() {
        return $(this).text();
    }).get();
    var theadTotalColumn = $("#<?php echo $tableID; ?>").find('tr:first th').length;
    var businessLogoURL = 'uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image"; ?>';
    var businessName = $('input[name="company_name"]').val();
    var reportName = $('input[name="report_name"]').val();
    var reportDate = $("#reportDate").text();
    var filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
    var notes = $("#notesContent").text();
    // =========================
    var showHideLogo = $('select[name="showHideLogo"]').val();
    var enableDisableBusinessName = $('.enableDisableBusinessName').prop('checked');
    var enableDisableReportName = $('.enableDisableReportName').prop('checked');
    var header_align = $('select[name="header_align"]').val();
    var footer_align = $('select[name="footer_align"]').val();
    var sort_by = $('select[name="sort_by"]').val();
    var sort_order = $('select[name="sort_order"]').val();
    var page_size = $('select[name="page_size"]').val();
    var pageOrientation = $('select[name="pageOrientation"]').val();
    var pageHeaderRepeat = ($('input[name="pageHeaderRepeat"]').prop('checked') == true) ? 1 : 0;
    var date_from = $('input[name="date_from"]').val();
    var date_to = $('input[name="date_to"]').val();
    // =========================
    var reportConfig = {
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
    };

    // Render Report Data Script
    function renderReportList() {
        theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() {
            return $(this).text();
        }).get();
        theadTotalColumn = $("#<?php echo $tableID; ?>").find('tr:first th').length;
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
        };
        // =========================
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
        $(".settingsApplyButton").attr('disabled', '').html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Applying changes...');
        $('#pdfPreview').before('<span class="dataLoader"><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...</span>').hide();
        // $("#<?php echo $tableID; ?> > tbody").html('<tr><td colspan="' + theadColumnNames.length + '"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result... </center></td></tr>');
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
                $("#<?php echo $tableID; ?> > tbody").html(data);
                $(".settingsApplyButton").removeAttr('disabled').html('Apply');
                // $('#reportSettings').modal('hide');
            }
        });
    }

    document.querySelector('.settingsApplyButton').addEventListener('click', function() {
        const settings = {
            showHideLogo: $('select[name="showHideLogo"]').val(),
            companyName: $('input[name="company_name"]').val(),
            reportName: $('input[name="report_name"]').val(),
            headerAlign: $('select[name="header_align"]').val(),
            footerAlign: $('select[name="footer_align"]').val(),
            pageSize: $('select[name="page_size"]').val(),
            sortBy: $('select[name="sort_by"]').val(),
            sortOrder: $('select[name="sort_order"]').val(),
            pageOrientation: $('select[name="pageOrientation"]').val(),
            pageHeaderRepeat: $('input[name="pageHeaderRepeat"]').prop('checked'),
            dateFrom: $('input[name="date_from"]').val(),
            dateTo: $('input[name="date_to"]').val()
        };
        localStorage.setItem('reportSettings', JSON.stringify(settings));
        renderReportList();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const savedSettings = JSON.parse(localStorage.getItem('reportSettings'));
        if (savedSettings) {
            if (savedSettings.showHideLogo !== undefined) $('select[name="showHideLogo"]').val(savedSettings.showHideLogo);
            if (savedSettings.companyName !== undefined) $('input[name="company_name"]').val(savedSettings.companyName);
            if (savedSettings.reportName !== undefined) $('input[name="report_name"]').val(savedSettings.reportName);
            if (savedSettings.headerAlign !== undefined) $('select[name="header_align"]').val(savedSettings.headerAlign);
            if (savedSettings.footerAlign !== undefined) $('select[name="footer_align"]').val(savedSettings.footerAlign);
            if (savedSettings.pageSize !== undefined) $('select[name="page_size"]').val(savedSettings.pageSize);
            if (savedSettings.sortBy !== undefined) $('select[name="sort_by"]').val(savedSettings.sortBy);
            if (savedSettings.sortOrder !== undefined) $('select[name="sort_order"]').val(savedSettings.sortOrder);
            if (savedSettings.pageOrientation !== undefined) $('select[name="pageOrientation"]').val(savedSettings.pageOrientation);
            if (savedSettings.pageHeaderRepeat !== undefined) $('input[name="pageHeaderRepeat"]').prop('checked', savedSettings.pageHeaderRepeat);
            if (savedSettings.dateFrom !== undefined) $('input[name="date_from"]').val(savedSettings.dateFrom);
            if (savedSettings.dateTo !== undefined) $('input[name="date_to"]').val(savedSettings.dateTo);
        }
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
        renderReportList();
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
            renderReportList();
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
                renderReportList();
            }
        });
    });

    // Email Report Script
    $('#sendEmailForm').submit(function(event) {
        event.preventDefault();
        $(".sendEmail").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Send');
        var emailTo = $("#emailTo").val();
        var emailCC = $("#emailCC").val();
        var emailSubject = $("#emailSubject").val();
        var emailBody = $("#emailBody").html();
        var customAttachmentNamePDF = ($('.pdfAttachmentCheckbox').is(":checked") == true) ? $("#pdfReportFilename").val() : "";
        var customAttachmentNameXLSX = ($('.xlsxAttachmentCheckbox').is(":checked") == true) ? $("#xlsxReportFileName").val() : "";
        var attachmentConfig = {
            reportFilePathPDF: filename + ".pdf",
            reportFilePathXLSX: filename + ".xlsx",
            customAttachmentNamePDF: customAttachmentNamePDF,
            customAttachmentNameXLSX: customAttachmentNameXLSX,
        }

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

    // Email Subject
    document.addEventListener('DOMContentLoaded', function() {
        const businessName = '<?php echo $companyInfo ? strtoupper($companyInfo->business_name) : ''; ?>: ';
        const emailSubject = document.getElementById('emailSubject');

        emailSubject.value = businessName + '<?php echo $page->title; ?>';

        emailSubject.addEventListener('input', function() {
            if (!emailSubject.value.startsWith(businessName)) {
                emailSubject.value = businessName;
            }
        });

        emailSubject.addEventListener('keydown', function(e) {
            if (emailSubject.selectionStart < businessName.length) {
                emailSubject.setSelectionRange(businessName.length, businessName.length);
            }
        });

        emailSubject.addEventListener('click', function(e) {
            if (emailSubject.selectionStart < businessName.length) {
                emailSubject.setSelectionRange(businessName.length, businessName.length);
            }
        });
    });
</script>