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

            // saveButton.addEventListener('click', function() {
            //     var newName = inputElem.value;
            //     // Send AJAX request to update the business name
            //     $.ajax({
            //         url: baseUrl + 'accounting/reports/update_business_name',
            //         type: 'POST',
            //         data: {
            //             business_name: newName
            //         },
            //         success: function(response) {
            //             // Handle success
            //             businessNameElem.innerHTML = newName;
            //             alert('Business name updated successfully!');
            //         },
            //         error: function(xhr, status, error) {
            //             // Handle error
            //             console.error('AJAX Error:', status, error);
            //             alert('An error occurred while updating the business name.');
            //         }
            //     });
            // });

            cancelButton.addEventListener('click', function() {
                businessNameElem.innerHTML = originalName;
            });
        });
    });
</script>