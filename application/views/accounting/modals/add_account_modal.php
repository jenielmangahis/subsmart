<!-- add account modal -->
<div class="modal fade" id="add-account-modal" tabindex="-1" role="dialog" aria-labelledby="addLocationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg w-50 m-auto" role="document" style="max-width: 800px !important">
        <div class="modal-content">
            <form action="/accounting/chart-of-accounts/add" method="post" class="form-validate" novalidate="novalidate">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLocationLabel">Accounts</h5>
                    <button type="button" class="close close-add-account" aria-label="Close"><i class="fa fa-times fa-lg"></i></button>
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
                                                <select name="detail_type" id="detail_type" class="form-control select2" required></select>
                                            </div>
                                            <div class="detail-type-desc"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" required placeholder="Enter Name"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea type="text" class="form-control" name="description" id="description"
                                                        placeholder="Enter Description" rows="3" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" name="sub_account" class="js-switch" id="check_sub" onchange="check(this)"/>
                                                <label for="formClient-Status">Is sub account</label>
                                                <select name="parent_account" id="parent_account" class="form-control select2" required disabled></select>
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
                                            </div>
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
                        <div class="col-md-6"><button type="button" class="btn btn-secondary close-add-account">Cancel</button></div>
                        <div class="col-md-6"><button type="submit" name="save" class="btn btn-success float-right">Save</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end add account modal -->