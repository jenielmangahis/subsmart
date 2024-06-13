<script type="text/javascript">
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
    fetch(BASE_URL + "/accounting_controllers/reports/getNotes", {
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

        fetch(BASE_URL + "/accounting_controllers/reports/saveNotes", {
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