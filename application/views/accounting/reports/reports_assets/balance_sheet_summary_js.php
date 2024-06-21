<script type="text/javascript">
    // balance_sheet_summary_js.php
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
                    url: base_url + 'accounting/reports/_update_title',
                    type: 'POST',
                    data: {
                        report_id: REPORT_ID,
                        title: newTitle
                    },
                    dataType: 'json',
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

    var BASE_URL = window.location.origin;
    var REPORT_ID = "<?php echo $reportTypeId; ?>";

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
</script>