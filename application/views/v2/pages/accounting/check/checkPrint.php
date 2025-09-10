<div class="container" id="contentPage1">
    <h1>Sample UI for PDF - Page 1</h1>
    <p>This is the content for the first page...</p>
    <div style="background-color: lightcoral; padding: 10px; margin-top: 15px;">
        This is a distinct section for Page 1.
    </div>
</div>

<div class="container" id="contentPage2" style="display:none;">
    <h1>Sample UI for PDF - Page 2</h1>
    <p>This is the content for the second page...</p>
    <div style="background-color: lightgreen; padding: 10px; margin-top: 15px;">
        This is a distinct section for Page 2.
    </div>
</div>

<!-- Modal -->
<div id="pdfModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>PDF Preview</h3>
            <button id="closeModal">✖</button>
        </div>
        <div class="modal-body">
            <iframe id="pdfPreview"></iframe>
        </div>
        <div class="modal-footer">
            <button id="savePdf">Save PDF</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var generatedPdfBlob = null;

        var pdfSettings = {
            margin: [1, 1, 1, 1],
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 3 },
            jsPDF: { unit: 'mm', format: [215.9, 330.2], orientation: 'landscape' },
        };

        function showPdfModal(pdfBlob, filename) {
            generatedPdfBlob = { blob: pdfBlob, filename: filename };
            var url = URL.createObjectURL(pdfBlob);
            $("#pdfPreview").attr("src", url);
            $("#pdfModal").fadeIn();
        }

        $("#closeModal").on("click", function() {
            $("#pdfModal").fadeOut();
            $("#pdfPreview").attr("src", ""); 
            if (generatedPdfBlob) {
                URL.revokeObjectURL(generatedPdfBlob.blob);
                generatedPdfBlob = null;
            }
        });

        $("#savePdf").on("click", function() {
            if (generatedPdfBlob) {
                var link = document.createElement("a");
                link.href = URL.createObjectURL(generatedPdfBlob.blob);
                link.download = generatedPdfBlob.filename;
                link.click();
            }
        });

        $("#generateSinglePagePdf").on("click", function() {
            var element = document.getElementById("contentPage1");
            var options = { ...pdfSettings };
            var filename = "single-page-ui.pdf";

            html2pdf().from(element).set(options).outputPdf("blob").then(function(pdfBlob) {
                showPdfModal(pdfBlob, filename);
            });
        });

        $("#generateTwoPagePdf").on("click", function() {
            var tempPrintContainer = $("<div></div>");
            tempPrintContainer.append($("#contentPage1").clone());
            tempPrintContainer.append('<div class="page-break"></div>');
            tempPrintContainer.append($("#contentPage2").clone().show());
            $("body").append(tempPrintContainer);

            var options = { ...pdfSettings };
            var filename = "two-page-ui.pdf";

            html2pdf().from(tempPrintContainer[0]).set(options).outputPdf("blob").then(function(pdfBlob) {
                showPdfModal(pdfBlob, filename);
                tempPrintContainer.remove();
            });
        });
    });
</script>
