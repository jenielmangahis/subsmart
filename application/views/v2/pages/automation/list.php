<?php include viewPath('v2/includes/header'); ?>
<?php include viewPath('v2/includes/customer/customer_modals'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.bootstrap5.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link rel="stylesheet" href="<?php echo $url->assets ?>css/automation/automation.css">


<div class="row page-content g-0">
    <!-- TABS  -->
    <div class="col-12 mb-3">
        <?php include viewPath('v2/includes/page_navigations/automation_tabs'); ?>
    </div>
    <!-- CALLOUT  -->
    <div class="col-12">
        <div class="nsm-page">
            <div class="nsm-page-content">
                <div class="row">
                    <div class="col-12">
                        <div class="nsm-callout primary">
                            <button><i class='bx bx-x'></i></button>
                            Set automatic reminders for your team or clients.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CARDS  -->
    <div class="col-12">
        <div class="row g-3 mb-3">
            <div class="col-6 col-md-3 col-lg-2 select-filter-card">
                <div class="nsm-counter primary h-100 mb-2 ">
                    <div class="row h-100 w-auto">

                        <div class=" w-100 col-md-8 text-start d-flex align-items-center  justify-content-between">
                            <span><i class="bx bx-receipt"></i>
                                Active
                            </span>
                            <h2 id="total_this_year">4</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-2 select-filter-card">
                <div class="nsm-counter h-100 mb-2 ">
                    <div class="row h-100 w-auto">

                        <div class=" w-100 col-md-8 text-start d-flex align-items-center  justify-content-between">
                            <span><i class="bx bx-receipt"></i>
                                Triggered
                            </span>
                            <h2 id="total_this_year">1</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-md-6 grid-mb">
            <div class="nsm-field-group search">
                <input type="text" class="nsm-field nsm-search form-control mb-2" id="CUSTOMER_SEARCHBAR" placeholder="Search...">
            </div>
        </div>
        <div class="col-md-6 grid-mb text-end">
            <div class="nsm-page-buttons primary page-button-container">
                <button type="button" class="nsm-button primary" data-bs-toggle="modal" data-bs-target="#addAutomation">
                    <i class='bx bx-fw bx-plus'></i> Add Automation
                </button>
                <button type="button" class="nsm-button primary trigger-auto">
                    <i class='bx bx-fw bx-plus'></i>Trigger automation
                </button>
                <button type="button" class="nsm-button primary process-auto">
                    <i class='bx bx-fw bx-plus'></i>Process automation
                </button>

            </div>
        </div>
    </div>

    <?php
    foreach ($automations as $automation) : ?>
        <div class="col-12 mb-3">
            <div class="nsm-card primary" style="overflow: visible !important;">
                <div class="nsm-card-header">
                    <div class="nsm-card-title d-flex justify-content-between">
                        <span><?= !empty($automation['title']) ? $automation['title'] : 'No Title' ?></span>

                        <div class=" form-switch">
                            <input
                                class="form-check-input primary toggle-automation"
                                type="checkbox"
                                role="switch"
                                id="flexSwitchCheckChecked"
                                data-id="<?= $automation['id'] ?>" <?= $automation['status'] === 'active' ? 'checked' : '' ?>>
                        </div>
                    </div>
                </div>
                <div class="nsm-card-content">
                    <h6><?= generateAutomationDescription($automation) ?>.</h6>

                    <hr />
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="d-flex gap-3 small">
                                <span>Created on <?= date('M d, Y', strtotime($automation['created_at'])) ?></span>
                                <span>|</span>
                                <span>Triggered 0 times</span>
                            </div>

                            <div class="nsm-card-controls px-3">
                                <div class="dropup">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class='bx bx-fw bx-dots-horizontal-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="<?= base_url('automation/preview/') ?><?= $automation['id'] ?>">Preview</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('automation/edit/') ?><?= $automation['id'] ?>">Edit</a></li>
                                        <li><a class="dropdown-item" href="<?= base_url('automation/rename/') ?><?= $automation['id'] ?>">Rename</a></li>
                                        <li><a class="dropdown-item delete-automation" data-id="<?= $automation['id'] ?>">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="row">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>


<?php include viewPath('v2/includes/automation/add_automation_modal'); ?>
<?php include viewPath('v2/includes/automation/add_email_modal'); ?>



<!-- <script type="text/javascript">
    // START DYNAMIC ACCORDION
    document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("accordionContainer").innerHTML = generateAccordion();
    });

    //TODO: will pull from db
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

    const someoneOptions = ["assigned tech", "client", "to user", ];
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
                    <div id="collapse${index}" class="accordion-collapse collapse" aria-labelledby="heading${index}" data-bs-parent="#accordionContainer">
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
                `<li class="list-group-item cursor-pointer" onclick="displayFirstParagraphSelection('${type}', '${action}')">${action}</li>`
            )
            .join("");
    }

    function preventDropdownClose(event) {
        event.stopPropagation(); // Prevents the dropdown from closing
    }

    // END DYNAMIC ACCORDION



    // DYNAMIC DISPLAY OF SELECTION

    let selectedStatus = 'new'
    let selectedType = ''
    let selectedAction = ''
    let selectedSomeone = 'someone'
    let selectedReminder = 'a reminder'
    let selectedTime = 'within a defined time'
    let selectedTiming = 'after'
    let selectedDate = 'date'
    let selectedTitle = ''


    function setActiveTimelineItem(itemId) {
        const selectedItem = document.getElementById(itemId);
        if (selectedItem) {
            selectedItem.classList.add('active');
        }
    }

    function generateAutomationTemplate(type, action, task) {
        selectedStatus = 'Scheduled'
        selectedSomeone = 'client'
        selectedReminder = 'a text message'
        selectedTime = 'immediately'
        displayFirstParagraphSelection(type, action)
        displaySecondParagraphSelection('send')
    }

    //eg. When a lead has a status of new
    function displayFirstParagraphSelection(type, action) {
        selectedType = type || ''
        selectedAction = action || ''

        const parentNode = document.getElementById('workflowMenuBtn').parentNode;

        // clear previously appended elements
        // so that when the user updates selectedType, we can have fresh start
        clearAppendedElements('workflowMenuBtn', '.added-first-paragraph');
        clearAppendedElements('taskMenuBtn', '.added-second-paragraph');

        // update the text of the original dropdown 'this happens' to selectedType eg. 'a lead'
        const workflow = document.getElementById('workflowMenuBtn');
        workflow.textContent = `${determineArticle(type)} ${type}`;

        // append action dropdown e.g is created, is scheduled
        createDropdown({
            parentNode,
            category: 'action',
            options: actionTypes,
            value: selectedAction,
            dropdownId: 'actionDropdown',
            className: 'added-first-paragraph',
            type: type,
            callback: (selectedAction) => {
                displayFirstParagraphSelection(type, selectedAction);
            }
        })

        // append status dropdown e.g new, scheduled, completed if type is LEAD OR JOB
        if (action === "has a status" && (type == 'lead' || type == 'job')) {
            appendElement(parentNode, "span", 'h4 fw-bold added-first-paragraph me-2 nsm-text secondary', 'of') // when a job has a status 'of'
            createDropdown({
                parentNode,
                category: 'status',
                options: statusOptions,
                value: selectedStatus,
                dropdownId: 'statusDropdown',
                className: 'added-first-paragraph',
                type: type,
                callback: (selected) => {
                    selectedStatus = selected
                }
            })

        }
    }

    //eg. send assigned tech a text message 10 mintues after the lead end date
    function displaySecondParagraphSelection(task) {
        const parentNode = document.getElementById('taskMenuBtn').parentNode;

        // clear previously appended elements
        clearAppendedElements('taskMenuBtn', '.added-second-paragraph');

        // update the text of the original dropdown 'do this' to selectedTask eg. 'send'
        const taskElement = document.getElementById('taskMenuBtn');
        taskElement.textContent = task;
        taskElement.classList.remove('secondary');
        taskElement.classList.add('primary');

        let className = 'added-second-paragraph'
        createDropdown({
            parentNode,
            category: 'someone',
            options: someoneOptions,
            value: selectedSomeone,
            dropdownId: 'someoneDropdown',
            className: className,
            callback: (selected) => {
                selectedSomeone = selected
            }
        })
        createDropdown({
            parentNode,
            category: 'reminder',
            options: remiderOptions,
            value: selectedReminder,
            dropdownId: 'reminderDropdown',
            className: className,
            callback: (selected) => {
                selectedReminder = selected
            }
        })
        createDropdown({
            parentNode,
            category: 'time',
            options: timeOptions,
            value: selectedTime,
            dropdownId: 'timeDropdown',
            className: className,
            callback: (selected) => {
                selectedTime = selected
            }
        })
        if (selectedTime !== 'immediately') {
            createDropdown({
                parentNode,
                category: 'timing',
                options: timingOptions,
                value: selectedTiming,
                dropdownId: 'timingDropdown',
                className: className,
                callback: (selected) => {
                    selectedTiming = selected
                }
            })
            appendElement(parentNode, "span", `h4 fw-bold added me-2 nsm-text secondary ${className}`, `the ${selectedType}`)
            createDropdown({
                parentNode,
                category: 'date',
                options: dateOptions,
                value: selectedDate,
                dropdownId: 'dateDropdown',
                className: className,
                callback: (selected) => {
                    selectedDate = selected
                }
            })
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
        const toggle = createDropdownToggle(value, dropdownId, className);
        parentNode.appendChild(toggle);

        const items = (type && options[type] || options).map(option => {
            let dropdownItemId = `${category}-${option}`
            const item = createDropdownItem(option, dropdownItemId, () => {
                //TODO: Need to add update for other category
                if (callback) {
                    callback(option);
                }
                updateSelectedValue({ //update innertext and selected value
                    value: option,
                    dropdownId: dropdownId,
                    category: category,
                });
            });

            return item;
        });

        parentNode.appendChild(createDropdownMenu(items, `${dropdownId}-Menu`, className));
        updateDropdownActiveClass(`${dropdownId}-Menu`, `${category}-${value}`)
    }

    //START OF DROPDOWN CREATION HELPER
    function createDropdownToggle(text, id, className) { // create a dropdown toggle
        const toggle = document.createElement('a');
        toggle.className = `dropdown-toggle nsm-text primary h4 fw-bold me-2 ${className}`;
        toggle.href = '#';
        toggle.id = id;
        toggle.role = 'button';
        toggle.setAttribute('data-bs-toggle', 'dropdown');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.innerText = text;
        return toggle;
    }

    function createDropdownMenu(items, id, className) { // create a dropdown menu
        console.log('createDropdownMenu', className)
        const container = document.createElement('div');
        container.className = `dropdown-menu ${className}`;
        container.id = id;
        container.setAttribute('aria-labelledby', id);

        items.forEach(item => container.appendChild(item)); // append all items to the menu
        return container;
    }

    function createDropdownItem(text, id, onClickCallback) { // create a dropdown item
        const item = document.createElement('a');
        item.className = 'dropdown-item';
        item.href = '#';
        item.id = id;
        item.innerText = text;
        item.addEventListener("click", onClickCallback);
        return item;
    }
    //END OF DROPDOWN CREATION HELPER

    function updateDropdownActiveClass(dropdownMenuId, dropdownItemId) {
        document.querySelectorAll(`#${dropdownMenuId} .dropdown-item`).forEach(item => {
            item.classList.toggle("active", item.id === `${dropdownItemId}`);
        });
    }

    function updateSelectedStatus({
        status,
        dropdownId,
        category
    }) {
        selectedStatus = status

        const statusToggle = document.getElementById(dropdownId);
        if (statusToggle) {
            statusToggle.textContent = selectedStatus;
        }

        updateDropdownActiveClass(`${dropdownId}-Menu`, `${category}-${status}`)


    }

    function updateSelectedValue({
        value,
        dropdownId,
        category,
    }) {
        // Update the dropdown display text
        const toggle = document.getElementById(dropdownId);
        if (toggle) {
            toggle.textContent = value;
        }

        // Update the dropdown active class (if applicable)
        updateDropdownActiveClass(`${dropdownId}-Menu`, `${category}-${value}`);

        console.log('selectedStatus', selectedStatus)
        console.log('selectedType', selectedType)
        console.log('selectedAction', selectedAction)
        console.log('selectedSomeone', selectedSomeone)
        console.log('selectedReminder', selectedReminder)
        console.log('selectedTime', selectedTime)
    }

    function appendElement(parentNode, elementName, className, text) {
        const element = document.createElement(elementName);
        element.className = className;
        element.innerText = text;
        parentNode.appendChild(element);
    }

    function clearAppendedElements(dropdownToggleId, className) { // clear previously added elements
        const parentNode = document.getElementById(dropdownToggleId).parentNode;
        const existingElements = parentNode.querySelectorAll(className);
        existingElements.forEach(element => element.remove());
    }

    // END OF DYNAMIC DISPLAY SELECTION

    function determineArticle(type) {
        return /^[aeiou]/i.test(type) ? "an" : "a";
    }

    function storeTitle(input) {
        const title = input.value;
        console.log("Title stored:", title); // For debugging
        selectedTitle = title
    }
</script> -->
<?php
$options = get_automation_options();
?>
<script src="<?php echo $url->assets ?>js/automation/options.js" type="text/javascript"></script>
<?php include viewPath('v2/pages/automation/js/automation'); ?>
<?php include viewPath('v2/includes/footer'); ?>