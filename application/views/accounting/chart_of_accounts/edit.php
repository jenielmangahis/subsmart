<div class="modal fade" id="modalEditAccount" tabindex="-1" role="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg w-50 m-auto" role="document" style="max-width: 800px !important">
        <div class="modal-content">
            <?php echo form_open_multipart('accounting/chart-of-accounts/update/'.$chart_of_accounts->id, ['class' => 'form-validate', 'autocomplete' => 'off']); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addLocationLabel">Edit Account</h5>
                    <button type="button" class="close" id="closeModalInvoice" data-dismiss="modal" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body" style="max-height: 650px;">
                    <!-- end row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account_type">Account Type</label>
                                                <select name="account_type" id="edit_account_type" class="form-control select2" required>
                                                    <?php foreach ($this->account_model->getAccounts() as $row): ?>
                                                        <option value="<?php echo $row->id ?>" <?php if($row->id == $chart_of_accounts->account_id) { echo "selected";} ?>><?php echo $row->account_name ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="detail_type">Detail Type</label>
                                                <select name="detail_type" id="edit_detail_type" class="form-control select2" required>
                                                    <!-- <option selected value="<?php echo $chart_of_accounts->acc_detail_id?>"><?php echo $this->account_detail_model->getName($chart_of_accounts->acc_detail_id) ?></option> -->
                                                    <?php foreach ($this->account_detail_model->getDetailTypesById($chart_of_accounts->account_id) as $row_detail): ?>
                                                        <option value="<?php echo $row_detail->acc_detail_id ?>" <?php if($row_detail->acc_detail_id == $chart_of_accounts->acc_detail_id) { echo "selected";} ?> ><?php echo $row_detail->acc_detail_name ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="detail-type-desc">
                                                <?=$detail_type->description?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="edit_name" required
                                                    placeholder="Enter Name" value="<?php echo $chart_of_accounts->name ?>" 
                                                    autofocus/>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea type="text" class="form-control" name="description" id="edit_description"
                                                        placeholder="Enter Description" rows="3"><?php echo $chart_of_accounts->description ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="sub_account" class="js-switch" id="edit_check_sub" onchange="check(this)" <?=$chart_of_accounts->parent_acc_id != 0 || $chart_of_accounts->parent_acc_id != null ? 'checked' : ''?>/>
                                                <label for="formClient-Status">Is sub account</label>
                                                <select name="sub_account_type" id="edit_sub_account_type" class="form-control select2" required <?=$chart_of_accounts->parent_acc_id == 0 || $chart_of_accounts->parent_acc_id == null ? 'disabled' : ''?>  >
                                                    <?php if($chart_of_accounts->parent_acc_id === 0 || $chart_of_accounts->parent_acc_id === null) : ?>
                                                        <option disabled selected>Enter parent account</option>
                                                    <?php endif; ?>
                                                    <?php foreach($accountsDropdown as $key => $accounts) : ?>
                                                        <optgroup label="<?=$key?>">
                                                            <?php foreach($accounts as $account) : ?>
                                                                <option value="<?=$account['id']?>" <?=$chart_of_accounts->parent_acc_id === $account['id'] ? 'selected' : '' ?>><?=$account['name']?></option>
                                                                <?php if(!empty($account['child_accounts'])) : ?>
                                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;<?='Sub-account of '.$account['name']?>">
                                                                        <?php foreach($account['child_accounts'] as $subAcc) : ?>
                                                                            <option value="<?=$subAcc->id?>" <?=$chart_of_accounts->parent_acc_id === $account['id'] ? 'selected' : '' ?>><?=$account['name']?>>&nbsp;&nbsp;&nbsp;&nbsp;<?=$subAcc->name?></option>
                                                                        <?php endforeach; ?>
                                                                    </optgroup>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </optgroup>
                                                    <?php endforeach; ?>
                                                </select>
                                                <br>
                                                <label for="choose_time">When do you want to start tracking your finances from this account in nSmarTrac?</label>
                                                <span></span>
                                                <select name="choose_time" id="edit_choose_time" class="form-control select2" required onchange="showdiv(this)">
                                                    <option selected="selected" disabled="disabled">Choose one</option>
                                                    <option value="Beginning of this year" <?php if($chart_of_accounts->time == "Beginning of this year") { echo "selected";} ?>>Beginning of this year</option>
                                                    <option value="Beginning of this month" <?php if($chart_of_accounts->time == "Beginning of this month") { echo "selected";} ?>>Beginning of this month</option>
                                                    <option value="Today" <?php if($chart_of_accounts->time == "Today") { echo "selected";} ?>>Today</option>
                                                    <option value="Other" <?php if($chart_of_accounts->time == "Other") { echo "selected";} ?> onclick="hidediv()">Other</option>
                                                </select>
                                            </div>
                                            <div class="form-group hide-date <?=$chart_of_accounts->time === 'Other' ? '' : 'hide'?>">
                                                <label for="time_date">Date</label>
                                                <div class="col-xs-10 date_picker">
                                                    <input type="text" class="form-control" name="time_date" id="edit_time_date"
                                                    placeholder="Enter Date" autofocus 
                                                    value="<?php if($chart_of_accounts->time_date != ''){echo $chart_of_accounts->time_date;}else{echo "";}?>"/>
                                                </div>
                                            </div>
                                            <div class="form-group hide-div">
                                                <label for="balance">Balance</label>
                                                <input type="text" class="form-control" name="balance" id="edit_balance" required
                                                    placeholder="Enter Balance" value="<?php echo $chart_of_accounts->balance ?>"
                                                    autofocus/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-6"><button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button></div>
                        <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>