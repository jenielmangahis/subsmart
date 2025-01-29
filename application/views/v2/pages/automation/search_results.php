<?php if (!empty($automations)): ?>
    <?php foreach ($automations as $automation): ?>
        <div class="col-12 mb-3">
            <div class="nsm-card primary" style="overflow: visible !important;">
                <div class="nsm-card-header">
                    <div class="nsm-card-title d-flex justify-content-between">
                        <span><?php echo !empty($automation->title) ? $automation->title : 'No Title'; ?></span>
                        <div class="form-switch">
                            <input
                                class="form-check-input primary toggle-automation"
                                type="checkbox"
                                role="switch"
                                data-id="<?php echo $automation->id; ?>"
                                <?php echo $automation->status === 'active' ? 'checked' : ''; ?>
                            >
                        </div>
                    </div>
                </div>
                <div class="nsm-card-content">
                    <h6><?php echo generateAutomationDescription($automation); ?>.</h6>
                    <hr />
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <div class="d-flex gap-3 small">
                                <span>Created on <?php echo date('M d, Y', strtotime($automation->created_at)); ?></span>
                                <span>|</span>
                                <span>Triggered 0 times</span>
                            </div>
                            <div class="nsm-card-controls px-3">
                                <div class="dropup">
                                    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" id="actionsDropdown" aria-expanded="false">
                                        <i class='bx bx-fw bx-dots-horizontal-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                                        <li><a class="dropdown-item cursor-pointer preview-automation" data-id="<?php echo $automation->id; ?>">Preview</a></li>
                                        <li><a class="dropdown-item cursor-pointer edit-automation" data-id="<?php echo $automation->id; ?>">Edit</a></li>
                                        <li><a class="dropdown-item cursor-pointer delete-automation" data-id="<?php echo $automation->id; ?>" data-title="<?php echo $automation->title; ?>">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="row"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>No automations found.</p>
<?php endif; ?>
