<!-- Modal -->
<div class="modal fade" id="new_customer" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Add new customer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_customer_form">
                <div class="modal-body">
                    <div class="contact-info">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Middle Initial</label>
                                            <input type="text" name="middle_name" class="form-control" placeholder="optional" >
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" name="phone_h" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="mail_add" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" name="city" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" name="state" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Zip Code</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="new_items" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="item_details_title">Add New Item</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="new_customer_form">
                <div class="modal-body">
                    <div class="contact-info">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <input type="text" id="item_details_name" name="item_details_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="last_name" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Qty</label>
                                            <input type="text" id="item_details_qty" name="middle_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost</label>
                                            <input type="number" id="item_details_cost" name="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost Per</label>
                                            <select class="form-control" name="cost_per" id="cost_per" required>
                                                <option value="each" selected>Each</option>
                                                <option>Weight</option>
                                                <option>Length</option>
                                                <option>Area</option>
                                                <option>Volume</option>
                                                <option>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Unit</label>
                                            <input type="text" name="mail_add" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Brand</label>
                                            <input type="text" name="middle_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Vendor</label>
                                            <select class="form-control" name="vendor" id="exampleFormControlSelect1">
                                                <option disabled>Select</option>
                                                <option value="1">Vendor A</option>
                                                <option value="2">Vendor B</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Product Url</label>
                                            <input type="text" name="state" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Cost of Goods</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Model Number</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Item Group</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Sold By</label>
                                            <select id="employee_id_sold" name="employee_id_sold" class="form-control">
                                                <option selected="">Select Employee</option>
                                                <?php if(!empty($employees)): ?>
                                                    <?php foreach ($employees as $employee): ?>
                                                        <option <?php if(isset($jobs_data) && $jobs_data->employee_ids == $employee->id) {echo 'selected'; } ?> value="<?= $employee->id; ?>"><?= $employee->LName.','.$employee->FName; ?></option>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Points</label>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Location</label>
                                            <button class="btn btn-default" type="button" data-id="<?php echo $item[3]; ?>" id="seeLocation" data-toggle="dropdown" aria-expanded="true">
                                                <span class="btn-label">See Location <i class="fa fa-caret-down fa-sm" style="margin-left:10px;"></i></span></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" id="<?php echo 'locQtyList' . $item[3]; ?>" style="width:300px;" role="menu" aria-labelledby="dropdown-edit">
                                                <li role="presentation" style="background-color:#D3D3D3;">
                                                    <a role="menuitem" tabindex="-1" href="javascript:void(0)" class="editItemBtn"><span style="padding-right:150px;">
                                                            <strong>Location</strong></span><span style="border-left:1px solid black;"> <strong>Qty</strong></span>
                                                </li>
                                                <li role="separator" class="divider"></li>
                                            </ul>
                                            <input type="text" name="zip_code" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>

                </div>
                <div class="modal-footer modal-footer-detail">
                    <div class="button-modal-list">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span class="fa fa-remove"></span> Close</button>
                        <button type="submit" class="btn btn-primary"><span class="fa fa-paper-plane-o"></span> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="item_list" tabindex="-1" role="dialog" aria-labelledby="newcustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newcustomerLabel">Item Lists</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="items_table" class="table table-hover" style="width: 100%;">
                            <thead>
                            <tr>
                                <td style="width: 70%;">Name</td>
                                <td>Qty</td>
                                <td>Price</td>
                                <td style="width: 5%;"> Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($items)): ?>
                                <?php foreach ($items as $item): ?>
                                    <?php $item_qty = get_total_item_qty($item->id); ?>
                                    <tr>
                                        <td><?= $item->title; ?></td>
                                        <td><?= $item_qty[0]->total_qty > 0 ? $item_qty[0]->total_qty : 0; ?></td>
                                        <td><?= $item->price; ?></td>
                                        <td><button id="<?= $item->id; ?>" data-quantity="<?= $item->units; ?>" data-itemname="<?= $item->title; ?>" data-price="<?= $item->price; ?>" type="button" data-bs-dismiss="modal" class="btn btn-sm btn-default select_item">
                                        <span class="bx bx-fw bx-plus"></span></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- On My Way Modal -->
<div class="modal fade" id="omw_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">On My Way</h4>
            </div>
            <form id="update_status_to_omw">
                <div class="modal-body">
                    <p>This will start travel duration tracking.</p>
                    <p>On my way at:</p>
                    <input type="date" name="event_omw_date" id="event_omw_date" class="form-control" required>
                    <input type="hidden" name="id" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                    <input type="hidden" name="status" id="status" value="2">
                    <select id="event_omw_time" name="event_omw_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-paper-plane-o"></span> Save
                    </button>
                    <button type="button" id="" class="btn btn-default" data-bs-dismiss="modal">
                        <span class="fa fa-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Start Job Modal -->
<div class="modal fade" id="start_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Start Event</h4>
            </div>
            <form id="update_status_to_started">
                <div class="modal-body">
                    <p>This will stop travel duration tracking and start on event duration tracking.</p>
                    <p>Start event at:</p>
                    <input type="date" name="event_start_date" id="event_start_date" class="form-control" required>
                    <input type="hidden" name="id" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                    <input type="hidden" name="status" id="status" value="3">
                    <select id="event_start_time" name="event_start_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-paper-plane-o"></span> Save
                    </button>
                    <button type="button" id="" class="btn btn-default" data-bs-dismiss="modal">
                        <span class="fa fa-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Start Job Modal -->
<div class="modal fade" id="finish_modal" role="dialog">
    <div class="close-modal" data-bs-dismiss="modal">&times;</div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Finish Event</h4>
            </div>
            <form id="update_status_to_finished">
                <div class="modal-body">
                    <p>This will stop travel duration tracking and start on event duration tracking.</p>
                    <p>Start event at:</p>
                    <input type="date" name="event_finish_date" id="event_finish_date" class="form-control" required>
                    <input type="hidden" name="id" value="<?php if(isset($jobs_data)){echo $jobs_data->job_unique_id;} ?>">
                    <input type="hidden" name="status" id="status" value="4">
                    <select id="event_finish_time" name="event_finish_time" class="form-control" required>
                        <?php for($x=0;$x<time_availability(0,TRUE);$x++){ ?>
                            <option <?= isset($jobs_data) && strtolower($jobs_data->start_time) == time_availability($x) ?  'selected' : '';  ?> value="<?= time_availability($x); ?>"><?= time_availability($x); ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <span class="fa fa-paper-plane-o"></span> Save
                    </button>
                    <button type="button" id="" class="btn btn-default" data-bs-dismiss="modal">
                        <span class="fa fa-remove"></span> Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>