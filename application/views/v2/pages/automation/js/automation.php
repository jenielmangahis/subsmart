<script type="text/javascript">
    <?php
        $options = get_automation_options();
    ?>
    const eventOptions = <?php echo json_encode($options['eventOptions']); ?>;
    const targetOptions =   <?php echo json_encode($options['targetOptions']); ?>;
    const actionOptions =   <?php echo json_encode($options['actionOptions']); ?>;
    const timeOptions =  <?php echo json_encode($options['timeOptions']); ?>;
    const timingOptions =<?php echo json_encode($options['timingOptions']); ?>;
    const dateOptions =  <?php echo json_encode($options['dateOptions']); ?>;
    const automationConfig =     <?php echo json_encode(get_automation_email_config()); ?>;

    $(document).ready(function() {
        let selectedAutomationId = "";
        let selectedStatus = "";
        let selectedType = "";
        let selectedEvent = "";
        let selectedTarget = "";
        let selectedAction = "";
        let selectedTime = "";
        let selectedTiming = "";
        let selectedDate = "";
        let selectedTitle = "";
        let emailSubject = "";
        let emailBody = "";
        let activeAutoTemplate = "";
        let selectedEntity = "";
        let selectedOperation = "";
        let operationOptions = ["send", "create"];

        const extractStatuses = (statusArray) =>
        statusArray
            .filter((item) => item.status) // Remove any empty or falsy status values
            .reduce((acc, item) => {
            acc[item.status] = item.status; // Dynamically set key-value pairs in the accumulator object
            return acc;
            }, {});

        const leadStatus = extractStatuses(<?php echo json_encode($lead_status); ?>);
        const jobStatus = extractStatuses(<?php echo json_encode($job_status); ?>);

        const statusOptions = {
            lead: {'New': 'New','Contacted': 'Contacted','Follow Up' : 'Follow Up','Converted' : 'Converted','Closed': 'Closed'},
            job: {'Draft': 'Draft','Scheduled': 'Scheduled','Arrival': 'Arrival','Started': 'Started','Approved': 'Approved','Finished': 'Finished','Cancelled': 'Cancelled','Invoiced': 'Invoiced','Completed': 'Completed'},
        };

        console.log(leadStatus)

        function setupDropdownToggle(dropdownBtnId, dropdownMenuId) {
            $(dropdownBtnId).on("click", function () {
                if(selectedEntity == "" && dropdownBtnId == '#operationDropdownBtn'){ //do not toggle unless entity is set
                    return;
                }
                toggleDropdown(dropdownMenuId);
                closeDropdownsExcept(dropdownMenuId);
            });
        }

        setupDropdownToggle("#entityDropdownBtn", "#entityDropdownMenu");
        setupDropdownToggle("#timeDropdownBtn", "#timeDropdownMenu");
        setupDropdownToggle("#eventDropdownBtn", "#eventDropdownMenu");
        setupDropdownToggle("#statusDropdownBtn", "#statusDropdownMenu");
        setupDropdownToggle("#operationDropdownBtn", "#operationDropdownMenu");
        setupDropdownToggle("#targetDropdownBtn", "#targetDropdownMenu");
        setupDropdownToggle("#actionDropdownBtn", "#actionDropdownMenu");
        setupDropdownToggle("#dateDropdownBtn", "#dateDropdownMenu");

          $(document).on("click", function (event) {
            // Check if the click is outside any dropdown button or menu
            if (!$(event.target).closest('.timeline-item').length) {
                $(".dropdown-menu").hide(); // Hide all dropdowns
            }
        });
      
        // Populate Dropdowns
        function populateDropdown(menuId, options, selectedValue, className, buttonId) {
            if (!options) return; 

            $(buttonId).text(options[selectedValue] || selectedValue);

            $(menuId).empty();
            Object.entries(options).forEach(([value, text]) => {
                $(menuId).append(
                `<li class="list-group-item ${className} cursor-pointer ${selectedValue == value ? "active" : ""}" data-value="${value}">${text}</li>`,
                );
            });

            $(`.${className}`).on("click", function () {
                const selectedVal = $(this).data("value");
                $(buttonId).text(options[selectedVal] || selectedValue);
                $(buttonId).addClass("primary").removeClass("secondary");
                $(menuId).hide();
                $(`${menuId} .${className}`).removeClass("active");
                $(this).addClass("active");

                updateSelectedValues(menuId, selectedVal)

                if (menuId == "#eventDropdownMenu") {
                handleEventItemClick();
                }

                if (menuId == "#actionDropdownMenu") {
                populateEmailModal("automation_msg", "#addEmail");
                }
            });
        }

        function populateModal(data) {
            console.log(data);
            if (data) {
                selectedStatus = data.status ? data.status
                    : Object.values(statusOptions[data.entity])[0];
                selectedTitle = data.title;
                selectedTarget = data.target;
                selectedAction = data.action;
                selectedTime = data.time;
                selectedTiming = data.timing;
                selectedDate = data.date;
                selectedEvent = data.event;
                selectedEntity = data.entity;
                selectedOperation = 'send';

                console.log(selectedStatus)

                const template = generateEmailTemplate(data.target);
                if (template) {
                    const { subject, body } = template;
                    emailSubject = subject;
                    emailBody = body;
                }
             
            }

            //first
            handleFirstParagraph(selectedEntity);

            //second 
            $("#operationDropdownBtn").text(selectedOperation || "do this");
            if (selectedOperation) { //only display the rest of the sentence if there selectedOperation is not empty
                populateOperationDropdown(selectedEntity);
                handleSecondParagraph();
                setActiveTimelineItem();
            }

            $("#addAutomation").modal("show");
        }

        function handleFirstParagraph() {
            let entity =
                selectedEntity != "" ? determineArticle(selectedEntity) : "this happens";
            $("#entityDropdownBtn").text(entity);
            populateEventDropdown(selectedEntity);
            handleEventItemClick();
        }

        function handleSecondParagraph() {
            $(".target-dropdown-container").removeClass("d-none");
            $(".action-dropdown-container").removeClass("d-none");
            $(".time-dropdown-container").removeClass("d-none");

            populateDropdown(
                "#targetDropdownMenu",
                targetOptions,
                selectedTarget || "someone",
                "target-item",
                "#targetDropdownBtn",
            );
            populateDropdown(
                "#actionDropdownMenu",
                actionOptions,
                selectedAction || "a reminder",
                "action-item",
                "#actionDropdownBtn",
            );
            populateTimeDropdownBtn(selectedEntity);

             if (selectedDate && selectedTime > 0) {
                $(".date-dropdown-container").removeClass("d-none");
            }
            
            populateDropdown(
                "#dateDropdownMenu",
                dateOptions,
                selectedDate || "date",
                "date-item",
                "#dateDropdownBtn",
            );

            
        }

        function populateEventDropdown(entity) {
            const item = eventOptions[entity];
            if (entity) {
                $(".event-dropdown-container").removeClass("d-none");
            }
            if (item) {
                populateDropdown(
                "#eventDropdownMenu",
                item,
                selectedEvent,
                "event-item-2",
                "#eventDropdownBtn",
                );
            }
        }

        function populateStatusDropdown(entity) {
            const item = statusOptions[entity]; // Get status options for the selected entity
            selectedStatus = selectedStatus ? selectedStatus : Object.values(statusOptions[entity])[0];

            if (item) {
                populateDropdown(
                "#statusDropdownMenu",
                item,
                selectedStatus,
                "status-item",
                "#statusDropdownBtn",
                );
            }
        }

        function populateOperationDropdown(entity) {
            // Clear the operation dropdown menu
            $("#operationDropdownMenu").empty();

            // Iterate over the statuses object and populate the dropdown
            let operationItem = ["send", "create"];

            operationItem.forEach((value) => {
                if (value !== "create" || entity === "job") {
                // Only include "create" if entity is "job"
                $("#operationDropdownMenu").append(
                    `<li class="list-group-item operation-item cursor-pointer ${selectedOperation === value ? "active" : ""}" data-value="${value}">${value}</li>`,
                );
                }
            });
           
        }

        function populateTimeDropdownBtn(entity) {
            //if no selected time set text to default
            //if selected time is 0 set text to immediately
            //if selected time > 0 set text to selectedTime (20 minutes) + selectedTiming (after) (eg. 20 minutes after)
            if(selectedTime == ""){
                text = "within a defined time";
            }else{
                text = selectedTime == 0 ? formatTriggerTime(selectedTime) : formatTriggerTime(selectedTime) + " " + timingOptions[selectedTiming];
            }

            $("#timeDropdownBtn").text(text);
        }

        function populateEmailModal(ckId, modalId) {
            document.querySelector('[name="subject"]').value = emailSubject;
            document.getElementById("automation_msg").value = emailBody;
            if (CKEDITOR.instances[ckId]) {
                CKEDITOR.instances[ckId].setData(emailBody);
            } else {
                console.error(`CKEditor instance with id "${ckId}" not found.`);
            }

            $(modalId).modal("show");
        }

        function openAutomationModal(mode, data = null) {
            const $modal = $("#addAutomation");
            const $addButton = $("#submitAutomation");
            const $editButton = $("#editAutomation");

            if (mode === "edit") {
                //hide add automation button, show edit button
                $editButton.removeClass("d-none");
                $addButton.addClass("d-none");

                if (data) { //open the modal with their data
                    $("#automation_title").val(data.title || "");
                    populateModal(data);
                }
            } else {
                //show add automation button, hide edit button
                $addButton.removeClass("d-none");
                $editButton.addClass("d-none");

                //clear fields //open an empty modal
                $("#automation_title").val("");
                resetAutomationModal();
                populateModal(data);
            }
        }

        function resetAutomationModal() {
            selectedStatus = "";
            selectedType = "";
            selectedEvent = "";
            selectedTarget = "someone";
            selectedAction = "a reminder";
            selectedTime = "";
            selectedTiming = "after";
            selectedDate = "";
            selectedTitle = "";
            emailSubject = "";
            emailBody = "";
            activeAutoTemplate = "";
            selectedEntity = "";
            selectedOperation = "";

            $(".event-dropdown-container").addClass("d-none");
            $(".status-dropdown-container").addClass("d-none");
            $(".target-dropdown-container").addClass("d-none");
            $(".action-dropdown-container").addClass("d-none");
            $(".time-dropdown-container").addClass("d-none");
            $(".date-dropdown-container").addClass("d-none");
        }

        function updateSelectedValues(menuId, value) {
            console.log('menuId', menuId)
            if (menuId === "#eventDropdownMenu") {
                selectedEvent = value;
            } else if (menuId === "#statusDropdownMenu") {
                selectedStatus = value;
            } else if (menuId === "#targetDropdownMenu") {
                selectedTarget = value;
            } else if (menuId === "#actionDropdownMenu") {
                selectedAction = value;
            } else if (menuId === "#operationDropdownMenu") {
                selectedOperation = value;
            } else if (menuId === "#dateDropdownMenu") {
                selectedDate = value;
            }
        }

        // Handle button selection and toggling
        function handleTimeClick(name, clickedButton) {
            $(name)
                .removeClass("nsm-button primary")
                .addClass("nsm-button-outlined primary");
            $(clickedButton)
                .removeClass("nsm-button-outlined primary")
                .addClass("nsm-button primary");
        }

        function handleEventItemClick() {
            if (selectedEvent === "has_status") {
                $(".status-dropdown-container").removeClass("d-none");
                populateStatusDropdown(selectedEntity);
            } else {
                $(".status-dropdown-container").addClass("d-none");
            }
        }

        // Close all dropdowns except the one passed as argument
        function closeDropdownsExcept(except) {
            $(".dropdown-menu").not(except).slideUp("fast"); // Close all other dropdowns
        }

        // Close all dropdowns
        function closeDropdowns() {
            $(".dropdown-menu").slideUp("fast"); // Close all open dropdowns
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

          // Handle entity and event selection
        $(".entity-event-item").on("click", function () {
            selectedEntity = $(this).data("type");
            selectedEvent = $(this).data("value");

            $("#entityDropdownBtn").text(determineArticle(selectedEntity));
            $("#entityDropdownMenu").hide();

            populateEventDropdown(selectedEntity);
            handleEventItemClick();
            populateOperationDropdown(selectedEntity);
            $(".event-dropdown-container").removeClass("d-none");
        });

        // Handle operation item click using event delegation
        $(document).on("click", ".operation-item", function () {
            console.log($(this));
            selectedOperation = $(this).data("value");

            // Update the button text with the selected operation
            $("#operationDropdownBtn").text(selectedOperation);
            $("#operationDropdownBtn").addClass("primary");
            $("#operationDropdownMenu").hide();

            handleSecondParagraph();
        });


        // Time and Timing selection logic
        $(".time-btn").on("click", function () {
            handleTimeClick(".time-btn", this);
            selectedTime = $(this).data("value");
            
            if(selectedTime > 0){ //highlight timing-btn if selectedTime is NOT immediately
                $(".timing-btn").each(function () {
                    if ($(this).data('value') == selectedTiming) {
                        handleTimeClick(".timing-btn", this);
                    }
                });
            }

            let text = selectedTime == 0 ? formatTriggerTime(selectedTime) :  formatTriggerTime(selectedTime) + " " + selectedTiming;
            $("#timeDropdownBtn").text(text);
            $("#timeDropdownBtn").addClass("primary").removeClass("secondary");

            if(selectedTime > 0){ //show if selectedTime to send is NOT immediately
                $(".date-dropdown-container").removeClass("d-none");
            }else{
                $(".date-dropdown-container").addClass("d-none");

            }
        });

        
        // Timing selection logic

        $(".timing-btn").on("click", function () {
            handleTimeClick(".timing-btn", this);
            selectedTiming = $(this).data("value");
            let text =
                formatTriggerTime(selectedTime) + " " + timingOptions[selectedTiming];
            $("#timeDropdownBtn").text(text);
            $(".date-dropdown-container").removeClass("d-none");
        });

        $(".timeline-item").on("click", function () {
            setActiveTimelineItem(this.id);
        });

        $("#automation_title").on("change", function () {
            selectedTitle = $(this).val();
        });

        $(".reminder-item").on("click", function () {
            let action = $(this).data("onclick");
            let value = $(this).data("value");
            let type = $(this).data("type");

            if (value) {
                // Set the value of the input field inside the modal
                $('input[type="text"].nsm-field').val(value);
                selectedTitle = value;
                activeAutoTemplate = type;
            }
            if (action) {
                eval(action);
            }
        });

        $(".preview-message").on("click", function () {
            populateEmailModal("automation_msg", "#addEmail");
        });

        $("#emailForm").on("submit", function (e) {
            e.preventDefault();

            const messageContent = CKEDITOR.instances["automation_msg"].getData(); // Fetch the CKEditor content
            $('textarea[name="message"]').val(messageContent); // Update the textarea value

            let formData = $(this).serializeArray();
            emailBody = formData.find((field) => field.name === "message").value;
            emailSubject = formData.find((field) => field.name === "subject").value;

            // Close modal or perform further actions
            $("#addEmail").modal("hide");
        });

        $(".preview-automation").click(function (e) {
            e.preventDefault();
            const automationId = $(this).data("id");

            // Fetch automation details via AJAX
            $.ajax({
                url: '<?php echo base_url("automation/getAutomation") ?>',
                type: "POST",
                data: { id: automationId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        let data = response.data[0];
                        document.querySelector('[name="preview_subject"]').value =
                        data.email_subject;
                        document.getElementById("preview_automation_msg").value =
                        data.email_body;
                        CKEDITOR.instances.preview_automation_msg.setData(data.email_body);

                        $("#previewEmail").modal("show");
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Missing fields!",
                            text: response.message || "Failed to fetch automation details.",
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Missing fields!",
                        text: "An error occurred while fetching automation details."
                    });
                },
            });
        });

        $(".edit-automation").click(function (e) {
            e.preventDefault();
            const automationId = $(this).data("id");
            console.log(automationId)

            // Fetch automation details via AJAX
            $.ajax({
                url: '<?php echo base_url("automation/getAutomation") ?>',
                type: "POST",
                data: { id: automationId },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        let data = response.data[0];
                        selectedAutomationId = data.id;

                        emailSubject = data.email_subject;
                        emailBody = data.email_body;

                        automationData = {
                        status: data.trigger_status,
                        target: data.target,
                        action: data.trigger_action,
                        time: data.trigger_time,
                        timing: data.timing_reference,
                        date: data.date_reference,
                        event: data.trigger_event,
                        entity: data.entity,
                        title: data.title,
                        };

                        setActiveTimelineItem();
                        openAutomationModal("edit", automationData);
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Missing fields!",
                            text: response.message || "Failed to fetch automation details."
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: "error",
                        title: "Missing fields!",
                        text: "An error occurred while fetching automation details."
                    });
                },
            });
        });

        $("#submitAutomation").click(async function (e) {
            e.preventDefault();
            let scheduledForm = $(this);

            const automationData = {
                title: selectedTitle,
                entity: selectedEntity,
                trigger_event: selectedEvent,
                trigger_status: selectedEvent == "has_status" ? selectedStatus : "", // For non-status triggers
                trigger_time: selectedTime, // 2 hours in minutes
                trigger_action: selectedAction,
                target: selectedTarget,
                date_reference: selectedDate,
                timing_reference: selectedTiming,
                email_subject: emailSubject,
                email_body: emailBody,
                status: "active",
            };

            console.log(automationData);

            // Check for missing fields
            const missingFields = getMissingFields(automationData);
            if (missingFields.length > 0) {

                Swal.fire({
                    icon: "error",
                    title: "Missing fields!",
                    text: `Please fill in the following fields: ${missingFields.join(", ")}`,
                });
                return; // Stop further execution
            }

            let message = {
                icon: "success",
                title: "Automation",
                body: "Automation has been successfully saved.",
            };
            let res = await sendPost(
                automationData,
                "/Automation/saveAutomation",
                message,
                true,
            );
        });

        $("#editAutomation").click(async function (e) {
            e.preventDefault();
            let scheduledForm = $(this);

            const automationData = {
                title: selectedTitle,
                entity: selectedEntity,
                trigger_event: selectedEvent,
                trigger_status: selectedEvent == "has_status" ? selectedStatus : "", // For non-status triggers
                trigger_time: selectedTime, // 2 hours in minutes
                trigger_action: selectedAction,
                target: selectedTarget,
                date_reference: selectedDate,
                timing_reference: selectedTiming,
                email_subject: emailSubject,
                email_body: emailBody,
                id: selectedAutomationId,
            };

            console.log(automationData);

            // Check for missing fields
            const missingFields = getMissingFields(automationData);
            if (missingFields.length > 0) {
                Swal.fire({
                    icon: "error",
                    title: "Missing fields!",
                    text: `Please fill in the following fields: ${missingFields.join(", ")}`,
                    });
                return; // Stop further execution
            }

            let message = {
                icon: "success",
                title: "Automation",
                body: "Automation has been successfully updated.",
            };
            let res = await sendPost(
                automationData,
                "/Automation/updateAutomation",
                message,
                true,
            );
            selectedAutomationId = "";
        });

         $(".delete-automation").click(function (e) {
            e.preventDefault();

            var automationId = $(this).data("id");

             Swal.fire({
                title: 'Are you sure?',
                title: 'Delete Automation',
                html: "Are you sure you want to delete this automation?",
                icon: 'question',
                confirmButtonText: 'Proceed',
                showCancelButton: true,
                cancelButtonText: "Cancel"
                })
                .then(async (result) => {
                    if (result.isConfirmed) {
                        let automationData = {id: automationId}
                        let message = {
                            icon: "success",
                            title: "Automation",
                            body: "Automation has been successfully deleted.",
                        };
                        let res = await sendPost(
                            automationData,
                            "/Automation/deleteAutomation",
                            message,
                            true,
                        );
                            
                    } 
                });
        });

         $("#addAutomationBtn").click(function (e) {
            openAutomationModal("add");
        });

        function sendPost(data, url, message, isReload = false) {
            return new Promise((resolve, reject) => {
                $.ajax({
                type: "POST",
                url: BASE_URL + url,
                data: data,
                dataType: "JSON",
                beforeSend: function () {
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
                success: function (response) {
                    formDisabler(data, false);
                    Swal.fire({
                    icon: message.icon,
                    title: message.title,
                    html: message.body,
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                    }).then((result) => {
                        
                        location.reload(); 

                    });
                    resolve(response); // Resolve the promise with the response
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error:", error, xhr, status);
                    Swal.fire({
                    icon: "error",
                    title: "Error!",
                    html: "Something went wrong. Try Again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                    });
                    formDisabler(data, false);
                    reject(error); // Reject the promise with the error
                },
                });
            });
        }

        $(".process-auto").click(function (e) {
            e.preventDefault();
            const automationData = {};

            let message = {
                icon: "success",
                title: "Automation",
                body: "Automation has been successfully saved.",
            };

            let res = sendPost(
                automationData,
                "/Automation/processQueuedAutomations",
                message,
            );
        });

        $(".toggle-automation").change(function () {
            var automationId = $(this).data("id");
            var status = $(this).prop("checked") ? "active" : "inactive";

            let data = {
                id: automationId,
                status: status,
            };
            let message = {
                icon: "success",
                title: "Success!",
                body: "Automation has been updated.",
            };
            let res = sendPost(data, "/Automation/toggleAutomationStatus", message, true);
        });

       

       

        function getMissingFields(data) {
            let missingFields = [];
            Object.entries(data).forEach(([key, value]) => {
                
                // Skip `trigger_status` if `trigger_event` is not 'has_status'
                if (key === "trigger_status" && data.trigger_event !== "has_status") {
                    return;
                }

                // Skip `timing_reference` and `date_reference` if `trigger_time` is 0
                if (
                    (key == "timing_reference" || key == "date_reference" || key ==="trigger_time") &&
                    data.trigger_time == 0
                ) {
                    return;
                }


                if (!value) {
                    missingFields.push(key); // Add missing field to the list
                }
            });
            return missingFields;
        }

        function typeIcon(type) {
            const icons = {
                lead: "bx-group",
                job: "bx-briefcase",
                estimate: "bx-file",
                invoice: "bx-receipt",
            };
            return icons[type] || "bx-file";
        }

        function determineArticle(type) {
            return /^[aeiou]/i.test(type) ? `an ${type}` : `a ${type}`;
        }

        function setActiveTimelineItem(itemId = null) {
            if (itemId) {
                $(`#${itemId}`).addClass("active");
                return;
            }
            $(".timeline-item").addClass("active");
        }

        // DYNAMIC DISPLAY OF SELECTION

        function formatTriggerTime(triggerTime) {
            if (triggerTime >= 1440) {
                // 1440 minutes = 1 day
                const days = Math.floor(triggerTime / 1440);
                return days + " day" + (days > 1 ? "s" : "");
            }
            if (triggerTime >= 60) {
                // 60 minutes = 1 hour
                const hours = Math.floor(triggerTime / 60);
                return hours + " hour" + (hours > 1 ? "s" : "");
            }

            if (triggerTime == 0) {
                return 'immediately';
            }

            return triggerTime + " minute" + (triggerTime > 1 ? "s" : "");
        }

        //AUTOMATION TEMPLATE

        function generateEmailTemplate(recipient) {
            let automationType = activeAutoTemplate;

            const recipientType = recipient;
            if (
                !automationConfig[automationType] ||
                !automationConfig[automationType].templates[recipientType]
            ) {
                console.error("Invalid automation type or recipient.");
                return null;
            }

            const { subject, body } =
                automationConfig[automationType].templates[recipientType];

            return {
                subject,
                body,
            };
        }

        if (CKEDITOR.instances["automation_msg"]) {
         CKEDITOR.instances["automation_msg"].destroy(true);
        }

        CKEDITOR.replace("automation_msg", {
            height: 250,
            toolbarGroups: [
                {
                name: "document",
                groups: ["mode", "document"],
                },
                {
                name: "clipboard",
                groups: ["clipboard", "undo"],
                },
                "/",
                {
                name: "basicstyles",
                groups: ["basicstyles", "cleanup"],
                },
                {
                name: "links",
                },
            ],
        });

        if (CKEDITOR.instances["preview_automation_msg"]) {
         CKEDITOR.instances["preview_automation_msg"].destroy(true);
        }

        CKEDITOR.replace("preview_automation_msg", {
            height: 250,
            toolbarGroups: [
                "/",
                {
                name: "basicstyles",
                groups: ["basicstyles", "cleanup"],
                },
            ],
        });

    })
</script>