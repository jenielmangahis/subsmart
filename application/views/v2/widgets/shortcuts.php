<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '<div class="col-12 col-lg-4">';
    endif;
?>

<div class="<?= $class ?>" data-id="<?= $id ?>" id="widget_<?= $id ?>" draggable="true">
    <div class="nsm-card-header">
        <div class="nsm-card-title">
            <span>Shortcuts</span>
        </div>
        <div class="nsm-card-controls">
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class='bx bx-fw bx-dots-vertical-rounded'></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" onclick="addToMain('<?= $id ?>',<?php echo ($isMain?'1':'0') ?>,'<?= $isGlobal ?>' )"><?php echo ($isMain?'Remove From Main':'Add to Main') ?></a></li>
                    <li><a class="dropdown-item" href="#" onclick="removeWidget('<?= $id ?>');">Remove Widget</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="nsm-card-content">
        <div id="shortcut_slider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#shortcut_slider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#shortcut_slider" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#shortcut_slider" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#shortcut_slider" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row shortcut-container">
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="addcheck()">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-file-blank'></i>
                                </div>
                                <label class="content-subtitle">Add a Check</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="printcheck()">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-printer'></i>
                                </div>
                                <label class="content-subtitle">Print a Check</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-dollar-circle'></i>
                                </div>
                                <label class="content-subtitle">Process Payment</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-wallet'></i>
                                </div>
                                <label class="content-subtitle">Receive Payments</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('invoice/add') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-detail'></i>
                                </div>
                                <label class="content-subtitle">Add Invoice</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-receipt'></i>
                                </div>
                                <label class="content-subtitle">Add Receipt</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-file-blank'></i>
                                </div>
                                <label class="content-subtitle">Add Bill</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer/settings') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-bar-chart-square'></i>
                                </div>
                                <label class="content-subtitle">Add Sales Tax</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-file'></i>
                                </div>
                                <label class="content-subtitle">Pay Bill</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('accounting/payroll-overview') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-calendar-week'></i>
                                </div>
                                <label class="content-subtitle">Run Payroll</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('accounting/link_bank') ?>'">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-buildings'></i>
                                </div>
                                <label class="content-subtitle">Bank Sync</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('credit_notes/add_new') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-note'></i>
                                </div>
                                <label class="content-subtitle">Add Credit Notes</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row shortcut-container">
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('events') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-calendar-event'></i>
                                </div>
                                <label class="content-subtitle">Add Calendar Events</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-task'></i>
                                </div>
                                <label class="content-subtitle">Add/Assign a Task</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('workorder/priority/add') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-list-ol'></i>
                                </div>
                                <label class="content-subtitle">Add Priority List</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('color_settings/index') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-color-fill'></i>
                                </div>
                                <label class="content-subtitle">Assign Color Listing</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('users') ?>'">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-user-plus'></i>
                                </div>
                                <label class="content-subtitle">Add Employees</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('users/businessview') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-building'></i>
                                </div>
                                <label class="content-subtitle">Change Business Profile</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-image-add'></i>
                                </div>
                                <label class="content-subtitle">Add Pictures</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('vault') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-folder-plus'></i>
                                </div>
                                <label class="content-subtitle">Save to Vault</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('marketing') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-wrench'></i>
                                </div>
                                <label class="content-subtitle">Marketing Tools</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('job') ?>'">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-message-square-add'></i>
                                </div>
                                <label class="content-subtitle">Add a Job</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('job/job_types') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-message-square-error'></i>
                                </div>
                                <label class="content-subtitle">Add a Job Type</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('job/job_tags') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-purchase-tag-alt'></i>
                                </div>
                                <label class="content-subtitle">Add a Job Tag</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row shortcut-container">
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('estimate') ?>">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-line-chart'></i>
                                </div>
                                <label class="content-subtitle">Add an Estimate</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('workorder/NewworkOrderAlarm') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-layer-plus'></i>
                                </div>
                                <label class="content-subtitle">Add Workorder</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer/addTicket') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-sticker'></i>
                                </div>
                                <label class="content-subtitle">Add Service Ticket</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer/add_lead') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-add-to-queue'></i>
                                </div>
                                <label class="content-subtitle">Add Lead</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer') ?>'">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-plus-circle'></i>
                                </div>
                                <label class="content-subtitle">Add Customer</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer/group_add') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-group'></i>
                                </div>
                                <label class="content-subtitle">Add Customer Group</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer/settings') ?>'">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-user-check'></i>
                                </div>
                                <label class="content-subtitle">Add Customer Source</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer/settings') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-user-circle'></i>
                                </div>
                                <label class="content-subtitle">Add Customer Type</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-tachometer'></i>
                                </div>
                                <label class="content-subtitle">Customer Dashboard</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('customer/import_customer') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-import'></i>
                                </div>
                                <label class="content-subtitle">Import Customer</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="lcation.href='<?= base_url('') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-toggle-left'></i>
                                </div>
                                <label class="content-subtitle">Enable/Disable Settings</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="lcation.href='<?= base_url('') ?>'">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-calendar-star'></i>
                                </div>
                                <label class="content-subtitle">Schedule a Demo</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row shortcut-container">
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('inventory/add') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-message-alt-add'></i>
                                </div>
                                <label class="content-subtitle">Add Item</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('inventory/import') ?>'">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-box'></i>
                                </div>
                                <label class="content-subtitle">Import Inventory</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('') ?>'">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-book-add'></i>
                                </div>
                                <label class="content-subtitle">Add New Service</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('') ?>'">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-calendar-plus'></i>
                                </div>
                                <label class="content-subtitle">Add Free Schedule</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item" onclick="location.href='<?= base_url('inventory/item_groups/add') ?>'">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-folder-plus'></i>
                                </div>
                                <label class="content-subtitle">Add Item Group</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon success">
                                    <i class='bx bx-location-plus'></i>
                                </div>
                                <label class="content-subtitle">Add Item Location</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon default">
                                    <i class='bx bx-book-heart'></i>
                                </div>
                                <label class="content-subtitle">Create Booking</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon">
                                    <i class='bx bx-bot'></i>
                                </div>
                                <label class="content-subtitle">Create a Wiz</label>
                            </div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="shortcut-item">
                                <div class="nsm-list-icon secondary">
                                    <i class='bx bx-extension'></i>
                                </div>
                                <label class="content-subtitle">See Plugin/Addons</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
    if(!is_null($dynamic_load) && $dynamic_load == true):
        echo '</div>';
    endif;
?>
