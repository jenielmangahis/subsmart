<script type="text/javascript">
    // balance_sheet_summary_js.php
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('editButton').addEventListener('click', function() {
            var businessNameElem = document.querySelector('.company-name');
            var originalName = businessNameElem.textContent;

            var inputElem = document.createElement('input');
            inputElem.type = 'text';
            inputElem.value = originalName;
            inputElem.className = 'company-name-input';

            var buttonContainer = document.createElement('div');
            buttonContainer.className = 'button-group';

            var saveButton = document.createElement('button');
            saveButton.type = 'button';
            saveButton.textContent = 'Save';
            saveButton.className = 'nsm-button primary save-button';

            var cancelButton = document.createElement('button');
            cancelButton.type = 'button';
            cancelButton.textContent = 'Cancel';
            cancelButton.className = 'nsm-button cancel-button';

            businessNameElem.innerHTML = '';
            businessNameElem.appendChild(inputElem);
            businessNameElem.appendChild(buttonContainer);
            buttonContainer.appendChild(saveButton);
            buttonContainer.appendChild(cancelButton);

            inputElem.focus();

            saveButton.addEventListener('click', function() {
                var newName = inputElem.value;
                var clientId = document.getElementById('client_id').value;

                $.ajax({
                    url: baseUrl + 'accounting_controllers/Reports/update_clients_name',
                    type: 'POST',
                    data: {
                        client_id: clientId,
                        business_name: newName
                    },
                    success: function(response) {
                        console.log(response);
                        try {
                            var result = JSON.parse(response);
                            if (result.status === 'success') {
                                businessNameElem.innerHTML = '<span class="company-name">' + newName + '</span>';
                            } else {
                                alert(result.message || 'An unknown error occurred.');
                            }
                        } catch (e) {
                            console.error('Error parsing JSON response', e);
                            alert('An error occurred while processing the response. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', xhr.status, xhr.responseText, status, error);
                        alert('An error occurred while making the AJAX request. Please try again.');
                    }
                });
            });

            cancelButton.addEventListener('click', function() {
                businessNameElem.innerHTML = originalName;
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