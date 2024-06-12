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
</script>