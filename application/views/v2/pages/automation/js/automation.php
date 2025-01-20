<script type="text/javascript">
    <?php
$options = get_automation_options();
?>
    const eventOptions = <?php echo json_encode($options['eventOptions']); ?>;
    const targetOptions =   <?php echo json_encode($options['targetOptions']); ?>;
    const actionOptions =   <?php echo json_encode($options['actionOptions']); ?>;
    const timeOptions =  <?php echo json_encode($options['timeOptions']); ?>;
    const timingOptions =<?php echo json_encode($options['timingOptions']); ?>;
    const dateOptions =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <?php echo json_encode($options['dateOptions']); ?>;
    const automationConfig =                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         <?php echo json_encode(get_automation_email_config()); ?>;

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
        let selectedEntity = '';
        let selectedOperation = '';
        let operationOptions = ["send", "create"]

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

        function setupDropdownToggle(dropdownBtnId, dropdownMenuId) {
            $(dropdownBtnId).on('click', function () {
            console.log(dropdownMenuId)
                toggleDropdown(dropdownMenuId);
                closeDropdownsExcept(dropdownMenuId);
            });
        }

        setupDropdownToggle('#entityDropdownBtn', '#entityDropdownMenu');
        setupDropdownToggle('#timeDropdownBtn', '#timeDropdownMenu');
        setupDropdownToggle('#eventDropdownBtn', '#eventDropdownMenu');
        setupDropdownToggle('#statusDropdownBtn', '#statusDropdownMenu');
        setupDropdownToggle('#operationDropdownBtn', '#operationDropdownMenu');
        setupDropdownToggle('#targetDropdownBtn', '#targetDropdownMenu');
        setupDropdownToggle('#actionDropdownBtn', '#actionDropdownMenu');
        setupDropdownToggle('#dateDropdownBtn', '#dateDropdownMenu');

        // Handle entity and event selection
        $(".entity-event-item").on("click", function () {
            selectedEntity = $(this).data("type");
            selectedEvent = $(this).data("value");
            $("#entityDropdownBtn").text(determineArticle(selectedEntity));
            populateEventDropdown(selectedEntity);
            populateOperationDropdown(selectedEntity);
            $("#entityDropdownMenu").hide();
            $(".event-dropdown-container").show();
            handleEventClick();
        });

        // Populate Dropdowns
        function populateDropdown(menuId, options, selectedValue, className, buttonId) {
            if (!options) return; // Check if options are null or undefined
            
            $(buttonId).text(options[selectedValue] || selectedValue);

            $(menuId).empty();
            Object.entries(options).forEach(([value, text]) => {
                $(menuId).append(
                    `<li class="list-group-item ${className} cursor-pointer ${selectedValue == value ? 'active' : ''}" data-value="${value}">${text}</li>`
                );
            });

            $(`.${className}`).on("click", function () {
                const selected = $(this).data("value");
                $(buttonId).text(options[selected] || selectedValue);
                $(buttonId).addClass('primary');
                $(menuId).hide();
                $(`${menuId} .${className}`).removeClass('active');
                $(this).addClass('active');

                if (menuId === '#eventDropdownMenu') {
                    selectedEvent = selected;
                } else if (menuId === '#statusDropdownMenu') {
                    selectedStatus = selected;
                } else if (menuId === '#targetDropdownMenu') {
                    selectedTarget = selected;
                } else if (menuId === '#actionDropdownMenu') {
                    selectedAction = selected;
                } else if (menuId === '#operationDropdownMenu') {
                    selectedOperation = selected;
                } else if (menuId === '#dateDropdownMenu') {
                    selectedDate = selected;
                }

                if(menuId == '#eventDropdownMenu'){
                 handleEventClick()

                }
            });
        }



        function populateModal(data) {
            console.log(data)
             const template = generateEmailTemplate(data.target);

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
            selectedStatus = Object.values(statusOptions[data.entity])[0];
            selectedTarget = data.target;
            selectedAction = data.action;
            selectedTime = data.time;
            selectedTiming = data.timing;
            selectedDate = data.date;
            selectedEvent = data.event
            selectedEntity = data.entity
            selectedOperation = 'send'

            //first
            $("#entityDropdownBtn").text(determineArticle(selectedEntity));
            populateEventDropdown(selectedEntity);
            handleEventClick()

            //second
            $("#operationDropdownBtn").text(selectedOperation);
            populateOperationDropdown(selectedEntity);
            handleSecondParagraph()

            setActiveTimelineItem();
            $('#addAutomation').modal('show');
        }

            console.log(eventOptions)


         function populateEventDropdown(entity) {
            console.log(entity)
            const item = eventOptions[entity];
            if (item) {
                populateDropdown('#eventDropdownMenu', item, selectedEvent, 'event-item-2', '#eventDropdownBtn');
            }
        }
      
        function populateStatusDropdown(entity) {
            const item = statusOptions[entity]; // Get status options for the selected entity
            selectedStatus = Object.values(statusOptions[entity])[0];

            if (item) {
                populateDropdown('#statusDropdownMenu', item, selectedStatus, 'status-item', '#statusDropdownBtn');
            }
        }

         function populateOperationDropdown(entity) {
            // Clear the operation dropdown menu
            $('#operationDropdownMenu').empty();

            // Iterate over the statuses object and populate the dropdown
            let operationItem = ["send", "create"]

              operationItem.forEach(value => {
                if (value !== "create" || entity === "job") { // Only include "create" if entity is "job"
                    $('#operationDropdownMenu').append(
                        `<li class="list-group-item operation-item cursor-pointer ${selectedOperation === value ? 'active' : ''}" data-value="${value}">${value}</li>`
                    );
                }
            });


           // Handle operation item click
            $(".operation-item").on("click", function () {
                selectedOperation = $(this).data("value");

                // Update the button text with the selected operation
                $("#operationDropdownBtn").text(selectedOperation);
                $(this).addClass('active');
                

                handleSecondParagraph()
            });
        }

        function handleSecondParagraph(){
            $('#operationDropdownBtn').addClass('primary');
            $("#operationDropdownMenu").hide();
            $('.operation-item').removeClass('active'); 

            $(".target-dropdown-container").removeClass('d-none');
            $(".action-dropdown-container").removeClass('d-none');
            $(".time-dropdown-container").removeClass('d-none');
            $(".date-dropdown-container").removeClass('d-none');

            populateDropdown('#targetDropdownMenu', targetOptions, selectedTarget, 'target-item', '#targetDropdownBtn');
            populateDropdown('#actionDropdownMenu', actionOptions, selectedAction, 'action-item', '#actionDropdownBtn');
            populateTimeDropdown(selectedEntity)
            populateDropdown('#dateDropdownMenu', dateOptions, selectedDate, 'date-item', '#dateDropdownBtn');
        }

        // Time and Timing selection logic
        $('.time-btn').on('click', function () {
            handleTimeClick('.time-btn', this);
            selectedTime = $(this).data("value");
            $(".timing-btn").each(function() {
                if ($(this).text() == selectedTiming) {
                    handleTimeClick('.timing-btn', this);
                }
            });
            let text = formatTriggerTime(selectedTime) + ' ' + selectedTiming;
            $("#timeDropdownBtn").text(text);
            $('#timeDropdownBtn').addClass('primary');
        });

        $('.timing-btn').on('click', function () {
            handleTimeClick('.timing-btn', this);
            selectedTiming = $(this).text();
            let text = formatTriggerTime(selectedTime) + ' ' + selectedTiming;
            $("#timeDropdownBtn").text(text);
        });

        // Handle button selection and toggling
        function handleTimeClick(name, clickedButton) {
            $(name).removeClass('nsm-button primary').addClass('nsm-button-outlined primary');
            $(clickedButton).removeClass('nsm-button-outlined primary').addClass('nsm-button primary');
        }

         function handleEventClick(){
            if (selectedEvent === 'has_status') {
                $(".status-dropdown-container").removeClass('d-none');
                populateStatusDropdown(selectedEntity);
            } else {
                $(".status-dropdown-container").addClass('d-none');
            }
        }

        function populateTimeDropdown(entity) {
            let text = selectedTime ? formatTriggerTime(selectedTime) + ' ' + timingOptions[selectedTiming] : "within a defined time"
            $("#timeDropdownBtn").text(text);
        }


        // Close all dropdowns except the one passed as argument
        function closeDropdownsExcept(except) {
            $('.dropdown-menu').not(except).slideUp("fast"); // Close all other dropdowns
        }

        // Close all dropdowns
        function closeDropdowns() {
            $('.dropdown-menu').slideUp("fast"); // Close all open dropdowns
        }

        // Toggle the visibility of a specific dropdown
        function toggleDropdown(dropdown) {
            const isOpen = $(dropdown).is(":visible");

            if (isOpen) {
                $(dropdown).slideUp("fast");
            } else {
                $(dropdown).slideDown("fast");
            }
        }




        $(document).on('click', '.timeline-item', function() {
            setActiveTimelineItem(this.id);
        });

        $(document).on('click', '#workflowMenuAccordion', function(event) {
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


        function typeIcon(type) {
            const icons = {
                lead: "bx-group",
                job: "bx-briefcase",
                estimate: "bx-file",
                invoice: "bx-receipt"
            };
            return icons[type] || "bx-file";
        }


        function determineArticle(type) {
            return /^[aeiou]/i.test(type) ? `an ${type}` :  `a ${type}`;
        }



        function setActiveTimelineItem(itemId = null) {
            if (itemId) {
                $(`#${itemId}`).addClass('active');
                return;
            }
            $('.timeline-item').addClass('active');
        }

        // DYNAMIC DISPLAY OF SELECTION

        function formatTriggerTime(triggerTime) {
            if (triggerTime >= 1440) { // 1440 minutes = 1 day
                const days = Math.floor(triggerTime / 1440);
                return days + " day" + (days > 1 ? "s" : "");
            }
            if (triggerTime >= 60) { // 60 minutes = 1 hour
                const hours = Math.floor(triggerTime / 60);
                return hours + " hour" + (hours > 1 ? "s" : "");
            }

            return triggerTime + " minute" + (triggerTime > 1 ? "s" : "");
        }

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