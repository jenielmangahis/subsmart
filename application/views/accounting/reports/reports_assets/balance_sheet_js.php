<script type="text/javascript">
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
                var newName = inputElem.value;

                $.ajax({
                    url: baseUrl + 'accounting_controllers/Reports/update_business_name',
                    type: 'POST',
                    data: {
                        business_name: newName
                    },
                    success: function(response) {
                        console.log(response);
                        try {
                            var result = JSON.parse(response);
                            console.log('test', result);
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
                        console.error('AJAX Error:', status, error);
                        alert('An error occurred while making the AJAX request. Please try again.');
                    }
                });
            });

            cancelButton.addEventListener('click', function() {
                businessNameElem.innerHTML = '<span class="company-name">' + originalName + '</span>';
            });
        });
    });
</script>