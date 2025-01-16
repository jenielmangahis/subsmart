<script type="text/javascript">
    const eventOptions =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 <?php echo json_encode($options['eventOptions']); ?>;
    const targetOptions =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo json_encode($options['targetOptions']); ?>;
    const actionOptions =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo json_encode($options['actionOptions']); ?>;
    const timeOptions =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php echo json_encode($options['timeOptions']); ?>;
    const timingOptions =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   <?php echo json_encode($options['timingOptions']); ?>;
    const dateOptions =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <?php echo json_encode($options['dateOptions']); ?>;
    const automationConfig =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php echo json_encode(get_automation_email_config()); ?>;

    $(document).ready(function() {

        let selectedStatus = 'Approved';
        let selectedType = '';
        let selectedEvent = '';
        let selectedTarget = 'someone';
        let selectedAction = 'a reminder';
        let selectedTime = 'within a defined time';
        let selectedTiming = 'after';
        let selectedDate = 'date';
        let selectedTitle = '';
        let emailSubject = '';
        let emailBody = '';
        let activeAutoTemplate = ''

        $(document).on('click', '.timeline-item', function() {
            setActiveTimelineItem(this.id);
        });

        $(document).on('click', '#workflowMenuAccordion', function(event) {
            console.log('test')
            event.preventDefault();
            event.stopPropagation();
        });

        $(document).on('click', '.task-item', function() {
            const value = $(this).data('value');
            displaySecondParagraphSelection(value);
        });

        $('#automation_title').on('change', function() {
            selectedTitle = $(this).val();
        });

        $(document).on('click', '.reminder-item', function() {
            var action = $(this).data('onclick');
            var value = $(this).data('value');
            var type = $(this).data('type');
            if (value) {
                // Set the value of the input field inside the modal
                $('input[type="text"].nsm-field').val(value);
                selectedTitle = value
                activeAutoTemplate = type
            }
            if (action) {
                eval(action);
            }
        });

        $(document).on('click', '.preview-message', function() {
            //autopolate subject and body
            document.querySelector('[name="subject"]').value = emailSubject;
            document.getElementById('automation_msg').value = emailBody;
            CKEDITOR.instances.automation_msg.setData(emailBody);

            $('#addEmail').modal('show');

        });

        $(document).on('submit', '#emailForm', function(e) {
            console.log('close')
            e.preventDefault();

            let formData = $(this).serializeArray();
            console.log(formData)
            emailBody = formData.find(field => field.name === 'message').value;
            emailSubject = formData.find(field => field.name === 'subject').value;

            // Close modal or perform further actions
            $('#addEmail').modal('hide');
        });

        $('.preview-automation').click(function(e) {
            e.preventDefault();
            const automationId = $(this).data('id');

            // Fetch automation details via AJAX
            $.ajax({
                url: '<?php echo base_url("automation/getAutomation") ?>',
                type: 'POST',
                data: { id: automationId },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        let data = response.data[0]
                        console.log(data)
                        document.querySelector('[name="preview_subject"]').value = data.email_subject;
                        document.getElementById('preview_automation_msg').value = data.email_body;
                        CKEDITOR.instances.preview_automation_msg.setData(data.email_body);

                        $('#previewEmail').modal('show');
                    } else {
                        alert(response.message || 'Failed to fetch automation details.');
                    }
                },
                error: function () {
                    alert('An error occurred while fetching automation details.');
                }
            });
        });

        $('.edit-automation').click(function(e) {
            e.preventDefault();
            const automationId = $(this).data('id');

            // Fetch automation details via AJAX
            $.ajax({
                url: '<?php echo base_url("automation/getAutomation") ?>',
                type: 'POST',
                data: { id: automationId },
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        let data = response.data[0]
                        selectedStatus =data.trigger_status;
                        selectedTarget = data.target;
                        selectedAction = data.trigger_action;
                        selectedTime = data.trigger_time;
                        selectedTiming = data.timing_reference;
                        selectedDate = data.date_reference;
                        selectedEvent = data.trigger_event
                        type = data.entity
                        selectedTitle = data.title

                        emailSubject = data.email_subject;
                        emailBody = data.email_body;

                        $("#automation_title").val(selectedTitle)

                        setActiveTimelineItem();
                        $('#addAutomation').modal('show');

                        displayFirstParagraphSelection(type, selectedEvent);
                        displaySecondParagraphSelection('send');


                    } else {
                        alert(response.message || 'Failed to fetch automation details.');
                    }
                },
                error: function () {
                    alert('An error occurred while fetching automation details.');
                }
            });
        });


        $('#submitAutomation').click(function(e) {
            e.preventDefault();
            let scheduledForm = $(this);

            const automationData = {
                title: selectedTitle,
                entity: selectedType,
                trigger_event: selectedEvent,
                trigger_status: selectedEvent == 'has_status' ? selectedStatus : null, // For non-status triggers
                trigger_time: selectedTime, // 2 hours in minutes
                trigger_action: selectedAction,
                target: selectedTarget,
                date_reference: selectedDate,
                timing_reference: selectedTiming,
                email_subject: emailSubject,
                email_body: emailBody,
                status: 'active'
            };

            console.log(automationData)

             let message = {
                icon: 'success',
                title: 'Automation Saved!',
                body: 'Automation has been saved.'
            }
            let res = sendPost(automationData, "/Automation/saveAutomation", message )
            if(res) {
                $('#addAutomation').modal('hide');
                location.reload();
            }
        });

        $('.trigger-auto').click(function(e) {
            e.preventDefault();
            const automationData = {

            };
            $.ajax({
                type: "POST",
                url: BASE_URL + "/Automation/triggerAutomations",
                data: automationData,
                dataType: "JSON",
                beforeSend: function() {
                    formDisabler(automationData, true);
                    Swal.fire({
                        icon: "info",
                        title: "Saving Automation!",
                        html: "Please wait while the process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    console.log('response')
                    console.log(response)
                    $('#emailForm')[0].reset();
                    formDisabler(automationData, false);
                    Swal.fire({
                        icon: "success",
                        title: "Automation Saved!",
                        html: "Automation has been saved.",
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });

                    return response;
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        html: "An unexpected error occurred: " + error,
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                    formDisabler(automationData, false);
                },
            });
        });

        $('.process-auto').click(function(e) {
            e.preventDefault();
            const automationData = {
            };

            let message = {
                icon: 'success',
                title: 'Automation Saved!',
                body: 'Automation has been saved.'
            }

           let res = sendPost(automationData, "/Automation/processQueuedAutomations", message )

        });

        $('.toggle-automation').change(function() {
            var automationId = $(this).data('id');
            var status = $(this).prop('checked') ? 'active' : 'inactive';

            let data= {
                    id: automationId,
                    status: status
                }
            let message = {
                icon: 'success',
                title: 'Success!',
                body: 'Automation has been updated.'
            }
            let res = sendPost(data, "/Automation/toggleAutomationStatus", message )
            $('#flexSwitchCheck' + automationId).prop('checked', !$('#flexSwitchCheck' + automationId).prop('checked'));
        });

        $('.delete-automation').click(function(e) {
            e.preventDefault();

            var automationId = $(this).data('id');

            if (confirm('Are you sure you want to delete this automation?')) {
                $.ajax({
                    url: BASE_URL + "/Automation/deleteAutomation",
                    method: 'POST',
                    data: {
                        id: automationId
                    },
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert('Automation deleted successfully!');
                            location.reload();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    },
                    error: function() {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });

        function sendPost(data, url, message){
            $.ajax({
                type: "POST",
                url: BASE_URL + url,
                data: data,
                dataType: "JSON",
                beforeSend: function() {
                    formDisabler(data, true);
                    Swal.fire({
                        icon: "info",
                        title: "Processing!",
                        html: "Please wait while the process is running...",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    formDisabler(data, false);
                    Swal.fire({
                        icon: message.icon,
                        title: message.title,
                        html: message.body,
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        html: "An unexpected error occurred: " + error,
                        showConfirmButton: true,
                        confirmButtonText: "Okay",
                    });
                    formDisabler(data, false);
                },
            });
        }

        const extractStatuses = (statusArray) =>
            statusArray
            .filter(item => item.status) // Remove any empty or falsy status values
            .reduce((acc, item) => {
                acc[item.status] = item.status; // Dynamically set key-value pairs in the accumulator object
                return acc;
            }, {});

        const leadStatus = extractStatuses(<?php echo json_encode($lead_status); ?>);
        const jobStatus = extractStatuses(<?php echo json_encode($job_status); ?>);

        const statusOptions = {
            lead: leadStatus,
            job: jobStatus
        };

        const recipientMapping = {
            1: "assigned tech",
            2: "client",
            3: "to user",
        };

        function typeIcon(type) {
            const icons = {
                lead: "bx-group",
                job: "bx-briefcase",
                estimate: "bx-file",
                invoice: "bx-receipt"
            };
            return icons[type] || "bx-file";
        }

        function preventDropdownClose(event) {
            event.stopPropagation(); // Prevents the dropdown from closing
        }

        function determineArticle(type) {
            return /^[aeiou]/i.test(type) ? "an" : "a";
        }

        function appendElement(parentNode, elementName, className, text) {
            const $element = $(`<${elementName} class="${className}">${text}</${elementName}>`);
            parentNode.append($element);
        }

        function clearAppendedElements(dropdownToggleId, className) {
            $(`${dropdownToggleId}`).parent().find(className).remove();
        }

        function updateSelectedValue({
            value,
            dropdownId,
            category
        }) {
            $(`#${dropdownId}`).text(value);
            const dropdownItemId = `${category}-${value}`;
            updateDropdownActiveClass(dropdownId, dropdownItemId);
        }

        function setActiveTimelineItem(itemId = null) {
            if (itemId) {
                $(`#${itemId}`).addClass('active');
                return;
            }
            $('.timeline-item').addClass('active');
        }

        // DYNAMIC DISPLAY OF SELECTION


        // eg. When a lead has a status of new
        function displayFirstParagraphSelection(type, event) {
            selectedType = type || '';

            const $parentNode = $('#workflowMenuBtn').parent();

            // Clear previously appended elements
            clearAppendedElements('#workflowMenuBtn', '.added-first-paragraph');
            clearAppendedElements('#taskMenuBtn', '.added-second-paragraph');

            // Update the text of the original dropdown
            $('#workflowMenuBtn').text(`${determineArticle(type)} ${type}`);

            // Append event dropdown
            createDropdown({
                parentNode: $parentNode,
                category: 'event',
                options: eventOptions,
                value: eventOptions[type][selectedEvent],
                dropdownId: 'eventDropdown',
                className: 'added-first-paragraph',
                type: type,
                callback: function(selected) {
                    selectedEvent = selected
                    displayFirstParagraphSelection(type, selected);
                }
            });

            // Append status dropdown if type is LEAD OR JOB
            if (selectedEvent === 'has_status' && (type === 'lead' || type === 'job')) {
                appendElement($parentNode, 'span', 'h4 fw-bold added-first-paragraph me-2 nsm-text secondary', 'of');
                createDropdown({
                    parentNode: $parentNode,
                    category: 'status',
                    options: statusOptions,
                    value: statusOptions[type][selectedStatus] || 'new',
                    dropdownId: 'statusDropdown',
                    className: 'added-first-paragraph',
                    type: type,
                    callback: function(selected) {
                        selectedStatus = selected;
                    }
                });
            }
        }

        // eg. send assigned tech a text message 10 minutes after the lead end date
        function displaySecondParagraphSelection(task) {
            const $parentNode = $('#taskMenuBtn').parent();

            // Clear previously appended elements
            clearAppendedElements('#taskMenuBtn', '.added-second-paragraph');

            // Update the text of the original dropdown
            $('#taskMenuBtn').text(task).removeClass('secondary').addClass('primary');

            let className = 'added-second-paragraph';
            createDropdown({
                parentNode: $parentNode,
                category: 'target',
                options: targetOptions,
                value: targetOptions[selectedTarget] || 'someone',
                dropdownId: 'targetDropdown',
                className: className,
                callback: function(selected) {
                    selectedTarget = selected;
                }
            });
            createDropdown({
                parentNode: $parentNode,
                category: 'action',
                options: actionOptions,
                value: actionOptions[selectedAction] || 'a reminder',
                dropdownId: 'actionDropdown',
                className: className,
                callback: function(selected) {
                    selectedAction = selected;
                    $('#addEmail').modal('show');
                }
            });
            createDropdown({
                parentNode: $parentNode,
                category: 'time',
                options: timeOptions,
                value: timeOptions[selectedTime] || 'within a defined time',
                dropdownId: 'timeDropdown',
                className: className,
                callback: function(selected) {
                    selectedTime = selected;
                    displaySecondParagraphSelection(task)
                }
            });
            if (selectedTime !== '0') {
                createDropdown({
                    parentNode: $parentNode,
                    category: 'timing',
                    options: timingOptions,
                    value: timingOptions[selectedTiming] || 'ahead of',
                    dropdownId: 'timingDropdown',
                    className: className,
                    callback: function(selected) {
                        selectedTiming = selected;
                    }
                });
                appendElement($parentNode, 'span', `h4 fw-bold added me-2 nsm-text secondary ${className}`, `the ${selectedType}`);
                createDropdown({
                    parentNode: $parentNode,
                    category: 'date',
                    options: dateOptions,
                    value: dateOptions[selectedDate] || 'date',
                    dropdownId: 'dateDropdown',
                    className: className,
                    callback: function(selected) {
                        selectedDate = selected;
                    }
                });
            }
        }

        /**
         * Creates and appends a dropdown menu to the specified parent node with selectable options.
         *
         * @param {Object} params - An object containing the following properties:
         * @param {HTMLElement} parentNode - The parent DOM element to which the dropdown will be appended.
         * @param {string} category - A string representing the category for the dropdown (e.g., 'action', 'status', 'task').
         * @param {Array|Object} options - The options to populate the dropdown with.
         *                                        If 'type' is specified, it is used to select a specific set of options from the 'options' object.
         *                                        If no 'type' is provided, the entire array of options is used.
         * @param {string} value - The current value that should be selected in the dropdown (e.g., 'new', 'completed').
         * @param {string} dropdownId - The unique identifier for the dropdown element
         * @param {string} className - The CSS class to apply to both the dropdowns.
         * @param {string|null} [params.type=null] - (Optional) A string key to select a subset of options from the 'options' object.
         *                                           If 'type' is provided, it will be used to select the corresponding set of options
         *                                           from the 'options' object (e.g., `options[type]`).
         */
        function createDropdown({
            parentNode,
            category,
            options,
            value,
            dropdownId,
            className,
            type = null,
            callback
        }) {

            const $toggle = createDropdownToggle(value, dropdownId, className);
            parentNode.append($toggle);

            const data = type ? options[type] : options
            const items = Object.entries(data).map(([optionValue, optionText]) => {
                const dropdownItemId = `${category}-${optionValue}`;
                const $item = createDropdownItem(optionValue, optionText, dropdownItemId, () => {
                    if (callback) {
                        callback(optionValue);
                    }

                    $toggle.text(optionText); //update text based on selected item
                    updateDropdownActiveClass(dropdownId, dropdownItemId); //add active class
                });
                return $item;
            });

            parentNode.append(createDropdownMenu(items, `${dropdownId}-Menu`, className));
        }

        function createDropdownToggle(text, id, className) {
            return $(`<a href="#" class="dropdown-toggle nsm-text primary h4 fw-bold me-2 ${className}" id="${id}" role="button" data-bs-toggle="dropdown" aria-expanded="false">${text}</a>`);
        }

        function createDropdownMenu(items, id, className) {
            const $container = $(`<div class="dropdown-menu ${className}" id="${id}" aria-labelledby="${id}"></div>`);
            items.forEach($item => $container.append($item));
            return $container;
        }

        function createDropdownItem(value, text, id, onClickCallback) {
            return $(`<a href="#" class="dropdown-item" data-value="${value}" id="${id}">${text}</a>`).on('click', () => {
                if (onClickCallback) {
                    onClickCallback(value);
                }
            });
        }

        function updateDropdownActiveClass(dropdownId, dropdownItemId) {
            $(`#${dropdownId}-Menu .dropdown-item`).removeClass('active')
                .filter(`#${dropdownItemId}`).addClass('active');
        }

        // Dynamic Accordion Initialization
        $("#workflowMenuAccordion").html(generateAccordion());

        function generateAccordion() {
            return Object.entries(eventOptions)
                .map(([type, options], index) => `
                    <div class="accordion-item" style="border: none !important;">
                        <h2 class="accordion-header" id="heading${index}">
                            <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapse${index}"
                                aria-expanded="false"
                                aria-controls="collapse${index}">
                                <i class='bx ${typeIcon(type)} me-3'></i> ${determineArticle(type)} ${type}
                            </button>
                        </h2>
                        <div
                            id="collapse${index}"
                            class="accordion-collapse collapse"
                            aria-labelledby="heading${index}"
                            data-bs-parent="#workflowMenuAccordion">
                            <div class="accordion-body">
                                <ul class="list-group list-group-flush">
                                    ${generateLi(type, options)}
                                </ul>
                            </div>
                        </div>
                    </div>
                `)
                .join("");
        }

        function generateLi(type, options) {
            return Object.entries(options) // Convert object to array of [key, value]
                .map(
                    ([value, text]) => `
                <li
                    class="list-group-item event-item cursor-pointer"
                    data-type="${type}"
                    data-event="${value}">
                    ${text}
                </li>
            `
                )
                .join("");
        }

        $(document).on('click', '.event-item', function() {
            const type = $(this).data('type');
            const event = $(this).data('event');
            selectedEvent = event

            displayFirstParagraphSelection(type, event);
        });

        //AUTOMATION TEMPLATE

        function generateEmailTemplate(recipient) {
            let automationType = activeAutoTemplate

            const recipientType = recipient
            if (!automationConfig[automationType] || !automationConfig[automationType].templates[recipientType]) {
                console.error("Invalid automation type or recipient.");
                return null;
            }

            const {
                subject,
                body
            } = automationConfig[automationType].templates[recipientType];

            return {
                subject,
                body
            };
        }

        function generateAutomationTemplate(type, event, recepient, action, time, timing, date) {
            const template = generateEmailTemplate(recepient);

            if (!template) {
                console.error("Failed to generate automation template.");
                return;
            }

            const {
                subject,
                body
            } = template;
            emailSubject = subject;
            emailBody = body;

            setActiveTimelineItem();
            $('#addAutomation').modal('show');

            selectedStatus = 'Approved';
            selectedTarget = recepient;
            selectedAction = action;
            selectedTime = time;
            selectedTiming = timing;
            selectedDate = date;
            selectedEvent = event

            displayFirstParagraphSelection(type, event);
            displaySecondParagraphSelection('send');
        }

        if (CKEDITOR.instances['automation_msg']) {
            CKEDITOR.instances['automation_msg'].destroy(true);
        }

        CKEDITOR.replace('automation_msg', {
            height: 250,
            toolbarGroups: [{
                    name: 'document',
                    groups: ['mode', 'document']
                },
                {
                    name: 'clipboard',
                    groups: ['clipboard', 'undo']
                },
                '/',
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup']
                },
                {
                    name: 'links'
                }
            ],
        });

        if (CKEDITOR.instances['preview_automation_msg']) {
            CKEDITOR.instances['preview_automation_msg'].destroy(true);
        }

        CKEDITOR.replace('preview_automation_msg', {
            height: 250,
            toolbarGroups: [
                '/',
                {
                    name: 'basicstyles',
                    groups: ['basicstyles', 'cleanup']
                },

            ],
        });


    })
</script>