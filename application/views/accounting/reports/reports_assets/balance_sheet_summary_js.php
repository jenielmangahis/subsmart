<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const reportTitleElem = document.getElementById('reportTitle');
        const reportTable = document.getElementById('reportTable');
        const compactDisplayCheckbox = document.getElementById('display');
        const applyButton = document.querySelector('.settingsApplyButton');
        const filterDateElem = document.getElementById('filter-date');
        const balanceSheetDateElem = document.getElementById('balance-sheet-date');
        const balanceSheetTitleElem = document.getElementById('balance-sheet-title');
        const reportNameInput = document.getElementById('report_name');

        const applyCompactStyle = () => {
            if (compactDisplayCheckbox.checked) {
                reportTable.classList.add('compact-table');
                localStorage.setItem('compactState', 'true');
            } else {
                reportTable.classList.remove('compact-table');
                localStorage.setItem('compactState', 'false');
            }
        };

        const loadCompactState = () => {
            const compactState = localStorage.getItem('compactState');
            if (compactState === 'true') {
                compactDisplayCheckbox.checked = true;
                reportTable.classList.add('compact-table');
            } else {
                compactDisplayCheckbox.checked = false;
                reportTable.classList.remove('compact-table');
            }
        };

        const setLoading = (isLoading) => {
            if (isLoading) {
                applyButton.textContent = 'Applying Changes...';
                applyButton.disabled = true;
            } else {
                applyButton.textContent = 'Apply';
                applyButton.disabled = false;
            }
        };

        const saveDateToLocalStorage = () => {
            const currentDate = filterDateElem.value;
            localStorage.setItem('reportDate', currentDate);
            updateBalanceSheetDate(currentDate);
        };

        const loadDateFromLocalStorage = () => {
            const storedDate = localStorage.getItem('reportDate');
            if (storedDate) {
                filterDateElem.value = storedDate;
                updateBalanceSheetDate(storedDate);
            } else {
                const currentDate = new Date().toISOString().split('T')[0];
                filterDateElem.value = currentDate;
                updateBalanceSheetDate(currentDate);
            }
        };

        const updateBalanceSheetDate = (dateString) => {
            const date = new Date(dateString);
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = date.toLocaleDateString(undefined, options);
            balanceSheetDateElem.textContent = `As of ${formattedDate}`;
        };

        const saveSettings = () => {
            setLoading(true);

            const newTitle = reportTitleElem.value;
            const isCompact = compactDisplayCheckbox.checked ? 1 : 0;

            $.ajax({
                url: base_url + 'accounting/reports/_update_title',
                type: 'POST',
                data: {
                    report_id: REPORT_ID,
                    title: newTitle,
                    compact: isCompact,
                    date: filterDateElem.value
                },
                dataType: 'json',
                success: function(response) {
                    setLoading(false);

                    if (response.is_success === 1) {
                        document.querySelector('.company-name').textContent = newTitle;
                        applyCompactStyle();
                        saveDateToLocalStorage();
                        saveReportNameToLocalStorage(); 
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            html: 'An unknown error occurred.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    setLoading(false);

                    console.error('AJAX Error:', status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: 'An error occurred while making the AJAX request. Please try again.'
                    });
                },
            });
        };

        const saveReportNameToLocalStorage = () => {
            const reportName = reportNameInput.value;
            localStorage.setItem('reportName', reportName);
            updateBalanceSheetTitle(reportName);
        };

        const loadReportNameFromLocalStorage = () => {
            const storedReportName = localStorage.getItem('reportName');
            if (storedReportName) {
                reportNameInput.value = storedReportName;
                updateBalanceSheetTitle(storedReportName);
            }
        };

        const updateBalanceSheetTitle = (title) => {
            balanceSheetTitleElem.textContent = title || 'Balance Sheet Summary';
        };

        document.getElementById('reportSettingsForm').addEventListener('submit', function(event) {
            event.preventDefault();
            saveSettings();
        });

        loadCompactState();
        loadDateFromLocalStorage();
        loadReportNameFromLocalStorage();
    });

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

    // var currentDate = new Date().toISOString().split('T')[0];
    // document.getElementById('filter-date').value = currentDate;

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