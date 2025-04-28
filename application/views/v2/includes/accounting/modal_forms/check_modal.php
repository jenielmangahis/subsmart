<!-- Modal for bank deposit-->
<style>
    .btn-recent-checks-print{
        display:inline-block;
        float:right;
    }
    #checkModal h5.dropdown-header{
        display:inline-block;
    }
    #checkModal #category-details-table td .table-checkbox{
        margin:0 auto;
    }
    #checkModal .nsm-table thead td{
        background-color:#6a4a86;
        color:#ffffff;
    }
    .dropzone {
        min-height: 160px !important;
    }
    .span-input{
        display: block;
        width: 100%;
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .fw-normalx {
        font-weight: 500;
    }

    .cursorPointer {
        cursor: pointer;
    }

    #payee-modal .modal-content,
    #account-modal .modal-content {
        box-shadow: 0px 0px 10px 0px #6a4a86;
        border-radius: 10px;
    }

    .checkContainer {
        position: relative;
        width: 1000px;
        max-width: 1000px;
        height: 360px;
        border: 2px solid #000;
        padding: 20px;
        border-radius: 10px;
        background-color: #f9f9f9;
        font-family: Arial, sans-serif;
        margin: auto;
    }

    .checkSection {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .checkPayerInfo_Section {}

    .checkNumber_Section {
        right: -20px;
    }

    .printLater_Section {
        right: 46px;
        top: 55px;
    }

    .checkDate_Section {
        right: 26px;
        top: 100px;
    }

    #checkDateInput {
        width: 180px;
    }

    .checkPayee_Section {
        top: 150px;
    }

    .checkPayeeSelect+* {
        width: 625px !important;
    }

    .checkAmount_Section {
        top: 150px;
        right: 26px;
    }

    #checkAmountInput {
        width: 150px;
    }

    .checkWrittenAmount_Section {
        top: 200px;
    }

    #checkWrittenText {
        letter-spacing: 4px;
    }

    .checkBankName_Section {
        top: 250px;
    }

    .checkCategoryName_Section {
        top: 250px;
        left: 290px;
        width: 170px;
    }

    .checkExpenseAccount_Section {
        top: 250px;
        left: 470px;
        width: 240px;
    }

    .checkBankNameSelect+* {
        width: 260px !important;
    }

    .checkMemo_Section {
        bottom: 20px;
    }

    #checkMemoInput {
        background: unset;
        border-radius: 0;
        border-left: 0;
        border-right: 0;
        border-top: 0;
        width: 713px;
    }
    
    .checkSwitchButton {
        white-space: nowrap;
    }

    .topSection {
        position: absolute;
        margin-top: -18px;
    }
