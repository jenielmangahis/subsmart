<script type="text/javascript">
    // balance_sheet_summary_js.php
    document.addEventListener('DOMContentLoaded', function() {
        const reportTitleElem = document.getElementById('reportTitle');
        const displayDensityElem = document.getElementById('displayDensity');
        const reportTable = document.getElementById('reportTable');
        const settingsApplyButton = document.querySelector('.settingsApplyButton');

        const saveDisplayDensitySetting = (value) => {
            localStorage.setItem('displayDensity', value);
        };

        const loadDisplayDensitySetting = () => {
            const savedDensity = localStorage.getItem('displayDensity');
            if (savedDensity) {
                displayDensityElem.value = savedDensity;
                applyDisplayDensity(savedDensity);
            }
        };

        const applyDisplayDensity = (density) => {
            if (density === '0') {
                reportTable.classList.add('compact-table');
            } else {
                reportTable.classList.remove('compact-table');
            }
        };

        const saveTitle = () => {
            const newTitle = reportTitleElem.value;

            settingsApplyButton.disabled = true;
            settingsApplyButton.innerHTML = '<div class="spinner-border spinner-border-sm" role="status"></div>&nbsp;&nbsp;Applying changes...';

            $.ajax({
                url: base_url + 'accounting/reports/_update_title',
                type: 'POST',
                data: {
                    report_id: REPORT_ID,
                    title: newTitle
                },
                dataType: 'json',
                success: function(response) {
                    if (response.is_success === 1) {
                        saveDisplayDensitySetting(displayDensityElem.value);
                        location.reload();
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
                },
                complete: function() {
                    settingsApplyButton.disabled = false;
                    settingsApplyButton.innerHTML = 'Apply';
                }
            });
        };

        document.getElementById('reportSettingsForm').addEventListener('submit', function(event) {
            event.preventDefault();
            saveTitle();
        });

        displayDensityElem.addEventListener('change', function() {
            applyDisplayDensity(this.value);
        });

        loadDisplayDensitySetting();
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
<style>
    .compact-table td,
    .compact-table th {
        padding: 4px 8px;
        font-size: 12px;
    }
</style>