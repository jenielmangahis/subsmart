<script type="text/javascript">
    var REPORT_ID = 18;  
    var REPORT_CATEGORY = "accounts_receivable_aging_summary";
    var theadTotalColumn = $("#balance-sheet-comparison").find('tr:first th').length;
    var businessLogoURL = 'uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image"; ?>';
    var businessName = $('input[name="company_name"]').val();
    var reportName = $('input[name="report_name"]').val();
    var reportDate = $("#reportDate").text();
    var filename = (businessName + '_' + reportName).replace(/[^\p{L}\p{N}_-]+/gu, '_');
    var notes = $("#notesContent").text();

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('editButton').addEventListener('click', function() {
            var businessNameElem = document.getElementById('businessName');
            var companyNameSpan = businessNameElem.querySelector('.company-name');
            var originalName = companyNameSpan.textContent;

            var inputElem = document.createElement('input');
            inputElem.type = 'text';
            inputElem.value = originalName;
            inputElem.className = 'company-name-input';

            var saveButton = document.createElement('button');
            saveButton.type = 'button';
            saveButton.className = 'nsm-button primary';
            saveButton.textContent = 'Save';

            var cancelButton = document.createElement('button');
            cancelButton.type = 'button';
            cancelButton.className = 'nsm-button';
            cancelButton.textContent = 'Cancel';

            var buttonContainer = document.createElement('div');
            buttonContainer.className = 'button-group';
            buttonContainer.appendChild(saveButton);
            buttonContainer.appendChild(cancelButton);

            businessNameElem.innerHTML = '';
            businessNameElem.appendChild(inputElem);
            businessNameElem.appendChild(buttonContainer);

            inputElem.focus();

            saveButton.addEventListener('click', function() {
                var newTitle = inputElem.value;

                $.ajax({
                    url: base_url + 'accounting/reports/_update_title', //for update title
                    type: 'POST',
                    data: {
                        report_id: REPORT_ID,
                        title: newTitle
                    },
                    dataType:'json',
                    success: function(response) {
                        if (response.is_success == 1) {
                            businessNameElem.innerHTML = '<span class="company-name">' + newTitle + '</span>';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                html: 'An unknown error occurred.'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: 'An error occurred while making the AJAX request. Please try again.'
                        });
                    }
                });
            });

            cancelButton.addEventListener('click', function() {
                businessNameElem.innerHTML = '<span class="company-name">' + originalName + '</span>';
            });
        });
    });

    // Show/hide script
    document.querySelector('.addNotes').addEventListener('click', function(event) {
        document.getElementById("notesContent").style.display = "none";
        document.getElementById("addNotesForm").style.display = "block";
        document.getElementById("NOTES").focus();
    });

    document.getElementById('cancelNotes').addEventListener('click', function(event) {
        document.querySelector(".addNotes").focus();
        document.getElementById("notesContent").style.display = "block";
        document.getElementById("addNotesForm").style.display = "none";
    });

    // Realtime character counter on report notes.
    document.getElementById("NOTES").addEventListener('input', function() {
        let textLength = document.getElementById("NOTES").value.length;
        document.querySelector(".noteCharMax").textContent = textLength + " / 4000 characters max";
    });

    // Fetch Report Notes On Page Load
    fetch(base_url + "/accounting_controllers/reports/getNotes", {
            method: "POST",
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                reportID: REPORT_ID
            })
        })
        .then(response => response.text())
        .then(data => {
            document.querySelector('.addNotes').textContent = (data !== "") ? 'Edit Notes' : 'Add Notes';
            document.getElementById('notesContent').innerHTML = data;
            document.getElementById("NOTES").value = data;
        });

    // Add and Edit Notes Script
    document.getElementById('addNotesForm').addEventListener('submit', function(event) {
        event.preventDefault();
        document.querySelector(".noteSaveButton").setAttribute('disabled', '');
        document.querySelector(".noteSaveButton").innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Saving notes...';
        document.getElementById('notesContent').innerHTML = document.getElementById("NOTES").value;
        document.querySelector('.addNotes').textContent = (document.getElementById("NOTES").value !== "") ? 'Edit Notes' : 'Add Notes';

        fetch(base_url + "/accounting_controllers/reports/saveNotes", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams({
                    reportID: REPORT_ID,
                    reportNotes: document.getElementById("NOTES").value
                })
            })
            .then(response => response.text())
            .then(data => {
                document.querySelector(".noteSaveButton").removeAttribute('disabled');
                document.querySelector(".noteSaveButton").innerHTML = 'Save';
                document.getElementById("notesContent").style.display = "block";
                document.getElementById("addNotesForm").style.display = "none";
            });
    });

    function generatePDF(preview = false, orientation, generate_pdf) {
        var table = document.querySelector('.nsm-table');
        var companyName = document.querySelector('.company-name').textContent;
        var reportTitle = "Balance Sheet";
        var reportDate = "As of " + new Date().toLocaleDateString();

        html2canvas(table, {
            onrendered: function(canvas) {
                var imgData = canvas.toDataURL('image/png');
                var {
                    jsPDF
                } = window.jspdf;
                var pdf = new jsPDF(orientation, 'pt', 'a4');

                var imgWidth = 555;
                var pageHeight = 792;
                var imgHeight = canvas.height * imgWidth / canvas.width;
                var heightLeft = imgHeight;

                var margin = 20;
                var yOffset = 80;

                // Add header
                pdf.setFontSize(18);
                pdf.text(companyName, pdf.internal.pageSize.getWidth() / 2, margin, {
                    align: 'center'
                });

                pdf.setFontSize(16);
                pdf.text(reportTitle, pdf.internal.pageSize.getWidth() / 2, margin + 20, {
                    align: 'center'
                });

                pdf.setFontSize(14);
                pdf.text(reportDate, pdf.internal.pageSize.getWidth() / 2, margin + 40, {
                    align: 'center'
                });

                pdf.setLineWidth(0.5);
                pdf.line(margin, margin + 50, pdf.internal.pageSize.getWidth() - margin, margin + 50);

                // Add table
                pdf.addImage(imgData, 'PNG', margin, yOffset, imgWidth, imgHeight);
                heightLeft -= pageHeight - yOffset;

                var pageNumber = 1;
                pdf.setFontSize(10);
                pdf.text('Page ' + String(pageNumber), pdf.internal.pageSize.getWidth() - margin - 30, pageHeight - 30);

                while (heightLeft >= 0) {
                    pageNumber++;
                    yOffset = heightLeft - imgHeight;
                    pdf.addPage();
                    // Re-add header
                    pdf.setFontSize(18);
                    pdf.text(companyName, pdf.internal.pageSize.getWidth() / 2, margin, {
                        align: 'center'
                    });

                    pdf.setFontSize(16);
                    pdf.text(reportTitle, pdf.internal.pageSize.getWidth() / 2, margin + 20, {
                        align: 'center'
                    });

                    pdf.setFontSize(14);
                    pdf.text(reportDate, pdf.internal.pageSize.getWidth() / 2, margin + 40, {
                        align: 'center'
                    });

                    pdf.setLineWidth(0.5);
                    pdf.line(margin, margin + 50, pdf.internal.pageSize.getWidth() - margin, margin + 50);

                    pdf.addImage(imgData, 'PNG', margin, margin + 60, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                    pdf.setFontSize(10);
                    pdf.text('Page ' + String(pageNumber), pdf.internal.pageSize.getWidth() - margin - 30, pageHeight - 30);
                }

                if (preview) {
                    var pdfData = pdf.output('datauristring');
                    document.getElementById('pdfPreview').src = pdfData;
                    showPDFModal();
                } else {
                    var pdfData = pdf.output('datauristring');
                    document.getElementById('pdfPreview').src = pdfData;                    
                }

                if( generate_pdf ){
                    pdf.save('balance_sheet_comparison.pdf');
                }
            }
        });
    }

    function previewPDF() {
        generatePDF(true, 'p', false);
        closeModal();
    }

    function closeModal() {
        var modalElement = document.getElementById('printPreviewModal');
        var modal = bootstrap.Modal.getInstance(modalElement);
        modal.hide();
    }

    function showPDFModal() {
        var modal = new bootstrap.Modal(document.getElementById('printPreviewModal'));
        modal.show();
    }

    // Load .pdf Report Script
    function loadReportPreview() {
        $('#pdfPreview').hide();
        $('#pdfPreview').attr('src', base_url + "/assets/pdf/accounting/" + filename + ".pdf?" + Math.round(Math.random() * 1000000)).on('load', function() {
            $('.dataLoader').remove();
            $('#pdfPreview').show();
        });
    }

    document.getElementById('printPreviewModal').addEventListener('hide.bs.modal', function() {
        var modalBackdrop = document.querySelector('.modal-backdrop');
        if (modalBackdrop) {
            modalBackdrop.parentNode.removeChild(modalBackdrop);
        }
    });

    // Page Orientation Config Script
    $('#pageOrientation').change(function(event) {
        var orientation = $(this).val();
        generatePDF(false, orientation, false);
        //renderReportList();
    });

    // Render Report Data Script
    function renderReportList() {
        theadColumnNames = $(`#balance-sheet-comparison th`).map(function() {
            return $(this).text();
        }).get();
        theadTotalColumn = $("#balance-sheet-comparison").find('tr:first th').length;
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
            $('#businessLogo').attr('src', base_url + '/uploads/users/business_profile/<?php echo "$companyInfo->id/$companyInfo->business_image?"; ?>' + Math.round(Math.random() * 1000000)).show();
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
            url:  base_url + "/accounting_controllers/Reports/getReportData/" + REPORT_CATEGORY,
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
                $("#balance-sheet-comparison > tbody").html(data);
                $(".settingsApplyButton").removeAttr('disabled').html('Apply');
                // $('#reportSettings').modal('hide');
            }
        });
    }

    // Export Report to PDF Script
    $(".savePDF").click(function(event) {
        var orientation = $('#pageOrientation').val();
        generatePDF(false, orientation, true);
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
            var emailBody = $("#emailBody").html();
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
                url: base_url + "AccountingMailer/emailReport/" + REPORT_CATEGORY,
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
</script>