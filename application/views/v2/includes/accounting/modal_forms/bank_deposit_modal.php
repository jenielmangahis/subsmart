<!-- Modal for bank deposit-->
<div class="full-screen-modal">
<?php if(!isset($deposit)) : ?>
<form onsubmit="submitModalForm(event, this)" id="modal-form">
<?php else : ?>
<form onsubmit="updateTransaction(event, this)" id="modal-form" data-href="/accounting/update-transaction/deposit/<?=$deposit->id?>">
<?php endif; ?>
    <div id="depositModal" class="modal fade modal-fluid nsm-modal" role="dialog" data-bs-backdrop="false">
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
                                    <h5 class="dropdown-header">Recent Deposits</h5>
                                    <table class="nsm-table cursor-pointer recent-transactions-table" id="recent-deposits">
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                            &nbsp;
                            <span class="modal-title content-title">
                                Bank Deposit
                            </span>
                        </div>
                    </div>
                    <button type="button" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-fw bx-x m-0"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row" style="min-height: 100%">
                        <div class="col">
                            <div class="row bank-account-details">
                                <div class="col-12 col-md-8 grid-mb">
                                    <div class="row">
                                        <div class="col-12 col-md-3">
                                            <label for="bank_deposit_account">Account</label>
                                            <select name="bank_account" id="bank_deposit_account" class="form-control nsm-field" required>
                                                <?php if(isset($deposit)) : ?>
                                                <option value="<?=$account->id?>"><?=$account->name?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-3 d-flex ">
                                            <p style="align-self: flex-end; margin-bottom: 0px">Balance <span id="account-balance"><?= $balance ?></span></p>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label for="date">Date</label>
                                            <div class="nsm-field-group calendar">
                                                <input type="text" class="form-control nsm-field date" name="date" id="date" value="<?=!isset($deposit) ? date('m/d/Y') : ($deposit->date !== "" && !is_null($deposit->date) ? date("m/d/Y", strtotime($deposit->date)) : "")?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 text-end grid-mb">
                                    <h6>AMOUNT</h6>
                                    <h2>
                                        <span class="transaction-total-amount">
                                        <?php if(isset($deposit)) :
                                            $amount = '$'.number_format(floatval($deposit->total_amount), 2, '.', ',');
                                            $amount = str_replace('$-', '-$', $amount);
                                        ?>
                                        <?=$amount?>
                                        <?php else : ?>
                                        $0.00
                                        <?php endif; ?>
                                        </span>
                                    </h2>
                                </div>
                            </div>

                            <div class="row">
                                <?php if($is_copy) : ?>
                                <div class="col-12">
                                    <div class="nsm-callout primary">
                                        <button><i class='bx bx-x'></i></button>
                                        <h6 class="mt-0">This is a copy</h6>
                                        <span>This is a copy of a bank deposit. Revise as needed and save the bank deposit.</span>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6 grid-mb">
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
                                <div class="col-12">
                                    <div class="accordion grid-mb">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button content-title collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-nsmartrac-payments" aria-expanded="true" aria-controls="collapse-nsmartrac-payments">
                                                    nSmarTrac Payments
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse" id="collapse-nsmartrac-payments">
                                                <div class="accordion-body">
                                                    <p>These payments will be automatically added to a Deposit transaction when they settle</p>
                                                    <table class="nsm-table" id="nsmartrac-payments-table">
                                                        <thead>
                                                            <tr>
                                                                <td class="table-icon text-center">
                                                                    <input class="form-check-input select-all table-select" type="checkbox">
                                                                </td>
                                                                <td data-name="Received From">RECEIVED FROM</td>
                                                                <td data-name="Date">DATE</td>
                                                                <td data-name="Type">TYPE</td>
                                                                <td data-name="Payment Method">PAYMENT METHOD</td>
                                                                <td data-name="Memo">MEMO</td>
                                                                <td data-name="Ref No.">REF NO.</td>
                                                                <td data-name="Amount">AMOUNT</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="8">
                                                                    <div class="nsm-page-buttons page-buttons-container">
                                                                        <button type="button" class="nsm-button" data-target="#nsmartrac-payments-table">
                                                                            Select all
                                                                        </button>
                                                                        <button type="button" class="nsm-button" data-target="#nsmartrac-payments-table">
                                                                            Clear all
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

                                    <div class="accordion mb-2">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button content-title" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-deposit-funds" aria-expanded="true" aria-controls="collapse-deposit-funds">
                                                    Add funds to this deposit
                                                </button>
                                            </h2>
                                            <div class="accordion-collapse collapse show" id="collapse-deposit-funds">
                                                <div class="accordion-body">
                                                    <table class="nsm-table clickable" id="bank-deposit-table">
                                                        <thead>
                                                            <tr>
                                                                <td data-name="Num">#</td>
                                                                <td data-name="Received From">RECEIVED FROM</td>
                                                                <td data-name="Account">ACCOUNT</td>
                                                                <td data-name="Description">DESCRIPTION</td>
                                                                <td data-name="Payment Method">PAYMENT METHOD</td>
                                                                <td data-name="Ref no.">REF NO.</td>
                                                                <td data-name="Amount">AMOUNT</td>
                                                                <td data-name="Manage"></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>
                                                                    <select name="received_from[]" class="form-control nsm-field"></select>
                                                                </td>
                                                                <td>
                                                                    <select name="funds_account[]" class="form-control nsm-field" required></select>
                                                                </td>
                                                                <td><input type="text" name="description[]" class="form-control nsm-field"></td>
                                                                <td>
                                                                    <select name="payment_method[]" class="form-control nsm-field"></select>
                                                                </td>
                                                                <td><input type="text" name="reference_no[]" class="form-control nsm-field"></td>
                                                                <td><input type="number" name="amount[]" class="form-control nsm-field text-end" step=".01" onchange="convertToDecimal(this)" required></td>
                                                                <td>
                                                                    <button type="button" class="nsm-button delete-row">
                                                                        <i class='bx bx-fw bx-trash'></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                            <?php $count = 1; ?>
                                                            <?php if(isset($funds) && count($funds) > 0) : $fundsAmount = 0.00;?>
                                                                <?php foreach($funds as $fund) : $fundsAmount += floatval($fund->amount);?>
                                                                    <tr>
                                                                        <td><?=$count?></td>
                                                                        <td>
                                                                            <select name="received_from[]" class="form-control nsm-field">
                                                                                <option value="<?=$fund->received_from_key.'-'.$fund->received_from_id?>"><?=$fund->name?></option>
                                                                            </select>
                                                                        </td>
                                                                        <td>
                                                                            <select name="funds_account[]" class="form-control nsm-field" required>
                                                                                <option value="<?=$fund->account->id?>"><?=$fund->account->name?></option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="description[]" class="form-control nsm-field" value="<?=$fund->description?>"></td>
                                                                        <td>
                                                                            <select name="payment_method[]" class="form-control nsm-field">
                                                                                <option value="<?=$fund->payment_method?>"><?=$fund->payment->name?></option>
                                                                            </select>
                                                                        </td>
                                                                        <td><input type="text" name="reference_no[]" class="form-control nsm-field" value="<?=$fund->ref_no?>"></td>
                                                                        <td><input type="number" name="amount[]" value="<?=number_format(floatval($fund->amount), 2, '.', ',')?>" class="form-control nsm-field text-end" step=".01" onchange="updateBankDepositTotal(this)" required></td>
                                                                        <td>
                                                                            <button type="button" class="nsm-button delete-row">
                                                                                <i class='bx bx-fw bx-trash'></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $count++; ?>
                                                                <?php endforeach; ?>
                                                            <?php endif; ?>

                                                            <?php do {?>
                                                            <tr>
                                                                <td><?=$count?></td>
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
                                                            </tr>
                                                            <?php $count++; } while ($count <= 2) ?>
                                                            <tr>
                                                                <td>2</td>
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
                                                            </tr>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td colspan="8">
                                                                    <div class="nsm-page-buttons page-buttons-container">
                                                                        <button type="button" class="nsm-button" onclick="addTableLines(event)" data-target="#bank-deposit-table">
                                                                            Add lines
                                                                        </button>
                                                                        <button type="button" class="nsm-button" onclick="clearTableLines(event)" data-target="#bank-deposit-table">
                                                                            Clear all lines
                                                                        </button>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" value="1" name="track_returns_for_customers" id="track-returns-for-customers">
                                                                        <label for="track-returns-for-customers" class="form-check-label">Track returns for customers</label>
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
                            </div>

                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <label for="memo">Memo</label>
                                            <textarea name="memo" id="memo" class="form-control nsm-field mb-2"><?=isset($deposit) ? str_replace("<br />", "", $deposit->memo) : ''?></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="attachments">
                                                <label for="attachment" style="margin-right: 15px"><i class="bx bx-fw bx-paperclip"></i>&nbsp;Attachment</label> 
                                                <span>Maximum size: 20MB</span>
                                                <div id="bank-deposit-attachments" class="dropzone d-flex justify-content-center align-items-center" style="border: 1px solid #e1e2e3;background: #ffffff;width: 100%;">
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
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col-12 col-md-8 offset-md-4">
                                            <table class="nsm-table" id="bank-deposit-cashback">
                                                <tfoot>
                                                    <tr>
                                                        <td class="border-0">
                                                            <div class="row">
                                                                <div class="col-12 col-md-4">
                                                                    <label for="cashBackTarget">Cash back goes to</label>
                                                                    <select name="cash_back_account" id="cash_back_account" class="form-control nsm-field" required>
                                                                        <?php if(isset($deposit) && !is_null($cash_back_account)) : ?>
                                                                        <option value="<?=$cash_back_account->id?>"><?=$cash_back_account->name?></option>
                                                                        <?php endif; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <label for="cashBackMemo">Cash back memo</label>
                                                                    <textarea name="cash_back_memo" id="cashBackMemo" class="form-control nsm-field"><?=isset($deposit) ? $deposit->cash_back_memo : ''?></textarea>
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <label for="cashBackAmount">Cash back amount</label>
                                                                    <input type="number" name="cash_back_amount" value="<?=isset($deposit) && $deposit->cash_back_amount !== "0" ? number_format(floatval($deposit->cash_back_amount), 2, '.', ',') : ''?>" id="cashBackAmount" step=".01" onchange="convertToDecimal(this)" class="form-control nsm-field text-end">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-12 col-md-4"></div>
                                                                <div class="col-12 col-md-4 text-end">
                                                                    Total
                                                                </div>
                                                                <div class="col-12 col-md-4">
                                                                    <span class="float-end total-cash-back">
                                                                        <?php if(isset($deposit)) :
                                                                            $amount = '$'.number_format(floatval($deposit->total_amount), 2, '.', ',');
                                                                            $amount = str_replace('$-', '-$', $amount);
                                                                        ?>
                                                                        <?=$amount?>
                                                                        <?php else : ?>
                                                                        $0.00
                                                                        <?php endif; ?>
                                                                    </span>
                                                                </div>
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
                                    <span><a href="#" onclick="viewPrint(1, 'deposit-summary')" class="text-dark text-decoration-none">Print deposit summary</a></span>
                                    <span class="mx-3 divider"></span>
                                    <span><a href="#" onclick="makeRecurring('bank_deposit')" class="text-dark text-decoration-none">Make recurring</a></span>
                                    <?php if(isset($deposit)) : ?>
                                    <span class="mx-3 divider"></span>
                                    <span>
                                        <div class="dropup">
                                            <a href="#" class="text-dark text-decoration-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#" id="delete-deposit">Delete</a>
                                                <a class="dropdown-item" href="#">Transaction journal</a>
                                                <a class="dropdown-item" href="#">Audit history</a>
                                            </div>
                                        </div>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- Split dropup button -->
                            <div class="btn-group float-end" role="group">
                                <button type="button" class="nsm-button success" onclick="saveAndCloseForm(event)">
                                    Save and close
                                </button>
                                <div class="btn-group" role="group">
                                    <button type="button" class="nsm-button success dropdown-toggle" style="margin-left: 0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-fw bx-chevron-up text-white"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" onclick="saveAndNewForm(event)">Save and new</a>
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