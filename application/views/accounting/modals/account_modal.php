<!-- add account modal -->
<div class="modal fade" id="account-modal" tabindex="-1" role="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg w-50 m-auto" role="document" style="max-width: 800px !important">
        <div class="modal-content">
            <?php $action = isset($account) ? '/accounting/chart-of-accounts/update/'.$account->id : '/accounting/chart-of-accounts/add'; ?>
            <form action="<?=$action?>" method="post" class="form-validate" novalidate="novalidate">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLocationLabel">Accounts</h5>
                    <button type="button" class="close close-account-modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body" style="max-height: 650px;">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card p-0 m-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="account_type">Account Type</label>
                                                <select name="account_type" id="account_type" class="form-control select2" required>
                                                    <?php if(isset($accountType)) : ?>
                                                        <option value="<?=$accountType->id?>" selected><?=$accountType->account_name?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="detail_type">Detail Type</label>
                                                <select name="detail_type" id="detail_type" class="form-control select2" required>
                                                    <?php if(isset($detailType)) : ?>
                                                        <option value="<?=$detailType->acc_detail_id?>" selected><?=$detailType->acc_detail_name?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="detail-type-desc">
                                                <?php if(isset($detailType)) : ?>
                                                    <?=$detailType->description?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <?php if(isset($account)) {
                                                    $name = $account->name;
                                                } else {
                                                    $name = isset($detailType) ? $detailType->acc_detail_name : '';
                                                } ?>
                                                <input type="text" class="form-control" name="name" id="name" required placeholder="Enter Name" value="<?=$name?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea type="text" class="form-control" name="description" id="description" placeholder="Enter Description" rows="3" required><?=isset($account) ? $account->description : ''?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" <?=isset($parentAcc) ? 'checked' : ''?>/>
                                                <label for="formClient-Status">Is sub account</label>
                                                <select name="parent_account" id="parent_account" class="form-control select2" required <?=isset($account) && in_array($account->parent_acc_id, ['', null, 0]) || !isset($account) ? 'disabled' : ''?>>
                                                    <?php if(isset($parentAcc)) : ?>
                                                        <option value="<?=$parentAcc->id?>" selected><?=$parentAcc->name?></option>
                                                    <?php endif; ?>
                                                </select>
                                                <?php if(!isset($account)) : ?>
                                                <br>
                                                <label for="choose_time">When do you want to start tracking your finances from this account in nSmarTrac?</label>
                                                <span></span>
                                                <select name="choose_time" id="choose_time" class="form-control select2" required>
                                                    <option selected="selected" disabled>Choose one</option>
                                                    <option value="beginning-of-year">Beginning of this year</option>
                                                    <option value="beginning-of-month">Beginning of this month</option>
                                                    <option value="today">Today</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <?php endif; ?>
                                            </div>
                                            <?php if(!isset($account)) : ?>
                                            <div class="form-group hide-date hide">
                                                <label for="time_date">Date</label>
                                                <div class="col-xs-10 date_picker">
                                                    <input type="text" class="form-control" name="time_date" id="time_date" placeholder="Enter Date" onchange="showBalance(this)"/>
                                                </div>
                                            </div>
                                            <div class="form-group hide-div hide">
                                                <label for="balance">Balance</label>
                                                <input type="text" class="form-control" name="balance" id="balance" required placeholder="Enter Balance"/>
                                            </div>
                                            <?php else : ?>
                                            <div class="form-group">
                                                <label for="balance">Balance</label>
                                                <p id="balance"><?=number_format($account->balance, 2, '.', ',')?></p>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                    </div>

                </div>
                <!-- end modal-body -->
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-6"><button type="button" class="btn btn-secondary close-account-modal">Cancel</button></div>
                        <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add account modal -->