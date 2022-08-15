<!-- add account modal -->
<div class="modal fade nsm-modal fade d-flex" id="account-modal" tabindex="-1" role="dialog" aria-labelledby="account-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg m-auto">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="account-modal-label">Accounts</span>
                <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="account_type">Account Type</label>
                        <select name="account_type" id="account_type" class="nsm-field mb-2 form-control d-select2-account-type" required>
                            <option value="<?=$accountType->id?>" selected><?=$accountType->account_name?></option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control nsm-field mb-2" name="name" id="name" required placeholder="Enter Name" value="<?=$detailType->acc_detail_name?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="detail_type">Detail Type</label>
                        <select name="detail_type" id="detail_type" class="nsm-field mb-2 form-control d-select2-detail-type" required>
                            <option value="<?=$detailType->acc_detail_id?>" selected><?=$detailType->acc_detail_name?></option>
                        </select>

                        <div class="mt-3">
                            <?=$detailType->description?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control nsm-field mb-2" name="description" id="description" placeholder="Enter Description" rows="3" required></textarea>

                        <div class="mt-3 mb-2">
                            <input type="checkbox" name="sub_account" class="js-switch" id="check_sub"/>
                            <label for="formClient-Status">Is sub account</label>
                        </div>

                        <div class="mt-3">
                            <select name="parent_account" id="parent_account" class="nsm-field mb-2 form-control d-select2-detail-type" required disabled></select>
                        </div>

                        <div class="mt-3">
                            <label for="choose_time">When do you want to start tracking your finances from this account in nSmarTrac?</label>
                            <select name="choose_time" id="choose_time" class="nsm-field mb-2 form-control d-select2-detail-type" required>
                                <option selected="selected" disabled>Choose one</option>
                                <option value="beginning-of-year">Beginning of this year</option>
                                <option value="beginning-of-month">Beginning of this month</option>
                                <option value="today">Today</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mt-3 hide-date d-none">
                            <label for="time_date">Date</label>
                            <div class="nsm-field-group calendar">
                                <input type="text" name="time_date" id="time_date" class="nsm-field form-control datepicker" onchange="showBalance(this)">
                            </div>
                        </div>
                        <div class="mt-3 hide-div d-none">
                            <label for="balance">Balance</label>
                            <input type="text" class="form-control nsm-field mb-2" name="balance" id="balance" required placeholder="Enter Balance"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-md-6">
                        <button type="button" class="nsm-button primary close-account-modal" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="nsm-button success">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end add account modal -->