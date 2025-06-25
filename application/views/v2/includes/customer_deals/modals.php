<div class="modal fade" id="modal-add-new-deal" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add New Customer Deal</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-add-new-deal">                    
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Customer</label>
                            <div class="input-group mb-3">
                                <select class="select-customer form-select" name="customer_id"></select>                                
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Title</label>
                            <div class="input-group mb-3">
                                <input type="text" name="deal_title" value="" id="deal-title" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Value</label>
                            <div class="input-group mb-3">
                                <input type="number" step="any" name="deal_value" value="0.00" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Stage</label>
                            <div class="input-group mb-3">
                                <select class="form-select select-stage" name="deal_stage_id">
                                    <?php foreach($customerDealStages as $stage){ ?>
                                        <option value="<?= $stage->id; ?>"><?= $stage->name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Label</label>
                            <a href="javascript:void(0);" class="nsm-button btn-small float-end" id="btn-quick-add-label"><span class="fa fa-plus"></span> Add New Label</a> 
                            <div class="input-group mb-3">
                                <select class="form-select select-label" name="deal_label[]" multiple=""></select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Probability</label>
                            <div class="input-group mb-3">
                                <input type="number" step="any" name="deal_probability" value="0.00" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Expected close date</label>
                            <div class="input-group mb-3">
                                <input type="date" name="expected_close_date" value="<?= date("Y-m-d"); ?>" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Source Channel</label>
                            <div class="input-group mb-3">
                                <select class="form-select select-channel" name="source_channel">
                                    <?php foreach($optionSourceChannel as $channel){ ?>
                                        <option value="<?= $channel; ?>"><?= $channel; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Source Channel ID</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="source_channel_id" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Owner</label>
                            <div class="input-group mb-3">
                                <select class="form-select company-users" name="owner_id"></select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Visible to</label>
                            <div class="input-group mb-3">
                                <select class="form-select select-visible-to" name="visible_to">
                                    <?php foreach($optionVisibleTo as $visibleTo){ ?>
                                        <option value="<?= $visibleTo; ?>"><?= $visibleTo; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-save-customer-deal" form="frm-add-new-deal">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-new-deal-stage" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add New Stage</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-add-new-deal-stage">                    
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="stage_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <label class="mb-2">Probability</label>
                            <div class="input-group mb-3">
                                <input type="number" step="any" value="0" name="stage_probability" style="width:50%;" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_rotting_days" value="1" type="checkbox" role="switch" id="toggle-rotting-days">
                                <label class="form-check-label" for="toggle-rotting-days">Rotting in (days)</label>                                
                            </div>
                            <input type="number" step="any" name="rotting_num_days" value="0" class="form-control mt-2 mb-2" style="display:none;" id="rotting-num-days" autocomplete="off" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-deal-stage">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-deal-stage" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Stage</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-edit-deal-stage">
                    <input type="hidden" name="cdid" id="cdid" value="" />
                    <div id="edit-deal-stage-container"></div>                    
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-deal-stage">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-quick-add-label" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add New Label</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <form id="frm-save-customer-deal-label">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="label_name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="mb-2">Color</label>
                            <div class="input-group mb-3">
                                <input type="color" name="label_color" style="width:10%;" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>                   
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-deal-label">Save</button>
                    </div>                
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-quick-edit-label" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Label</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <form id="frm-update-customer-deal-label">
                <input type="hidden" name="cdlid" id="cdlid" value="" />
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Name</label>
                            <div class="input-group mb-3">
                                <input type="text" name="label_name" id="edit-customer-deal-label-name" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <label class="mb-2">Color</label>
                            <div class="input-group mb-3">
                                <input type="color" name="label_color" id="edit-customer-deal-label-color" style="width:10%;" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>                   
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-update-deal-label">Save</button>
                    </div>                
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-customer-deals" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">View Customer Deal</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body" id="view-customer-deals-container"></div>            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-deal" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Customer Deal</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>              
            <div class="modal-body">
                <form id="frm-update-deal">   
                    <div id="edit-deal-form-container"></div>
                </form>
            </div>  
            <div class="modal-footer">
                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-update-customer-deal" form="frm-update-deal">Save</button>                
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-customer-deal-activity-schedules" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="border:none;">
                <span class="modal-title content-title" style="font-size: 17px;"></span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body" id="activity-schedules-container"></div>
            <?php if(checkRoleCanAccessModule('customer-deals', 'write')){ ?>
            <div class="modal-footer" style="display:block;justify-content:normal !important;">
                <a class="nsm nsm-button btn-create-schedule-activity" data-id="" href="javascript:void(0);"><i class='bx bx-plus'></i> Schedule an activity</a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-create-deal-scheduled-activity" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add New Activity Schedule</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>            
            <div class="modal-body">                
                <form id="frm-save-activity-schedule">     
                <input type="hidden" id="cdi" name="cdi" value="" />
                <div class="row">                        
                    <div class="col-sm-12">
                        <label class="mb-2">Activity Subject</label>
                        <div class="input-group mb-3">
                            <input type="text" name="activity_name" value="" class="form-control" required="" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Activity Type</label>
                        <div class="input-group mb-3">
                            <select class="form-select select-activity-type" name="activity_type">
                                <?php foreach($optionActivityTypes as $key => $value){ ?>
                                    <option data-icon="<?= $value['icon']; ?>" value="<?= $key; ?>"><?= $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">From</label>
                        <div class="input-group mb-3" style="width:65%;">
                            <input type="date" class="form-control" name="date_from" value="<?= date("Y-m-d"); ?>" style="margin-right:2px;" />
                            <input type="time" class="form-control" name="time_from" value="<?= date("H:i"); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">To</label>
                        <div class="input-group mb-3" style="width:65%;">
                            <input type="date" class="form-control" name="date_to" value="<?= date("Y-m-d"); ?>" style="margin-right:2px;" />
                            <input type="time" class="form-control" name="time_to" value="<?= date("H:i"); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Priority</label>
                        <div class="input-group mb-3">
                            <select class="form-select select-activity-priority" name="activity_priority">
                                <?php foreach($optionsPriorities as $key => $value){ ?>
                                    <option data-icon="<?= $value['icon']; ?>" data-color="<?= $value['color']; ?>" value="<?= $key; ?>"><?= $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Owner</label>
                        <div class="input-group mb-3">
                            <select class="form-select activity-company-users" name="owner_id"></select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label class="mb-2">Location</label>
                        <div class="autocomplete-panel">
                            <div id="autocomplete" class="autocomplete-container"></div>
                            <input type="hidden" name="activity_location" id="autocomplete-map-address" value="" class="form-control" />
                        </div>                     
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Notes</label>
                        <textarea name="activity_notes" id="ck-activity-notes" class="form-control"></textarea>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_done" value="1" id="activity-is-done">
                            <label class="form-check-label" for="activity-is-done">
                                Mark as Done
                            </label>
                        </div>
                    </div>                    
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-save-schedule-activity" form="frm-save-activity-schedule">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-edit-deal-scheduled-activity" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Edit Activity Schedule</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>            
            <div class="modal-body">                
                <form id="frm-update-activity-schedule">     
                <input type="hidden" id="edit-asid" name="asid" value="" />
                    <div id="edit-activity-schedule-container"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button btn-danger" data-id="" data-name="" id="btn-delete-schedule-activity">Delete</button>
                <button type="submit" class="nsm-button primary" id="btn-update-schedule-activity" form="frm-update-activity-schedule">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-archive" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Archive</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body" id="customer-deals-archive-container"></div>            
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add-new-lost-reason" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add New Lost Reason</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>
            <div class="modal-body">
                <form id="frm-add-new-lost-reason">                    
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="mb-2">Reason</label>
                            <div class="input-group mb-3">
                                <input type="text" name="lost_reason" value="" class="form-control" required="" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">                        
                        <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="nsm-button primary" id="btn-save-lost-reason">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-with-selected-create-deal-scheduled-activity" data-bs-backdrop="static" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" style="font-size: 17px;">Add New Activity Schedule</span>
                <button class="border-0 rounded mx-1" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fas fa-times m-0 text-muted"></i></button>
            </div>            
            <div class="modal-body">                
                <form id="frm-with-selected-save-activity-schedule">     
                <input type="hidden" id="cdi" name="cdi" value="" />
                <div class="row">                        
                    <div class="col-sm-12">
                        <label class="mb-2">Activity Subject</label>
                        <div class="input-group mb-3">
                            <input type="text" name="activity_name" value="" class="form-control" required="" autocomplete="off" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Activity Type</label>
                        <div class="input-group mb-3">
                            <select class="form-select with-selected-select-activity-type" name="activity_type">
                                <?php foreach($optionActivityTypes as $key => $value){ ?>
                                    <option data-icon="<?= $value['icon']; ?>" value="<?= $key; ?>"><?= $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">From</label>
                        <div class="input-group mb-3" style="width:65%;">
                            <input type="date" class="form-control" name="date_from" value="<?= date("Y-m-d"); ?>" style="margin-right:2px;" />
                            <input type="time" class="form-control" name="time_from" value="<?= date("H:i"); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">To</label>
                        <div class="input-group mb-3" style="width:65%;">
                            <input type="date" class="form-control" name="date_to" value="<?= date("Y-m-d"); ?>" style="margin-right:2px;" />
                            <input type="time" class="form-control" name="time_to" value="<?= date("H:i"); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Priority</label>
                        <div class="input-group mb-3">
                            <select class="form-select with-selected-select-activity-priority" name="activity_priority">
                                <?php foreach($optionsPriorities as $key => $value){ ?>
                                    <option data-icon="<?= $value['icon']; ?>" data-color="<?= $value['color']; ?>" value="<?= $key; ?>"><?= $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Owner</label>
                        <div class="input-group mb-3">
                            <select class="form-select with-selected-activity-company-users" name="owner_id"></select>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-2">
                        <label class="mb-2">Location</label>
                        <div class="autocomplete-panel">
                            <div id="autocomplete-with-selected" class="autocomplete-container"></div>
                            <input type="hidden" name="activity_location" id="autocomplete-with-selected-map-address" value="" class="form-control" />
                        </div>                     
                    </div>
                    <div class="col-sm-12">
                        <label class="mb-2">Notes</label>
                        <textarea name="activity_notes" id="ck-with-selected-activity-notes" class="form-control"></textarea>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="is_done" value="1" id="activity-is-done">
                            <label class="form-check-label" for="activity-is-done">
                                Mark as Done
                            </label>
                        </div>
                    </div>                    
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="" class="nsm-button" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="nsm-button primary" id="btn-with-selected-save-schedule-activity" form="frm-with-selected-save-activity-schedule">Save</button>
            </div>
        </div>
    </div>
</div>