</style>
<div class="full-screen-modal">
<?php if(!isset($check)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="<?php echo base_url(); ?>accounting/update-transaction/check/<?=$check->id?>">
<?php endif; ?>
    <div id="checkModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row w-100">
                        <div class="col-6 d-flex align-items-center">
                            <div class="dropdown mr-1">
                                <a href="javascript:void(0);" class="h4 recent-transactions-button" data-bs-toggle="dropdown">
                                    <i class="bx bx-fw bx-history"></i>
                                </a>
                                <div class="dropdown-menu p-3" style="width: 500px">
                                    <h5 class="dropdown-header">Recent Updated Checks</h5>
                                    <!-- <a class="nsm btn-recent-checks-print text-decoration-none" href="javascript:void(0);"><i class='bx bx-printer'></i> Print Checks</a> -->
                                    <table class="table table-hover cursor-pointer recent-transactions-table" id="recent-checks">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Date</th>
                                                <th>Total Amount</th>
                                                <th>Payee</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            &nbsp;
                            <span class="modal-title content-title">
                                <div class="topSection">
                                    <div class="btn-group checkSwitchButton" role="group">
                                        <input type="radio" class="btn-check" name="options-outlined" id="standardCheck_toggle" autocomplete="off" checked>
                                        <label class="btn btn-outline-secondary fw-normalx" for="standardCheck_toggle">Standard Check</label>
                                        <input type="radio" class="btn-check" name="options-outlined" id="virtualCheck_toggle" autocomplete="off">
                                        <label class="btn btn-outline-success fw-normalx" for="virtualCheck_toggle">Virtual Check</label>
                                    </div>
                                    <span>
                                        <?php if(isset($check)) : ?>
                                            <?php if(is_null($check->to_print) && $check->check_no !== "" && !is_null($check->check_no)) : ?>
                                                #<?=$check->check_no?>
                                            <?php elseif(!is_null($check->to_print)) : ?>
                                                #To Print
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row standardCheckContent" style="min-height: 100%; display: non;">
                        <div class="col">
                            <div class="row payee-details">
                                <?php if(isset($check) && !is_null($check->linked_transacs)) : ?>
                                <div class="col-12">
                                    <button class="nsm-button open-transactions-container float-end" type="button"><i class="bx bx-fw bx-chevron-left"></i></button>

                                    <div class="dropdown">
                                        <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="linked-transaction">
                                            <?php if(count($check->linked_transacs) > 1) : ?>
                                                <?=count($check->linked_transacs)?> linked Purchase Orders
                                            <?php else : ?>
                                                1 linked Purchase Order
                                            <?php endif; ?>
                                        </a>
                                        <div class="dropdown-menu">
                                            <table class="nsm-table">
                                                <thead>
                                                    <tr>
                                                        <td data-name="Type">Type</td>
                                                        <td data-name="Date">Date</td>
                                                        <td data-name="Amount">Amount</td>
                                                        <td data-name="Action"></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($check->linked_transacs as $linkedTransac) : ?>
                                                    <tr>
                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="<?=$linkedTransac['transaction']->id?>" data-type="purchase-order">Purchase Order</a></td>
                                                        <td><?=date("m/d/Y", strtotime($linkedTransac['transaction']->purchase_order_date))?></td>
                                                        <td>
                                                                <?php
                                                            $transacAmount = $linkedTransac['transaction']->total_amount;
                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                            echo str_replace('$-', '-$', $transacAmount);
                                                            ?>
                                                        </td>
                                                        <td><button type="button" class="nsm-button unlink-transaction" data-type="purchase-order" data-id="<?=$linkedTransac['transaction']->id?>">Remove</button></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <?php foreach($check->linked_transacs as $linkedTransac) : ?>
                                        <input type="hidden" value="purchase_order-<?=$linkedTransac['transaction']->id?>" name="linked_transaction[]">
                                    <?php endforeach; ?>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-8 grid-mb">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <label for="payee">Payee</label>
                                            <div id="open-payee-info-window-container" style='float:right;'>
                                                <a href="javascript:void(0)" class="nsm-button btn-small" style="margin-bottom:3px;display:inline-block;" id="open-payee-info-window">View Payee Info</a>
                                            </div>  
                                            <select name="payee" id="payee" class="nsm-field form-control">
                                                <?php if(isset($check)) : ?>
                                                <option value="<?=$check->payee_type.'-'.$check->payee_id?>">
                                                <?php
                                                    switch($check->payee_type) {
                                                        case 'vendor' :
                                                            $vendor = $this->vendors_model->get_vendor_by_id($check->payee_id);
                                                            echo $vendor->display_name;
                                                        break;
                                                        case 'customer' :
                                                            $customer = $this->accounting_customers_model->get_by_id($check->payee_id);
                                                            echo $customer->first_name . ' ' . $customer->last_name;
                                                        break;
                                                        case 'employee' :
                                                            $employee = $this->users_model->getUser($check->payee_id);
                                                            echo $employee->FName . ' ' . $employee->LName;
                                                        break;
                                                    }
                                                ?>
                                                </option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="bank_account">Bank account</label>
                                            <select name="bank_account" id="bank_account" class="nsm-field form-control" required>
                                                <?php if(isset($check)) : ?>
                                                    <option value="<?=$check->bank_account_id?>"><?=$this->chart_of_accounts_model->getName($check->bank_account_id)?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-3 ">
                                            <label for="account_balance">Balance</label>
                                            <!-- <input type="text" name="account_balance" disabled id="account_balance" class="form-control nsm-field mb-2 date" value="<?php echo $balance; ?>"> -->
                                            <span id="account-balance" class="span-input"><?= $balance ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6>
                                        <?php if(isset($check)) : ?>
                                        <?=$check->status === "4" ? "PAYMENT STATUS" : "AMOUNT" ?>
                                        <?php else : ?>
                                        AMOUNT
                                        <?php endif; ?>
                                    </h6>
                                    <h2>
                                        <?php if(isset($check)) : ?>
                                            <?php if($check->status === "4") : ?>
                                                VOID
                                            <?php else : ?>
                                                <span class="transaction-total-amount">
                                                    <?php
                                                        $amount = '$'.number_format(floatval($check->total_amount), 2, '.', ',');
                                                        $amount = str_replace('$-', '-$', $amount);
                                                        echo $amount;
                                                    ?>
                                                </span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <span class="transaction-total-amount">$0.00</span>
                                        <?php endif; ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="row">
                                <?php if($is_copy) : ?>
                                <div class="col-12">
                                    <div class="nsm-callout primary">
                                        <button><i class='bx bx-x'></i></button>
                                        <h6 class="mt-0">This is a copy</h6>
                                        <span>This is a copy of a check. Revise as needed and save the check.</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <div class="col-12 col-md-2">
                                    <label for="mailing_address">Mailing address</label>
                                    <textarea name="mailing_address" id="mailing_address" style="min-height: 192px;" class="form-control nsm-field mb-2"><?=isset($check) ? str_replace("<br />", "", $check->mailing_address) : ''?></textarea>
                                </div>
                                <div class="col-12 col-md-2">
                                    <label for="payment_date">Payment date</label>
                                    <div class="nsm-field-group calendar">
                                        <input type="text" name="payment_date" id="payment_date" class="form-control nsm-field mb-2 date" value="<?=isset($check) ? ($check->payment_date !== "" && !is_null($check->payment_date) ? date("m/d/Y", strtotime($check->payment_date)) : "") : date("m/d/Y")?>" required>
                                    </div>
                                    <div class="mb-2">
                                        <label for="check_no">Check no.</label>
                                        <input type="text" name="check_no" id="check_no" class="form-control nsm-field" <?=isset($check) && !is_null($check->to_print) ? "value='To Print' disabled" : "value='$check->check_no'"?>>
                                        <div class="form-check">
                                            <input type="checkbox" name="print_later" id="print_later" class="form-check-input" value="1" <?=isset($check) && !is_null($check->to_print) ? 'checked' : ''?>>
                                            <label for="print_later" class="form-check-label">Print later</label>
                                        </div>
                                    </div>
                                    <label for="permit_number">Permit no.</label>
                                    <input type="number" class="form-control nsm-field mb-2" name="permit_number" id="permit_number" <?=isset($check) ? "value='$check->permit_no'" : ''?>> 
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-12 col-md-2">
                                    <!-- 
                                    <div class="mb-2">
                                        <label for="check_no">Check no.</label>
                                        <input type="text" name="check_no" id="check_no" class="form-control nsm-field" <?=isset($check) && !is_null($check->to_print) ? "value='To Print' disabled" : "value='$check->check_no'"?>>
                                        <div class="form-check">
                                            <input type="checkbox" name="print_later" id="print_later" class="form-check-input" value="1" <?=isset($check) && !is_null($check->to_print) ? 'checked' : ''?>>
                                            <label for="print_later" class="form-check-label">Print later</label>
                                        </div>
                                    </div>
                                    <label for="permit_number">Permit no.</label>
                                    <input type="number" class="form-control nsm-field mb-2" name="permit_number" id="permit_number" <?=isset($check) ? "value='$check->permit_no'" : ''?>> 
                                    -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4 grid-mb">
                                    <div id="label">
                                        <label for="tags">Tags</label>
                                        <span class="float-end"><a href="#" class="text-decoration-none" id="open-tags-modal">Manage tags</a></span>
                                    </div>
                                    <select name="tags[]" id="tags" class="form-control" multiple="multiple">
                                        <?php if(isset($tags) && count($tags) > 0) : ?>
                                            <?php foreach($tags as $tag) : ?>
                                                <?php 
                                                    $name = $tag->name;
                                                    if($tag->group_tag_id !== null) {
                                                        $group = $this->tags_model->getGroupById($tag->group_tag_id);
                                                        $name = $group->name.': '.$tag->name;
                                                    }
                                                ?>
                                                <option value="<?=$tag->id?>" selected><?=$name?></option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 categoryItemSection"> 
                                    <div class="accordion grid-mb categoryItemCollapsible">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-category-details" aria-expanded="true" aria-controls="collapse-category-details">
                                                    Category details
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse show" id="collapse-category-details">
                                                <div class="accordion-body">
                                                    <table class="nsm-table" id="category-details-table">
                                                        <thead>
                                                            <tr>
                                                                <td data-name="Num" style="width:3%;text-align:center;">#</td>
                                                                <td data-name="Customer" style="width:15%;">CUSTOMER</td>
                                                                <td data-name="Expense Name">EXPENSE NAME</td>
                                                                <td data-name="Category" style="width:15%;">CATEGORY</td>
                                                                <td data-name="Description">DESCRIPTION</td>
                                                                <td data-name="Amount" style="width:10%;">AMOUNT</td>
                                                                <td data-name="Billable" style="width:8%;text-align:center;">BILLABLE</td>
                                                                <td data-name="Markup %" style="width:8%;">MARKUP %</td>
                                                                <td data-name="Tax" style="width:5%;text-align:center;">TAX</td>                                                                
                                                                <?php if(isset($check) && !is_null($check->linked_transacs)) : ?>
                                                                <td data-name="Linked"></td>
                                                                <?php endif; ?>
                                                                <td data-name="Manage" style="width:3%;"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>
                                                                    <select name="category_customer[]" class="nsm-field form-control"></select>
                                                                </td>
                                                                <td>
                                                                    <select name="expense_account[]" class="nsm-field form-control" required></select>
                                                                </td>
                                                                <td>
                                                                    <select name="category[]" class="nsm-field form-control">
                                                                        <option disabled selected>&nbsp;</option>
                                                                        <option value="fixed">Fixed Cost</option>
                                                                        <option value="variable">Variable Cost</option>
                                                                        <option value="periodic">Periodic Cost</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="description[]" class="nsm-field form-control"></td>
                                                                <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" value="0.00" class="nsm-field form-control text-end" step=".01"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox">
                                                                        <input class="form-check-input table-select" name="category_billable[]" type="checkbox" value="1">
                                                                    </div>
                                                                </td>
                                                                <td><input type="number" name="category_markup[]" class="nsm-field form-control text-end" onchange="convertToDecimal(this)"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox">
                                                                        <input class="form-check-input table-select" name="category_tax[]" type="checkbox" value="1">
                                                                    </div>
                                                                </td>                                                               
                                                                <td>
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $count = 1; ?>
                                                            <?php if(isset($categories) && count($categories) > 0) : ?>
                                                            <?php foreach($categories as $category) : ?>
                                                            <tr>
                                                                <td><?=$count?></td>
                                                                <td>
                                                                    <select name="category_customer[]" class="nsm-field form-control">
                                                                        <option value="<?=$category->customer_id?>">
                                                                            <?php $customer = $this->accounting_customers_model->get_by_id($category->customer_id); ?>
                                                                            <?=$customer->first_name . ' ' . $customer->last_name?>
                                                                        </option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="expense_account[]" class="nsm-field form-control" required>
                                                                        <option value="<?=$category->expense_account_id?>"><?=$this->chart_of_accounts_model->getName($category->expense_account_id)?></option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select name="category[]" class="nsm-field form-control">
                                                                        <option disabled selected>&nbsp;</option>
                                                                        <option value="fixed" <?=$category->category === 'fixed' ? 'selected' : ''?>>Fixed Cost</option>
                                                                        <option value="variable" <?=$category->category === 'variable' ? 'selected' : ''?>>Variable Cost</option>
                                                                        <option value="periodic" <?=$category->category === 'periodic' ? 'selected' : ''?>>Periodic Cost</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" name="description[]" class="nsm-field form-control" value="<?=$category->description?>"></td>
                                                                <td><input type="number" name="category_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=str_replace(',', '', number_format(floatval($category->amount), 2, '.', ','))?>"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox">
                                                                        <input class="form-check-input table-select" name="category_billable[]" type="checkbox" value="1" <?=$category->billable === "1" ? 'checked' : ''?>>
                                                                    </div>
                                                                </td>
                                                                <td><input type="number" name="category_markup[]" class="nsm-field form-control" onchange="convertToDecimal(this)" value="<?=number_format(floatval($category->markup_percentage), 2, '.', ',')?>"></td>
                                                                <td>
                                                                    <div class="table-row-icon table-checkbox">
                                                                        <input class="form-check-input table-select" name="category_tax[]" type="checkbox" value="1" <?=$category->tax === "1" ? 'checked' : ''?>>
                                                                    </div>
                                                                </td>
                                                                <?php if(isset($check) && !is_null($check->linked_transacs)) : ?>
                                                                <td>
                                                                <?php if(!is_null($category->linked_transaction_type) && !is_null($category->linked_transaction_id)) : ?>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                                                        <div class="dropdown-menu">
                                                                            <table class="nsm-table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td data-name="Type">Type</td>
                                                                                        <td data-name="Date">Date</td>
                                                                                        <td data-name="Amount">Amount</td>
                                                                                        <td data-name="Action"></td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><a class="text-decoration-none open-transaction" href="#" data-id="<?=$category->linked_transaction_id?>" data-type="purchase-order">Puchase Order</a></td>
                                                                                        <td><?=date("m/d/Y", strtotime($category->linked_transac->purchase_order_date))?></td>
                                                                                        <td>
                                                                                            <?php
                                                                                            $transacAmount = $category->linked_transac->total_amount;
                                                                                            $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                            echo str_replace('$-', '-$', $transacAmount);
                                                                                            ?>
                                                                                        </td>
                                                                                        <td><button class="nsm-button unlink-transaction" data-type="purchase-order" data-id="<?=$category->linked_transaction_id?>">Remove</button></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" value="<?=$category->linked_transaction_type?>-<?=$category->linked_transaction_id?>" name="category_linked_transaction[]">
                                                                    <input type="hidden" value="<?=$category->linked_transaction_category_id?>" name="transaction_category_id[]">
                                                                <?php endif; ?>
                                                                </td>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $count++; endforeach; ?>
                                                            <?php endif; ?>

                                                            <?php do {?>
                                                            <tr style="">
                                                                <td><?=$count?></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <?php if(isset($check) && !is_null($check->linked_transacs)) : ?>
                                                                <td></td>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $count++; } while ($count <= 2) ?>
                                                            <!-- <tr>
                                                                <td>2</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr> -->
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="11">
                                                                    <div class="nsm-page-buttons page-buttons-container">
                                                                        <button type="button" class="nsm-button" onclick="addTableLines(event)" data-target="#category-details-table">
                                                                            Add lines
                                                                        </button>
                                                                        <button type="button" class="nsm-button" onclick="clearTableLines(event)" data-target="#category-details-table">
                                                                            Clear all lines
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion grid-mb categoryItemCollapsible">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button content-title <?=isset($items) && count($items) > 0 ? '' : ' collapsed'?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-item-details" aria-expanded="false" aria-controls="collapse-item-details">
                                                    Item details
                                                </button>
                                            </h2>
                                            <div id="collapse-item-details" class="accordion-collapse collapse <?=isset($items) && count($items) > 0 ? 'show' : ''?>">
                                                <div class="accordion-body">
                                                    <table class="nsm-table" id="item-details-table">
                                                        <thead>
                                                            <tr>
                                                                <td data-name="Product/Service">PRODUCT/SERVICE</td>
                                                                <td data-name="Type" style="width:10%;">TYPE</td>
                                                                <td data-name="Location" style="width:15%;">LOCATION</td>
                                                                <td data-name="Quantity" style="width:8%;">QUANTITY</td>
                                                                <td data-name="Price" style="width:8%;">PRICE</td>
                                                                <td data-name="Discount" style="width:8%;">DISCOUNT</td>
                                                                <td data-name="Tax" style="width:8%;">TAX</td>
                                                                <td data-name="Total" style="width:8%;">TOTAL</td>
                                                                <?php if(isset($check) && !is_null($check->linked_transacs)) : ?>
                                                                <td data-name="Linked"></td>
                                                                <?php endif; ?>
                                                                <td data-name="Manage" style="width:3%;"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php if(isset($items) && count($items) > 0) : ?>
                                                                <?php foreach($items as $item) : ?>
                                                                    <?php $itemDetails = $this->items_model->getItemById($item->item_id)[0];?>
                                                                    <?php $locations = $this->items_model->getLocationByItemId($item->item_id);?>
                                                                    <tr>
                                                                        <td><?=$itemDetails->title?><input type="hidden" name="item[]" value="<?=$item->item_id?>"></td>
                                                                        <td><?=ucfirst($itemDetails->type)?></td>
                                                                        <td>
                                                                            <?php if(in_array($itemDetails->type, ['product', 'Product', 'inventory', 'Inventory'])) : ?>
                                                                            <select name="location[]" class="nsm-field form-control" required>
                                                                                <?php foreach($locations as $location) : ?>
                                                                                    <option value="<?=$location['id']?>" data-quantity="<?=$location['qty'] === null ? 0 : $location['qty']?>" <?=$item->location_id === $location['id'] ? 'selected' : ''?>><?=$location['name']?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td><input type="number" name="quantity[]" class="nsm-field form-control text-end" required value="<?=$item->quantity?>" max="<?=$locations[0]['qty']?>"></td>
                                                                        <td><input type="number" name="item_amount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=number_format(floatval($item->rate), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="discount[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=number_format(floatval($item->discount), 2, '.', ',')?>"></td>
                                                                        <td><input type="number" name="item_tax[]" onchange="convertToDecimal(this)" class="nsm-field form-control text-end" step=".01" value="<?=number_format(floatval($item->tax), 2, '.', ',')?>"></td>
                                                                        <td>
                                                                            <span class="row-total">
                                                                                <?php
                                                                                    $rowTotal = '$'.number_format(floatval($item->total), 2, '.', ',');
                                                                                    $rowTotal = str_replace('$-', '-$', $rowTotal);
                                                                                    echo $rowTotal;
                                                                                ?>
                                                                            </span>
                                                                        </td>
                                                                        <?php if(isset($check) && !is_null($check->linked_transacs)) : ?>
                                                                        <td>
                                                                        <?php if(!is_null($item->linked_transaction_type) && !is_null($item->linked_transaction_id)) : ?>
                                                                            <div class="dropdown">
                                                                                <a href="#" class="text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-fw bx-link"></i></a>
                                                                                <div class="dropdown-menu">
                                                                                    <table class="nsm-table">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <td data-name="Type">Type</td>
                                                                                                <td data-name="Date">Date</td>
                                                                                                <td data-name="Amount">Amount</td>
                                                                                                <td data-name="Action"></td>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td><a class="text-decoration-none open-transaction" href="#" data-id="<?=$item->linked_transaction_id?>" data-type="purchase-order">Puchase Order</a></td>
                                                                                                <td><?=date("m/d/Y", strtotime($item->linked_transac->purchase_order_date))?></td>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    $transacAmount = $item->linked_transac->total_amount;
                                                                                                    $transacAmount = '$'.number_format(floatval($transacAmount), 2, '.', ',');

                                                                                                    echo str_replace('$-', '-$', $transacAmount);
                                                                                                    ?>
                                                                                                </td>
                                                                                                <td><button class="nsm-button unlink-transaction" data-type="purchase-order" data-id="<?=$item->linked_transaction_id?>">Remove</button></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" value="<?=$item->linked_transaction_type?>-<?=$item->linked_transaction_id?>" name="item_linked_transaction[]">
                                                                            <input type="hidden" value="<?=$item->linked_transaction_item_id?>" name="transaction_item_id[]">
                                                                        <?php endif; ?>
                                                                        </td>
                                                                        <?php endif; ?>
                                                                        <td>
                                                                            <button type="button" class="nsm-button delete-row">
                                                                                <i class='bx bx-fw bx-trash'></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="10">
                                                                    <div class="nsm-page-buttons page-buttons-container">
                                                                        <button type="button" class="nsm-button" id="add_another_items">
                                                                            Add items
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" rows="7" class="nsm-field form-control mb-2"><?=isset($check) ? str_replace("<br />", "", $check->memo) : ''?></textarea>
                                        </div>
                                        <div class="col-12 col-md-6">   
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="check-attachments" class="dropzone d-block justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
                                                    <div class="dz-message" style="margin: 20px;border">
                                                        <span style="font-size: 16px;color: rgb(180,132,132);font-style: italic;">Drag and drop files here or</span>
                                                        <a href="#" style="font-size: 16px;color: #0b97c4">browse to upload</a>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <a href="#" id="show-existing-attachments" class="text-decoration-none">Show existing</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($check) && !is_null($check->linked_transacs)) : ?>
                        <div class="w-auto nsm-callout primary" style="display: none; max-width: 15%">
                            <div class="transactions-container h-100 p-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Add to Check</h4>
                                    </div>

                                    <?php foreach($linkableTransactions as $linkableTransac) : ?>
                                    <?php
                                    $title = $linkableTransac['type'];
                                    $title .= $linkableTransac['number'] !== '' ? ' #' . $linkableTransac['number'] : '';
                                    ?>

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><?=$title?></h5>
                                                <p class="card-subtitle"><?=$linkableTransac['formatted_date']?></p>
                                                <p class="card-text">
                                                    <strong>Total</strong>&emsp;<?=$linkableTransac['total']?>
                                                    <?php if($linkableTransac['type'] === 'Purchase Order') : ?>
                                                    <br>
                                                    <strong>Balance</strong>&emsp;<?=$linkableTransac['balance']?>
                                                    <?php endif; ?>
                                                </p>
                                                <ul class="d-flex justify-content-around list-unstyled">
                                                    <li><a href="#" class="add-transaction text-decoration-none" data-id="<?=$linkableTransac['id']?>" data-type="<?=$linkableTransac['type']?>"><strong>Add</strong></a></li>
                                                    <li><a href="#" class="open-transaction text-decoration-none" data-id="<?=$linkableTransac['id']?>" data-type="<?=$linkableTransac['type']?>"><strong>Open</strong></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="row virtualCheckContent" style="display: none;">
                        <div class="checkContainer">
                            <div class="checkSection">
                                <div class="checkPayerInfo_Section position-absolute d-none">
                                    <strong class="checkPayerNameText">{PAYER_NAME}</strong><br>
                                    <span class="checkPayerAddressText">{ADDRESS}</span>
                                </div>
                                <div class="printLater_Section position-absolute">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="checkPrintLater">
                                        <label class="form-check-label text-muted" for="checkPrintLater">Print Later</label>
                                    </div>
                                </div>
                                <div class="checkNumber_Section position-absolute">
                                    <div class="d-flex align-items-center">
                                        <label for="checkNumberInput" class="me-2">Check No.</label>
                                        <input type="number" id="checkNumberInput" class="form-control form-control-sm w-50">
                                    </div>
                                </div>
                                <div class="checkDate_Section position-absolute">
                                    <div class="d-flex align-items-center">
                                        <label for="checkDateInput" class="me-2">Date</label>
                                        <input type="date" id="checkDateInput" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="checkPayee_Section position-absolute">
                                    <div class="d-flex align-items-center">
                                        <strong for="checkPayeeSelect" class="me-2 text-nowrap">Pay to the Order of</strong>
                                        <select id="payee" name="payee" class="form-select checkPayeeSelect">
                                            <option value="" selected disabled>Select payee...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="checkAmount_Section position-absolute">
                                    <div class="input-group">
                                        <div class="input-group-text" id="btnGroupAddon"><strong>$</strong></div>
                                        <input id="checkAmountInput" type="number" class="form-control" placeholder="0.00" step="any">
                                    </div>
                                </div>
                                <div class="checkWrittenAmount_Section position-absolute">
                                    <div class="d-flex align-items-center">
                                        <span id="checkWrittenText" class="me-2 text-nowrap">{WRITTEN_AMOUNT}</span>
                                        <strong class="me-2 text-nowrap">Dollars</strong>
                                    </div>
                                </div>
                                <div class="checkBankName_Section position-absolute">
                                    <select id="bank_account" name="bank_account" class="form-select checkBankNameSelect">
                                        <option value="" selected disabled>Select Bank...</option>
                                    </select>
                                </div>
                                <div class="checkCategoryName_Section position-absolute">
                                    <select name="category[]" class="form-select checkCategorySelect">
                                        <option value="" selected disabled>Select Category...</option>
                                    </select>
                                </div>
                                <div class="checkExpenseAccount_Section position-absolute">
                                    <select name="expense_account[]" class="form-select checkExpenseAccountSelect">
                                        <option value="" selected disabled>Select Expense Account...</option>
                                    </select>
                                </div>
                                <div class="checkMemo_Section position-absolute">
                                    <div class="d-flex align-items-center">
                                        <strong for="checkMemoInput" class="me-2 text-nowrap">Memo</strong>
                                        <input type="text" id="checkMemoInput" class="form-control" placeholder="Specify notes...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            $('.checkBankNameSelect').change(function(e) {
                                e.stopPropagation();
                            });
                        </script>
                    </div>
                    <div class="container mt-3">
                        <div class="row virtualOtherDetails"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-md-4">
                            <button type="button" class="nsm-button primary" data-bs-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-4">
                            <div class="row h-100">
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <span><a href="#" class="text-dark text-decoration-none" id="print-check">Print check</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" class="text-dark text-decoration-none m-auto" onclick="makeRecurring('check')">Make Recurring</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#" <?=isset($check) ? '' : 'onclick="saveAndVoid(event)"' ?> id="<?=isset($check) ? 'copy-check' : 'save-and-void'?>"><?=isset($check) ? 'Copy' : 'Void'?></a>
                                            <?php if(isset($check)) : ?>
                                            <?php if($check->status !== "4") : ?>
                                            <a class="dropdown-item" href="#" id="void-check">Void</a>
                                            <?php endif; ?>
                                            <a class="dropdown-item" href="#" id="delete-check">Delete</a>
                                            <a class="dropdown-item" href="#">Transaction journal</a>
                                            <a class="dropdown-item" href="#">Audit history</a>
                                            <?php endif; ?>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" onclick="saveAndNewForm(event)">
                                    Save and new
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndCloseForm(event)">Save and close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end of modal-->
</form>
</div>
<script>
    $(document).ready(function () {
        $('#category-details-table td').click().change();
    });

    var currentCheckNo = $('#checkNumberInput').val();
    var totalAmountInVirtualCheck = 0.00;

    function setPayerDetails() {
        $.ajax({
            type: "POST",
            url: window.origin + "/accounting/getPayerDetails",
            dataType: "JSON",
            success: function(response) {
                $('.checkPayerNameText').text(response.name);

                const formatAddress = (address) => {
                    return address
                        .split(/\s+/)
                        .map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase())
                        .join(' ');
                };

                const formattedAddress = formatAddress(response.address || '') +
                    (response.city ? `, ${formatAddress(response.city)}` : '') +
                    (response.state ? `, ${formatAddress(response.state)}` : '') +
                    (response.postal_code ? `, ${response.postal_code}` : '');

                $('.checkPayerAddressText').text(formattedAddress.trim());
            }
        });
    }
    setPayerDetails();

    $('#checkNumberInput').on('input', function() {
        const value = $(this).val();
        if (value >= 0) {
            currentCheckNo = $('#checkNumberInput').val();
        }
    });

    $('#checkPrintLater').on('change', function() {
        if ($(this).is(':checked')) {
            $('#checkNumberInput').prop('disabled', true);
            $('#checkNumberInput').val('');
            $('#print_later').prop('checked', true).change();
        } else {
            $('#checkNumberInput').prop('disabled', false);
            $('#checkNumberInput').val(currentCheckNo).change();
            $('#print_later').prop('checked', false).change();
            $('#check_no').val(currentCheckNo).change();
        }
    });

    $('#checkDateInput').on('change', function() {
        const value = $(this).val();
        const dateParts = value.split('-');
        const padZero = (num) => (num < 10 ? `0${num}` : num);
        const formattedDate = `${padZero(parseInt(dateParts[1]))}/${padZero(parseInt(dateParts[2]))}/${dateParts[0]}`;
        $('#payment_date').val(formattedDate).change();
    });

    $('.checkPayeeSelect').on('change', function() {
        const selectedValue = $(this).val();
        const selectedText = $(this).find('option:selected').text();

        $('#payee').empty();
        const newOption = new Option(selectedText, selectedValue, true, true);
        $('#payee').append(newOption).trigger('change');
    });

    $('.checkBankNameSelect').on('change', function() {
        const selectedValue = $(this).val();
        const selectedText = $(this).find('option:selected').text();

        $('#bank_account').empty();
        const newOption = new Option(selectedText, selectedValue, true, true);
        $('#bank_account').append(newOption).trigger('change');
    });

    $('#checkMemoInput').on('input', function() {
        const value = $(this).val();
        $('#memo').val(value).change();
    });

    function numberToWords(amount) {
        const numbersToWords = (num) => {
            const ones = [
                "", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"
            ];
            const tens = [
                "", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"
            ];
            const teens = [
                "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"
            ];

            if (num < 10) return ones[num];
            if (num < 20) return teens[num - 10];
            if (num < 100) {
                return tens[Math.floor(num / 10)] + (num % 10 !== 0 ? " " + ones[num % 10] : "");
            }
            if (num < 1000) {
                return ones[Math.floor(num / 100)] + " Hundred" +
                    (num % 100 !== 0 ? " " + numbersToWords(num % 100) : "");
            }
            if (num < 1000000) {
                return numbersToWords(Math.floor(num / 1000)) + " Thousand" +
                    (num % 1000 !== 0 ? " " + numbersToWords(num % 1000) : "");
            }
            if (num < 1000000000) {
                return numbersToWords(Math.floor(num / 1000000)) + " Million" +
                    (num % 1000000 !== 0 ? " " + numbersToWords(num % 1000000) : "");
            }
            if (num < 1000000000000) {
                return numbersToWords(Math.floor(num / 1000000000)) + " Billion" +
                    (num % 1000000000 !== 0 ? " " + numbersToWords(num % 1000000000) : "");
            }
            return "Amount Too Large";
        };

        const dollars = Math.floor(amount);
        const cents = Math.round((amount - dollars) * 100);

        const dollarText = dollars > 0 ? numbersToWords(dollars) : "";
        const centText = cents > 0 ? `${cents}/100` : "";

        return dollarText + (dollars > 0 && cents > 0 ? " and " : "") + centText;
    }

    $('#checkAmountInput').on('input change', function() {
        const inputValue = parseFloat($(this).val());
        window.totalAmountInVirtualCheck = inputValue;
        if (!isNaN(inputValue)) {
            const writtenAmount = numberToWords(inputValue);
            $('#checkWrittenText').text(writtenAmount);
        } else {
            $('#checkWrittenText').text("{WRITTEN_AMOUNT}");
        }
    });

    $('input[name="options-outlined"]').on('click', function() {
        if ($('#standardCheck_toggle').is(':checked')) {
            // $('.categoryItemCollapsible').appendTo('.categoryItemSection');
            $('.standardCheckContent').fadeIn();
            $('.virtualCheckContent').hide();
        } else if ($('#virtualCheck_toggle').is(':checked')) {
            // $('.categoryItemCollapsible').appendTo('.virtualOtherDetails');
            $('.standardCheckContent').hide();
            $('.virtualCheckContent').fadeIn();
        }
    });

    // ====================================================

    $(function() {
        $('.btn-recent-checks-print').on('click', function() {
            $.get(base_url + 'accounting/get-other-modals/print_checks_modal', function(res) {
                if ($('div#modal-container').length > 0) {
                    $('div#modal-container').html(res);
                } else {
                    $('body').append(`
                        <div id="modal-container"> 
                            ${res}
                        </div>
                    `);
                }

                $(`#printChecksModal select`).each(function() {
                    var type = $(this).attr('id');
                    if (type === undefined) {
                        type = $(this).attr('name').replaceAll('[]', '').replaceAll('_', '-');
                    } else {
                        type = type.replaceAll('_', '-');

                        if (type.includes('transfer')) {
                            type = 'transfer-account';
                        }
                    }

                    if (type === 'payment-account') {
                        $(this).select2({
                            ajax: {
                                url: base_url + 'accounting/get-dropdown-choices',
                                dataType: 'json',
                                data: function(params) {
                                    var query = {
                                        search: params.term,
                                        type: 'public',
                                        field: type,
                                        modal: 'printChecksModal'
                                    }

                                    // Query parameters will be ?search=[term]&type=public&field=[type]
                                    return query;
                                }
                            },
                            templateResult: formatResult,
                            templateSelection: optionSelect,
                            dropdownParent: $('#printChecksModal')
                        });
                    } else {
                        $(this).select2({
                            minimumResultsForSearch: -1,
                            dropdownParent: $('#printChecksModal')
                        });
                    }
                });

                if ($(`#printChecksModal .dropdown`).length > 0) {
                    $(`#printChecksModal .dropdown-menu`).on('click', function(e) {
                        e.stopPropagation();
                    });
                }

                $('#printChecksModal').on('hidden.bs.modal', function() {
                    $('#modal-container').remove();
                    $('.modal-backdrop').remove();
                });

                $('#printChecksModal').modal('show');
            });
        })
    });
</script>