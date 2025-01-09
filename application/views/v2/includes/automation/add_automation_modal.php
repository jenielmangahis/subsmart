<div class="modal fade" id="addAutomation" data-bs-backdrop="static" tabindex="-1" aria-labelledby="addAutomationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row h-100">
                    <div class="col-8 m-auto">
                        <div class="nsm-field-group icon-right">
                            <input type="text" class="nsm-field form-control mb-2" placeholder="Title..." id="automation_title">
                        </div>
                        <section class="py-5">
                            <ul class="timeline">
                                <li class="timeline-item mb-5" id="timeline-item-1">
                                    <h4 class="fw-bold nsm-text secondary d-inline">When</h4>
                                    <a class="dropdown-toggle nsm-text primary h4 fw-bold" href="#" id="workflowMenuBtn" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        this happens
                                    </a>
                                    <div class="dropdown-menu workflow" aria-labelledby="workflowMenuBtn">
                                        <div class="accordion" id="workflowMenuAccordion">
                                        </div>
                                    </div>
                                </li>

                                <li class="timeline-item mb-5" id="timeline-item-2" style="word-break: break-all;">
                                    <a class="dropdown-toggle nsm-text secondary h4 fw-bold me-2" href="#" id="taskMenuBtn" data-bs-toggle="dropdown">
                                        do this
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-start task">
                                        <li class="dropdown-item cursor-pointer task-item" data-value='send'>send</li>
                                        <li class="dropdown-item cursor-pointer task-item" data-value='create'>create</li>
                                    </ul>
                                </li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="nsm-button secondary outlined preview-message" data-bs-toggle="modal">Preview/edit message</button>
                <button type="button" class="nsm-button primary" id='submitAutomation'>
                    <i class='bx bx-fw bx-plus'></i> Add Automation
                </button>
            </div>
        </div>
    </div>
</div>