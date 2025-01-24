<div class="modal fade" id="addAutomation" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addAutomationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title nsm-text">Automation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-md-8 col-12 m-auto">
                        <div class="nsm-field-group icon-right">
                            <input type="text" class="nsm-field form-control mb-2" placeholder="Title..." id="automation_title" required>
                        </div>
                        <section class="py-5">
                            <ul class="timeline">
                                <li class="timeline-item d-flex mb-5" id="timeline-item-1" style="flex-flow: wrap;">
                                    <h4 class="nsm-text me-2">
                                        When
                                    </h4>

                                    <div class="entity-dropdown-container">
                                        <h4 id="entityDropdownBtn" class='cursor-pointer me-2 text-underline nsm-text primary fw-bold'>
                                            this happens
                                        </h4>
                                        <div class="dropdown-menu" id="entityDropdownMenu" style="width: 300px;" >
                                            <div class="container ">
                                                <div class="accordion" id="">
                                                    <?php
                                                        $automationOptions = get_automation_options();

                                                    $eventOptions = $automationOptions['eventOptions'];
                                                    $index        = 0;

                                                    foreach ($eventOptions as $type => $options) {
                                                        $iconClass = "bx bx-" . $type; // You can modify the icon class based on the type
                                                        $article   = ($type == 'estimate' || $type == 'invoice') ? 'an ' : 'a ';
                                                        ?>
                                                        <div class="accordion-item" style="border: none !important;">
                                                            <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="collapse<?php echo $index; ?>">
                                                                    <i class="bx
                                                                    <?php echo $iconClass; ?> me-2"></i><?php echo $article; ?><?php echo $type; ?>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $index; ?>" data-bs-parent="#entityMenuAccordion">
                                                                <div class="accordion-body">
                                                                    <ul class="list-group list-group-flush">
                                                                        <?php
                                                                            foreach ($options as $value => $text) {
                                                                                echo "<li class='list-group-item entity-event-item cursor-pointer' data-type='{$type}' data-value='{$value}'>{$text}</li>";
                                                                            }
                                                        ?>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                        $index++;
                                                    }
                                                    ?>
                                                </div>
                                                <!-- Hidden inputs to store selected entity and event -->
                                                <input type="hidden" id="selectedEntity" name="selectedEntity" value="">
                                                <input type="hidden" id="selectedEvent" name="selectedEvent" value="">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="event-dropdown-container d-flex d-none">
                                        <h4 id="eventDropdownBtn" class='cursor-pointer me-2 text-underline nsm-text secondary fw-bold'>
                                            <!-- event here: example if user chose lead - has a status it should have a dropdown of event base from lead and text should be "has a status"  -->
                                        </h4>
                                        <ul class="dropdown-menu list-group list-group-flush" id="eventDropdownMenu">
                                        
                                        </ul>
                                    </div>

                                    <div class="status-dropdown-container d-flex d-none">
                                        <h4 class='cursor-pointer me-2'>
                                            of <span id="statusDropdownBtn" class=" text-underline nsm-text secondary fw-bold">new</span>
                                        </h4>
                                        <ul class="dropdown-menu list-group list-group-flush" id="statusDropdownMenu">
                                        
                                        </ul>
                                    </div>
                                </li>
                                

                                <li class="timeline-item d-flex mb-5" id="timeline-item-2" style="flex-flow: wrap;">
                                  <div class="operation-dropdown-container">
                                        <h4 id="operationDropdownBtn" class='cursor-pointer me-2 text-underline nsm-text secondary fw-bold'>
                                            do this
                                        </h4>
                                        <ul class="dropdown-menu list-group list-group-flush" id="operationDropdownMenu" style="display:none;">
                                        
                                        </ul>
                                    </div>
                                    <div class="target-dropdown-container d-none">
                                        <h4 id="targetDropdownBtn" class='cursor-pointer me-2 text-underline nsm-text secondary fw-bold'>
                                            
                                        </h4>
                                        <ul class="dropdown-menu list-group list-group-flush" id="targetDropdownMenu">
                                        
                                        </ul>
                                    </div>
                                    
                                    <div class="action-dropdown-container d-none">
                                        <h4 id="actionDropdownBtn" class='cursor-pointer me-2 text-underline nsm-text secondary fw-bold'></h4>
                                        <ul class="dropdown-menu list-group list-group-flush" id="actionDropdownMenu">
                                        
                                        </ul>
                                    </div>

                                    <div class="time-dropdown-container d-none">
                                        <h4 id="timeDropdownBtn" class='cursor-pointer me-2  text-underline nsm-text secondary fw-bold'></h4>
                                        <div class="dropdown-menu p-3" id="timeDropdownMenu" style="width: 350px;">
                                            <h6>Choose time:</h6>
                                            <div class="row gutter g-3">
                                                <div class="col-md-4 col-sm-6">
                                                    <button type="button" class="nsm-button-outlined btn-sm primary w-100 time-btn" data-value='0'>immediately</button>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <button type="button" class="nsm-button-outlined btn-sm primary w-100 time-btn" data-value='10'>10 min</button>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <button type="button" class="nsm-button-outlined btn-sm primary w-100 time-btn" data-value='20'>20 min</button>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <button type="button" class="nsm-button-outlined btn-sm primary w-100 time-btn" data-value='30'>30 min</button>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <button type="button" class="nsm-button-outlined btn-sm primary w-100 time-btn" data-value='60'>1 hour</button>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <button type="button" class="nsm-button-outlined btn-sm primary w-100 time-btn" data-value='120'>2 hour</button>
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <button type="button" class="nsm-button-outlined btn-sm primary w-100 time-btn" data-value='1440'>1 day</button>
                                                </div>
                                            </div>
                                            <div class=" py-3">
                                                <h6>Choose timing:</h6>
                                                <div class="row gutter g-3">
                                                    <div class="col-6">
                                                        <button type="button" class="nsm-button-outlined btn-sm primary w-100 timing-btn" data-value="ahead_of">ahead of</button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="button" class="nsm-button-outlined btn-sm primary w-100 timing-btn" data-value="after">after</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="container">
                                                <hr />
                                                <button type="button" class="nsm-button-outlined primary w-100">
                                                    <i class="bx bx-cog"></i> Customize
                                                </button>
                                            </div> -->
                                        </div>
                                    </div>


                                    <div class="date-dropdown-container d-none">
                                        <h4 class='me-2'>
                                            the <span id="dateDropdownBtn" class="cursor-pointer text-underline nsm-text secondary fw-bold">date</span>
                                        </h4>
                                        <ul class="dropdown-menu list-group list-group-flush" id="dateDropdownMenu">
                                        
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined preview-message" data-bs-toggle="modal">Preview/edit message</button>
                <button type="button" class="nsm-button primary d-none" id="editAutomation">
                    <i class="bx bx-fw bx-save"></i> Save Changes
                </button>
                <button type="button" class="nsm-button primary" id='submitAutomation'>
                    <i class='bx bx-fw bx-plus'></i> Add Automation
                </button>
            </div>
        </div>
    </div>
</div>