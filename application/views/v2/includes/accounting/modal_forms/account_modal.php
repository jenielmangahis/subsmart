<!-- add account modal -->
<div class="modal fade nsm-modal fade d-flex" id="account-modal" tabindex="-1" role="dialog" aria-labelledby="account-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg m-auto">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title content-title" id="account-modal-label">Accounts</span>
                <button type="button" class="close-account-modal" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-fw bx-x m-0'></i></button>
            </div>
            <?php $action = isset($account) ? base_url() . 'accounting/chart-of-accounts/update/'.$account->id : base_url() . 'accounting/chart-of-accounts/add'; ?>
            <form action="<?=$action?>" method="post" class="form-validate">
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="account_type">Account Type</label>
                        <select name="account_type" id="account_type" class="nsm-field mb-2 form-control" required>
                            <option value="<?=$accountType->id?>" selected><?=$accountType->account_name?></option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="name">Name</label>
                        <input type="text" class="form-control nsm-field mb-2" name="name" id="name" required placeholder="Enter Name" value="<?=isset($account) ? $account->name : ""; ?>"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <label for="detail_type">Detail Type</label>
                        <select name="detail_type" id="detail_type" class="nsm-field mb-2 form-control" required>
                            <option value="<?=$detailType->acc_detail_id?>" selected><?=$detailType->acc_detail_name?></option>
                        </select>

                        <div class="mt-3">
                            <?=$detailType->description?>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <label for="description">Description</label>
                        <textarea type="text" class="form-control nsm-field mb-2" name="description" id="description" placeholder="Enter Description" rows="3" required><?=isset($account) ? $account->description : ''?></textarea>

                        <div class="mt-3 mb-2">
                            <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" <?=isset($parentAcc) ? 'checked' : ''?>/>
                            <label for="check_sub">Is sub account</label>
                        </div>

                        <div class="mt-3">
                            <select name="parent_account" id="parent_account" class="nsm-field mb-2 form-control" <?=isset($account) && in_array($account->parent_acc_id, ['', null, 0]) || !isset($account) ? 'disabled' : ''?>>
                                <?php if(isset($parentAcc)) : ?>
                                    <option value="<?=$parentAcc->id?>" selected><?=$parentAcc->name?></option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <?php if(!isset($account)) : ?>
                        <div class="mt-3">
                            <label for="choose_time">When do you want to start tracking your finances from this account in nSmarTrac?</label>
                            <select name="choose_time" id="choose_time" class="nsm-field mb-2 form-control" required>
                                <option value="" selected="selected">Choose one</option>
                                <option value="beginning-of-year">Beginning of this year</option>
                                <option value="beginning-of-month">Beginning of this month</option>
                                <option value="today">Today</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mt-3 d-none">
                            <label for="time_date">Date</label>
                            <div class="nsm-field-group calendar">
                                <input type="text" name="time_date" id="time_date" class="nsm-field form-control date" onchange="showBalance(this)">
                            </div>
                        </div>

                        <div class="mt-3 d-none">
                            <label for="balance">Account balance at end of <span id="selected-date"></span></label>
                            <input type="number" min="0" value="0" class="form-control nsm-field mb-2" name="balance" id="balance" placeholder="Enter Balance"/>
                        </div>
                        <?php else : ?>
                        <div class="mt-3">
                            <label for="balance">Balance</label>
                            <p id="balance"><?=str_replace("$-", "-$", "$".number_format($account->balance, 2, '.', ','))?></p>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row w-100">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 text-end">
                        <button type="button" class="nsm-button close-account-modal" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="nsm-button success">Save</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- end add account modal -->