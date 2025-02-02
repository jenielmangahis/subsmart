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
        let smsBody = "";
        let activeAutoTemplate = "";
        let selectedEntity = "";
        let selectedOperation = "";
        let operationOptions = ["send", "create"];
        let jobTypes = []; 
        let jobTags = []; 

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

        function handleDropdownText(menuId, buttonId, options, selectedVal){
            if(menuId == "#targetDropdownMenu"){
                if(selectedTarget == "user" || selectedVal == "user"){
                    let userName = <?php echo json_encode(logged('FName') . ' ' . logged('LName')); ?>;
                    $(buttonId).text(userName || selectedValue);
                }else{
                    $(buttonId).text(options[selectedVal] || selectedVal);
                }
            }else{
                $(buttonId).text(options[selectedVal] || selectedVal);
            }
        }
      
        // Populate Dropdowns
        function populateDropdown(menuId, options, selectedValue, className, buttonId) {
            if (!options) return; 

            $(buttonId).text(options[selectedValue] || selectedValue);
            handleDropdownText(menuId, buttonId, options, selectedValue)
            $(menuId).empty();
            Object.entries(options).forEach(([value, text]) => {
                if (value === "user") {
                    // "To User" dropdown with logged-in user
                    let userDropdown = `
                        <li class="list-group-item dropdown-submenu dropright ${className} ${selectedValue == value ? "active" : ""}" data-value="${value}">
                            <div href="#" class="dropdown-item dropdown-toggle" style="padding: 0px !important">${text}</div>
                            <ul class="dropdown-menu user-dropdown">
                                <li class="dropdown-item user-item cursor-pointer" data-value="<?php echo logged('id'); ?>">
                                    <?php echo logged('FName').' '.logged('LName'); ?>
                                </li>
                            </ul>
                        </li>`;

                    $(menuId).append(userDropdown);
                } else {
                    $(menuId).append(
                        `<li class="list-group-item ${className} cursor-pointer ${selectedValue == value ? "active" : ""}" data-value="${value}">${text}</li>`
                    );
                }
            });

            $(`.${className}`).on("click", function () {
                const selectedVal = $(this).data("value");
                // $(buttonId).text(options[selectedVal] || selectedValue);
                $(buttonId).addClass("primary").removeClass("secondary");
                $(menuId).hide();
                $(`${menuId} .${className}`).removeClass("active");
                $(this).addClass("active");

                updateSelectedValues(menuId, selectedVal)

                handleDropdownText(menuId, buttonId, options, selectedVal)


                if (menuId == "#eventDropdownMenu") {
                    handleEventItemClick();
                }

                if (menuId == "#actionDropdownMenu") {
                    if(selectedAction == "send_email"){
                        populateEmailModal("automation_msg", "#addEmail");
                    }
                    if(selectedAction == "send_sms"){
                        populateSmsModal("sms_automation_msg", "#addSms");
                    }
                }
            });
        }

        
        $(document).on("mouseenter", ".dropdown-submenu", function () {
            console.log('Hover In');
            $(this).children(".user-dropdown").css({
                display: "block",
                position: "absolute",
                top: 0,
                left: "100%",
                zIndex: 1000 
            });
        }).on("mouseleave", ".dropdown-submenu", function () {
            console.log('Hover Out');
            $(this).children(".user-dropdown").hide();
        });

        async function populateModal(data) {
            if (data) {
                selectedStatus = data.trigger_status 
                    ?? Object.values(statusOptions[data.entity] || {})[0] 
                    ?? null;
                selectedTitle = data.title;
                selectedTarget = data.target;
                selectedAction = data.trigger_action;
                selectedTime = data.trigger_time;
                selectedTiming = data.timing_reference;
                selectedDate = data.date_reference;
                selectedEvent = data.trigger_event;
                selectedEntity = data.entity;
                smsBody = data.sms_body;
                selectedOperation = 'send';
                conditions = data.conditions ? JSON.parse(data.conditions) : [];

                const template = generateEmailTemplate(data.target);
                if (template) {
                    const { subject, body } = template;
                    emailSubject = subject;
                    emailBody = body;
                    if(!smsBody){
                        smsBody = body;
                    }
                }

                console.log('smsBody', smsBody)
             
            }

            let tagData = await sendGet("/Automation/getJobTags");
            jobTags = tagData.data || [];
            typeData = await sendGet("/Automation/getJobTypes");
            jobTypes = typeData.data || [];

            //first
            handleFirstParagraph(selectedEntity);

            //second 
            $("#operationDropdownBtn").text(selectedOperation || "do this");
            if (selectedOperation) { //only display the rest of the sentence if there selectedOperation is not empty
                populateOperationDropdown(selectedEntity);
                handleSecondParagraph();
                setActiveTimelineItem();
            }

            renderConditions();

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

            
            populateTargetDropdown(selectedEntity)
            populateDropdown(
                "#actionDropdownMenu",
                actionOptions,
                selectedAction || "a reminder",
                "action-item",
                "#actionDropdownBtn",
            );
            populateTimeDropdownBtn(selectedEntity);

            
            
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

        function populateTargetDropdown(entity) {
            const item = targetOptions; // Get status options for the selected entity
             if(selectedEntity == 'lead' || selectedEntity == 'invoice' || selectedEntity == 'estimate'){
                delete item.technician; // Remove the 'assigned tech' option
                selectedTarget = selectedTarget == "technician" ? '' : selectedTarget;
            }else{
                item.technician = "assigned tech"; 
            }

            if( selectedEntity == 'estimate'){
                delete item.sales_rep; // Remove the 'assigned tech' option
                selectedTarget = selectedTarget == "sales_rep" ? '' : selectedTarget;
            }else{
                item.sales_rep = "sales representative"; 

            }

            if (item) {
                populateDropdown(
                "#targetDropdownMenu",
                item,
                selectedTarget || "someone",
                "target-item",
                "#targetDropdownBtn",
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
            //hide date if selectedTime is immediately
            toggleDateDropdown();

            //if no selected time set text to default
            //if selected time is 0 set text to immediately
            //if selected time > 0 set text to selectedTime (20 minutes) + selectedTiming (after) (eg. 20 minutes after)
            if(selectedTime == ""){
                text = "within a defined time";
            }else{
                if(selectedTime == 0){
                    text = formatTriggerTime(selectedTime);
                    toggleTimingButtons();
                }else{
                    text = formatTriggerTime(selectedTime) + " " + timingOptions[selectedTiming];
                }
            }

            //update the timedropdown text
            $("#timeDropdownBtn").text(text);
        }

        function populateEmailModal(ckId, modalId) {
            document.querySelector('[name="subject"]').value = emailSubject;
            document.getElementById("automation_msg").value = emailBody;
            if (CKEDITOR.instances[ckId]) {
                CKEDITOR.instances[ckId].setData(emailBody);
            }

            $(modalId).modal("show");
        }

         function populateSmsModal(ckId, modalId) {
            document.getElementById(ckId).value = smsBody;
            if (CKEDITOR.instances[ckId]) {
                CKEDITOR.instances[ckId].setData(smsBody);
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
            selectedTarget = "";
            selectedAction = "";
            selectedTime = "";
            selectedTiming = "";
            selectedDate = "";
            selectedTitle = "";
            emailSubject = "";
            emailBody = "";
            activeAutoTemplate = "";
            selectedEntity = "";
            selectedOperation = "";
            smsBody = "";

            $(".event-dropdown-container").addClass("d-none");
            $(".status-dropdown-container").addClass("d-none");
            $(".target-dropdown-container").addClass("d-none");
            $(".action-dropdown-container").addClass("d-none");
            $(".time-dropdown-container").addClass("d-none");
            $(".date-dropdown-container").addClass("d-none");
            disableTimeDropdownBtns();
        }

        function updateSelectedValues(menuId, value) {
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
        function toggleHighlightBtn(name, clickedButton) {
            $(name)
                .removeClass("nsm-button primary")
                .addClass("nsm-button-outlined primary");
            $(clickedButton)
                .removeClass("nsm-button-outlined primary")
                .addClass("nsm-button primary");
        }

        function disableTimeDropdownBtns(){
            $(".timing-btn").removeClass("nsm-button primary").addClass("nsm-button-outlined primary");
            $(".time-btn").removeClass("nsm-button primary").addClass("nsm-button-outlined primary");
        }

        function toggleTimingButtons(){
            if (selectedTime == 0) {
                $(".timing-btn").attr("disabled", true);
                $(".timing-btn").addClass("secondary").removeClass("primary");
            } else {
                $(".timing-btn").removeClass("disabled").attr("disabled", false);
                $(".timing-btn").addClass("primary").removeClass("secondary");
            }
        }

        function toggleDateDropdown(){
            if(selectedTime > 0){ //show if selectedTime to send is NOT immediately
                $(".date-dropdown-container").removeClass("d-none");
            }else{
                $(".date-dropdown-container").addClass("d-none");
            }
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

           populateTargetDropdown(selectedEntity)
        });

        // Handle operation item click using event delegation
        $(document).on("click", ".operation-item", function () {
            selectedOperation = $(this).data("value");

            // Update the button text with the selected operation
            $("#operationDropdownBtn").text(selectedOperation);
            $("#operationDropdownBtn").addClass("primary");
            $("#operationDropdownMenu").hide();

            handleSecondParagraph();
        });


        // Time and Timing selection logic
        $(".time-btn").on("click", function () {

            //highlight selected time btn
            toggleHighlightBtn(".time-btn", this);
            selectedTime = $(this).data("value");
            
            // Disable timing buttons if selectedTime is 0, enable otherwise
            toggleTimingButtons()

            if(selectedTime > 0){ 
                //highlight timing-btn if selectedTime is NOT immediately
                selectedTiming = selectedTiming || 'after';
                $(".timing-btn").each(function () {
                    if ($(this).data('value') == selectedTiming) {
                        toggleHighlightBtn(".timing-btn", this);
                    }
                });
            }else{
                selectedTiming = '';
                selectedDate = '';
            }

            //update time btn text
            let timingBtnText = selectedTiming ? timingOptions[selectedTiming] : '';
            let timeBtnText = formatTriggerTime(selectedTime);
            let text = selectedTime == 0 ? timeBtnText :  timeBtnText + " " + timingBtnText;
            $("#timeDropdownBtn").text(text);

            //highlight the text
            $("#timeDropdownBtn").addClass("primary").removeClass("secondary");

            //hide or show date
            toggleDateDropdown();
        });

        
        // Timing selection logic

        $(".timing-btn").on("click", function () {
            toggleHighlightBtn(".timing-btn", this);
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
            let title = $(this).data("title");
            let type = $(this).data("type");


            if (title) {
                // Set the value of the input field inside the modal
                $('input[type="text"].nsm-field').val(title);
                // Update the modal title dynamically
                $('.automation-title').text(`Automation: ${title}`);
                selectedTitle = title;
                activeAutoTemplate = type;
            }
            if (action) {
                eval(action);
            }
        });

        $(".marketing-item").on("click", function () {
            let action = $(this).data("onclick");
            let title = $(this).data("title");
            let type = $(this).data("type");


            if (title) {
                // Set the value of the input field inside the modal
                $('input[type="text"].nsm-field').val(title);
                // Update the modal title dynamically
                $('.automation-title').text(`Automation: ${title}`);
                selectedTitle = title;
                activeAutoTemplate = type;
            }
            if (action) {
                eval(action);
            }
        });

        $(".followUps-item").on("click", function () {
            let action = $(this).data("onclick");
            let title = $(this).data("title");
            let type = $(this).data("type");


            if (title) {
                // Set the value of the input field inside the modal
                $('input[type="text"].nsm-field').val(title);
                // Update the modal title dynamically
                $('.automation-title').text(`Automation: ${title}`);
                selectedTitle = title;
                activeAutoTemplate = type;
            }
            if (action) {
                eval(action);
            }
        });

         $(".actions-item").on("click", function () {
            let action = $(this).data("onclick");
            let title = $(this).data("title");
            let type = $(this).data("type");


            if (title) {
                // Set the value of the input field inside the modal
                $('input[type="text"].nsm-field').val(title);
                // Update the modal title dynamically
                $('.automation-title').text(`Automation: ${title}`);
                selectedTitle = title;
                activeAutoTemplate = type;
            }
            if (action) {
                eval(action);
            }
        });

        $(".preview-message").on("click", function () {
            if(selectedAction == "send_email"){
                populateEmailModal("automation_msg", "#addEmail");
            }
            if(selectedAction == "send_sms"){
                populateSmsModal("sms_automation_msg", "#addSms");

            }
        });

        $(".delete-first-line").click(function () {
            console.log('asdasd')
           resetAutomationModal();
           $("#entityDropdownBtn").text("this happens");
           $("#operationDropdownBtn").text("do this");
        });

         $(".delete-second-line").click(function () {

            selectedTarget = "";
            selectedAction = "";
            selectedTime = "";
            selectedTiming = "";
            selectedDate = "";
            emailSubject = "";
            emailBody = "";
            activeAutoTemplate = "";
            selectedEntity = "";
            selectedOperation = "";
            smsBody = "";

            $(".target-dropdown-container").addClass("d-none");
            $(".action-dropdown-container").addClass("d-none");
            $(".time-dropdown-container").addClass("d-none");
            $(".date-dropdown-container").addClass("d-none");
            disableTimeDropdownBtns();

           $("#operationDropdownBtn").text("do this");
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

         $("#smsForm").on("submit", function (e) {
            e.preventDefault();

            const messageContent = CKEDITOR.instances["sms_automation_msg"].getData(); // Fetch the CKEditor content
            $('textarea[name="sms_message"]').val(messageContent); // Update the textarea value

            let formData = $(this).serializeArray();
            smsBody = formData.find((field) => field.name === "sms_message").value;

            // Close modal or perform further actions
            $("#addSms").modal("hide");
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

                        if(data.trigger_action == "send_email"){
                            document.querySelector('[name="preview_subject"]').value =
                            data.email_subject;
                            document.getElementById("preview_automation_msg").value =
                            data.email_body;
                            CKEDITOR.instances.preview_automation_msg.setData(data.email_body);

                            $("#previewEmail").modal("show");
                        }

                        if(data.trigger_action == "send_sms"){
                            smsBody = data.sms_body;
                            populateSmsModal('preview_sms_automation_msg', '#previewSms')
                        }
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
                       

                        setActiveTimelineItem();
                        openAutomationModal("edit", data);
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
                sms_body: smsBody,
                status: "active",
                conditions: JSON.stringify(conditions) 
            };

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
                sms_body: smsBody,
                id: selectedAutomationId,
                conditions: JSON.stringify(conditions) 
            };

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
            var automationTitle = $(this).data("title");

             Swal.fire({
                title: 'Are you sure?',
                title: 'Delete Automation',
                html: `Are you sure you want to delete automation <b>${automationTitle}</b>?`,
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

        let conditions = [];
        

        const conditionOptions = {
            lead: [
                { value: "job_types", text: "Job Type" },
                { value: "job_tags", text: "Job Tag" }
            ],
            job: [
                { value: "job_types", text: "Job Type" },
                { value: "job_tags", text: "Job Tag" },
                { value: "amount", text: "Amount" }
            ],
            estimate: [
                { value: "amount", text: "Amount" }
            ],
            invoice: [
                { value: "amount", text: "Amount" }
            ]
        };
        
        //open condition modal
        $(".add-condition").on("click", function () {
            $(".operator-btns button").removeClass("d-none");
            $(".operator-btns button").removeClass("active");
            handleConditionOptions();
            handleConditionValueOptions("#conditionValueSelect")
            $("#addCondition").modal("show");
            conditions = []; 
            $(".list-condition").empty(); 

        console.log(jobTags)

        });

        $("#conditionSelect").on("change", async function () {
            let selectedValue = $(this).val();
            let res = null;

            $(".operator-btns button").removeClass("d-none");

            try {
                if (selectedValue === "amount") {
                    //show amount input field, hide select dropdown
                    $(".cond-value-amount-container").removeClass("d-none");
                    $(".cond-value-select-container").addClass("d-none");

                    //only show =, >, and < for amount
                    $(".operator-btns button[data-value='!=']").addClass("d-none");
                } else {
                    //show select dropdown, hide amount input field
                    $(".cond-value-amount-container").addClass("d-none");
                    $(".cond-value-select-container").removeClass("d-none");

                    $(".operator-btns button").removeClass("d-none");

                    if (selectedValue === "job_tags" || selectedValue === "job_types") {
                        //hide > and < for job_tags and job_types
                        $(".operator-btns button[data-value='>']").addClass("d-none");
                        $(".operator-btns button[data-value='<']").addClass("d-none");

                        //fetch data
                        res = selectedValue === "job_tags"
                            ? jobTags
                            : jobTypes;

                        console.log(res)
                    }
                }

                //populate select dropdown if data is available
                if (res) {
                    handleConditionValueOptions("#conditionValueSelect", res);
                }

            } catch (error) {
                console.error("Error fetching data:", error);
            }
        });


        $(".or-condition").on("click", function () {
            let selectedProperty = $("#conditionSelect").val();
            let selectedOperator = $(".operator-btns button.active").data("value");
            let selectedValue = $("#conditionValueSelect").val() || $(".cond-value-amount-container input").val();

            let selectedValueName = getConditionValueName(selectedProperty, selectedValue);


            //validate if the user has selected values
            if (!selectedProperty || !selectedOperator || !selectedValue) {
                alert("Please select a property, operator, and value before adding a condition.");
                return;
            }

            let newCondition = {
                property: selectedProperty,
                operator: selectedOperator,
                value: selectedValue
            };

            conditions.push(newCondition); // Save condition to array

            $(".list-condition").append(`
                <h6 class="nsm-text cursor-pointer fw-bold px-5">
                    ${selectedProperty} ( ${selectedOperator} ) ${selectedValueName}
                </h6>
                <label class="mb-1 fw-xnormal">or...</label>
            `);

            // Reset select and input fields
            resetForm();
            console.log(conditions);
        });

        $(".operator-btns button").on("click", function () {
            //remove active class from all buttons in the same group
            $(this).siblings().removeClass("active");

            //add active class to the clicked button
            $(this).addClass("active");
        });

        $("#addCondition .nsm-button.primary").on("click", function () {
            let property = $("#conditionSelect").val(); 
            let operator = $(".operator-btns button.active").data("value");
            let value = $("#conditionValueSelect").val() || $(".cond-value-amount-container input").val();
            if (!property || !operator || !value) {
                alert("Please select all fields.");
                return;
            }

            let condition = {
                property: property,
                operator: operator,
                value: value
            };

         
            conditions.push(condition);
            renderConditions();

            $("#addCondition").modal("hide");
            console.log(condition)
        });

         $(document).on("click", ".remove-condition", function () {
            let index = $(this).data("index");
            console.log(index)
            conditions.splice(index, 1);
            console.log(conditions)
            renderConditions();
        });

        function resetForm() {
            $("#conditionSelect").val("");
            $("#conditionValueSelect").empty().append('<option value="" disabled selected>Select Property</option>');
            $(".cond-value-amount-container input").val("");
            $(".cond-value-amount-container").addClass("d-none");
            $(".cond-value-select-container").removeClass("d-none");
            $(".operator-btns button").removeClass("active");
        }

        function renderConditions() {
            $(".conditions-list").empty(); 

            if (conditions.length === 0) {
                $(".conditions-listn").append("<p class='text-muted px-5'>No conditions added yet.</p>");
                return;
            }

            conditions.forEach((condition, index) => {
                let selectedValueName = getConditionValueName(condition.property, condition.value);
                $(".conditions-list").append(`
                    <div class="condition-item d-flex justify-content-between align-items-center px-3 mb-2">
                        <h6 class="nsm-text cursor-pointer fw-bold">
                            Only if ${condition.property} ${condition.operator} ${selectedValueName}
                        </h6>
                      
                        <i class="bx bx-fw bx-x primary cursor-pointer remove-condition" data-index="${index}"></i>

                    </div>
                `);
            });
        }

        function getNameById(array, id) {
            let item = array.find(obj => obj.id === id);
            return item ? item.name : null;
        }

        function getConditionValueName(property, value) {
            let selectedValueName = '';

            if (property === "job_types") {
                selectedValueName = getNameById(jobTypes, value) || value; 
            } else if (property === "job_tags") {
                selectedValueName = getNameById(jobTags, value) || value; 
            } else {
                selectedValueName = value;
            }

            return selectedValueName;
        }

        function handleConditionOptions () {
            let $conditionSelect = $("#conditionSelect");
            $conditionSelect.empty();
            $conditionSelect.append(new Option("Select Property", "", true, true));
            if (selectedEntity && conditionOptions[selectedEntity]) {
                conditionOptions[selectedEntity].forEach(option => {
                    $conditionSelect.append(new Option(option.text, option.value));
                });
            }
        }

        function handleConditionValueOptions(selectId, options) {
            if(!selectId) return;
            let $conditionSelect = $(selectId);

            // Clear the existing options
            $conditionSelect.empty();

            // Optionally, add a default "Select" option
            $conditionSelect.append(new Option("Select Property", "", true, true));

            if (options && options.length > 0) {
                // Append new options
                options.forEach(option => {
                    $conditionSelect.append(new Option(option.name, option.id));
                });
            }
        }


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
                    if(response.code == 1062){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Automation',
                            html: response.message,
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                            }).then((result) => {
                                
                        });
                    }else{
                     Swal.fire({
                            icon: message.icon,
                            title: message.title,
                            html: message.body,
                            showConfirmButton: true,
                            confirmButtonText: "Okay",
                            }).then((result) => {
                                
                                location.reload(); 

                        });
                    }
                  
                    resolve(response); // Resolve the promise with the response
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                    icon: "error",
                    title: "Error!",
                    html: "Something went wrong. Try Again!",
                    showConfirmButton: true,
                    confirmButtonText: "Okay",
                    });
                    formDisabler(data, false);
                    reject(error); // Reject the promise with the error

                    console.log(error, xhr, status)
                },
                });
            });
        }

        function sendGet(url, message, isReload = false) {
            return new Promise((resolve, reject) => {
                $.ajax({
                type: "GET",
                url: BASE_URL + url,
                success: function (response) {
                    const parsedResponse = typeof response === "string" ? JSON.parse(response) : response;
                    resolve(parsedResponse);
                },
                error: function (xhr, status, error) {
                    reject(error);
                    console.log(error, xhr, status)
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
                let triggerTime = Number(data.trigger_time)
                if (
                    (key == "timing_reference" || key == "date_reference" || key ==="trigger_time") &&
                    triggerTime === 0
                ) {
                    return;
                }

                // Skip `email_body` and `email_subject` if `trigger_action` is send_sms
                if (
                    (key == "email_body" || key == "email_subject") &&
                    data.trigger_action == "send_sms"
                ) {
                    return;
                }

                if (
                    (key == "sms_body") &&
                    data.trigger_action == "send_email"
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
                return null;
            }

            const { subject, body } =
                automationConfig[automationType].templates[recipientType];

            return {
                subject,
                body,
            };
        }

        // Handle the Insert Smart Tag button click
        $('#smartTags').on('change', function () {
            const selectedTag = $(this).val(); 
            if (!selectedTag) {
                alert('Please select a smart tag to insert.');
                return;
            }

            const editorInstance = CKEDITOR.instances['automation_msg'];

            if (editorInstance) {
                editorInstance.insertText(selectedTag); 
                $('#smartTags').val("");

               
            } 
        });

        // Handle the Insert Smart Tag button click
        $('#smsSmartTags').on('change', function () {
            const selectedTag = $(this).val(); 
            if (!selectedTag) {
                alert('Please select a smart tag to insert.');
                return;
            }

            const editorInstance = CKEDITOR.instances['sms_automation_msg'];

            if (editorInstance) {
                editorInstance.insertText(selectedTag); 
                $('#smsSmartTags').val("");

               
            } 
        });

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


        $('#automation_searchbar').on('keyup', function() {
            var searchQuery = $(this).val(); 

            $.ajax({
                url: BASE_URL + "/Automation/searchAutomation",
                method: 'GET',
                data: { query: searchQuery }, 
                 success: function(response) {
                    var data = JSON.parse(response); 
                    if (data.automations && data.automations.length > 0) {
                        var html = '';
                        data.automations.forEach(function(automation) {
                            html += `
                             <div class="col-12 mb-3">
                                <div class="nsm-card primary" style="overflow: visible !important;">
                                    <div class="nsm-card-header">
                                        <div class="nsm-card-title d-flex justify-content-between">
                                            <span>${automation.title || 'No Title'}</span>
                                            <div class="form-switch">
                                                <input class="form-check-input primary toggle-automation" type="checkbox" role="switch" data-id="${automation.id}" ${automation.status === 'active' ? 'checked' : ''}>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nsm-card-content">
                                        <h6>${automation.description}</h6> <!-- Use the description from PHP -->
                                        <hr />
                                        <div class="row">
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="d-flex gap-3 small">
                                                    <span>Created on ${new Date(automation.created_at).toLocaleDateString()}</span>
                                                    <span>|</span>
                                                    <span>Triggered 0 times</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        });

                        $('#automationResults').html(html);
                    } else {
                        $('#automationResults').html('<p>No automations found.</p>');
                    }
                },
                error: function() {
                    $('#automationResults').html('<p>Error occurred while searching.</p>'); 
                }
            });
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

        if (CKEDITOR.instances["sms_automation_msg"]) {
         CKEDITOR.instances["sms_automation_msg"].destroy(true);
        }

        CKEDITOR.replace("sms_automation_msg", {
            height: 250,
            toolbarGroups: [
                "/",
                {
                name: "basicstyles",
                groups: ["basicstyles", "cleanup"],
                },
            ],
        });

        if (CKEDITOR.instances["preview_sms_automation_msg"]) {
         CKEDITOR.instances["preview_sms_automation_msg"].destroy(true);
        }

        CKEDITOR.replace("preview_sms_automation_msg", {
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