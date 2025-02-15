<script type="text/javascript">
    // $(function() { $('select').select2('destroy'); });

    CKEDITOR.replace('emailBody', {
        toolbarGroups: [
            { name: 'clipboard', groups: ['clipboard', 'undo'] },
            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
        ],
        height: '165px',
    });
    
    var setDataTable;
    var currentTable = '<?php echo $tableID; ?>';
    var reportTables = [
        'vendorcontactlist_table',
        'salesbycustomersummary_table',
        'customerbalancesummary_table',
        'customercontactlist_table',
        'expensesbyvendorsummary_table',
        // 'incomebycustomersummary_table',
        'invoicelistbydate_table',
        'paymentmethodlist_table',
        'physicalinventoryworksheet_table',
        'productservicelist_table',
        'salesbyproductservicesummary_table',
        'taxablesalessummary_table',
        'vendorbalancesummary_table',
        'statementlist_table',
        'employeedetails_table',
        'accountsreceivableagingsummarylist_table',
        'accountlist_table',
        'contractorbalancesummary_table',
        'transactionlistwithsplits_table',
        'transactionlistcustomer_table',
        'employeedirectory_table',
        'reconciliationreports_table',
        'salesbyitems_table',
        'accountreceivable_table',
        'auditlogs_table',
        'active_subscriptions_table',
        'earned_table',
        'invoiceamount_table',
        'jobscompleted_table',
        'newjobs_table',
        'lostaccounts_table',
        'serviceprojectiveincome_table',
        'customergroups_table',
        'jobstatus_table',
        'estimates_table',
        'jobtags_table',
        'leadsource_table',
        'paidinvoices_table',
        'openinvoices_table',
        'pastdueinvoices_table',
        'overdueinvoices_table',
        'unpaidinvoices_table',
        'taskhub_table',
        'openestimates_table',
        'timesheet_table',
        'recentleads_table',
        'customerstatus_table',
        'servicetickets_table',
        'bankaccounts_table',
        'salesleaderboard_table',
        'techleaderboard_table',
        'recentcustomers_table',
        'jobactivities_table',
        'sales_table',
        'collections_table',
        'employeeperformancerating_table'
    ];

    var base_url = window.location.origin;
    var REPORT_CATEGORY = "<?php echo $reportCategory; ?>";
    var REPORT_ID = "<?php echo $reportTypeId; ?>";
    // =========================
    var theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() { return $(this).text(); }).get();
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
    var showHideBusinessNameStatus = (enableDisableBusinessName == true) ? 1 : 0;
    var showHideReportNameStatus = (enableDisableReportName == true) ? 1 : 0;
    var header_align = $('select[name="header_align"]').val();
    var footer_align = $('select[name="footer_align"]').val();
    var sort_by = $('select[name="sort_by"]').val();
    var sort_order = $('select[name="sort_order"]').val();
    var page_size = $('select[name="page_size"]').val();
    var pageOrientation = $('select[name="pageOrientation"]').val();
    var pageHeaderRepeat = ($('input[name="pageHeaderRepeat"]').prop('checked') == true) ? 1 : 0;
    var date_from = $('input[name="date_from"]').val();
    var date_to = $('input[name="date_to"]').val();
    var subscription_period = $('select[name="subscription_period"]').val();
    var filter_by = $('select[name="filter_by"]').val();
    var status_filter = $('select[name="status_filter"]').val();
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
        subscription_period: subscription_period,
        filter_by: filter_by,
        status_filter: status_filter,
    };
    // =========================

    // Date Filter 
    var dateFilterText = '';
    $('select[name="date_filter"]').on('change', function() {
        const dateFilterOption = $(this).val();
        const $dateFromInput = $('input[name="date_from"]');
        const $dateToInput = $('input[name="date_to"]');

        const currentDate = new Date();
        let dateFrom = '';
        let dateTo = '';

        if (dateFilterOption === 'get_all') {
            dateFrom = `1970-01-01`;
            dateTo = `9999-12-31`;
            dateFilterText = 'As of <?php echo date("F d, Y"); ?> (All Data)';
            $('.dateRangeFilterSection').hide();
        } else if (dateFilterOption === 'current_month') {
            const currentMonth = currentDate.getMonth();
            dateFrom = new Date(currentDate.getFullYear(), currentMonth, 1).toLocaleDateString('en-CA');
            dateTo = new Date(currentDate.getFullYear(), currentMonth + 1, 0).toLocaleDateString('en-CA');
            const monthName = currentDate.toLocaleString('default', {month: 'long'});
            dateFilterText = `This Month (${monthName} 1 - ${new Date(currentDate.getFullYear(), currentMonth + 1, 0).getDate()}, ${currentDate.getFullYear()})`;
            $('.dateRangeFilterSection').hide();
        } else if (dateFilterOption === 'current_quarter') {
            const currentMonth = currentDate.getMonth();
            const startMonth = Math.floor(currentMonth / 3) * 3;
            dateFrom = new Date(currentDate.getFullYear(), startMonth, 1).toLocaleDateString('en-CA');
            dateTo = new Date(currentDate.getFullYear(), startMonth + 3, 0).toLocaleDateString('en-CA');
            const startMonthName = new Date(currentDate.getFullYear(), startMonth, 1).toLocaleString('default', {month: 'long'});
            const endMonthName = new Date(currentDate.getFullYear(), startMonth + 2, 1).toLocaleString('default', {month: 'long'});
            dateFilterText = `This Quarter (${startMonthName} ${currentDate.getFullYear()} - ${endMonthName} ${currentDate.getFullYear()})`;
            $('.dateRangeFilterSection').hide();
        } else if (dateFilterOption === 'current_year') {
            dateFrom = `${currentDate.getFullYear()}-01-01`;
            dateTo = `${currentDate.getFullYear()}-12-31`;
            dateFilterText = `This Year (${currentDate.getFullYear()})`;
            $('.dateRangeFilterSection').hide();
        } else if (dateFilterOption === 'custom') {
            dateFrom = `${currentDate.getFullYear()}-01-01`;
            const currentDay = currentDate.getDate();
            dateTo = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}-${String(currentDay).padStart(2, '0')}`;
            dateFilterText = `${new Date(dateFrom).toLocaleString('default', { month: 'long' })} 1, ${currentDate.getFullYear()} - ${new Date(dateTo).toLocaleString('default', { month: 'long' })} ${currentDay}, ${currentDate.getFullYear()}`;
            $('.dateRangeFilterSection').fadeIn();
        }

        if (dateFrom && dateTo) {
            $dateFromInput.val(dateFrom);
            $dateToInput.val(dateTo);
            $("#filter_by_text").text(dateFilterText);
        }
    });

    function initializeDateFilterText() {
        const dateFilterOption = $('select[name="date_filter"').val();
        const currentDate = new Date();
        if (dateFilterOption === 'get_all') {
            dateFilterText = 'As of <?php echo date("F d, Y"); ?> (All Data)';
        } else if (dateFilterOption === 'current_month') {
            const currentMonth = currentDate.getMonth();
            const monthName = currentDate.toLocaleString('default', {month: 'long'});
            dateFilterText = `This Month (${monthName} 1 - ${new Date(currentDate.getFullYear(), currentMonth + 1, 0).getDate()}, ${currentDate.getFullYear()})`;
        } else if (dateFilterOption === 'current_quarter') {
            const currentMonth = currentDate.getMonth();
            const startMonth = Math.floor(currentMonth / 3) * 3;
            const startMonthName = new Date(currentDate.getFullYear(), startMonth, 1).toLocaleString('default', {month: 'long'});
            const endMonthName = new Date(currentDate.getFullYear(), startMonth + 2, 1).toLocaleString('default', {month: 'long'});
            dateFilterText = `This Quarter (${startMonthName} ${currentDate.getFullYear()} - ${endMonthName} ${currentDate.getFullYear()})`;
        } else if (dateFilterOption === 'current_year') {
            dateFilterText = `This Year (${currentDate.getFullYear()})`;
        }  else if (dateFilterOption === 'custom') {
            dateFilterText = `${new Date(dateFrom).toLocaleString('default', { month: 'long' })} 1, ${currentDate.getFullYear()} - ${new Date(dateTo).toLocaleString('default', { month: 'long' })} 31, ${currentDate.getFullYear()}`;
        }
        $("#filter_by_text").text(dateFilterText);
    } initializeDateFilterText();

    function formatDate(inputDate) {
        const date = new Date(inputDate);
        const options = { year: 'numeric', month: 'long', day: '2-digit' };
        return date.toLocaleDateString('en-US', options);
    }

    function updateReportDate() {
        const dateFrom = $('input[name="date_from"]').val();
        const dateTo = $('input[name="date_to"]').val();

        if (dateFrom && dateTo) {
            const formattedDateFrom = formatDate(dateFrom);
            const formattedDateTo = formatDate(dateTo);
            $('#filter_by_text').text(`${formattedDateFrom} - ${formattedDateTo}`);
        }
    }

    $('input[name="date_from"]').on('change', updateReportDate);
    $('input[name="date_to"]').on('change', updateReportDate);

    // Render Report Data Script
    function renderReportList() {
        subscription_period = $('select[name="subscription_period"]').val();
        // filter_by = $('select[name="filter_by"]').val();
        status_filter = $('select[name="status_filter"]').val();

        switch (subscription_period) {
            case "all":
                period = " (All Time)";
                break;
            case "last_7_days":
                period = " (Last 7 Days)";
                break;
            case "last_14_days":
                period = " (Last 14 Days)";
                break;
            case "last_30_days":
                period = " (Last 30 Days)";
                break;
            case "last_60_days":
                period = " (Last 60 Days)";
                break;
            default:
                period = "";
        }

        switch (status_filter) {
            case "Accepted":
                status_text = " (Accepted Status)";
                break;
            case "Acceptance Pending":
                status_text = " (Acceptance Pending)";
                break;
            case "Active":
                status_text = " (Active)";
                break;
            case "Active w/RAR":
                status_text = " (Active w/RAR)";
                break;
            case "Active w/RMR":
                status_text = " (Active w/RMR)";
                break;
            case "Active w/RQR":
                status_text = " (Active w/RQR)";
                break;
            case "Active w/RYR":
                status_text = " (Active w/RYR)";
                break;
            case "active_customer_group":
                status_text = " (Active Only)";
                break;
            case "all_customer_group":
                status_text = " (All)";
                break;
            case "Arrival":
                status_text = " (Arrival Status)";
                break;
            case "CAD/Permitting":
                status_text = " (CAD/Permitting)";
                break;
            case "Cancel Pending":
                status_text = " (Cancel Pending)";
                break;
            case "Cancelled":
                status_text = " (Cancelled Status)";
                break;
            case "Charge Back":
                status_text = " (Charge Back)";
                break;
            case "Collection":
                status_text = " (Collection)";
                break;
            case "Competition Lost":
                status_text = " (Competition Lost)";
                break;
            case "Completed":
                status_text = " (Completed Status)";
                break;
            case "Contract Review":
                status_text = " (Contract Review)";
                break;
            case "Declined By Customer":
                status_text = " (Declined By Customer Status)";
                break;
            case "Design Team/Engineering Stamps":
                status_text = " (Design Team/Engineering Stamps)";
                break;
            case "Draft":
                status_text = " (Draft Status)";
                break;
            case "Due":
                status_text = " (Due Status)";
                break;
            case "Estimate":
                status_text = " (Estimate)";
                break;
            case "Event":
                status_text = " (Event)";
                break;
            case "Finished":
                status_text = " (Finished Status)";
                break;
            case "Funded":
                status_text = " (Funded)";
                break;
            case "Inactive":
                status_text = " (Inactive)";
                break;
            case "Inactive w/RMM":
                status_text = " (Inactive w/RMM)";
                break;
            case "Invoiced":
                status_text = " (Invoiced Status)";
                break;
            case "Inspection":
                status_text = " (Inspection)";
                break;
            case "Installed":
                status_text = " (Installed)";
                break;
            case "Interconnection":
                status_text = " (Interconnection)";
                break;
            case "Job":
                status_text = " (Job)";
                break;
            case "Lead":
                status_text = " (Lead)";
                break;
            case "Loan Documents to be Executed":
                status_text = " (Loan Documents to be Executed)";
                break;
            case "Lost":
                status_text = " (Lost Status)";
                break;
            case "New":
                status_text = " (New)";
                break;
            case "Overdue":
                status_text = " (Overdue Status)";
                break;
            case "Paid":
                status_text = " (Paid Status)";
                break;
            case "Partially Paid":
                status_text = " (Partially Paid Status)";
                break;
            case "Pending":
                status_text = " (Pending Status)";
                break;
            case "Proposal":
                status_text = " (Proposal)";
                break;
            case "Scheduled":
                status_text = " (Scheduled Status)";
                break;
            case "Service":
                status_text = " (Service)";
                break;
            case "Site Survey":
                status_text = " (Site Survey)";
                break;
            case "Started":
                status_text = " (Started Status)";
                break;
            case "Submitted":
                status_text = " (Submitted Status)";
                break;
            case "Unpaid":
                status_text = " (Unpaid Status)";
                break;
            default:
                status_text = "";
        }


        // =========================
        theadColumnNames = $(`#<?php echo $tableID; ?> th`).map(function() { return $(this).text(); }).get();
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
        showHideBusinessNameStatus = (enableDisableBusinessName == true) ? 1 : 0;
        showHideReportNameStatus = (enableDisableReportName == true) ? 1 : 0;
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
            subscription_period: subscription_period,
            filter_by: filter_by,
            status_filter: status_filter,
        };
        // =========================
        (enableDisableBusinessName) ? $("#businessName").text(businessName) : businessName = $("#businessName").html("&nbsp;").html() ;
        (enableDisableReportName) ? $("#reportName").text(reportName) : reportName = $("#reportName").html("&nbsp;").html() ;
        if (showHideLogo == "1") {
            $('#businessLogo').attr('src', base_url + '/uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image?"; ?>' + Math.round(Math.random() * 1000000)).show();
            if (header_align == "L") { $('.reportTitleInfo').css({textAlign: 'left', marginLeft: '115px'}); }
            if (header_align == "C") { $('.reportTitleInfo').css({textAlign: 'center', marginLeft: 'unset'}); }
            if (header_align == "R") { $('.reportTitleInfo').css({textAlign: 'right', marginLeft: 'unset'}); }
            if (footer_align == "L") { $('.footerInfo').css({textAlign: 'left'}); }
            if (footer_align == "C") { $('.footerInfo').css({textAlign: 'center'}); }
            if (footer_align == "R") { $('.footerInfo').css({textAlign: 'right'}); }
        } else {
            $('#businessLogo').hide();
            if (header_align == "L") { $('.reportTitleInfo').css({textAlign: 'left', marginLeft: 'unset'}); }
            if (header_align == "C") { $('.reportTitleInfo').css({textAlign: 'center', marginLeft: 'unset'}); }
            if (header_align == "R") { $('.reportTitleInfo').css({textAlign: 'right', marginLeft: 'unset'}); }
            if (footer_align == "L") { $('.footerInfo').css({textAlign: 'left'}); }
            if (footer_align == "C") { $('.footerInfo').css({textAlign: 'center'}); }
            if (footer_align == "R") { $('.footerInfo').css({textAlign: 'right'}); }
        }
        $(".settingsApplyButton").attr('disabled', '').html('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Applying changes...');
        $('#pdfPreview').before('<span class="dataLoader"><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result...</span>').hide();
        $("#<?php echo $tableID; ?> > tbody").html('<tr><td colspan="' + theadColumnNames.length + '"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result... </center></td></tr>');
        // =========================
        $.ajax({
            type: "POST",
            url: base_url + "/accounting_controllers/Reports/getReportData/" + REPORT_CATEGORY,
            data: { 
                theadColumnNames: theadColumnNames,
                theadTotalColumn: theadTotalColumn,
                businessName: businessName,
                reportName: reportName + period + status_text, 
                reportDate: reportDate, 
                filename: filename, 
                notes: notes, 
                reportConfig: reportConfig, 
            },
            success: function(data) {
                loadReportPreview();
                $("#<?php echo $tableID; ?> > tbody").html(data);
                $(".settingsApplyButton").removeAttr('disabled').html('Apply');
                $('#reportSettings').modal('hide');

                if (reportTables.includes(currentTable)) {
                    window.setDataTable = $('#<?php echo $tableID; ?>').DataTable({
                        "ordering": false,
                        "pageLength": 10,
                        "searching": false,
                        "lengthChange": false
                    });
                }
                $('#reportName').text(reportName + period + status_text);
            }
        });
        // =========================
        $.ajax({
            type: "POST",
            url: base_url + "/accounting_controllers/reports/saveReportSettings/",
            data: {
                report_type_id: REPORT_ID,
                company_name: businessName,
                title: reportName,
                notes: notes,
                show_logo: showHideLogo,
                show_company_name: showHideBusinessNameStatus,
                show_title: showHideReportNameStatus,
                header_align: header_align,
                footer_align: footer_align,
                sort_by: sort_by,
                sort_asc_desc: sort_order,
                page_size: page_size,
                report_date_from_text: date_from,
                report_date_to_text: date_to,
                subscription_period: subscription_period,
                filter_by: filter_by,
                status_filter: status_filter,
            },
            success: function(data) {}   
        });
    }

    // Load .pdf Report Script
    function loadReportPreview() {
        $('#pdfPreview').hide();
        $('#pdfPreview').attr('src', base_url + "/assets/pdf/accounting/" + filename + ".pdf?" + Math.round(Math.random() * 1000000) ).on('load', function() {
            $('.dataLoader').remove();
            $('#pdfPreview').show();
        });
    }

    // Report Config Script
    $('#reportSettingsForm').submit(function(event) {
        event.preventDefault();
        renderReportList();
        showTableLoader();
    });

    // Page Orientation Config Script
    $('#pageOrientation').change(function(event) {
        renderReportList();
        showTableLoader();
    });

    // Header Repeat Config Script
    $('#pageHeaderRepeat').change(function(event) {
        renderReportList();
        showTableLoader();
    });

    // Fetch Report Notes On Page Load
    $.ajax({
        type: "POST",
        url: base_url + "/accounting_controllers/reports/getNotes",
        data: { reportID: REPORT_ID, },
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
            url: base_url + "/accounting_controllers/reports/saveNotes",
            data: { 
                reportID: REPORT_ID,
                reportNotes: $("#NOTES").val(),
            },
            success: function(data) {
                $(".noteSaveButton").removeAttr('disabled').html('Save');
                $("#notesContent").show();
                $("#addNotesForm").hide();
                renderReportList();
                showTableLoader();
            }
        });
    });

    // Email Report Script
    $('#sendEmailForm').submit(function(event) {
        event.preventDefault();
        $(".sendEmail").attr('disabled', '').empty().append('<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Send');
        var emailTo = $("#emailTo").val();
        var emailCC = $("#emailCC").val();
        var emailSubject = "<?php echo $companyInfo->business_name ?> - " + $("#emailSubject").val();
        var emailBody = CKEDITOR.instances['emailBody'].getData();
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
            url: base_url + "/AccountingMailer/emailReport/" + REPORT_CATEGORY,
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
        var filePath = base_url + "/assets/pdf/accounting/" + filename + ".pdf";
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
        var filePath = base_url + "/assets/pdf/accounting/" + filename + ".xlsx";
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

    $('.settingsApplyButton').click(function (e) { 
        applyTextRangeDate();
    });

    function showTableLoader() {
        if (reportTables.includes(currentTable)) {
            window.setDataTable.destroy();
            $("#<?php echo $tableID; ?> > tbody").html('<tr><td colspan="' + theadColumnNames.length + '"><center><div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Fetching Result... </center></td></tr>');
        }
    }

    function applyTextRangeDate() {
        let dateFromNumeric = $('input[name="date_from"]').val();
        let dateFromWordDate = new Date(dateFromNumeric).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: '2-digit' });
        $('#date_from_text').text(dateFromWordDate);
        // ==================
        let dateToNumeric = $('input[name="date_to"]').val();
        let dateToWordDate = new Date(dateToNumeric).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: '2-digit' });
        $('#date_to_text').text(dateToWordDate);
    } applyTextRangeDate();

    $(document).on('click', '.collapse-row', function(){
        var target = $(this).data("bs-target");
        $(this).find("i").toggleClass("bx-caret-down bx-caret-right");
    });
</script>