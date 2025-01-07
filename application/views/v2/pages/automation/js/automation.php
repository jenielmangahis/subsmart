<script type="text/javascript">
    $(document).ready(function() {
        console.log(CKEDITOR.instances);

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

        $(document).on('click', '.timeline-item', function() {
            setActiveTimelineItem(this.id);
        });

        $(document).on('click', '#workflowMenuAccordion', function(event) {
            event.preventDefault(); // Prevent the dropdown from closing
            event.stopPropagation(); // Stop event bubbling
        });

        $(document).on('click', '.task-item', function() {
            const value = $(this).data('value');
            displaySecondParagraphSelection(value);
        });

        $(document).on('click', '.reminder-item', function() {
            var onclickAction = $(this).data('onclick');
            var onclickValue = $(this).data('value');
            if (onclickValue) {
                // Set the value of the input field inside the modal
                $('input[type="text"].nsm-field').val(onclickValue);
                selectedTitle = onclickValue

            }
            if (onclickAction) {
                eval(onclickAction);
            }
        });

        const extractStatuses = (statusArray) =>
            statusArray.map(item => item.status).filter(Boolean);

        const leadStatus = extractStatuses(<?php echo json_encode($lead_status); ?>);
        const jobStatus = extractStatuses(<?php echo json_encode($job_status); ?>);

        const statusOptions = {
            lead: leadStatus,
            job: jobStatus
        };

        const actionTypes = {
            lead: ["is created", "has a status", "is scheduled"],
            job: ["is created", "has a status"],
            estimate: ["is created", "is sent", "is approved", "is declined"],
            invoice: ["is created", "is sent", "is due", "is past due"]
        };

        const someoneOptions = ["assigned tech", "client", "to user"];
        const remiderOptions = ["a text message", "an email", "a text and an email"];
        const timeOptions = ["10 minutes", "15 minutes", "30 minutes", "2 hours", "1 day", "immediately"];
        const timingOptions = ["ahead of", "after"];
        const dateOptions = ["scheduled date", "end date"];

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
            updateDropdownActiveClass(`${dropdownId}-Menu`, `${category}-${value}`);
        }

        function storeTitle(input) {
            selectedTitle = $(input).val();
            console.log('Title stored:', selectedTitle);
        }

        function setActiveTimelineItem(itemId = null) {
            console.log('setActiveTimelineItem called');
            if (itemId) {
                $(`#${itemId}`).addClass('active');
                return;
            }
            $('.timeline-item').addClass('active');
        }

        // DYNAMIC DISPLAY OF SELECTION

        let selectedStatus = 'new';
        let selectedType = '';
        let selectedAction = '';
        let selectedSomeone = 'someone';
        let selectedReminder = 'a reminder';
        let selectedTime = 'within a defined time';
        let selectedTiming = 'after';
        let selectedDate = 'date';
        let selectedTitle = '';

        function generateAutomationTemplate(type, action, recepient, reminder, time, timing, date) {
            setActiveTimelineItem();
            $('#addAutomation').modal('show');

            selectedStatus = 'scheduled';
            selectedSomeone = recepient;
            selectedReminder = reminder;
            selectedTime = time;
            selectedTiming = timing;
            selectedDate = date;

            displayFirstParagraphSelection(type, action);
            displaySecondParagraphSelection('send');
        }

        // eg. When a lead has a status of new
        function displayFirstParagraphSelection(type, action) {
            selectedType = type || '';
            selectedAction = action || '';

            const $parentNode = $('#workflowMenuBtn').parent();

            // Clear previously appended elements
            clearAppendedElements('#workflowMenuBtn', '.added-first-paragraph');
            clearAppendedElements('#taskMenuBtn', '.added-second-paragraph');

            // Update the text of the original dropdown
            $('#workflowMenuBtn').text(`${determineArticle(type)} ${type}`);

            // Append action dropdown
            createDropdown({
                parentNode: $parentNode,
                category: 'action',
                options: actionTypes,
                value: selectedAction,
                dropdownId: 'actionDropdown',
                className: 'added-first-paragraph',
                type: type,
                callback: function(selectedAction) {
                    displayFirstParagraphSelection(type, selectedAction);
                }
            });

            // Append status dropdown if type is LEAD OR JOB
            if (action === 'has a status' && (type === 'lead' || type === 'job')) {
                appendElement($parentNode, 'span', 'h4 fw-bold added-first-paragraph me-2 nsm-text secondary', 'of');
                createDropdown({
                    parentNode: $parentNode,
                    category: 'status',
                    options: statusOptions,
                    value: selectedStatus,
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
                category: 'someone',
                options: someoneOptions,
                value: selectedSomeone,
                dropdownId: 'someoneDropdown',
                className: className,
                callback: function(selected) {
                    selectedSomeone = selected;
                }
            });
            createDropdown({
                parentNode: $parentNode,
                category: 'reminder',
                options: remiderOptions,
                value: selectedReminder,
                dropdownId: 'reminderDropdown',
                className: className,
                callback: function(selected) {
                    selectedReminder = selected;
                }
            });
            createDropdown({
                parentNode: $parentNode,
                category: 'time',
                options: timeOptions,
                value: selectedTime,
                dropdownId: 'timeDropdown',
                className: className,
                callback: function(selected) {
                    selectedTime = selected;
                }
            });
            if (selectedTime !== 'immediately') {
                createDropdown({
                    parentNode: $parentNode,
                    category: 'timing',
                    options: timingOptions,
                    value: selectedTiming,
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
                    value: selectedDate,
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

            const items = (type && options[type] || options).map(option => {
                const dropdownItemId = `${category}-${option}`;
                const $item = createDropdownItem(option, dropdownItemId, () => {
                    if (callback) {
                        callback(option);
                    }
                    updateSelectedValue({
                        value: option,
                        dropdownId: dropdownId,
                        category: category
                    });
                });
                return $item;
            });

            parentNode.append(createDropdownMenu(items, `${dropdownId}-Menu`, className));
            updateDropdownActiveClass(`${dropdownId}-Menu`, `${category}-${value}`);
        }

        function createDropdownToggle(text, id, className) {
            return $(`<a href="#" class="dropdown-toggle nsm-text primary h4 fw-bold me-2 ${className}" id="${id}" role="button" data-bs-toggle="dropdown" aria-expanded="false">${text}</a>`);
        }

        function createDropdownMenu(items, id, className) {
            const $container = $(`<div class="dropdown-menu ${className}" id="${id}" aria-labelledby="${id}"></div>`);
            items.forEach($item => $container.append($item));
            return $container;
        }

        function createDropdownItem(text, id, onClickCallback) {
            return $(`<a href="#" class="dropdown-item" id="${id}">${text}</a>`).on('click', onClickCallback);
        }

        function updateDropdownActiveClass(dropdownMenuId, dropdownItemId) {
            $(`#${dropdownMenuId} .dropdown-item`).each(function() {
                $(this).toggleClass('active', $(this).attr('id') === dropdownItemId);
            });
        }


        // Dynamic Accordion Initialization
        $("#workflowMenuAccordion").html(generateAccordion());

        function generateAccordion() {
            return Object.keys(actionTypes)
                .map(
                    (type, index) => `
                <div class="accordion-item" style="border: none !important;">
                    <h2 class="accordion-header" id="heading${index}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${index}" aria-expanded="false" aria-controls="collapse${index}">
                            <i class='bx ${typeIcon(type)} me-3'></i> ${determineArticle(type)} ${type}
                        </button>
                    </h2>
                    <div id="collapse${index}" class="accordion-collapse collapse" aria-labelledby="heading${index}" data-bs-parent="#workflowMenuAccordion">
                        <div class="accordion-body">
                            <ul class="list-group list-group-flush">
                                ${generateLi(type)}
                            </ul>
                        </div>
                    </div>
                </div>`
                )
                .join("");
        }

        function generateLi(type) {
            return actionTypes[type]
                .map(
                    action =>
                    `<li class="list-group-item action-item cursor-pointer" data-type="${type}" data-action="${action}">${action}</li>`
                )
                .join("");
        }

        $(document).on('click', '.action-item', function() {
            const type = $(this).data('type');
            const action = $(this).data('action');
            displayFirstParagraphSelection(type, action);
        });



    })
</script>